<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $idpkb = $_GET['idpkb'];
        
            $updatepkb = "UPDATE t_pkb SET status_pkb='Buka' WHERE id_pkb='$idpkb'";
            mysqli_query($objConn, $updatepkb);
?>
