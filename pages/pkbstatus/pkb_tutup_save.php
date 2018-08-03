<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $idpkb = $_GET['idpkb'];
        
            $updatepkb = "UPDATE t_pkb SET status_pkb='Tutup' WHERE id_pkb='$idpkb'";
            mysql_query($updatepkb);
?>
