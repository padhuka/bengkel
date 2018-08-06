<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';

        $idestimasi = trim($_POST['idestimasi']);
        $nilaikwitansi = trim($_POST['nilaikwitansi']);
        $diskonor = trim($_POST['diskonor']);
        $keterangan = trim($_POST['keterangan']);

        $hrn2= date('dmy' , strtotime($hrini));
        $kodeawal2 = 'OR_BR.';
        $kodeawal = 'OR_BR.'.$hrn2.'.';
        $sqljur = "SELECT * FROM t_kwitansi_or WHERE no_kwitansi_or LIKE '$kodeawal2%' ORDER BY no_kwitansi_or DESC";
        $resultjur = mysql_query( $sqljur );
        $jur = mysql_fetch_array( $resultjur );
        if (empty($jur['no_kwitansi_or'])){
            $kodeakhir = '000001';
        }else{
            # GENERATE
            $kode = $jur['no_kwitansi_or'];
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

        //echo $idestimasi;
            // $sqlest = "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi'";
            // $hest= mysql_fetch_array(mysql_query($sqlest));

        
        $sqltbemp = "INSERT INTO t_kwitansi_or (no_kwitansi_or,fk_estimasi,nilai_kwitansi,diskon_or,keterangan) VALUES ('$kodebaru','$idestimasi','$nilaikwitansi','$diskonor','$keterangan')";

            mysql_query($sqltbemp);
           // echo $sqltbemp;
        //    echo $kodebaru.'-'.$warnanm;
        
?>