<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
    
		$username = trim($_POST['username']);
        $password = trim(md5($_POST['password'])); 
        $nama = trim($_POST['nama']); 
        $nip = trim($_POST['nip']); 
        $level = trim($_POST['level']); 
        
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_user WHERE username='$username'";
        $qrycek = mysqli_query($objConn, $sqlcek);
        $row = mysqli_fetch_array($qrycek);

        if ($row){
            //echo 'var obat=new Array("'.$row[kode].'","'.$nama.'","'.$harga.'","'.$row[ukuran].'","'.$stkisi.'","'.$stk.'","'.$carabayar.'","'.$byre.'","'.$jl.'");';
            //unlink('../../file/tmp/'.$photo);
            echo 'y';
        }else{
        	
		    $sqltbemp = "INSERT INTO t_user (username,password,nama,nip,level) VALUES ('$username','$password','$nama','$nip','$level')";
            mysqli_query($objConn, $sqltbemp);
            echo 'n';
        }
?>