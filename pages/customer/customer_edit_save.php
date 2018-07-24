<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
    	$id_customer = trim($_POST['id_customer']);
        $id_customerhid = trim($_POST['id_customerhid']);
        $namacustomer = trim($_POST['namacustomer']);
        $jeniskelamin = trim($_POST['jeniskelamin']);
        $alamatcustomer = trim($_POST['alamat']);
        $noktpcustomer = trim($_POST['no_ktp']);
        $telpcustomer = trim($_POST['no_telp']);
        $email = trim($_POST['email']);
	
        $sqlcek = "SELECT * FROM t_customer WHERE id_customer='$id_customer' AND id_customer<>'$id_customerhid";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);
        if ($row){
            echo 'y';
        }else{
		        $sqltbemp = "UPDATE t_customer SET nama='$namacustomer',jenis_kelamin='$jeniskelamin',alamat='$alamatcustomer',no_ktp='$noktpcustomer',no_telp='$telpcustomer',email='$email' WHERE id_customer='$id_customerhid'";
        		mysql_query($sqltbemp);
           // echo 'n';
        }
?>