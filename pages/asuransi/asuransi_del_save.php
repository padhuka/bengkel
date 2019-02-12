<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_asuransi = $_GET['id_asuransi'];
		# HAPUS DATA 
		$sqlhapusasuransi = "DELETE FROM t_asuransi WHERE id_asuransi='$id_asuransi'";
   		mysql_query( $sqlhapusasuransi );
?>
