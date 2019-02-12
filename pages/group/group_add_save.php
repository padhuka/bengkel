<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_group_kendaraan = trim($_POST['id_group_kendaraan']);
        $nama = trim($_POST['nama']);
        //message_back($id_group_kendaraan);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_group_kendaraan WHERE nama='$nama' OR id_group_kendaraan='$id_group_kendaraan'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_group_kendaraan (id_group_kendaraan,nama) VALUES ('$id_group_kendaraan','$nama')";
            mysql_query($sqltbemp);
            //echo 'n';
        }
?>