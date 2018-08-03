<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';

        $idpkb = trim($_POST['idpkb']);
        
      

      $("#chasis").val(b);
                              $("#mesin").val(c);
                              $("#polisi").val(d);
                              $("#nama").val(e);
                              $("#kategori").val(f);                              
                              $("#asuransi").val(h);
                              //--
                              $("#grosspanel").val(j);
                              $("#diskonpanel").val(k);
                              $("#nettopanel").val(l);
                              //--
                              $("#grosspart").val(m);
                              $("#diskonpart").val(n);
                              $("#nettopart").val(o);
                              //---
                              $("#grosstotal").val(p);
                              $("#diskontotal").val(q);
                              $("#nettototal").val(r);

                              $("#idpkb").val(s);
                              $("#ModalPkb").modal('hide');
       

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

        
        $sqltbemp = "INSERT INTO t_kwitansi (no_kwitansi,fk_pkb) VALUES ('$kodebaru','$idpkb')";

            mysql_query($sqltbemp);
           // echo $sqltbemp;
        //    echo $kodebaru.'-'.$warnanm;
        
?>