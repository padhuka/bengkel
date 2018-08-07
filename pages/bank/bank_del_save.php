<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $no_bukti = $_GET['no_bukti'];
        $keterangan_batal = $_GET['keteranganbatal'];
        //$no_bukti_or = trim($_POST['idkwitansior']);
        //$keterangan_batal = trim($_POST['keteranganbatal']);
        echo $keterangan_batal;
        
            $updatebatalcash = "UPDATE t_bank SET tgl_batal='$hrini',keterangan_batal='$keterangan_batal' WHERE no_bukti='$no_bukti'";
             $query =  mysql_query($updatebatalcash);
              
?>
