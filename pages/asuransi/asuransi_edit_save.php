<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
    	$id_asuransi = trim($_POST['id_asuransi']);
        $id_asuransihid = trim($_POST['id_asuransihid']);
		$nama = trim($_POST['nama']);
        $namahid = trim($_POST['namahid']);
        $alamat = trim($_POST['alamat']);
        $no_telp = trim($_POST['no_telp']); 
        $npwp = trim($_POST['npwp']); 
		 #cek id_asuransisurat
        //$sqlcek = "SELECT * FROM t_asuransi WHERE (id_asuransi='$id_asuransi' AND id_asuransi<>'$id_asuransihid') OR (nama='$nama' AND nama<>'$namahid')";
        $sqlcek = "SELECT * FROM t_asuransi WHERE id_asuransi='$id_asuransi' AND id_asuransi<>'$id_asuransihid'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);
        if ($row){
            echo 'y';
        }else{
		        $sqltbemp = "UPDATE t_asuransi SET id_asuransi='$id_asuransi',nama='$nama',alamat='$alamat',no_telp='$no_telp',npwp='$npwp' WHERE id_asuransi='$id_asuransi'";
        		mysql_query($sqltbemp);
           // echo 'n';
        }
?>