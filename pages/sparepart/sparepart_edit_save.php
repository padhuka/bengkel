<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';

        $id = trim($_POST['id']);
        $harga_beli = trim($_POST['harga_beli']);
        $harga_jual = trim($_POST['harga_jual']);

        $sqltbemp = "UPDATE t_part_pkb SET harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE id='$id'";
        mysqli_query($objConn, $sqltbemp);

        echo 'n';
?>
