      <?php
            include_once '../../lib/config.php';
      ?>

<div class="modern-table-container">
    <div class="table-responsive">
        <table id="inventory1" class="modern-table table table-hover">
            <thead>
                <tr>
                    <th class="table-header-cell">
                        <i class="fa fa-users"></i>
                        Customer
                    </th>
                    <th class="table-header-cell">
                        <i class="fa fa-car"></i>
                        No Chasis
                    </th>
                    <th class="table-header-cell">
                        <i class="fa fa-cog"></i>
                        No Mesin
                    </th>
                    <th class="table-header-cell">
                        <i class="fa fa-id-card"></i>
                        No Polisi
                    </th>
                    <th class="table-header-cell">
                        <i class="fa fa-user"></i>
                        Nama STNK
                    </th>
                    <th class="table-header-cell">
                        <i class="fa fa-car"></i>
                        Tipe Kendaraan
                    </th>
                    <th class="table-header-cell text-center">
                        <i class="fa fa-cogs"></i>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $j = 1;
                $sqlcatat = "SELECT i.no_chasis,i.no_mesin,i.no_polisi,i.nama_stnk,i.alamat_stnk,t.nama AS nama_tipe,w.nama AS nama_warna, c.nama AS nama_customer FROM t_inventory_bengkel i LEFT JOIN t_customer c
                ON i.fk_customer=c.id_customer LEFT JOIN t_tipe_kendaraan t
                ON i.fk_tipe_kendaraan=t.id_tipe_kendaraan LEFT JOIN t_warna_kendaraan w
                ON i.fk_warna_kendaraan=w.id_warna_kendaraan";
                $rescatat = mysqli_query($objConn, $sqlcatat);

                if (mysqli_num_rows($rescatat) > 0) {
                    while($catat = mysqli_fetch_array($rescatat)){
                ?>
                    <tr class="table-row">
                        <td class="table-cell">
                            <div class="cell-content">
                                <span class="customer-name"><?php echo htmlspecialchars($catat['nama_customer']); ?></span>
                            </div>
                        </td>
                        <td class="table-cell">
                            <div class="cell-content">
                                <span class="chasis-number"><?php echo htmlspecialchars($catat['no_chasis']); ?></span>
                            </div>
                        </td>
                        <td class="table-cell">
                            <div class="cell-content">
                                <span class="engine-number"><?php echo htmlspecialchars($catat['no_mesin']); ?></span>
                            </div>
                        </td>
                        <td class="table-cell">
                            <div class="cell-content">
                                <span class="police-number"><?php echo htmlspecialchars($catat['no_polisi']); ?></span>
                            </div>
                        </td>
                        <td class="table-cell">
                            <div class="cell-content">
                                <span class="stnk-name"><?php echo htmlspecialchars($catat['nama_stnk']); ?></span>
                            </div>
                        </td>
                        <td class="table-cell">
                            <div class="cell-content">
                                <span class="vehicle-type"><?php echo htmlspecialchars($catat['nama_tipe']); ?></span>
                            </div>
                        </td>
                        <td class="table-cell">
                            <div class="action-buttons">
                                <button type="button" class="btn-modern btn-edit"
                                        onclick="open_modal(ideditas='<?php echo $catat['no_chasis']; ?>');"
                                        title="Edit Data">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn-modern btn-delete"
                                        onclick="open_del(iddelas='<?php echo $catat['no_chasis']; ?>');"
                                        title="Hapus Data">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                ?>
                    <tr class="empty-row">
                        <td colspan="7" class="text-center py-4">
                            <div class="empty-state">
                                <i class="fa fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data inventory</h5>
                                <p class="text-muted">Silakan tambahkan data inventory terlebih dahulu</p>
                                <button type="button" class="btn btn-modern-primary mt-3" onclick="showAddModal()">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data Pertama
                                </button>
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

<script>
$(document).ready(function(){
    // Initialize modern DataTable
    $('#inventory1').DataTable({
        "language": {
            "search": "Cari data...",
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data yang tersedia",
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
            $('.dataTables_filter input').attr('placeholder', 'Cari inventory...');
        }
    });

    // Remove add button from header since we have it in the main page
    $('.open_add').remove();
});

function open_del(){
    $.ajax({
        url: "inventory/inventory_del.php?no_chasis="+iddelas,
        type: "GET",
        success: function (ajaxData){
            $("#ModalDelete").html(ajaxData);
            $("#ModalDelete").modal({backdrop: 'static', keyboard: false});
        },
        error: function(){
            showNotification('Terjadi kesalahan saat memuat form hapus', 'error');
        }
    });
}

function open_modal(){
    $.ajax({
        url: "inventory/inventory_edit.php?no_chasis="+ideditas,
        type: "GET",
        success: function (ajaxData){
            $("#ModalEdit").html(ajaxData);
            $("#ModalEdit").modal({backdrop: 'static', keyboard: false});
        },
        error: function(){
            showNotification('Terjadi kesalahan saat memuat form edit', 'error');
        }
    });
}

function showAddModal(){
    $("#addInventoryBtn").click();
}
</script>

<!-- Modern Table Styles -->
<style>
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
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
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
}

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

.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.btn-modern {
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.btn-edit {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.btn-edit:hover {
    background: linear-gradient(135deg, #218838, #1ea085);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-delete {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
}

.btn-delete:hover {
    background: linear-gradient(135deg, #c82333, #bd2130);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.empty-state {
    padding: 3rem 1rem;
    text-align: center;
}

.empty-state i {
    margin-bottom: 1rem;
    opacity: 0.5;
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
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
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
    color: #667eea;
    margin: 0 0.125rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.dataTables_paginate .page-link:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.dataTables_paginate .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-color: #667eea;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-table-container {
        border-radius: 8px;
    }

    .table-cell {
        padding: 0.75rem 0.5rem;
        font-size: 0.9rem;
    }

    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }

    .btn-modern {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }

    .vehicle-type {
        font-size: 0.75rem;
        padding: 0.2rem 0.5rem;
    }

    .chasis-number, .engine-number, .police-number {
        font-size: 0.8rem;
        padding: 0.2rem 0.4rem;
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