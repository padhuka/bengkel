<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $idestimasi = $_GET['idestimasi'];
        
            $updateestimasi = "UPDATE t_estimasi SET tgl_batal='$hrini' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);
?>
