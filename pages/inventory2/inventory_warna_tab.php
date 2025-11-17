<!-- Modern Vehicle Color Selection Modal -->
<div id="ModalWarna" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-labelledby="modalWarnaLabel" aria-hidden="true">
    <div class="modal-dialog modern-modal-dialog modal-lg">
        <div class="modal-content modern-modal-content">
            <div class="modal-header modern-modal-header">
                <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title modern-modal-title" id="modalWarnaLabel">
                    <i class="fa fa-palette"></i>
                    Pilih Warna Kendaraan
                </h4>
            </div>

            <div class="modal-body modern-modal-body">
                <div class="modal-description">
                    <p class="text-muted mb-4">Silakan pilih warna kendaraan dari daftar berikut:</p>
                </div>

                <div class="modern-table-container">
                    <div class="table-responsive">
                        <table id="warna1" class="modern-table table table-hover">
                            <thead>
                                <tr>
                                    <th class="table-header-cell">
                                        <i class="fa fa-hashtag"></i>
                                        Kode Warna
                                    </th>
                                    <th class="table-header-cell">
                                        <i class="fa fa-paint-brush"></i>
                                        Nama Warna
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
                                $sqlcatat = "SELECT * FROM t_warna_kendaraan ORDER BY id_warna_kendaraan ASC";
                                $rescatat = mysqli_query($objConn, $sqlcatat);

                                if (mysqli_num_rows($rescatat) > 0) {
                                    while($catat = mysqli_fetch_array($rescatat)){
                                ?>
                                    <tr class="table-row">
                                        <td class="table-cell">
                                            <div class="cell-content">
                                                <span class="color-code"><?php echo htmlspecialchars($catat['id_warna_kendaraan']); ?></span>
                                            </div>
                                        </td>
                                        <td class="table-cell">
                                            <div class="cell-content">
                                                <span class="color-name"><?php echo htmlspecialchars($catat['nama']); ?></span>
                                                <div class="color-preview" style="background-color: <?php echo htmlspecialchars($catat['nama']); ?>;"></div>
                                            </div>
                                        </td>
                                        <td class="table-cell">
                                            <div class="action-buttons">
                                                <button type="button" class="btn-modern btn-select"
                                                        onclick="pilihwarna('<?php echo $catat['id_warna_kendaraan']; ?>','<?php echo addslashes($catat['nama']); ?>');"
                                                        title="Pilih warna ini">
                                                    <i class="fa fa-check"></i>
                                                    Pilih
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr class="empty-row">
                                        <td colspan="3" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="fa fa-palette fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">Belum ada data warna kendaraan</h5>
                                                <p class="text-muted">Silakan tambahkan warna kendaraan terlebih dahulu</p>
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
                    <button type="button" class="btn btn-modern-secondary btn-cancel" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern JavaScript -->
<script type="text/javascript">
$(document).ready(function(){
    // Initialize modern DataTable for vehicle colors
    $('#warna1').DataTable({
        "language": {
            "search": "Cari warna kendaraan...",
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data warna kendaraan",
            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ warna",
            "infoEmpty": "Tidak ada data warna kendaraan",
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
        "dom": '<"top"<"table-controls"f>>rt<"bottom"<"table-info"i><"table-pagination"p>>',
        "initComplete": function(settings, json) {
            // Style the DataTables search input
            $('.dataTables_filter input').addClass('modern-search-input');
            $('.dataTables_filter input').attr('placeholder', 'Cari warna kendaraan...');
        }
    });
});

function pilihwarna(id, nama){
    $("#warna").val(id);
    $("#warnanm").val(nama);
    $("#ModalWarna").modal('hide');

    // Show success notification
    if (typeof showNotification === 'function') {
        showNotification('Warna kendaraan berhasil dipilih: ' + nama, 'success');
    }
}
</script>

<!-- Modern Modal Styles -->
<style>
/* Modern Modal Styles for Color Selection */
.modern-modal-dialog.modal-lg {
    max-width: 900px;
    width: 95%;
}

.modern-modal-header {
    background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
    color: white;
}

.modern-modal-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #6f42c1, #5a32a3, #9b59b6);
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
    background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
    color: white;
    font-weight: 600;
    padding: 1rem 1.25rem;
    border: none;
    font-size: 0.9rem;
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
    cursor: pointer;
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

.cell-content {
    display: flex;
    align-items: center;
    min-height: 1.5rem;
    gap: 0.75rem;
}

.color-code {
    font-family: 'Courier New', monospace;
    background: linear-gradient(135deg, #6f42c1, #5a32a3);
    color: white;
    padding: 0.3rem 0.6rem;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
}

.color-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
    flex: 1;
}

.color-preview {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    border: 2px solid #e1e8ed;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.color-preview:hover {
    transform: scale(1.2);
}

.action-buttons {
    display: flex;
    justify-content: center;
}

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

.btn-cancel {
    background: #6c757d;
    color: white;
}

.btn-cancel:hover {
    background: #5a6268;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
}

.empty-state {
    padding: 3rem 1rem;
    text-align: center;
}

.empty-state i {
    margin-bottom: 1rem;
    opacity: 0.5;
    color: #6f42c1;
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

/* Override AdminLTE modal styles */
.modal {
    z-index: 1050;
}

.modal .modal-dialog {
    margin: 2rem auto;
    position: relative;
}

.modal .modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    display: flex;
    flex-direction: column;
    max-height: 90vh;
}

.modal .modal-header {
    border: none;
    flex-shrink: 0;
}

.modal .modal-body {
    flex: 1;
    overflow-y: auto;
    padding: 2.5rem;
}

.modal .modal-footer {
    border-top: 1px solid #e9ecef;
    flex-shrink: 0;
    padding: 1.5rem 2.5rem;
    background: white;
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

    .action-buttons {
        justify-content: center;
    }

    .btn-modern {
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
    }

    .color-name {
        font-size: 0.9rem;
    }

    .color-code {
        font-size: 0.75rem;
        padding: 0.2rem 0.5rem;
    }

    .color-preview {
        width: 20px;
        height: 20px;
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

    .btn-modern {
        width: 100%;
        justify-content: center;
    }

    .cell-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

/* Ensure proper modal structure */
.modern-modal-dialog .modal-content {
    display: flex;
    flex-direction: column;
}

.modern-modal-dialog .modal-body {
    flex: 1;
    max-height: 70vh;
    overflow-y: auto;
}

.modern-modal-dialog .modal-footer {
    flex-shrink: 0;
    margin: 0;
    padding: 1.5rem 2.5rem;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    width: 100%;
    position: relative;
    z-index: 10;
}
</style>