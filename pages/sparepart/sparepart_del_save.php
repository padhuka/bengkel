<?php
		include_once '../../lib/config.php';
		$id = $_GET['id'];
		# HAPUS DATA
		$sqlhapus = "DELETE FROM t_part_pkb WHERE id='$id'";
   		mysqli_query($objConn,  $sqlhapus );
?>
