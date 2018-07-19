<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_asuransi = trim($_POST['id_asuransi']);
        $nama = trim($_POST['nama']);
        $alamat = trim($_POST['alamat']);
        $no_telp = trim($_POST['no_telp']);
        $npwp = trim($_POST['npwp']);
        //message_back($id_asuransi);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_asuransi WHERE nama='$nama' OR id_asuransi='$id_asuransi'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_asuransi (id_asuransi,nama,alamat,no_telp,npwp) VALUES ('$id_asuransi','$nama','$alamat','$no_telp','$npwp')";
            mysql_query($sqltbemp);
            //echo 'n';
        }
?>