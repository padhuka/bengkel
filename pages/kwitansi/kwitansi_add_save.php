<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';

        $idpkb = trim($_POST['idpkb']);
     
        $hrn2= date('dmy' , strtotime($hrini));
        $kodeawal2 = 'SI_BR.';
        $kodeawal = 'SI_BR.'.$hrn2.'.';
        $sqljur = "SELECT * FROM t_kwitansi WHERE no_kwitansi LIKE '$kodeawal2%' ORDER BY no_kwitansi DESC";
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

         $sqlest = "SELECT * FROM t_pkb WHERE id_pkb='$idpkb'";
         $hsl= mysql_fetch_array(mysql_query($sqlest));

            $grosspanel = $hsl['total_gross_harga_panel'];
            $diskonpanel = $hsl['total_diskon_rupiah_panel'];
            $nettopanel = $hsl['total_netto_harga_panel'];
            $grosspart = $hsl['total_gross_harga_part'];
            $diskonpart = $hsl['total_diskon_rupiah_part'];
            $nettopart = $hsl['total_netto_harga_part'];
            $grosstotal = $hsl['total_gross_harga_jasa'];
            $diskontotal = $hsl['total_diskon_rupiah_jasa'];
            $nettototal = $hsl['total_netto_harga_jasa'];

            $ppn = $nettototal*10/100;
            $payment = $nettototal+$ppn;

        
        $sqltbemp = "INSERT INTO t_kwitansi (no_kwitansi,fk_pkb,total_gross_panel,total_gross_part,total_diskon_panel,total_diskon_part,total_netto_panel,total_netto_part,total_ppn_kwitansi,total_kwitansi,total_payment) VALUES ('$kodebaru','$idpkb','$grosspanel','$grosspart','$diskonpanel','$diskonpart','$nettopanel','$nettopart',$ppn,'$nettototal',$payment)";

            mysql_query($sqltbemp);
         
        
?>