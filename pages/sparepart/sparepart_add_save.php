<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';

        $id_pkb = trim($_POST['id_pkb']);
        $id_parts = $_POST['id_part'];  // array
        $harga_belis = $_POST['harga_beli'];  // array
        $harga_juals = $_POST['harga_jual'];  // array

        $has_duplicate = false;

        // Fetch tgl_pkb from t_pkb table
        $query_pkb = mysqli_query($objConn, "SELECT tgl FROM t_pkb WHERE id_pkb = '$id_pkb'");
        if($query_pkb && mysqli_num_rows($query_pkb) > 0) {
            $pkb_data = mysqli_fetch_array($query_pkb);
            $tgl_pkb = date('Y-m-d', strtotime($pkb_data['tgl']));
        } else {
            $tgl_pkb = date('Y-m-d'); // Fallback to current date
        }

        // Loop through all parts
        foreach($id_parts as $index => $id_part) {
            $id_part = trim($id_part);
            $harga_beli = trim($harga_belis[$index]);
            $harga_jual = trim($harga_juals[$index]);

            // Check duplicate
            $cek = mysqli_query($objConn, "SELECT * FROM t_part_pkb WHERE id_part='$id_part' AND id_pkb='$id_pkb'");
            if(mysqli_num_rows($cek) > 0) {
                $has_duplicate = true;
            } else {
                $sqltbemp = "INSERT INTO t_part_pkb (id_part, harga_beli, harga_jual, id_pkb, tgl_pkb) VALUES ('$id_part', '$harga_beli', '$harga_jual', '$id_pkb', '$tgl_pkb')";
                mysqli_query($objConn, $sqltbemp);
            }
        }

        if ($has_duplicate){
            echo 'y';
        }else{
            echo 'n';
        }
?>
