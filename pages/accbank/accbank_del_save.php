<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $no_bukti = $_GET['no_bukti'];
        //$keterangan_batal = $_GET['keteranganbatal'];
        //$no_bukti_or = trim($_POST['idkwitansior']);
        //$keterangan_batal = trim($_POST['keteranganbatal']);
        //echo $keterangan_batal;
        
            $updatebatalbank = "UPDATE t_acc_bank SET tgl_batal='$hrini',status='Batal' WHERE no_bukti='$no_bukti'";
             $query =  mysql_query($updatebatalbank);
              echo $query;
?>
