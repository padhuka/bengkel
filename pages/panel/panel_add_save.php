<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_panel = trim($_POST['id_panel']);
        $nama = trim($_POST['nama']);
        $harga_pokok = trim($_POST['hargapokok']);
        $harga_jual= trim($_POST['hargajual']);
        $diskon = trim($_POST['diskon']);
        $ppn = trim($_POST['ppn']);
        //message_back($id_panel);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_panel WHERE nama='$nama' OR id_panel='$id_panel'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
		    $sqltbemp = "INSERT INTO t_panel (id_panel,nama,harga_pokok,harga_jual,diskon,ppn) VALUES ('$id_panel','$nama','$harga_pokok','$harga_jual','$diskon','$ppn')";
            mysql_query($sqltbemp);
            //echo 'n';
        }
?>