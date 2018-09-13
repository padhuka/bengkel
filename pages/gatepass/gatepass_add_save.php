<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
      
        $tgl = trim($_POST['tgl']);
        $idpkb = trim($_POST['idpkb']); 
        $status = trim($_POST['status']); 
     
        $hrn2= date('dmy' , strtotime($hrini));
        $kodeawal2 = 'GP_BR.';
        $kodeawal = 'GP_BR.'.$hrn2.'.';
        $sqljur = "SELECT * FROM t_gate_pass ORDER BY tgl_trx DESC";
        $resultjur = mysql_query( $sqljur );
        $jur = mysql_fetch_array( $resultjur );
        if (empty($jur['no_gate_pass'])){
            $kodeakhir = '000001';
        }else{
            # GENERATE
            $kode = $jur['no_gate_pass'];
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

        
            $sqltbemp = "INSERT INTO t_gate_pass (no_gate_pass,tgl,fk_pkb,status) VALUES ('$kodebaru','$tgl','$idpkb','$status')";
           // echo "$sqltbemp";
            mysql_query($sqltbemp);
            //echo $kodebaru.'-'.$warnanm;        
?>