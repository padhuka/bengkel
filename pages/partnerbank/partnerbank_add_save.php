<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_partner_bank = trim($_POST['id_partner_bank']);
        $nama = trim($_POST['nama']);
        $no_telp = trim($_POST['notelp']);
        $alamat = trim($_POST['alamat']);

        //message_back($id_partner_bank);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_partner_bank WHERE nama='$nama' OR id_partner_bank='$id_partner_bank'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_partner_bank (id_partner_bank,nama,no_telp,alamat) VALUES ('$id_partner_bank','$nama','$no_telp','$alamat')";
            mysql_query($sqltbemp);
            //echo 'n';
        }
?>