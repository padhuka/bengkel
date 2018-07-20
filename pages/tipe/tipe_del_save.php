<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_tipe_kendaraan = $_GET['id_tipe_kendaraan'];
		$sqlhapussatuan = "DELETE FROM t_tipe_kendaraan WHERE id_tipe_kendaraan='$id_tipe_kendaraan'";
   		mysql_query( $sqlhapussatuan );
?>
