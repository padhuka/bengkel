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
            <th>No Part</th>
            <th>Nama Part</th>
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

        // Query untuk mengambil data sparepart per PKB dari t_pkb_part_detail
        $sql = "SELECT
                    pkb.id_pkb,
                    pkb.tgl as tgl_pkb,
                    pkb.fk_no_polisi,
                    part.id_part as no_part,
                    part.nama as nama_part,
                    part.harga_beli,
                    ppd.harga_jual_part,
                    COALESCE(s.nama, '-') as nama_supplier
                FROM t_pkb pkb
                LEFT JOIN t_pkb_part_detail ppd ON pkb.id_pkb = ppd.fk_pkb
                LEFT JOIN t_part part ON ppd.fk_part = part.id_part
                LEFT JOIN t_supplier s ON part.fk_supplier = s.id_supplier
                WHERE pkb.tgl >= '$tgl1'
                AND pkb.tgl <= '$tgl2'
                AND ppd.fk_part IS NOT NULL
                AND (pkb.tgl_batal = '0000-00-00 00:00:00' OR pkb.tgl_batal IS NULL)
                ORDER BY pkb.tgl ASC, pkb.id_pkb ASC, part.id_part ASC";

        $result = mysqli_query($objConn, $sql);

        // Check for SQL errors
        if (!$result) {
            die("Query error: " . mysqli_error($objConn));
        }

        while($row = mysqli_fetch_array($result)) {
            // Accumulate totals
            $grand_harga_beli += $row['harga_beli'];
            $grand_harga_jual += $row['harga_jual_part'];
        ?>
            <tr>
                <td><?php echo $j++; ?></td>
                <td><?php echo date('d-m-Y', strtotime($row['tgl_pkb'])); ?></td>
                <td><?php echo $row['id_pkb']; ?></td>
                <td><?php echo $row['fk_no_polisi']; ?></td>
                <td><?php echo $row['no_part']; ?></td>
                <td><?php echo $row['nama_part']; ?></td>
                <td align="right"><?php echo rupiah2($row['harga_beli']); ?></td>
                <td align="right"><?php echo rupiah2($row['harga_jual_part']); ?></td>
                <td><?php echo $row['nama_supplier']; ?></td>
            </tr>
        <?php
        }
        ?>
        <!-- Grand Total Row -->
        <tr style="font-weight: bold;">
            <td colspan="6" align="right">GRAND TOTAL</td>
            <td align="right"><?php echo rupiah2($grand_harga_beli); ?></td>
            <td align="right"><?php echo rupiah2($grand_harga_jual); ?></td>
            <td></td>
        </tr>
    </tbody>
</table>
