<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_tipe_kendaraan = trim($_POST['id_tipe_kendaraan']);
        $nama = trim($_POST['nama']);
        //message_back($id_tipe_kendaraan);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_tipe_kendaraan WHERE nama='$nama' OR id_tipe_kendaraan='$id_tipe_kendaraan'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_tipe_kendaraan (id_tipe_kendaraan,nama) VALUES ('$id_tipe_kendaraan','$nama')";
            mysql_query($sqltbemp);
            echo 'n';
        }
?>