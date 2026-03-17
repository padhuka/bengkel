<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor
header("Content-Disposition: attachment; filename=report_pkb_sparepart.xls");

?>
<?php
include_once '../../lib/config.php';
include_once '../../lib/fungsi.php';
$tgle = date('d/m/Y');
$jame = date('H:i:s');
?>
<table width="100%" align="center" border="0">
    <tr>
        <td width="50%"><u style="font-size: 20px;"><strong>GEMILANG BODY & PAINT</strong><br>
        </u>
        Jl. Setia Budi No.152 <br>
        Srondol Kulon Semarang
        </td>
        <td align="right">
          Tanggal : <?php echo $tgle;?><br>
          Jam : <?php echo $jame;?>
        </td>
    </tr>
</table>
<span style="font-size: 20px;font-weight: bold;"><center>Laporan PKB Sparepart</center></span>
<span style="font-size: 20px;font-weight: bold;"><center> Per Tgl <?php echo date('d-m-Y' , strtotime($_GET['tgl1']));echo ' s/d '; echo date('d-m-Y' , strtotime($_GET['tgl2'])); ?></center></span>
<br>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tgl PKB</th>
            <th>No. PKB</th>
            <th>No Polisi</th>
            <th>Sparepart</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Supplier</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tgl1 = mysqli_real_escape_string($objConn, $_GET['tgl1']);
        $tgl2 = mysqli_real_escape_string($objConn, $_GET['tgl2']);
        $j = 1;

        // Initialize grand totals
        $grand_harga_beli = 0;
        $grand_harga_jual = 0;

        // Query untuk mengambil data sparepart per PKB
        $sql = "SELECT
                    pp.id,
                    pp.tgl_pkb,
                    p.id_pkb,
                    p.fk_no_polisi,
                    pt.nama as nama_sparepart,
                    pp.harga_beli,
                    pp.harga_jual,
                    COALESCE(s.nama, '-') as nama_supplier
                FROM t_part_pkb pp
                LEFT JOIN t_pkb p ON pp.id_pkb = p.id_pkb
                LEFT JOIN t_part pt ON pp.id_part = pt.id_part
                LEFT JOIN t_supplier s ON pt.fk_supplier = s.id_supplier
                WHERE pp.tgl_pkb >= '$tgl1'
                AND pp.tgl_pkb <= '$tgl2'
                AND (p.tgl_batal = '0000-00-00 00:00:00' OR p.tgl_batal IS NULL)
                ORDER BY pp.tgl_pkb ASC, p.id_pkb ASC, pp.id ASC";

        $result = mysqli_query($objConn, $sql);

        // Check for SQL errors
        if (!$result) {
            die("Query error: " . mysqli_error($objConn));
        }

        while($row = mysqli_fetch_array($result)) {
            // Accumulate totals
            $grand_harga_beli += $row['harga_beli'];
            $grand_harga_jual += $row['harga_jual'];
        ?>
            <tr>
                <td><?php echo $j++; ?></td>
                <td><?php echo date('d-m-Y', strtotime($row['tgl_pkb'])); ?></td>
                <td><?php echo $row['id_pkb']; ?></td>
                <td><?php echo $row['fk_no_polisi']; ?></td>
                <td><?php echo $row['nama_sparepart']; ?></td>
                <td align="right"><?php echo rupiah2($row['harga_beli']); ?></td>
                <td align="right"><?php echo rupiah2($row['harga_jual']); ?></td>
                <td><?php echo $row['nama_supplier']; ?></td>
            </tr>
        <?php
        }
        ?>
        <!-- Grand Total Row -->
        <tr style="font-weight: bold;">
            <td colspan="5" align="right">GRAND TOTAL</td>
            <td align="right"><?php echo rupiah2($grand_harga_beli); ?></td>
            <td align="right"><?php echo rupiah2($grand_harga_jual); ?></td>
            <td></td>
        </tr>
    </tbody>
</table>
