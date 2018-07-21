<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_part = $_GET['id_part'];
		# HAPUS DATA 
		$sqlhapusasuransi = "DELETE FROM t_part WHERE id_part='$id_part'";
   		mysql_query( $sqlhapusasuransi );
?>
