<?php
$basePath = $_SERVER['DOCUMENT_ROOT'] . '/bengkel';
include_once $basePath . '/lib/config.php';
include_once $basePath . '/lib/fungsi.php';
?>

<!-- Modern Vehicle Selection Modal Content -->
<div class="modal-dialog modern-modal-dialog modal-compact">
    <div class="modal-content modern-modal-content">
            <div class="modal-header modern-modal-header">
                <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title modern-modal-title" id="modalChasisLabel">
                    <i class="fa fa-car"></i>
                    Pilih Kendaraan dari Inventory
                </h4>
            </div>

            <div class="modal-body modern-modal-body">

                <div class="modern-table-container">
                    <div class="table-responsive">
                        <table id="tableChasis" class="modern-table table table-hover">
                            <thead>
                                <tr>
                                    <th class="table-header-cell">
                                        <i class="fa fa-hashtag"></i>
                                        No Chasis
                                    </th>
                                    <th class="table-header-cell">
                                        <i class="fa fa-cogs"></i>
                                        No Mesin
                                    </th>
                                    <th class="table-header-cell">
                                        <i class="fa fa-id-card"></i>
                                        No Polisi
                                    </th>
                                    <th class="table-header-cell">
                                        <i class="fa fa-user"></i>
                                        Customer
                                    </th>
                                    <th class="table-header-cell">
                                        <i class="fa fa-palette"></i>
                                        Warna
                                    </th>
                                    <th class="table-header-cell text-center">
                                        <i class="fa fa-check"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j = 1;
                                $sqlcatat = "SELECT i.*, c.nama as nama, w.id_warna_kendaraan, w.nama as warna
                                            FROM t_inventory_bengkel i
                                            LEFT JOIN t_customer c ON i.fk_customer = c.id_customer
                                            LEFT JOIN t_warna_kendaraan w ON i.fk_warna_kendaraan = w.id_warna_kendaraan
                                            ORDER BY i.no_chasis ASC";
                                $rescatat = mysqli_query($objConn, $sqlcatat);

                                if (mysqli_num_rows($rescatat) > 0) {
                                    while ($catat = mysqli_fetch_array($rescatat)) {
                                ?>
                                    <tr class="table-row">
                                        <td class="table-cell">
                                            <span class="chasis-number"><?= htmlspecialchars($catat['no_chasis']); ?></span>
                                        </td>
                                        <td class="table-cell">
                                            <span class="engine-number"><?= htmlspecialchars($catat['no_mesin']); ?></span>
                                        </td>
                                        <td class="table-cell">
                                            <span class="police-number"><?= htmlspecialchars($catat['no_polisi']); ?></span>
                                        </td>
                                        <td class="table-cell">
                                            <div class="customer-info">
                                                <i class="fa fa-user-circle customer-avatar"></i>
                                                <span class="customer-name"><?= htmlspecialchars($catat['nama']); ?></span>
                                            </div>
                                        </td>
                                        <td class="table-cell">
                                            <div class="color-info">
                                                <div class="color-preview" style="background-color: <?= htmlspecialchars($catat['warna']); ?>;"></div>
                                                <span class="color-name"><?= htmlspecialchars($catat['warna']); ?></span>
                                            </div>
                                        </td>
                                        <td class="table-cell text-center">
                                            <button type="button" class="btn-modern btn-select"
                                                    onclick="selectChasis('<?= addslashes($catat['no_chasis']); ?>',
                                                                      '<?= addslashes($catat['no_mesin']); ?>',
                                                                      '<?= addslashes($catat['no_polisi']); ?>',
                                                                      '<?= $catat['id_warna_kendaraan']; ?>',
                                                                      '<?= addslashes($catat['warna']); ?>',
                                                                      '<?= $catat['fk_customer']; ?>')"
                                                    title="Pilih kendaraan ini">
                                                <i class="fa fa-check"></i>
                                                Pilih
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr class="empty-row">
                                        <td colspan="6" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fa fa-car fa-4x text-muted mb-3"></i>
                                                <h5 class="text-muted">Belum ada data kendaraan</h5>
                                                <p class="text-muted">Silakan tambahkan data kendaraan ke inventory terlebih dahulu</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
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
</div>

<!-- Modern JavaScript -->
<script>
// DataTables will be initialized by the parent modal system

function selectChasis(chasis, mesin, polisi, warnaId, warnaNama, customerId) {
    // Fill the form fields in parent modal
    $("#chasis").val(chasis);
    $("#mesin").val(mesin);
    $("#polisi").val(polisi);
    $("#warna").val(warnaId);
    $("#warnanm").val(warnaNama);
    $("#customer").val(customerId);

    // Close modal using simple Bootstrap method
    $("#ModalChasis").modal('hide');

    // Show success notification
    showNotification('Kendaraan berhasil dipilih: ' + chasis, 'success');
}

// Initialize DataTables when modal is loaded
$(document).ready(function() {
    console.log('Vehicle selection modal loaded');

    // Initialize DataTables
    $('#tableChasis').DataTable({
        "language": {
            "search": "Cari kendaraan...",
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data kendaraan yang ditemukan",
            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ kendaraan",
            "infoEmpty": "Tidak ada data kendaraan",
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
            $('.dataTables_filter input').attr('placeholder', 'Cari kendaraan...');
        }
    });
});
</script>

<!-- Modern Modal Styles - Clean Bootstrap Approach -->
<style>
/* Modal Specific Styles for Vehicle Selection */
.modern-modal-dialog.modal-compact {
    max-width: 950px;
    width: 95%;
    margin: 1.75rem auto;
}

.modern-modal-header {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
    border: none;
    padding: 1rem 1.5rem;
    border-radius: 12px 12px 0 0;
}

.modern-modal-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #17a2b8, #138496, #20c997);
}

.modern-modal-title {
    font-weight: 600;
    margin: 0;
    font-size: 1.25rem;
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
    background: white;
}

.modern-modal-body {
    padding: 1rem;
    background: #f8f9fa;
}

.modal-description {
    text-align: center;
    margin-bottom: 1.5rem;
}

.modal-description p {
    font-size: 1rem;
    color: #6c757d;
    margin: 0;
}

/* Modern Table Styles */
.modern-table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    margin-bottom: 1rem;
}

.modern-table {
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.modern-table thead th {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
    font-weight: 600;
    padding: 0.75rem 1rem;
    border: none;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    position: relative;
}

.modern-table thead th i {
    margin-right: 0.5rem;
    opacity: 0.9;
}

.table-row {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f1f3f4;
    cursor: pointer;
}

.table-row:hover {
    background-color: #f0f8ff;
    transform: scale(1.005);
    box-shadow: 0 2px 8px rgba(23, 162, 184, 0.1);
}

.table-cell {
    padding: 0.75rem 1rem;
    vertical-align: middle;
    border: none;
}

/* Data Element Styles */
.chasis-number, .engine-number {
    font-family: 'Courier New', monospace;
    background: #f8f9fa;
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-size: 0.8rem;
    border: 1px solid #e9ecef;
    font-weight: 600;
}

.police-number {
    font-weight: 600;
    color: #dc3545;
    background: rgba(220, 53, 69, 0.1);
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-size: 0.85rem;
}

.customer-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.customer-avatar {
    font-size: 1.2rem;
    color: #17a2b8;
}

.customer-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.9rem;
}

.color-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.color-preview {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid #e1e8ed;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    flex-shrink: 0;
}

.color-preview:hover {
    transform: scale(1.2);
}

.color-name {
    font-weight: 500;
    color: #2c3e50;
    font-size: 0.85rem;
}

/* Action Buttons */
.btn-modern {
    padding: 0.4rem 1rem;
    border: none;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.85rem;
    font-weight: 500;
}

.btn-select {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.btn-select:hover {
    background: linear-gradient(135deg, #218838, #1ea085);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    color: white;
}

/* Empty State */
.empty-state {
    padding: 3rem 1rem;
    text-align: center;
}

.empty-state i {
    margin-bottom: 1rem;
    opacity: 0.5;
    color: #17a2b8;
}

/* DataTables Custom Styles */
.dataTables_wrapper {
    padding: 0;
}

.dataTables_filter {
    margin-bottom: 0.75rem;
}

.dataTables_filter input {
    border: 2px solid #e1e8ed;
    border-radius: 20px;
    padding: 0.5rem 0.75rem 0.5rem 2rem;
    width: 250px;
    transition: all 0.3s ease;
    font-size: 0.85rem;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="%238b949e"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>') no-repeat 0.65rem center;
    background-size: 14px;
}

.dataTables_filter input:focus {
    outline: none;
    border-color: #17a2b8;
    box-shadow: 0 0 0 4px rgba(23, 162, 184, 0.1);
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
    color: #17a2b8;
    margin: 0 0.125rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.dataTables_paginate .page-link:hover {
    background: #17a2b8;
    color: white;
    border-color: #17a2b8;
}

.dataTables_paginate .page-item.active .page-link {
    background: linear-gradient(135deg, #17a2b8, #138496);
    border-color: #17a2b8;
}

/* DataTables Custom Styles */
.dataTables_wrapper {
    padding: 0;
}

.dataTables_filter {
    margin-bottom: 0.75rem;
}

.dataTables_filter input {
    border: 2px solid #e1e8ed;
    border-radius: 20px;
    padding: 0.5rem 0.75rem 0.5rem 2rem;
    width: 250px;
    transition: all 0.3s ease;
    font-size: 0.85rem;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="%238b949e"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>') no-repeat 0.65rem center;
    background-size: 14px;
}

.dataTables_filter input:focus {
    outline: none;
    border-color: #17a2b8;
    box-shadow: 0 0 0 4px rgba(23, 162, 184, 0.1);
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
    color: #17a2b8;
    margin: 0 0.125rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.dataTables_paginate .page-link:hover {
    background: #17a2b8;
    color: white;
    border-color: #17a2b8;
}

.dataTables_paginate .page-item.active .page-link {
    background: linear-gradient(135deg, #17a2b8, #138496);
    border-color: #17a2b8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-modal-dialog.modal-compact {
        margin: 1rem;
        width: calc(100% - 2rem);
    }

    .table-cell {
        padding: 0.75rem 0.5rem;
        font-size: 0.9rem;
    }

    .customer-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .color-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
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

    .dataTables_filter input {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .dataTables_length {
        margin-bottom: 0.5rem;
    }
}
</style>