<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_supplier = $_GET['id_supplier'];
		# HAPUS DATA 
		$sqlhapusasuransi = "DELETE FROM t_supplier WHERE id_supplier='$id_supplier'";
   		mysql_query( $sqlhapusasuransi );
?>
