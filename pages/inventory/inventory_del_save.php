<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$no_chasis = $_GET['no_chasis'];
		# HAPUS DATA 
		$sqlhapusasuransi = "DELETE FROM t_inventory_bengkel WHERE no_chasis='$no_chasis'";
   		mysql_query( $sqlhapusasuransi );
?>
