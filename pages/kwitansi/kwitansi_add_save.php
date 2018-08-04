<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';

        $idpkb = trim($_POST['idpkb']);
        $chasis = trim($_POST['chasis']);
        $mesin = trim($_POST['mesin']);
       // $polisi = trim($_POST['polisi']);
        $nama = trim($_POST['nama']);  
        $kategori = trim($_POST['kategori']); 
        $asuransi = trim($_POST['asuransi']);
        $grosspanel = trim($_POST['grosspanel']);
        $diskonpanel = trim($_POST['diskonpanel']);
        $nettopanel = trim($_POST['nettopanel']);
        $grosspart = trim($_POST['grosspart']);
        $diskonpart = trim($_POST['diskonpart']);
        $nettopart = trim($_POST['nettopart']);
        $grosstotal = trim($_POST['grosstotal']);
        $diskontotal = trim($_POST['diskontotal']);
        $nettototal = trim($_POST['nettototal']);

        $ppn = $nettototal*10/100;
        $payment = $nettototal+$ppn;


        $hrn2= date('dmy' , strtotime($hrini));
        $kodeawal = 'SI_BR.'.$hrn2.'.';
        $sqljur = "SELECT * FROM t_kwitansi WHERE no_kwitansi LIKE '$kodeawal%' ORDER BY no_kwitansi DESC";
        $resultjur = mysql_query( $sqljur );
        $jur = mysql_fetch_array( $resultjur );
        if (empty($jur['no_kwitansi'])){
            $kodeakhir = '000001';
        }else{
            # GENERATE
            $kode = $jur['no_kwitansi'];
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

        //echo $idpkb;
            // $sqlest = "SELECT * FROM t_estimasi WHERE id_estimasi='$idpkb'";
            // $hest= mysql_fetch_array(mysql_query($sqlest));

        
        $sqltbemp = "INSERT INTO t_kwitansi (no_kwitansi,fk_pkb,total_gross_panel,total_gross_part,total_diskon_panel,total_diskon_part,total_netto_panel,total_netto_part,total_ppn_kwitansi,total_kwitansi,total_payment) VALUES ('$kodebaru','$idpkb','$grosspanel','$grosspart','$diskonpanel','$diskonpart','$nettopanel','$nettopart',$ppn,'$nettototal',$payment)";

            mysql_query($sqltbemp);
           // echo $sqltbemp;
        //    echo $kodebaru.'-'.$warnanm;
        
?>