<?php
include_once '../../lib/fungsi.php';
?>

<!-- Modern Panel Selection Modal -->
<div class="modal-dialog modern-modal-dialog modal-xl">
    <div class="modal-content modern-modal-content">
        <div class="modal-header modern-modal-header">
            <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title modern-modal-title" id="myModalLabel">
                <i class="fa fa-th-large"></i>
                Pilih Panel
            </h4>
        </div>

        <div class="modal-body modern-modal-body">
            <div class="panel-selection-container">
                <div class="table-header">
                    <div class="table-title">
                        <h5><i class="fa fa-list"></i> Daftar Panel Tersedia</h5>
                    </div>
                    <div class="table-info">
                        <span class="info-badge">
                            <i class="fa fa-info-circle"></i>
                            Klik "Pilih" untuk mengganti panel
                        </span>
                    </div>
                </div>

                <div class="modern-table-container">
                    <table id="panelestimasie" class="modern-table table table-hover">
                        <thead>
                            <tr>
                                <th class="table-header-cell">
                                    <i class="fa fa-tag"></i>
                                    Nama Panel
                                </th>
                                <th class="table-header-cell">
                                    <i class="fa fa-money-bill-wave"></i>
                                    Harga Pokok
                                </th>
                                <th class="table-header-cell">
                                    <i class="fa fa-tag"></i>
                                    Harga Jual
                                </th>
                                <th class="table-header-cell">
                                    <i class="fa fa-percentage"></i>
                                    Diskon
                                </th>
                                <th class="table-header-cell">
                                    <i class="fa fa-calculator"></i>
                                    Harga Total
                                </th>
                                <th class="table-header-cell text-center">
                                    <i class="fa fa-hand-pointer"></i>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Debug database connection
                            echo '<script>console.log("DEBUG: Checking database connection for panel_pilih_edit.php");</script>';

                            // Include database connection
                            include_once '../../lib/config.php';

                            $j = 1;
                            $sqlcatat = "SELECT * FROM t_panel ORDER BY id_panel ASC";
                            echo '<script>console.log("DEBUG: SQL Query: ' . $sqlcatat . '");</script>';

                            $rescatat = mysqli_query($objConn, $sqlcatat);

                            if (!$rescatat) {
                                echo '<script>console.log("DEBUG: MySQL Error: ' . mysqli_error($objConn) . '");</script>';
                                echo '<tr><td colspan="6" class="text-center">Error loading panel data. Please check database connection.</td></tr>';
                            } else {
                                $panelCount = mysqli_num_rows($rescatat);
                                echo '<script>console.log("DEBUG: Found ' . $panelCount . ' panels in database (edit)");</script>';

                                if ($panelCount == 0) {
                                    echo '<tr><td colspan="6" class="text-center">No panels found in database.</td></tr>';
                                } else {
                                    while ($catat = mysqli_fetch_array($rescatat)) {
                                        $diskon = ($catat['diskon'] / 100) * $catat['harga_jual'];
                                        $hartot = $catat['harga_jual'] - $diskon;
                                        echo '<script>console.log("DEBUG: Loading panel for edit: ' . addslashes($catat['nama']) . '");</script>';
                            ?>
                            <tr class="table-row">
                                <td class="table-cell">
                                    <div class="panel-info">
                                        <i class="fa fa-th-large panel-icon"></i>
                                        <span class="panel-name"><?php echo htmlspecialchars($catat['nama']); ?></span>
                                    </div>
                                </td>
                                <td class="table-cell">
                                    <span class="amount pokok-amount"><?php echo rupiah2($catat['harga_pokok']); ?></span>
                                </td>
                                <td class="table-cell">
                                    <span class="amount jual-amount"><?php echo rupiah2($catat['harga_jual']); ?></span>
                                </td>
                                <td class="table-cell">
                                    <span class="badge badge-discount"><?php echo $catat['diskon']; ?>%</span>
                                </td>
                                <td class="table-cell">
                                    <span class="amount total-amount"><?php echo rupiah2($hartot); ?></span>
                                </td>
                                <td class="table-cell text-center">
                                    <button type="button"
                                            class="btn btn-modern-primary btn-sm"
                                            onclick="pilihpaneledit('<?php echo $catat['id_panel']; ?>','<?php echo addslashes($catat['nama']); ?>','<?php echo $catat['harga_jual']; ?>','<?php echo $hartot; ?>','<?php echo $catat['diskon']; ?>');">
                                        <i class="fa fa-check"></i>
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal-footer modern-modal-footer">
            <div class="form-actions">
                <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modern JavaScript -->
<script>
$(document).ready(function() {
    // Initialize DataTables
    $('#panelestimasie').DataTable({
        "language": {
            "search": "Cari panel...",
            "lengthMenu": "Tampilkan _MENU_ panel per halaman",
            "zeroRecords": "Tidak ada data panel",
            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ panel",
            "infoEmpty": "Tidak ada data",
            "infoFiltered": "(disaring dari _MAX_ total data)",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        },
        "pageLength": 10,
        "responsive": true,
        "ordering": true,
        "searching": true,
        "info": true,
        "autoWidth": false,
        "initComplete": function(settings, json) {
            // Style the DataTables search input
            $('.dataTables_filter input').addClass('modern-search-input');
            $('.dataTables_filter input').attr('placeholder', 'Cari panel...');
        }
    });
});

function pilihpaneledit(a, b, c, d, e) {
    console.log('DEBUG: pilihpaneledit called with params:', a, b, c, d, e);
    console.log('DEBUG: ModalPilihPanelEdit element:', $('#ModalPilihPanelEdit'));
    console.log('DEBUG: ModalPilihPanelEdit length:', $('#ModalPilihPanelEdit').length);

    // Check if target elements exist before setting values
    console.log('DEBUG: #panele element exists:', $('#panele').length);
    console.log('DEBUG: #panelnme element exists:', $('#panelnme').length);
    console.log('DEBUG: #hargapokoke element exists:', $('#hargapokoke').length);
    console.log('DEBUG: #hargatotale element exists:', $('#hargatotale').length);
    console.log('DEBUG: #diskone element exists:', $('#diskone').length);

    try {
        $("#panele").val(a);
        console.log('DEBUG: Set panele value to:', a);

        $("#panelnme").val(b);
        console.log('DEBUG: Set panelnme value to:', b);

        $("#hargapokoke").val(c);
        console.log('DEBUG: Set hargapokoke value to:', c);

        $("#hargatotale").val(d);
        console.log('DEBUG: Set hargatotale value to:', d);

        $("#diskone").val(e);
        console.log('DEBUG: Set diskone value to:', e);

        // Trigger change event to recalculate totals
        console.log('DEBUG: Triggering change event on hargapokoke');
        $("#hargapokoke").trigger('change');

        console.log('DEBUG: Attempting to hide ModalPilihPanelEdit');
        $("#ModalPilihPanelEdit").modal('hide');

        console.log('DEBUG: Showing notification');
        showNotification('Panel berhasil dipilih', 'success');

    } catch (error) {
        console.error('DEBUG: Error in pilihpaneledit function:', error);
    }
}

// Debug: Check if modal exists on page load
$(document).ready(function() {
    console.log('DEBUG: panel_pilih_edit.php loaded');
    console.log('DEBUG: ModalPilihPanelEdit exists:', $('#ModalPilihPanelEdit').length > 0);
    console.log('DEBUG: ModalPilihPanelEdit content:', $('#ModalPilihPanelEdit').html());
});
</script>

<!-- Modern CSS Styles -->
<style>
/* Panel Selection Modal Styles */
.modern-modal-dialog.modal-xl {
    max-width: 1200px;
    width: 95%;
}

.modern-modal-header {
    background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
    color: white;
    border: none;
    padding: 1.5rem 2rem;
}

.modern-modal-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #6f42c1, #5a32a3, #e83e8c);
}

.modern-modal-title {
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: white;
}

.modern-close {
    color: white;
    opacity: 0.8;
    font-size: 1.5rem;
    transition: all 0.3s ease;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.modern-close:hover {
    opacity: 1;
    transform: rotate(90deg);
    background: rgba(255,255,255,0.1);
}

.modern-modal-content {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    overflow: hidden;
}

.modern-modal-body {
    padding: 2rem;
    background: #f8f9fa;
    max-height: 60vh;
    overflow-y: auto;
}

.modern-modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1.5rem 2rem;
    background: white;
    position: sticky;
    bottom: 0;
    z-index: 10;
}

/* Panel Selection Container */
.panel-selection-container {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e9ecef;
}

.table-title h5 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.table-title i {
    color: #6f42c1;
}

.info-badge {
    background: linear-gradient(135deg, #f3e5f5, #e1bee7);
    color: #8e24aa;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.modern-table {
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.modern-table thead th {
    background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
    color: white;
    font-weight: 600;
    padding: 1rem 1.25rem;
    border: none;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
}

.modern-table thead th:first-child {
    border-top-left-radius: 12px;
}

.modern-table thead th:last-child {
    border-top-right-radius: 12px;
}

.modern-table thead th i {
    margin-right: 0.5rem;
    opacity: 0.9;
}

.table-row {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f1f3f4;
}

.table-row:hover {
    background-color: #f8f5ff;
    transform: scale(1.005);
    box-shadow: 0 2px 8px rgba(111, 66, 193, 0.1);
}

.table-cell {
    padding: 1rem 1.25rem;
    vertical-align: middle;
    border: none;
}

.panel-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.panel-icon {
    font-size: 1.2rem;
    color: #6f42c1;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(111, 66, 193, 0.1);
    border-radius: 50%;
    flex-shrink: 0;
}

.panel-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
}

.amount {
    font-family: 'Courier New', monospace;
    font-weight: 600;
    font-size: 0.95rem;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
}

.pokok-amount {
    color: #6c757d;
    background: rgba(108, 117, 125, 0.05);
}

.jual-amount {
    color: #6f42c1;
    background: rgba(111, 66, 193, 0.05);
}

.total-amount {
    color: #28a745;
    background: rgba(40, 167, 69, 0.05);
}

.badge {
    padding: 0.25rem 0.75rem;
    font-weight: 500;
    border-radius: 20px;
    font-size: 0.875rem;
}

.badge-discount {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
}

.btn-modern-primary {
    background: linear-gradient(135deg, #6f42c1, #5a32a3);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.btn-modern-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(111, 66, 193, 0.3);
    color: white;
}

.btn-modern-secondary {
    background: #6c757d;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-modern-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
    color: white;
}

.text-center {
    text-align: center;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

/* DataTables Custom Styles */
.dataTables_wrapper {
    padding: 0;
}

.dataTables_filter {
    margin-bottom: 1rem;
}

.dataTables_filter input {
    border: 2px solid #e1e8ed;
    border-radius: 25px;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    width: 300px;
    transition: all 0.3s ease;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="%238b949e"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>') no-repeat 0.75rem center;
    background-size: 16px;
}

.dataTables_filter input:focus {
    outline: none;
    border-color: #6f42c1;
    box-shadow: 0 0 0 4px rgba(111, 66, 193, 0.1);
}

.dataTables_length select {
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    padding: 0.5rem;
    background: white;
    cursor: pointer;
}

.dataTables_info {
    color: #6c757d;
    font-size: 0.9rem;
    padding: 1rem 0;
}

.dataTables_paginate .pagination {
    margin: 0;
    justify-content: flex-end;
}

.dataTables_paginate .page-link {
    border: 2px solid #e1e8ed;
    color: #6f42c1;
    margin: 0 0.125rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.dataTables_paginate .page-link:hover {
    background: #6f42c1;
    color: white;
    border-color: #6f42c1;
}

.dataTables_paginate .page-item.active .page-link {
    background: linear-gradient(135deg, #6f42c1, #5a32a3);
    border-color: #6f42c1;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-modal-dialog.modal-xl {
        margin: 1rem;
        width: calc(100% - 2rem);
    }

    .table-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }

    .info-badge {
        justify-content: center;
    }

    .form-actions {
        flex-direction: column;
    }

    .form-actions .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .modern-modal-body {
        padding: 1.5rem;
    }

    .panel-selection-container {
        padding: 1rem;
    }

    .table-title h5 {
        font-size: 1rem;
    }

    .table-cell {
        padding: 0.75rem 0.5rem;
        font-size: 0.9rem;
    }

    .panel-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .panel-icon {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }

    .amount, .badge {
        font-size: 0.8rem;
    }

    .dataTables_filter input {
        width: 200px;
    }
}
</style>