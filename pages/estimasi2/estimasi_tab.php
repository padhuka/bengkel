  <!-- Modern Content Wrapper -->
<div class="modern-content-wrapper">
    <!-- Modern Page Header -->
    <section class="modern-page-header">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="page-title-section">
                    <h1 class="page-title">
                        <i class="fa fa-calculator"></i>
                        Data Estimasi
                    </h1>
                    <p class="page-subtitle">Kelola estimasi perbaikan kendaraan</p>
                </div>
                <div class="page-actions">
                    <button type="button" class="btn btn-modern-primary btn-add-estimasi" id="addEstimasiBtn" onclick="handleAddEstimasiClick()">
                        <i class="fa fa-plus"></i>
                        Tambah Estimasi
                    </button>
                </div>
            </div>
            <nav class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Data Estimasi</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Modern Main Content -->
    <section class="modern-content">
        <div class="container-fluid">
            <!-- Modern Table Section -->
            <div class="modern-table-section">
                <div class="table-header">
                    <div class="table-title">
                        <h2><i class="fa fa-list"></i> Daftar Estimasi</h2>
                    </div>
                    <div class="table-controls">
                        <div class="table-actions">
                            <button type="button" class="btn btn-modern-secondary btn-refresh" id="refreshTable">
                                <i class="fa fa-refresh"></i>
                                Refresh
                            </button>
                            <button type="button" class="btn btn-modern-success btn-export" id="exportTable">
                                <i class="fa fa-download"></i>
                                Export
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <div id="tableestimasi" class="modern-table-wrapper">
                        <!-- Table will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modern Modal Containers - Clean Inventory Approach -->
<div id="ModalAdd" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true"></div>
<div id="ModalShow" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalShowLabel" aria-hidden="true"></div>
<div id="ModalEdit" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true"></div>
<div id="ModalDelete" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true"></div>
<div id="ModalEstimasiDet" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalEstimasiDetLabel" aria-hidden="true"></div>
<div id="ModalEstPrint" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalEstPrintLabel" aria-hidden="true"></div>
<div id="ModalApproved" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalApprovedLabel" aria-hidden="true"></div>
<div id="ModalChasis" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalChasisLabel" aria-hidden="true"></div>
<div id="ModalAsuransi" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAsuransiLabel" aria-hidden="true"></div>

<!-- Modern JavaScript - Clean Inventory Approach -->
<script type="text/javascript">
$(document).ready(function (){
    // Load initial table
    $("#tableestimasi").load('estimasi/estimasi_load.php');

    // Add estimasi button click
    $("#addEstimasiBtn").click(function(){
        $.ajax({
            url: "estimasi/estimasi_add.php",
            type: "GET",
            success: function (ajaxData){
                $("#ModalAdd").html(ajaxData);
                $("#ModalAdd").modal({backdrop: 'static', keyboard: false});

                // Ensure table styling is preserved after modal load
                setTimeout(function(){
                    $('.modern-table-container').css('z-index', '1');
                }, 100);
            },
            error: function(){
                showNotification('Terjadi kesalahan saat memuat form tambah', 'error');
            }
        });
    });

    // Refresh table
    $("#refreshTable").click(function(){
        $("#tableestimasi").load('estimasi/estimasi_load.php');
        showNotification('Data berhasil diperbarui', 'success');
    });

    // Export table (placeholder function)
    $("#exportTable").click(function(){
        showNotification('Fitur export akan segera tersedia', 'info');
    });
});

// Modal event handlers to preserve table styling
$(document).on('hidden.bs.modal', '.modal', function () {
    // Ensure table styling is restored when modal is closed
    setTimeout(function(){
        $('.modern-table-container').css('z-index', '1');
        $('.modern-table thead th').css({
            'background': 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            'color': 'white'
        });
    }, 100);
});

// Show notification function
function showNotification(message, type){
    var notification = $('<div class="modern-notification notification-' + type + '">' +
        '<i class="fa fa-' + (type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : type === 'error' ? 'exclamation-circle' : 'info-circle') + '"></i>' +
        '<span>' + message + '</span>' +
        '</div>');

    $('body').append(notification);
    notification.fadeIn(300);

    setTimeout(function(){
        notification.fadeOut(300, function(){
            $(this).remove();
        });
    }, 3000);
}
</script>

<!-- Modern Responsive CSS - Clean Inventory Approach -->
<style>
/* Modern Estimasi Page Styles */
.modern-content-wrapper {
    background: #f8f9fa;
    min-height: 100vh;
}

/* Modern Page Header */
.modern-page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.page-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.page-title-section h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.page-subtitle {
    margin: 0.5rem 0 0 0;
    opacity: 0.9;
    font-size: 1rem;
}

.page-actions {
    display: flex;
    gap: 1rem;
}

.breadcrumb-nav {
    background: rgba(255,255,255,0.1);
    padding: 0.75rem 0;
    border-radius: 8px;
}

.breadcrumb {
    margin: 0;
    background: none;
    padding: 0;
}

.breadcrumb li a {
    color: rgba(255,255,255,0.9);
    text-decoration: none;
}

.breadcrumb li a:hover {
    color: white;
}

.breadcrumb .active {
    color: white;
    font-weight: 500;
}

/* Modern Table Section */
.modern-table-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    flex-wrap: wrap;
    gap: 1rem;
}

.table-title h2 {
    margin: 0;
    font-size: 1.5rem;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.table-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.table-actions {
    display: flex;
    gap: 0.5rem;
}

.table-container {
    padding: 1.5rem;
}

.modern-table-wrapper {
    overflow-x: auto;
}

/* Modern Buttons */
.btn-modern-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
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

.btn-modern-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-modern-secondary {
    background: #6c757d;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-modern-secondary:hover {
    background: #5a6268;
    color: white;
}

.btn-modern-success {
    background: #28a745;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-modern-success:hover {
    background: #218838;
    color: white;
}

/* Modern Modal Styles */
.modern-modal .modal-dialog {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
}

.modern-modal .modal-content {
    border: none;
    border-radius: 12px;
}

.modern-modal .modal-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 1.5rem;
}

.modern-modal .modal-title {
    font-weight: 600;
    margin: 0;
}

.modern-modal .modal-body {
    padding: 2rem;
}

.modern-modal .modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1.5rem;
}

/* Modern Notifications */
.modern-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    z-index: 9999;
    max-width: 300px;
}

.notification-success {
    border-left: 4px solid #28a745;
    color: #28a745;
}

.notification-info {
    border-left: 4px solid #17a2b8;
    color: #17a2b8;
}

.notification-warning {
    border-left: 4px solid #ffc107;
    color: #856404;
}

.notification-error {
    border-left: 4px solid #dc3545;
    color: #dc3545;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .page-title-section h1 {
        font-size: 1.5rem;
    }

    .table-header {
        flex-direction: column;
        align-items: stretch;
    }

    .table-controls {
        flex-direction: column;
        align-items: stretch;
    }

    .table-actions {
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .modern-page-header {
        padding: 1.5rem 0;
    }

    .container-fluid {
        padding: 0 1rem;
    }

    .table-container {
        padding: 1rem;
    }
}

/* Hide original AdminLTE elements */
.content-wrapper {
    display: none;
}

/* Ensure table styling is preserved when modals are open */
.modern-table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    position: relative;
    z-index: 1;
}

.modern-table {
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.modern-table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    background-color: #f8f9ff;
    transform: scale(1.005);
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
}

.table-cell {
    padding: 1rem 1.25rem;
    vertical-align: middle;
    border: none;
}

/* Prevent modal backdrop from affecting table */
.modal-backdrop {
    z-index: 1040;
}

.modal {
    z-index: 1050;
}

/* Ensure table colors remain consistent */
.customer-name {
    font-weight: 600;
    color: #2c3e50;
}

.chasis-number, .engine-number {
    font-family: 'Courier New', monospace;
    background: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.9rem;
}

.police-number {
    font-weight: 500;
    color: #e74c3c;
    background: rgba(231, 76, 60, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
}

.stnk-name {
    color: #2c3e50;
}

.vehicle-type {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}
</style>