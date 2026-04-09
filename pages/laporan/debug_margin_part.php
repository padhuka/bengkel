<?php
include_once '../../lib/config.php';
include_once '../../lib/fungsi.php';

$tgl1 = isset($_GET['tgl1']) ? $_GET['tgl1'] : date('Y-m-d');
$tgl2 = isset($_GET['tgl2']) ? $_GET['tgl2'] : date('Y-m-d');

echo "<h1>Debug Margin Part</h1>";
echo "<p>Tanggal: $tgl1 s/d $tgl2</p>";

// Test 1: Simple query - check if PKB data exists
echo "<h2>Test 1: Simple PKB Query</h2>";
$sql1 = "SELECT id_pkb, tgl, fk_no_chasis, fk_estimasi
         FROM t_pkb
         WHERE tgl >= '$tgl1' AND tgl <= '$tgl2'
         LIMIT 5";

echo "<pre>Query: $sql1</pre>";
$res1 = mysqli_query($objConn, $sql1);
echo "<p>Result: " . ($res1 ? "SUCCESS" : "FAILED - " . mysqli_error($objConn)) . "</p>";
echo "<p>Num rows: " . mysqli_num_rows($res1) . "</p>";

while($row = mysqli_fetch_array($res1)) {
    echo "<pre>" . print_r($row, true) . "</pre>";
}

// Test 2: Query with inventory join
echo "<h2>Test 2: PKB + Inventory Join</h2>";
$sql2 = "SELECT pkb.id_pkb, pkb.tgl, inv.no_polisi
         FROM t_pkb pkb
         LEFT JOIN t_inventory_bengkel inv ON pkb.fk_no_chasis = inv.no_chasis
         WHERE pkb.tgl >= '$tgl1' AND pkb.tgl <= '$tgl2'
         LIMIT 5";

echo "<pre>Query: $sql2</pre>";
$res2 = mysqli_query($objConn, $sql2);
echo "<p>Result: " . ($res2 ? "SUCCESS" : "FAILED - " . mysqli_error($objConn)) . "</p>";
echo "<p>Num rows: " . mysqli_num_rows($res2) . "</p>";

while($row = mysqli_fetch_array($res2)) {
    echo "<pre>" . print_r($row, true) . "</pre>";
}

// Test 3: Query with all joins but no aggregation
echo "<h2>Test 3: All Joins (No Aggregation)</h2>";
$sql3 = "SELECT
            pkb.id_pkb,
            pkb.tgl,
            tk.nama as unit,
            inv.no_polisi,
            part.harga_beli
         FROM t_pkb pkb
         LEFT JOIN t_inventory_bengkel inv ON pkb.fk_no_chasis = inv.no_chasis
         LEFT JOIN t_tipe_kendaraan tk ON inv.fk_tipe_kendaraan = tk.id_tipe_kendaraan
         LEFT JOIN t_estimasi e ON pkb.fk_estimasi = e.id_estimasi
         LEFT JOIN t_estimasi_part_detail epd ON e.id_estimasi = epd.fk_estimasi
         LEFT JOIN t_part part ON epd.fk_part = part.id_part
         WHERE pkb.tgl >= '$tgl1' AND pkb.tgl <= '$tgl2'
         LIMIT 10";

echo "<pre>Query: $sql3</pre>";
$res3 = mysqli_query($objConn, $sql3);
echo "<p>Result: " . ($res3 ? "SUCCESS" : "FAILED - " . mysqli_error($objConn)) . "</p>";
echo "<p>Num rows: " . mysqli_num_rows($res3) . "</p>";

while($row = mysqli_fetch_array($res3)) {
    echo "<pre>" . print_r($row, true) . "</pre>";
}

// Test 4: Full query with aggregation
echo "<h2>Test 4: Full Query (With Aggregation & GROUP BY)</h2>";
$sql4 = "SELECT
            pkb.id_pkb as no_pkb,
            pkb.tgl as tgl_pkb,
            tk.nama as unit,
            inv.no_polisi,
            SUM(part.harga_beli) as total_harga_beli_part
         FROM t_pkb pkb
         LEFT JOIN t_inventory_bengkel inv ON pkb.fk_no_chasis = inv.no_chasis
         LEFT JOIN t_tipe_kendaraan tk ON inv.fk_tipe_kendaraan = tk.id_tipe_kendaraan
         LEFT JOIN t_estimasi e ON pkb.fk_estimasi = e.id_estimasi
         LEFT JOIN t_estimasi_part_detail epd ON e.id_estimasi = epd.fk_estimasi
         LEFT JOIN t_part part ON epd.fk_part = part.id_part
         WHERE pkb.tgl >= '$tgl1' AND pkb.tgl <= '$tgl2'
         GROUP BY pkb.id_pkb
         LIMIT 5";

echo "<pre>Query: $sql4</pre>";
$res4 = mysqli_query($objConn, $sql4);
echo "<p>Result: " . ($res4 ? "SUCCESS" : "FAILED - " . mysqli_error($objConn)) . "</p>";
echo "<p>Num rows: " . mysqli_num_rows($res4) . "</p>";

while($row = mysqli_fetch_array($res4)) {
    echo "<pre>" . print_r($row, true) . "</pre>";
}

echo "<hr>";
echo "<p><a href='laporan_tab.php'>Kembali ke Menu Laporan</a></p>";
?>
