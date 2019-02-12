<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
        $nochasis = trim($_POST['no_chasis']);
        $no_chasishid = trim($_POST['no_chasishid']);
        $nomesin = trim($_POST['no_mesin']);
        $nopolisi= trim($_POST['no_polisi']);
        $tipekendaraan = trim($_POST['tipe']);
        $warnakendaraan= trim($_POST['warna']);
        $customer = trim($_POST['customer']);
        $namastnk = trim($_POST['namastnk']);
        $alamatstnk = trim($_POST['alamatstnk']);
		 #cek no_chasissurat
        //$sqlcek = "SELECT * FROM t_inventory_bengkel WHERE (no_chasis='$no_chasis' AND no_chasis<>'$no_chasishid') OR (nama='$nama' AND nama<>'$namahid')";
        $sqlcek = "SELECT * FROM t_inventory_bengkel WHERE no_chasis='$nochasis' AND no_chasis<>'$no_chasishid'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);
        if ($row){
            echo 'y';
        }else{
		        $sqltbemp = "UPDATE t_inventory_bengkel SET no_chasis='$nochasis',no_mesin='$nomesin',no_polisi='$nopolisi',fk_tipe_kendaraan='$tipekendaraan',fk_warna_kendaraan='$warnakendaraan',fk_customer='$customer', nama_stnk='$namastnk',alamat_stnk='$alamatstnk' WHERE no_chasis='$nochasis'";
        		mysql_query($sqltbemp);
          // echo 'n';
        }
?>