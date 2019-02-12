<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $idestimasi = $_GET['idestimasi'];
        
            $updateestimasi = "UPDATE t_estimasi SET approved='1' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);
?>
