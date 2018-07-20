<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
    	$id_supplier = trim($_POST['id_supplier']);
        $id_asuransihid = trim($_POST['id_asuransihid']);
		$nama = trim($_POST['nama']);
        $namahid = trim($_POST['namahid']);
        $alamat = trim($_POST['alamat']);
        $no_telp = trim($_POST['no_telp']); 
        $npwp = trim($_POST['npwp']); 
	
        $sqlcek = "SELECT * FROM t_supplier WHERE id_supplier='$id_supplier' AND id_supplier<>'$id_asuransihid'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);
        if ($row){
            echo 'y';
        }else{
		        $sqltbemp = "UPDATE t_supplier SET id_supplier='$id_supplier',nama='$nama',alamat='$alamat',no_telp='$no_telp',npwp='$npwp' WHERE id_supplier='$id_supplier'";
        		mysql_query($sqltbemp);
           // echo 'n';
        }
?>