<?php
$basePath = $_SERVER['DOCUMENT_ROOT'] . '/bengkel';
include_once $basePath . '/lib/config.php';
include_once $basePath . '/lib/fungsi.php';
?>

<!-- Modern Insurance Selection Modal Content -->
<div class="modal-dialog modern-modal-dialog modal-lg">
    <div class="modal-content modern-modal-content">
            <div class="modal-header modern-modal-header">
                <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title modern-modal-title" id="modalAsuransiLabel">
                    <i class="fa fa-shield-alt"></i>
                    Pilih Asuransi
                </h4>
            </div>

            <div class="modal-body modern-modal-body">
                <div class="modal-description">
                    <p class="text-muted mb-4">Silakan pilih perusahaan asuransi dari daftar berikut:</p>
                </div>

                <div class="modern-table-container">
                    <div class="table-responsive">
                        <table id="tableAsuransi" class="modern-table table table-hover">
                            <thead>
                                <tr>
                                    <th class="table-header-cell">
                                        <i class="fa fa-hashtag"></i>
                                        Kode Asuransi
                                    </th>
                                    <th class="table-header-cell">
                                        <i class="fa fa-building"></i>
                                        Nama Perusahaan
                                    </th>
                                    <th class="table-header-cell">
                                        <i class="fa fa-map-marker-alt"></i>
                                        Alamat
                                    </th>
                                    <th class="table-header-cell">
                                        <i class="fa fa-phone"></i>
                                        No. Telepon
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
                                $sqlcatat = "SELECT * FROM t_asuransi ORDER BY id_asuransi ASC";
                                $rescatat = mysqli_query($objConn, $sqlcatat);

                                if (mysqli_num_rows($rescatat) > 0) {
                                    while ($catat = mysqli_fetch_array($rescatat)) {
                                ?>
                                    <tr class="table-row">
                                        <td class="table-cell">
                                            <span class="insurance-code"><?= htmlspecialchars($catat['id_asuransi']); ?></span>
                                        </td>
                                        <td class="table-cell">
                                            <div class="insurance-info">
                                                <i class="fa fa-shield-alt insurance-icon"></i>
                                                <span class="insurance-name"><?= htmlspecialchars($catat['nama']); ?></span>
                                            </div>
                                        </td>
                                        <td class="table-cell">
                                            <div class="address-info">
                                                <i class="fa fa-map-marker-alt address-icon"></i>
                                                <span class="insurance-address"><?= htmlspecialchars($catat['alamat']); ?></span>
                                            </div>
                                        </td>
                                        <td class="table-cell">
                                            <div class="phone-info">
                                                <i class="fa fa-phone phone-icon"></i>
                                                <span class="insurance-phone"><?= htmlspecialchars($catat['no_telp']); ?></span>
                                            </div>
                                        </td>
                                        <td class="table-cell text-center">
                                            <button type="button" class="btn-modern btn-select"
                                                    onclick="pilihAsuransi('<?= $catat['id_asuransi']; ?>', '<?= addslashes($catat['nama']); ?>')"
                                                    title="Pilih asuransi ini">
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
                                        <td colspan="5" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fa fa-shield-alt fa-4x text-muted mb-3"></i>
                                                <h5 class="text-muted">Belum ada data asuransi</h5>
                                                <p class="text-muted">Silakan tambahkan data perusahaan asuransi terlebih dahulu</p>
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
// Initialize DataTables when modal is loaded
$(document).ready(function() {
    console.log('Insurance selection modal loaded');

    // Initialize DataTables
    $('#tableAsuransi').DataTable({
        "language": {
            "search": "Cari asuransi...",
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data asuransi yang ditemukan",
            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ asuransi",
            "infoEmpty": "Tidak ada data asuransi",
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
            $('.dataTables_filter input').attr('placeholder', 'Cari asuransi...');
        }
    });
});

function pilihAsuransi(id, nama) {
    // Fill the form fields in parent modal
    $("#asuransi").val(id);
    $("#asuransinm").val(nama);

    // Close modal using simple Bootstrap method
    $("#ModalAsuransi").modal('hide');

    // Show success notification
    showNotification('Asuransi berhasil dipilih: ' + nama, 'success');
}
</script>

<!-- Modern Modal Styles -->
<style>
/* Modal Specific Styles for Insurance Selection */
.modern-modal-dialog.modal-lg {
    max-width: 900px;
    width: 95%;
}

.modern-modal-header {
    background: linear-gradient(135deg, #fd7e14 0%, #e8590c 100%);
}

.modern-modal-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #fd7e14, #e8590c, #f39c12);
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
    background: linear-gradient(135deg, #fd7e14 0%, #e8590c 100%);
    color: white;
    font-weight: 600;
    padding: 1rem 1.25rem;
    border: none;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
    background-color: #fff5eb;
    transform: scale(1.005);
    box-shadow: 0 2px 8px rgba(253, 126, 20, 0.1);
}

.table-cell {
    padding: 1rem 1.25rem;
    vertical-align: middle;
    border: none;
}

/* Data Element Styles */
.insurance-code {
    font-family: 'Courier New', monospace;
    background: linear-gradient(135deg, #fd7e14, #e8590c);
    color: white;
    padding: 0.3rem 0.6rem;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
}

.insurance-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.insurance-icon {
    font-size: 1.25rem;
    color: #fd7e14;
}

.insurance-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
}

.address-info {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.address-icon {
    font-size: 1rem;
    color: #fd7e14;
    margin-top: 0.25rem;
    flex-shrink: 0;
}

.insurance-address {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.4;
    max-width: 250px;
}

.phone-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.phone-icon {
    font-size: 1rem;
    color: #fd7e14;
}

.insurance-phone {
    font-family: 'Courier New', monospace;
    font-weight: 600;
    color: #2c3e50;
    background: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    border: 1px solid #e9ecef;
}

/* Action Buttons */
.btn-modern {
    padding: 0.5rem 1.25rem;
    border: none;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
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
    color: #fd7e14;
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
    border-color: #fd7e14;
    box-shadow: 0 0 0 4px rgba(253, 126, 20, 0.1);
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
    color: #fd7e14;
    margin: 0 0.125rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.dataTables_paginate .page-link:hover {
    background: #fd7e14;
    color: white;
    border-color: #fd7e14;
}

.dataTables_paginate .page-item.active .page-link {
    background: linear-gradient(135deg, #fd7e14, #e8590c);
    border-color: #fd7e14;
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

    .insurance-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .address-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .insurance-address {
        max-width: 200px;
        font-size: 0.8rem;
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

    .insurance-name {
        font-size: 0.9rem;
    }

    .insurance-address {
        max-width: none;
        font-size: 0.8rem;
    }
}
</style>