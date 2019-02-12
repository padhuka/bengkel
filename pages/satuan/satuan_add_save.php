<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_satuan = trim($_POST['id_satuan']);
        $nama = trim($_POST['nama']);
        //message_back($id_satuan);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_satuan WHERE nama='$nama' OR id_satuan='$id_satuan'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_satuan (id_satuan,nama) VALUES ('$id_satuan','$nama')";
            mysql_query($sqltbemp);
            //echo 'n';
        }
?>