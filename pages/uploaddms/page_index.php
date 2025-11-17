<?php
// Start output buffering to capture any output
ob_start();

session_start();
include_once '../lib/sess.php';
include_once '../lib/config.php';
include_once '../lib/fungsi.php';

// Handle upload POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["test_file"])) {
    // Error reporting configuration
    error_reporting(0); // Disable error reporting for production
    try {
        // Check if file was actually uploaded
        if ($_FILES["test_file"]["error"] !== UPLOAD_ERR_OK) {
            throw new Exception("File upload error: " . $_FILES["test_file"]["error"]);
        }

        $file = $_FILES["test_file"];
        $fileName = $file["name"];
        $fileTmpPath = $file["tmp_name"];
        $fileSize = $file["size"];
        $fileType = $file["type"];

        // Additional validation
        if (!is_uploaded_file($fileTmpPath)) {
            throw new Exception("Invalid file upload");
        }

        // Validate file type (CSV)
        $allowedTypes = [
            "text/csv",
            "text/plain",
            "application/csv",
            "application/octet-stream"
        ];

        if (!in_array($fileType, $allowedTypes) && strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) !== "csv") {
            throw new Exception("Invalid file type. Please upload CSV file");
        }

        if ($fileSize > 5 * 1024 * 1024) {
            throw new Exception("File size too large. Maximum size is 5MB");
        }

        // Read CSV file with improved parsing and encoding handling
        $csvData = [];

        // Read entire file content first
        $fileContent = file_get_contents($fileTmpPath);
        if ($fileContent === false) {
            throw new Exception("Cannot read uploaded file");
        }

        // Convert line endings and remove BOM if present
        $fileContent = str_replace("\r\n", "\n", $fileContent);
        $fileContent = str_replace("\r", "\n", $fileContent);
        $fileContent = preg_replace('/^\xEF\xBB\xBF/', '', $fileContent);

        // Split into lines
        $lines = explode("\n", trim($fileContent));

        if (empty($lines)) {
            throw new Exception("CSV file appears to be empty");
        }

        // Try to detect delimiter from header
        $headerLine = $lines[0];
        $delimiter = ",";

        // Count delimiters in header to detect correct one
        $commaCount = substr_count($headerLine, ',');
        $semicolonCount = substr_count($headerLine, ';');
        $tabCount = substr_count($headerLine, "\t");
        $pipeCount = substr_count($headerLine, '|');

        if ($semicolonCount > $commaCount && $semicolonCount >= 4) {
            $delimiter = ";";
        } elseif ($tabCount > $commaCount && $tabCount >= 4) {
            $delimiter = "\t";
        } elseif ($pipeCount > $commaCount && $pipeCount >= 4) {
            $delimiter = "|";
        }

        // Parse CSV lines with smart decimal handling
        $row = 0;
        foreach ($lines as $line) {
            if (empty(trim($line))) continue;

            // Parse using str_getcsv for better control
            $data = str_getcsv($line, $delimiter, '"');

            
            if ($row == 0) {
                // Header validation
                if (count($data) < 5) {
                    // Fallback: try manual parsing
                    $manualData = explode($delimiter, $line);

                    if (count($manualData) >= 5) {
                        $data = $manualData;
                    } else {
                        $foundCols = count($data);
                        $headerPreview = implode(", ", array_slice($data, 0, 3));
                        throw new Exception("CSV format error: Found only $foundCols columns but expected 5 columns. Header preview: $headerPreview. Try downloading a fresh template or check your CSV format.");
                    }
                }
                $row++;
                continue;
            }

            // Special handling for jml_panel with comma as decimal separator
            if (count($data) >= 6) {
                // Check if we have too many columns (possible comma in jml_panel)
                if (count($data) > 6) {
                    // Reconstruct jml_panel and harga_panel properly
                    $reconstructed_data = array_slice($data, 0, 4); // Keep first 4 columns

                    // Find and merge the remaining columns for jml_panel (columns 4 and 5)
                    $remaining_columns = array_slice($data, 4);

                    // Combine columns 4 and 5 for jml_panel (in case of comma decimal)
                    $jml_panel_part1 = isset($remaining_columns[0]) ? $remaining_columns[0] : '';
                    $jml_panel_part2 = isset($remaining_columns[1]) ? $remaining_columns[1] : '';

                    // If we have more columns, jml_panel uses comma decimal
                    if (count($remaining_columns) > 2) {
                        $jml_panel = $jml_panel_part1 . ',' . $jml_panel_part2;
                        $harga_panel_index = 6;
                    } else {
                        $jml_panel = $jml_panel_part1;
                        $harga_panel_index = 5;
                    }

                    $reconstructed_data[] = $jml_panel;

                    // Get harga_panel
                    if ($harga_panel_index < count($data)) {
                        $reconstructed_data[] = $data[$harga_panel_index];
                    }

                    $data = $reconstructed_data;
                }
            }

            // Add data rows
            if (!empty(array_filter($data))) {
                // If still not enough columns, try manual parsing
                if (count($data) < 5) {
                    $manualData = explode($delimiter, $line);
                    if (count($manualData) >= 5) {
                        $data = $manualData;
                    }
                }
                $csvData[] = $data;
            }
            $row++;
        }

        if (empty($csvData)) {
            throw new Exception("No data found in CSV file. Please ensure your file has data rows below the header.");
        }

        $insertedCount = 0;
        $errorRows = [];

        // Check database connection
        if (!$objConn) {
            throw new Exception("Database connection failed");
        }

        foreach ($csvData as $index => $rowData) {
            try {
                // Flexible column validation - pad missing columns with empty values
                while (count($rowData) < 6) {
                    $rowData[] = "";
                }

                  // Extract data (matching CSV template: NOPKB, Tgl PKB, Unit, Nopol, Jml Panel, Harga Panel)
                $nopkb_raw = trim(isset($rowData[0]) ? $rowData[0] : "");

                // Transform NOPKB: Add "PKB_" prefix if not already present
                if (strpos($nopkb_raw, 'PKB_') !== 0) {
                    $nopkb = 'PKB_' . $nopkb_raw;
                } else {
                    $nopkb = $nopkb_raw;
                }

                $tgl_pkb = trim(isset($rowData[1]) ? $rowData[1] : "");
                $unit = trim(isset($rowData[2]) ? $rowData[2] : "");
                $nopol = trim(isset($rowData[3]) ? $rowData[3] : "");

                // Better decimal handling for jml_panel
                $jml_panel_raw = trim(isset($rowData[4]) ? $rowData[4] : "");

                
                // Try multiple approaches to convert to float
                $jml_panel = 0;
                if (!empty($jml_panel_raw)) {
                    // Remove any commas (Indonesian number format)
                    $jml_panel_clean = str_replace(',', '', $jml_panel_raw);
                    $jml_panel = floatval($jml_panel_clean);

                  }

                // Handle harga_panel
                $harga_panel_raw = trim(isset($rowData[5]) ? $rowData[5] : "");
                $harga_panel = is_numeric($harga_panel_raw) ? intval($harga_panel_raw) : 0;


                // Validate required fields
                if (empty($nopkb) || empty($unit)) {
                    $errorRows[] = "Row " . ($index + 2) . ": NOPKB and Unit are required";
                    continue;
                }

                // Validate and format date
                $tgl_pkb_date = "NULL";
                if (!empty($tgl_pkb)) {
                    $date = DateTime::createFromFormat("d/m/Y", $tgl_pkb);
                    if ($date) {
                        $tgl_pkb_date = "'" . $date->format("Y-m-d") . "'";
                    } else {
                        $date = DateTime::createFromFormat("Y-m-d", $tgl_pkb);
                        $tgl_pkb_date = $date ? "'" . $date->format("Y-m-d") . "'" : "NULL";
                    }
                }

                // Clean data for security
                $nopkb_clean = mysqli_real_escape_string($objConn, $nopkb);
                $unit_clean = mysqli_real_escape_string($objConn, $unit);
                $nopol_clean = mysqli_real_escape_string($objConn, $nopol);
                $jml_panel_clean = floatval($jml_panel);
                $harga_panel_clean = intval($harga_panel);

                // Build INSERT query with proper escaping
                $sql = "INSERT INTO t_dms (nopkb, unit, nopol, jml_panel, harga_panel, tgl_pkb, tgl_insert)
                        VALUES ('$nopkb_clean', '$unit_clean', '$nopol_clean', $jml_panel_clean, $harga_panel_clean, $tgl_pkb_date, NOW())";

  
                $result = mysqli_query($objConn, $sql);
                if (!$result) {
                    throw new Exception("Database error: " . mysqli_error($objConn) . " Query: " . $sql);
                }

                $insertedCount++;

            } catch (Exception $e) {
                $errorRows[] = "Row " . ($index + 2) . ": " . $e->getMessage();
            }
        }

        if (!empty($errorRows)) {
            $_SESSION["error"] = "Upload completed with some errors: " . implode("; ", $errorRows) . ". $insertedCount records inserted successfully.";
        } else {
            $_SESSION["success"] = "Successfully uploaded $insertedCount records to database.";
        }

  
    } catch (Exception $e) {
        $_SESSION["error"] = "Error processing file: " . $e->getMessage();
    }

    // Clean output buffer and redirect
    ob_end_clean();

    if (!headers_sent()) {
        header("Location: index.php?p=uploaddms");
        exit();
    } else {
        // Fallback to JavaScript if headers still sent
        echo "<script>window.location.href = 'index.php?p=uploaddms';</script>";
        exit();
    }
}

// Clean output buffer for normal page display
if (ob_get_length()) ob_end_clean();
?>

<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h2><i class="fa fa-upload"></i> Upload Data DMS</h2>
      <div class="breadcrumb">
        <a href="index.php"><i class="fa fa-home"></i> Home</a>
        <span class="separator">/</span>
        <a href="#">Finance</a>
        <span class="separator">/</span>
        <span class="current">Upload Data DMS</span>
      </div>
    </div>
  </div>
</div>

  <div class="page-content">
  <div class="container-fluid">
    <?php if (isset($_SESSION["success"])): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            <?php echo $_SESSION["success"]; unset($_SESSION["success"]); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION["error"])): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            <?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?>
        </div>
    <?php endif; ?>

    <div class="row">
      <!-- Upload Form -->
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-upload"></i> Upload CSV File</h3>
          </div>
          <div class="box-body">
            <form method="POST" enctype="multipart/form-data" id="uploadForm">
              <div class="form-group">
                <label for="test_file">Pilih File CSV</label>
                <input type="file" class="form-control" id="test_file" name="test_file"
                       accept=".csv" required>
                <p class="help-block"><strong>Format:</strong> File CSV dengan koma (,) sebagai pemisah (Max size: 5MB).<br>
    <strong>Kolom:</strong> NOPKB, Unit, Nopol, Jml Panel, Harga Panel, Tgl PKB<br>
    <strong>Penting:</strong> Gunakan template download untuk format yang benar</p>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary btn-block" id="uploadBtn">
                    <i class="fa fa-upload"></i> Upload Data
                  </button>
                </div>
                <div class="col-md-6">
                  <a href="uploaddms/download_csv_template.php" class="btn btn-default btn-block">
                    <i class="fa fa-download"></i> Download Template
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info-circle"></i> Petunjuk</h3>
          </div>
          <div class="box-body">
            <ol>
              <li>Download template CSV terlebih dahulu</li>
              <li>Isi data Anda sesuai format template</li>
              <li>Simpan sebagai file CSV</li>
              <li>Upload file yang sudah diisi</li>
            </ol>
            <hr>
            <p><strong>Keterangan Kolom:</strong></p>
            <ul>
              <li><strong>NOPKB:</strong> Nomor PKB (Wajib)</li>
              <li><strong>Unit:</strong> Jenis/Nama unit kendaraan (Wajib)</li>
              <li><strong>Nopol:</strong> Nomor polisi (Opsional)</li>
              <li><strong>Jml Panel:</strong> Jumlah panel (Angka, desimal diperbolehkan: 1.5, 2.75)</li>
              <li><strong>Harga Panel:</strong> Harga per panel (Angka saja)</li>
              <li><strong>Tgl PKB:</strong> Tanggal PKB (Format: DD/MM/YYYY, Opsional)</li>
            </ul>
            <p class="text-muted"><small>Catatan: Versi ini menggunakan format CSV yang kompatibel dengan Ubuntu 14.04</small></p>
          </div>
        </div>
      </div>

   
  </div>
</div>

<script>
$(document).ready(function() {
    console.log("page loaded successfully");

    // File validation
    $('#test_file').on('change', function() {
        const fileName = $(this).val();
        const fileExt = fileName.split('.').pop().toLowerCase();

        if (fileExt !== 'csv') {
            alert('Harap pilih file CSV');
            $(this).val('');
            return;
        }

        const fileSize = this.files[0]?.size || 0;
        if (fileSize > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 5MB');
            $(this).val('');
            return;
        }
    });

    // Form submission with loading and validation
    $('#uploadForm').on('submit', function(e) {
        const fileInput = $('#test_file');
        const submitBtn = $('#uploadBtn');

        // Validate file is selected
        if (!fileInput.val()) {
            alert('Please select a CSV file to upload');
            return false;
        }

        // Show loading state
        submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        submitBtn.prop('disabled', true);

        // Allow form to submit normally
        return true;
    });

    // Initialize DataTable for recent uploads
    if ($('#recentTable').length) {
        $('#recentTable').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    }
});
</script>

<style type="text/css">
  .title-header {
    font-size: 20px;
    text-align: center;
    font-weight: bold;
    font-family: monospace;
  }

  /* Modern Page Header Styles */
  .page-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #dee2e6;
    padding: 1.5rem 0;
    margin-bottom: 2rem;
  }

  .page-header-content {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
  }

  .page-title h2 {
    color: #495057;
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .page-title h2 i {
    color: #1585c3;
  }

  .breadcrumb {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: #6c757d;
  }

  .breadcrumb a {
    color: #1585c3;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .breadcrumb a:hover {
    color: #0f6fa0;
    text-decoration: underline;
  }

  .separator {
    margin: 0 0.75rem;
    color: #adb5bd;
  }

  .current {
    color: #495057;
    font-weight: 500;
  }

  /* Modern Page Content Styles */
  .page-content {
    flex: 1;
    padding: 0 1rem 2rem;
  }

  .page-content .container-fluid {
    max-width: 1400px;
    margin: 0 auto;
  }

  /* Modern Box Styles */
  .box {
    background: white;
    border: 1px solid #e3e6f0;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
  }

  .box-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e3e6f0;
    background: #f8f9fc;
    border-radius: 8px 8px 0 0;
  }

  .box-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #495057;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .box-title i {
    color: #1585c3;
  }

  .box-body {
    padding: 1.5rem;
  }

  /* Modern Form Styles */
  .form-group label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
  }

  .form-control {
    border: 1px solid #ced4da;
    border-radius: 6px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  .form-control:focus {
    border-color: #1585c3;
    box-shadow: 0 0 0 0.2rem rgba(21, 133, 195, 0.25);
  }

  .btn {
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .btn-primary {
    background: linear-gradient(135deg, #1585c3 0%, #0f6fa0 100%);
    border: none;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #0f6fa0 0%, #0a5a8a 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(21, 133, 195, 0.3);
  }

  .btn-default {
    background: #6c757d;
    border: none;
  }

  .btn-default:hover {
    background: #5a6268;
    transform: translateY(-1px);
  }

  /* Modern Alert Styles */
  .alert {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
  }

  .alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
  }

  /* Modern Table Styles */
  .table-responsive {
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .table {
    margin-bottom: 0;
  }

  .table thead th {
    background: #f8f9fc;
    border-bottom: 2px solid #e3e6f0;
    color: #495057;
    font-weight: 600;
    border-top: none;
  }

  .table tbody tr:hover {
    background-color: #f8f9fc;
  }

  /* Statistics Styles */
  .text-blue {
    color: #1585c3 !important;
    font-weight: 600;
  }

  .text-green {
    color: #28a745 !important;
    font-weight: 600;
  }

  .text-red {
    color: #dc3545 !important;
    font-weight: 600;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .page-header {
      padding: 1rem 0;
    }

    .page-title h2 {
      font-size: 1.5rem;
    }

    .breadcrumb {
      font-size: 0.8rem;
    }

    .box-body {
      padding: 1rem;
    }
  }
</style>