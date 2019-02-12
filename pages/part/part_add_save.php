<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_part = trim($_POST['id_part']);
        $nama = trim($_POST['nama']);
        $satuan = trim($_POST['satuan']);
        $harga_beli = trim($_POST['hargabeli']);
        $harga_jual= trim($_POST['hargajual']);
        $diskon = trim($_POST['diskon']);
        $ppn = trim($_POST['ppn']);
        $stock = trim($_POST['stock']);
        $supplier = trim($_POST['supplier']);
       
        //message_back($id_part);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_part WHERE id_part='$id_part'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_part (id_part,nama,fk_satuan,harga_beli,harga_jual,diskon,ppn,stock,fk_supplier,tgl_masuk) VALUES ('$id_part','$nama','$satuan','$harga_beli','$harga_jual','$diskon','$ppn','$stock','$supplier', NOW())";
            mysql_query($sqltbemp);
           // echo $sqltbemp;
            //echo 'n';
        }
?>