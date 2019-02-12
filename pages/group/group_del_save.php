<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_group_kendaraan = $_GET['id_group_kendaraan'];
		$sqlhapussatuan = "DELETE FROM t_group_kendaraan WHERE id_group_kendaraan='$id_group_kendaraan'";
   		mysql_query( $sqlhapussatuan );
?>
