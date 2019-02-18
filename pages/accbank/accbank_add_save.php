<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
      
        $fk_akun = trim($_POST['idaccbank']);
        $ref_akun = trim($_POST['idacc']); 
        $nominal = trim($_POST['nominal']);  
        $amount= str_replace(".", "", $nominal);
        $description = trim($_POST['keterangan']); 
        $transaction_type=trim($_POST['transaction_type']);
        $tr_date = trim($_POST['datebank']);
       // echo $idpkb;
       // echo $idkwitansi;
        //[13:11, 12/6/2018] St3 Dhuka: misal Kas/Bank Masuk = KM_ACCT_XXXX
        //[13:11, 12/6/2018] St3 Dhuka: Kas/Bank Keluar = KUK_ACCT_XX
        
        $hrn2= date('dmy' , strtotime($hrini));
        if ($transaction_type=='D'){
            $kodeawal2 = 'KM_ACCT.';
            $kodeawal = 'KM_ACCT.'.$hrn2.'.';
        }
        if ($transaction_type=='C'){
            $kodeawal2 = 'KUK_ACCT.';
            $kodeawal = 'KUK_ACCT.'.$hrn2.'.';
        }
        
        $sqljur = "SELECT * FROM t_acc_bank ORDER BY urut DESC";
        $resultjur = mysql_query( $sqljur );
        $jur = mysql_fetch_array( $resultjur );
        if (empty($jur['no_bukti'])){
            $kodeakhir = '000001';
        }else{
            # GENERATE
            $kode = $jur['no_bukti'];
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

        
            $sqltbemp = "INSERT INTO t_acc_bank (no_bukti, tr_date, transaction_type, fk_akun, via_bayar, ref_akun, amount, description, status, diterima_dari)VALUES ('$kodebaru', '$tr_date', '$transaction_type', '$fk_akun', '', '$ref_akun', '$amount', '$description', '', '')";
            //echo "$sqltbemp";
            mysql_query($sqltbemp);
            //echo $kodebaru.'-'.$warnanm;    
?>