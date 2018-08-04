<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $no_kwitansi = $_GET['idkwitansi'];
        $keterangan_batal = $_GET['keteranganbatal'];
        //$no_kwitansi_or = trim($_POST['idkwitansior']);
        //$keterangan_batal = trim($_POST['keteranganbatal']);
        echo $keterangan_batal;
        
            $updatekwitansi = "UPDATE t_kwitansi SET tgl_batal='$hrini',keterangan_batal='$keterangan_batal' WHERE no_kwitansi='$no_kwitansi'";
             $query =  mysql_query($updatekwitansi);
              echo $query;
?>
