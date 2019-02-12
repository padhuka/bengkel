<?php
        include_once '../../lib/config.php';
         //$ip = ; // Ambil IP Address dari User
        $id_satuan = trim($_POST['id_satuan']);
        $id_satuanhiden = trim($_POST['idsatuan']);

        $nama = trim($_POST['nama']);
        $namahiden= trim($_POST['namasatuan']);

        $sqlcek = "SELECT * FROM t_satuan WHERE id_satuan='$id_satuan' AND id_satuan<>'$id_satuanhiden'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
                $sqltbemp = "UPDATE t_satuan SET nama='$nama' WHERE id_satuan='$id_satuan'";
                mysql_query($sqltbemp);
           // echo '
     }
?>