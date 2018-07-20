<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_warna_kendaraan = trim($_POST['id_warna_kendaraan']);
        $nama = trim($_POST['nama']);
        //message_back($id_warna_kendaraan);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_warna_kendaraan WHERE nama='$nama' OR id_warna_kendaraan='$id_warna_kendaraan'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_warna_kendaraan (id_warna_kendaraan,nama) VALUES ('$id_warna_kendaraan','$nama')";
            mysql_query($sqltbemp);
            //echo 'n';
        }
?>