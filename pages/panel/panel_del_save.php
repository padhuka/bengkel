<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_panel = $_GET['id_panel'];
		# HAPUS DATA 
		$sqlhapusasuransi = "DELETE FROM t_panel WHERE id_panel='$id_panel'";
   		mysql_query( $sqlhapusasuransi );
?>
