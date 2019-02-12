<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
    	$id = trim($_POST['id']);
		$kode = trim($_POST['kode']);
        $kodehid = trim($_POST['kodehid']); 
        $nama = trim($_POST['nama']);
        $alamat = trim($_POST['alamat']);
        $email = trim($_POST['email']);
        $notelp = trim($_POST['notelp']);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_pengirim WHERE kode='$kode' AND kode<>'$kodehid'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            //echo 'var obat=new Array("'.$row[kode].'","'.$nama.'","'.$harga.'","'.$row[ukuran].'","'.$stkisi.'","'.$stk.'","'.$carabayar.'","'.$byre.'","'.$jl.'");';
            //unlink('../../file/tmp/'.$photo);
            echo 'y';
        }else{
		        $sqltbemp = "UPDATE t_pengirim SET kode='$kode',nama='$nama',alamat='$alamat',email='$email',notelp='$notelp' WHERE id='$id'";		        
        		mysql_query($sqltbemp);
            echo 'n';
        }
?>