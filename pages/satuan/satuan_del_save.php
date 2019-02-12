<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_satuan = $_GET['id_satuan'];
		$sqlhapussatuan = "DELETE FROM t_satuan WHERE id_satuan='$id_satuan'";
   		mysql_query( $sqlhapussatuan );
?>
