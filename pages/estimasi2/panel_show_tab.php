<?php
include_once '../../lib/config.php';
include_once '../../lib/fungsi.php';
$idestimasi = $_GET['idestimasine'];
?>

<!-- Modern Panel Show Modal -->
<div class="modal-dialog modern-modal-dialog modal-lg">
    <div class="modal-content modern-modal-content">
        <div class="modal-header modern-modal-header">
            <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title modern-modal-title" id="myModalLabel">
                <i class="fa fa-th-large"></i>
                Detail Panel Estimasi
            </h4>
        </div>

        <div class="modal-body modern-modal-body">
            <!-- Panel Detail Table Section -->
            <div class="panel-detail-section">
                <div class="table-container">
                    <table id="estimasiPanelTable" class="modern-table table table-hover">
                        <thead>
                            <tr>
                                <th class="table-header-cell">
                                    <i class="fa fa-tag"></i>
                                    Nama Panel
                                </th>
                                <th class="table-header-cell">
                                    <i class="fa fa-money-bill-wave"></i>
                                    Harga
                                </th>
                                <th class="table-header-cell">
                                    <i class="fa fa-percentage"></i>
                                    Diskon
                                </th>
                                <th class="table-header-cell">
                                    <i class="fa fa-calculator"></i>
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $j = 1;
                            $sqlcatat = "SELECT * FROM t_estimasi_panel_detail pd
                                        LEFT JOIN t_panel p ON p.id_panel=pd.fk_panel
                                        WHERE fk_estimasi='$idestimasi' ORDER BY id ASC";
                            $rescatat = mysqli_query($objConn, $sqlcatat);
                            $totalGross = 0;
                            $totalDiscount = 0;
                            $totalNet = 0;

                            while($catat = mysqli_fetch_array($rescatat)) {
                                $markpanel = $catat['mark_panel'];
                                $totalGross += $catat['harga_jual_panel'];
                                $totalDiscount += $catat['harga_diskon_panel'];
                                $totalNet += $catat['harga_total_estimasi_panel'];
                            ?>
                            <tr class="table-row">
                                <td class="table-cell">
                                    <div class="panel-info">
                                        <i class="fa fa-th-large panel-icon"></i>
                                        <span class="panel-name">
                                            <?php echo htmlspecialchars($catat['nama']); ?>
                                            <?php if ($markpanel == '1'): ?>
                                                <span class="mark-indicator" title="Panel ditandai">*</span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="table-cell">
                                    <span class="amount gross-amount"><?php echo rupiah2($catat['harga_jual_panel']); ?></span>
                                </td>
                                <td class="table-cell">
                                    <span class="amount discount-amount"><?php echo rupiah2($catat['harga_diskon_panel']); ?></span>
                                </td>
                                <td class="table-cell">
                                    <span class="amount net-amount"><?php echo rupiah2($catat['harga_total_estimasi_panel']); ?></span>
                                </td>
                            </tr>
                            <?php } ?>

                            <!-- Total Row -->
                            <tr class="total-row">
                                <td class="table-cell">
                                    <div class="total-info">
                                        <i class="fa fa-calculator total-icon"></i>
                                        <span class="total-label">Total Panel</span>
                                    </div>
                                </td>
                                <td class="table-cell">
                                    <span class="total-amount gross-total"><?php echo rupiah2($totalGross); ?></span>
                                </td>
                                <td class="table-cell">
                                    <span class="total-amount discount-total"><?php echo rupiah2($totalDiscount); ?></span>
                                </td>
                                <td class="table-cell">
                                    <span class="total-amount net-total"><?php echo rupiah2($totalNet); ?></span>
                                </td>
                            </tr>
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
    // Initialize DataTables for the panel table
    $('#estimasiPanelTable').DataTable({
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
</script>

<!-- Modern CSS Styles -->
<style>
/* Panel Show Modal Styles */
.modern-modal-dialog.modal-lg {
    max-width: 1000px;
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
}

.modern-modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1.5rem 2rem;
    background: white;
}

/* Panel Detail Section */
.panel-detail-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.table-container {
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

.total-row {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    font-weight: 600;
    border-top: 2px solid #6f42c1;
}

.total-row:hover {
    background: linear-gradient(135deg, #e9ecef, #dee2e6);
    transform: scale(1.005);
    box-shadow: 0 2px 8px rgba(111, 66, 193, 0.15);
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

.mark-indicator {
    color: #e83e8c;
    font-weight: 700;
    font-size: 1.2rem;
    margin-left: 0.5rem;
}

.amount {
    font-family: 'Courier New', monospace;
    font-weight: 600;
    font-size: 0.95rem;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
}

.gross-amount {
    color: #007bff;
    background: rgba(0, 123, 255, 0.05);
}

.discount-amount {
    color: #dc3545;
    background: rgba(220, 53, 69, 0.05);
}

.net-amount {
    color: #28a745;
    background: rgba(40, 167, 69, 0.05);
}

.total-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.total-icon {
    font-size: 1.2rem;
    color: #6f42c1;
}

.total-label {
    font-weight: 700;
    color: #2c3e50;
    font-size: 1rem;
}

.total-amount {
    font-family: 'Courier New', monospace;
    font-weight: 700;
    font-size: 1.1rem;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
}

.gross-total {
    color: #007bff;
    background: rgba(0, 123, 255, 0.1);
}

.discount-total {
    color: #dc3545;
    background: rgba(220, 53, 69, 0.1);
}

.net-total {
    color: #28a745;
    background: rgba(40, 167, 69, 0.1);
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.2);
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
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
    .modern-modal-dialog.modal-lg {
        margin: 1rem;
        width: calc(100% - 2rem);
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

    .amount, .total-amount {
        font-size: 0.85rem;
        padding: 0.2rem 0.4rem;
    }

    .total-amount {
        font-size: 0.95rem;
        padding: 0.3rem 0.5rem;
    }

    .dataTables_filter input {
        width: 200px;
    }
}

@media (max-width: 480px) {
    .table-cell {
        padding: 0.5rem 0.25rem;
        font-size: 0.8rem;
    }

    .modern-table thead th {
        padding: 0.75rem 0.5rem;
        font-size: 0.8rem;
    }

    .modern-table thead th i {
        display: none;
    }

    .amount, .total-amount {
        font-size: 0.8rem;
    }

    .total-amount {
        font-size: 0.9rem;
    }

    .dataTables_filter input {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>