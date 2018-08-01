<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
         //$ip = ; // Ambil IP Address dari User
        $idestimasi = trim($_POST['idestimasie']);
        $chasis = trim($_POST['chasise']);
        $mesin = trim($_POST['mesine']);
        $polisi = trim($_POST['polisie']);
        $warna = trim($_POST['warnae']);
        $warnanm = trim($_POST['warnanme']);
        $kmmasuk = trim($_POST['kmmasuke']);
        $uname = trim($_POST['unamee']);
        $kategori = trim($_POST['kategorie']);
        $customer = trim($_POST['customere']);
        $asuransi = trim($_POST['asuransie']);
        //message_back($id_estimasi);
        //$kodeawal = 'est_'.$hrini.'_';
        //UPDATE t_estimasi\
        $updateEs = "UPDATE t_estimasi SET fk_no_chasis='$chasis',fk_no_mesin='$mesin',fk_no_polisi='$polisi',km_masuk='$kmmasuk',fk_user='$uname',kategori='$kategori',fk_customer='$customer',fk_asuransi='$asuransi' WHERE id_estimasi='$idestimasi'";
        mysql_query($updateEs);
        echo $idestimasi.'-'.$warnanm;
        //echo $updateEs;      
?>