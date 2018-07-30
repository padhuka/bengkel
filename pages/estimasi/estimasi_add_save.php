<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
         //$ip = ; // Ambil IP Address dari User
        //$id_estimasi = trim($_POST['id_estimasi']);
        $chasis = trim($_POST['chasis']);
        $mesin = trim($_POST['mesin']);
        $polisi = trim($_POST['polisi']);
        $warna = trim($_POST['warna']);
        $warnanm = trim($_POST['warnanm']);
        $kmmasuk = trim($_POST['kmmasuk']);
        $uname = trim($_POST['uname']);
        $kategori = trim($_POST['kategori']);
        $customer = trim($_POST['customer']);
        $asuransi = trim($_POST['asuransi']);
        //message_back($id_estimasi);
        //$kodeawal = 'est_'.$hrini.'_';
        $kodeawal = 'est_';
        $sqljur = "SELECT * FROM t_estimasi WHERE id_estimasi LIKE '$kodeawal%' ORDER BY id_estimasi DESC";
        $resultjur = mysql_query( $sqljur );
        $jur = mysql_fetch_array( $resultjur );
        if (empty($jur['id_estimasi'])){
            $kodeakhir = '001';
        }else{
            # GENERATE
            $kode = $jur['id_estimasi'];
            $pecah = explode('_',$kode);
            $nilbaru = $pecah[1] + 1;
            $panj = strlen($nilbaru);
            //message_back($panj);
            switch($panj){
                default : break;
                case '1' : $kodeakhir='00'.$nilbaru; break;
                case '2' : $kodeakhir='0'.$nilbaru; break;
                case '3' : $kodeakhir=$nilbaru; break;
            }
        }
        
        $kodebaru = $kodeawal.$kodeakhir;         

        
            $sqltbemp = "INSERT INTO t_estimasi (id_estimasi,fk_no_chasis,fk_no_mesin,fk_no_polisi,km_masuk,fk_user,kategori,fk_customer,fk_asuransi) VALUES ('$kodebaru','$chasis','$mesin','$polisi','$kmmasuk','$uname','$kategori','$customer','$asuransi')";
            mysql_query($sqltbemp);
            echo $kodebaru.'-'.$warnanm;
        
?>