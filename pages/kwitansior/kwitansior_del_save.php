<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $no_kwitansi_or = $_GET['idkwitansior'];
        $keterangan_batal = $_GET['keteranganbatal'];
        //$no_kwitansi_or = trim($_POST['idkwitansior']);
        //$keterangan_batal = trim($_POST['keteranganbatal']);
        echo $keterangan_batal;
        
            $updatekwitansior = "UPDATE t_kwitansi_or SET tgl_batal='$hrini',keterangan_batal='$keterangan_batal' WHERE no_kwitansi_or='$no_kwitansi_or'";
             $query =  mysql_query($updatekwitansior);
              echo $query;
?>
