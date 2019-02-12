<?php
        include_once '../../lib/config.php';
         //$ip = ; // Ambil IP Address dari User
        $id_partner_bank = trim($_POST['id_partner_bank']);
        $id_partner_bankhiden = trim($_POST['idpartnerbank']);

        $nama = trim($_POST['nama']);
        $namahiden= trim($_POST['namapartnerbank']);

        $no_telp = trim($_POST['notelp']);
        $alamat = trim($_POST['alamat']);
        $sqlcek = "SELECT * FROM t_partner_bank WHERE id_partner_bank='$id_partner_bank' AND id_partner_bank<>'$id_partner_bankhiden'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
                $sqltbemp = "UPDATE t_partner_bank SET nama='$nama',no_telp='$no_telp',alamat='$alamat' WHERE id_partner_bank='$id_partner_bank'";
                mysql_query($sqltbemp);
           // echo '
     }
?>