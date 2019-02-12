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
        $tglselesai = trim($_POST['tglselesai']);
        //message_back($id_estimasi);
        //$kodeawal = 'est_'.$hrini.'_';
        $hrn2= date('dmy' , strtotime($hrini));
  //EST.BR.020818.000001
        $kodeawal2 = 'EST_BR.';
        $kodeawal = 'EST_BR.'.$hrn2.'.';
        //$sqljur = "SELECT * FROM t_estimasi WHERE id_estimasi LIKE '$kodeawal2%' ORDER BY id_estimasi DESC";
        $sqljur = "SELECT * FROM t_estimasi ORDER BY tgl DESC";
        $resultjur = mysql_query($sqljur);
        $jur = mysql_fetch_array($resultjur);
        if (empty($jur['id_estimasi'])){
            $kodeakhir = '000001';
        }else{
            # GENERATE
            $kode = $jur['id_estimasi'];
            $pecah = explode('.',$kode);
            $nilbaru = $pecah[2] + 1;
            $panj = strlen($nilbaru);
            //message_back($panj);
            switch($panj){
                default : break;
                case '1' : $kodeakhir='00000'.$nilbaru; break;
                case '2' : $kodeakhir='0000'.$nilbaru; break;
                case '3' : $kodeakhir='000'.$nilbaru; break;
                case '4' : $kodeakhir='00'.$nilbaru; break;
                case '5' : $kodeakhir='0'.$nilbaru; break;
                case '6' : $kodeakhir=$nilbaru; break;
            }
        }
        
        $kodebaru = $kodeawal.$kodeakhir;     
        
        $sqltbemp = "INSERT INTO t_estimasi (id_estimasi,fk_no_chasis,fk_no_mesin,fk_no_polisi,km_masuk,fk_user,kategori,fk_customer,fk_asuransi,tgl_estimasi_selesai) VALUES ('$kodebaru','$chasis','$mesin','$polisi','$kmmasuk','$uname','$kategori','$customer','$asuransi','$tglselesai')";
            mysql_query($sqltbemp);
            echo $kodebaru.'-'.$warnanm;
?>