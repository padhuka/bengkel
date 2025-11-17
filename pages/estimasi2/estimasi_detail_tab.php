		      <?php
include_once '../../lib/config.php';
include_once '../../lib/fungsi.php';

$idestimasi = $_GET['idestimasi'];
$sqlest = "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
$hest = mysqli_fetch_array(mysqli_query($objConn, $sqlest));
?>

<!-- Modern Estimasi Detail Table -->
<div class="modern-table-container">
    <div class="table-responsive">
        <table id="estimasiDetailTable" class="modern-table table table-hover">
            <thead>
                <tr>
                    <th class="table-header-cell">
                        <i class="fa fa-tag"></i>
                        Item
                    </th>
                    <th class="table-header-cell">
                        <i class="fa fa-money-bill-wave"></i>
                        Gross
                    </th>
                    <th class="table-header-cell">
                        <i class="fa fa-percentage"></i>
                        Diskon
                    </th>
                    <th class="table-header-cell">
                        <i class="fa fa-calculator"></i>
                        Netto
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-row">
                    <td class="table-cell">
                        <div class="item-info">
                            <i class="fa fa-wrench item-icon part-icon"></i>
                            <span class="item-name">Part</span>
                        </div>
                    </td>
                    <td class="table-cell">
                        <span class="amount gross-amount"><?php echo rupiah2($hest['total_gross_harga_part']); ?></span>
                    </td>
                    <td class="table-cell">
                        <span class="amount discount-amount"><?php echo rupiah2($hest['total_diskon_rupiah_part']); ?></span>
                    </td>
                    <td class="table-cell">
                        <span class="amount net-amount"><?php echo rupiah2($hest['total_netto_harga_part']); ?></span>
                    </td>
                </tr>
                <tr class="table-row">
                    <td class="table-cell">
                        <div class="item-info">
                            <i class="fa fa-th-large item-icon panel-icon"></i>
                            <span class="item-name">Panel</span>
                        </div>
                    </td>
                    <td class="table-cell">
                        <span class="amount gross-amount"><?php echo rupiah2($hest['total_gross_harga_panel']); ?></span>
                    </td>
                    <td class="table-cell">
                        <span class="amount discount-amount"><?php echo rupiah2($hest['total_diskon_rupiah_panel']); ?></span>
                    </td>
                    <td class="table-cell">
                        <span class="amount net-amount"><?php echo rupiah2($hest['total_netto_harga_panel']); ?></span>
                    </td>
                </tr>
                <!-- Total Row -->
                <tr class="total-row">
                    <td class="table-cell">
                        <div class="total-info">
                            <i class="fa fa-calculator total-icon"></i>
                            <span class="total-label">Total Estimasi</span>
                        </div>
                    </td>
                    <td class="table-cell">
                        <span class="total-amount gross-total"><?php echo rupiah2($hest['total_gross_harga_part'] + $hest['total_gross_harga_panel']); ?></span>
                    </td>
                    <td class="table-cell">
                        <span class="total-amount discount-total"><?php echo rupiah2($hest['total_diskon_rupiah_part'] + $hest['total_diskon_rupiah_panel']); ?></span>
                    </td>
                    <td class="table-cell">
                        <span class="total-amount net-total"><?php echo rupiah2($hest['total_netto_harga_part'] + $hest['total_netto_harga_panel']); ?></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modern JavaScript -->
<script>
$(document).ready(function() {
    // Initialize DataTables for the detail table
    $('#estimasiDetailTable').DataTable({
        "language": {
            "search": "Cari item...",
            "lengthMenu": "Tampilkan _MENU_ item per halaman",
            "zeroRecords": "Tidak ada data estimasi",
            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ item",
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
        "ordering": false,
        "searching": false,
        "info": false,
        "paging": false,
        "autoWidth": false
    });
});
</script>

<!-- Modern CSS Styles -->
<style>
/* Estimasi Detail Table Styles */
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
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
    background-color: #f0fff4;
    transform: scale(1.005);
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.1);
}

.total-row {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    font-weight: 600;
    border-top: 2px solid #28a745;
}

.total-row:hover {
    background: linear-gradient(135deg, #e9ecef, #dee2e6);
    transform: scale(1.005);
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.15);
}

.table-cell {
    padding: 1rem 1.25rem;
    vertical-align: middle;
    border: none;
}

.item-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.item-icon {
    font-size: 1.2rem;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    flex-shrink: 0;
}

.part-icon {
    color: #007bff;
    background: rgba(0, 123, 255, 0.1);
}

.panel-icon {
    color: #6f42c1;
    background: rgba(111, 66, 193, 0.1);
}

.item-name {
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
    color: #28a745;
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

/* Responsive Design */
@media (max-width: 768px) {
    .table-cell {
        padding: 0.75rem 0.5rem;
        font-size: 0.9rem;
    }

    .item-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .item-icon {
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
}
</style>