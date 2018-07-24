<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_customer = trim($_POST['id_customer']);
        $namacustomer = trim($_POST['namacustomer']);
        $jeniskelamin = trim($_POST['jeniskelamin']);
        $alamatcustomer = trim($_POST['alamat']);
        $noktpcustomer = trim($_POST['no_ktp']);
        $telpcustomer = trim($_POST['no_telp']);
        $email = trim($_POST['email']);
        //message_back($id_customer);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_customer WHERE nama='$nama' OR id_customer='$id_customer'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_customer (id_customer,nama,jenis_kelamin,alamat,no_ktp,no_telp,email) VALUES ('$id_customer','$namacustomer','$jeniskelamin','$alamatcustomer','$noktpcustomer','$telpcustomer','$email')";
            mysql_query($sqltbemp);
            //echo 'n';
        }
?>