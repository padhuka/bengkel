<?php
        include_once '../../lib/config.php';
         //$ip = ; // Ambil IP Address dari User
        $id_tipe_kendaraan = trim($_POST['id_tipe_kendaraan']);
        $id_tipehiden = trim($_POST['idtipekendaraan']);

        $nama = trim($_POST['nama']);
        $namahiden= trim($_POST['namakendaraan']);
        $group = trim($_POST['group']);

        $sqlcek = "SELECT * FROM t_tipe_kendaraan WHERE id_tipe_kendaraan='$id_tipe_kendaraan' AND id_tipe_kendaraan<>'$id_tipehiden'";
        $qrycek = mysqli_query($objConn, $sqlcek);
        $row = mysqli_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
                $sqltbemp = "UPDATE t_tipe_kendaraan SET nama='$nama',fk_group_kendaraan='$group' WHERE id_tipe_kendaraan='$id_tipe_kendaraan'";
                mysqli_query($objConn, $sqltbemp);
           // echo '
     }
?>