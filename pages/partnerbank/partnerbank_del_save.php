<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
		$id_partner_bank = $_GET['id_partner_bank'];
		$hapuspartner = "DELETE FROM t_partner_bank WHERE id_partner_bank='$id_partner_bank'";
   		mysql_query( $hapuspartner );
?>
