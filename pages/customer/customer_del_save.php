<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_customer = $_GET['id_customer'];
		# HAPUS DATA 
		$sqlhapusasuransi = "DELETE FROM t_customer WHERE id_customer='$id_customer'";
   		mysql_query( $sqlhapusasuransi );
?>
