<?php
        include_once '../../lib/config.php';
         //$ip = ; // Ambil IP Address dari User
        $id_group_kendaraan = trim($_POST['id_group_kendaraan']);
        $id_group_hiden = trim($_POST['idgroupkendaraan']);

        $nama = trim($_POST['nama']);
        $namahiden= trim($_POST['namakendaraan']);

        $sqlcek = "SELECT * FROM t_group_kendaraan WHERE id_group_kendaraan='$id_group_kendaraan' AND id_group_kendaraan<>'$id_group_hiden'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
                $sqltbemp = "UPDATE t_group_kendaraan SET nama='$nama' WHERE id_group_kendaraan='$id_group_kendaraan'";
                mysql_query($sqltbemp);
           // echo '
     }
?>