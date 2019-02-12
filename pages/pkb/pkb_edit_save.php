<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
         //$ip = ; // Ambil IP Address dari User
        //$id_pkb = trim($_POST['id_pkb']);
        $idestimasi = trim($_POST['idestimasi']);
        //message_back($id_pkb);
        //$kodeawal = 'est_'.$hrini.'_';
        $hrn2= date('dmy' , strtotime($hrini));
  //EST.BR.020818.000001
        $kodeawal = 'PKB_BR.'.$hrn2.'.';
        $sqljur = "SELECT * FROM t_pkb WHERE id_pkb LIKE '$kodeawal%' ORDER BY id_pkb DESC";
        $resultjur = mysql_query( $sqljur );
        $jur = mysql_fetch_array( $resultjur );
        if (empty($jur['id_pkb'])){
            $kodeakhir = '000001';
        }else{
            # GENERATE
            $kode = $jur['id_pkb'];
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

            $sqlest = "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi'";
            $hest= mysql_fetch_array(mysql_query($sqlest));


            $sqltbemp = "INSERT INTO t_pkb (id_pkb,fk_no_chasis,fk_no_mesin,fk_no_polisi,km_masuk,fk_user,kategori,fk_customer,fk_asuransi,fk_estimasi,total_gross_harga_panel,total_diskon_rupiah_panel,total_netto_harga_panel,total_gross_harga_part,total_diskon_rupiah_part,total_netto_harga_part,total_gross_harga_jasa,total_diskon_rupiah_jasa,total_netto_harga_jasa) VALUES ('$kodebaru','$hest[fk_no_chasis]','$hest[fk_no_mesin]','$hest[fk_no_polisi]','$hest[km_masuk]','$hest[fk_user]','$hest[kategori]','$hest[fk_customer]','$hest[fk_asuransi]','$hest[id_estimasi]','$hest[total_gross_harga_panel]','$hest[total_diskon_rupiah_panel]','$hest[total_netto_harga_panel]','$hest[total_gross_harga_part]','$hest[total_diskon_rupiah_part]','$hest[total_netto_harga_part]','$hest[total_gross_harga_jasa]','$hest[total_diskon_rupiah_jasa]','$hest[total_netto_harga_jasa]')";
            mysql_query($sqltbemp);
            //echo $sqltbemp;
            //echo $kodebaru.'-'.$warnanm;
            //insert panel pkb
            
            $sqlpanelest="SELECT * FROM t_estimasi_panel_detail WHERE fk_estimasi='$idestimasi'";
            $qpanelest=mysql_query($sqlpanelest);
            while($hpanelest=mysql_fetch_array($qpanelest)){

                $sqlpanelpkb = "INSERT INTO t_pkb_panel_detail (fk_pkb,fk_panel,harga_jual_panel,diskon_panel,harga_diskon_panel,harga_total_pkb_panel,mark_panel) VALUES ('$kodebaru','$hpanelest[fk_panel]','$hpanelest[harga_jual_panel]','$hpanelest[diskon_panel]','$hpanelest[harga_diskon_panel]','$hpanelest[harga_total_estimasi_panel]','$hpanelest[mark_panel]')";
                mysql_query($sqlpanelpkb);

            }

            $sqlpartest="SELECT * FROM t_estimasi_part_detail WHERE fk_estimasi='$idestimasi'";
            $qpartest=mysql_query($sqlpartest);
            while($hpartest=mysql_fetch_array($qpartest)){

                $sqlpartpkb = "INSERT INTO t_pkb_part_detail (fk_pkb,fk_part,harga_jual_part,diskon_part,harga_diskon_part,harga_total_pkb_part,mark_part,qty_part) VALUES ('$kodebaru','$hpartest[fk_part]','$hpartest[harga_jual_part]','$hpartest[diskon_part]','$hpartest[harga_diskon_part]','$hpartest[harga_total_estimasi_part]','$hpartest[mark_part]','$hpartest[qty_part]')";
                mysql_query($sqlpartpkb);

            }
        
?>