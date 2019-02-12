<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
    	$id_part = trim($_POST['id_part']);
        $id_parthid = trim($_POST['id_parthid']);
		$nama = trim($_POST['nama']);
        $satuan = trim($_POST['satuan']);
        $namahid = trim($_POST['namahid']);  
        $harga_pokok = trim($_POST['hargabeli']);
        $harga_jual = trim($_POST['hargajual']); 
        $diskon = trim($_POST['diskon']); 
        $ppn = trim($_POST['ppn']); 
        $stock = trim($_POST['stock']);
        $supplier = trim($_POST['supplier']);
		 #cek id_partsurat
        //$sqlcek = "SELECT * FROM t_part WHERE (id_part='$id_part' AND id_part<>'$id_parthid') OR (nama='$nama' AND nama<>'$namahid')";
        $sqlcek = "SELECT * FROM t_part WHERE id_part='$id_part' AND id_part<>'$id_parthid'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);
        if ($row){
            echo 'y';
        }else{
		        $sqltbemp = "UPDATE t_part SET id_part='$id_part',nama='$nama',fk_satuan='$satuan',harga_beli='$harga_pokok',harga_jual='$harga_jual',diskon='$diskon', ppn='$ppn',stock='$stock',fk_supplier='$supplier' WHERE id_part='$id_part'";
        		mysql_query($sqltbemp);
           // echo 'n';
        }
?>