<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$nochasis = trim($_POST['nochasis']);
        $nomesin = trim($_POST['nomesin']);
        $nopolisi= trim($_POST['nopolisi']);
        $tipekendaraan = trim($_POST['tipe']);
        $warnakendaraan= trim($_POST['warna']);
        $customer = trim($_POST['customer']);
        $namastnk = trim($_POST['namastnk']);
        $alamatstnk = trim($_POST['alamatstnk']);
    
       
        //message_back($id_part);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_inventory_bengkel WHERE no_chasis='$nochasis'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_inventory_bengkel (no_chasis,no_mesin,no_polisi,fk_tipe_kendaraan,fk_warna_kendaraan,fk_customer,nama_stnk,alamat_stnk) VALUES ('$nochasis','$nomesin','$nopolisi','$tipekendaraan','$warnakendaraan','$customer','$namastnk','$alamatstnk')";
            mysql_query($sqltbemp);
           // echo $sqltbemp;
            //echo 'n';
        }
?>