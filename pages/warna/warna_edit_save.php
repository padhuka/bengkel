<?php
        include_once '../../lib/config.php';
         //$ip = ; // Ambil IP Address dari User
        $id_warna_kendaraan = trim($_POST['id_warna_kendaraan']);
        $id_satuanhiden = trim($_POST['idwarnakendaraan']);

        $nama = trim($_POST['nama']);
        $namahiden= trim($_POST['namakendaraan']);

        $sqlcek = "SELECT * FROM t_warna_kendaraan WHERE id_warna_kendaraan='$id_warna_kendaraan' AND id_warna_kendaraan<>'$id_satuanhiden'";
        $qrycek = mysqli_query($objConn, $sqlcek);
        $row = mysqli_fetch_array($qrycek);

        if ($row){
            echo 'y';
        }else{
                $sqltbemp = "UPDATE t_warna_kendaraan SET nama='$nama' WHERE id_warna_kendaraan='$id_warna_kendaraan'";
                mysqli_query($objConn, $sqltbemp);
           // echo '
     }
?>