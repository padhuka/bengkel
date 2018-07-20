<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_supplier = trim($_POST['id_supplier']);
        $nama = trim($_POST['nama']);
        $alamat = trim($_POST['alamat']);
        $no_telp = trim($_POST['no_telp']);
        $npwp = trim($_POST['npwp']);
        //message_back($id_supplier);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_supplier WHERE nama='$nama' OR id_supplier='$id_supplier'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_supplier (id_supplier,nama,alamat,no_telp,npwp) VALUES ('$id_supplier','$nama','$alamat','$no_telp','$npwp')";
            mysql_query($sqltbemp);
            //echo 'n';
        }
?>