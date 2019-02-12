<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
    	$id_panel = trim($_POST['id_panel']);
        $id_panelhid = trim($_POST['id_panelhid']);
		$nama = trim($_POST['nama']);
        $namahid = trim($_POST['namahid']);  
        $harga_pokok = trim($_POST['hargapokok']);
        $harga_jual = trim($_POST['hargajual']); 
        $diskon = trim($_POST['diskon']); 
        $ppn = trim($_POST['ppn']); 
		 #cek id_panelsurat
        //$sqlcek = "SELECT * FROM t_panel WHERE (id_panel='$id_panel' AND id_panel<>'$id_panelhid') OR (nama='$nama' AND nama<>'$namahid')";
        $sqlcek = "SELECT * FROM t_panel WHERE id_panel='$id_panel' AND id_panel<>'$id_panelhid'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);
        if ($row){
            echo 'y';
        }else{
		        $sqltbemp = "UPDATE t_panel SET id_panel='$id_panel',nama='$nama',harga_pokok='$harga_pokok',harga_jual='$harga_jual',diskon='$diskon', ppn='$ppn' WHERE id_panel='$id_panel'";
        		mysql_query($sqltbemp);
           // echo 'n';
        }
?>