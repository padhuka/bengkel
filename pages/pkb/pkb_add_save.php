<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
         //$ip = ; // Ambil IP Address dari User
        //$id_estimasi = trim($_POST['id_estimasi']);
        $idestimasi = trim($_POST['idestimasi']);
        //message_back($id_estimasi);
        //$kodeawal = 'est_'.$hrini.'_';
        $hrn2= date('dmy' , strtotime($hrini));
  //EST.BR.020818.000001
        $kodeawal = 'PKB_BR.'.$hrn2.'.';
        $sqljur = "SELECT * FROM t_estimasi WHERE id_estimasi LIKE '$kodeawal%' ORDER BY id_estimasi DESC";
        $resultjur = mysql_query( $sqljur );
        $jur = mysql_fetch_array( $resultjur );
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

        
            $sqltbemp = "INSERT INTO t_estimasi (id_estimasi,fk_no_chasis,fk_no_mesin,fk_no_polisi,km_masuk,fk_user,kategori,fk_customer,fk_asuransi) VALUES ('$kodebaru','$chasis','$mesin','$polisi','$kmmasuk','$uname','$kategori','$customer','$asuransi')";
            mysql_query($sqltbemp);
            echo $kodebaru.'-'.$warnanm;
        
?>