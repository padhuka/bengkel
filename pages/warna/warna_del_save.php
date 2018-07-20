<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_warna_kendaraan = $_GET['id_warna_kendaraan'];
		$sqlhapussatuan = "DELETE FROM t_warna_kendaraan WHERE id_warna_kendaraan='$id_warna_kendaraan'";
   		mysql_query( $sqlhapussatuan );
?>
