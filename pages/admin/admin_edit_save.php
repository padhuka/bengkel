<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
    	$id = trim($_POST['id']);
		$username = trim($_POST['username']);
        $usernamehid = trim($_POST['usernamehid']);
        $password = trim(md5($_POST['password']));
        $passwordhid = trim($_POST['passwordhid']); 
        $nama = trim($_POST['nama']); 
        $nip = trim($_POST['nip']); 
        $level = trim($_POST['level']); 
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_user WHERE username='$username' AND username<>'$usernamehid'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);
        if ($password==''){
                $passworde=$passwordhid;
        }else{
                $passworde=$password;
        }

        if ($row){
            //echo 'var obat=new Array("'.$row[kode].'","'.$nama.'","'.$harga.'","'.$row[ukuran].'","'.$stkisi.'","'.$stk.'","'.$carabayar.'","'.$byre.'","'.$jl.'");';
            //unlink('../../file/tmp/'.$photo);
            echo 'y';
        }else{
		        $sqltbemp = "UPDATE t_user SET username='$username',password='$password',nama='$nama',nip='$nip',level='$level' WHERE id='$id'";		        
        		mysql_query($sqltbemp);
            echo 'n';
        }
?>