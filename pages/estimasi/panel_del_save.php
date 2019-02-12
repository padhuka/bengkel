<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $idestimasi = $_GET['idestimasi'];
        $id = $_GET['id'];


        $sqlhapusasuransi = "DELETE FROM t_estimasi_panel_detail WHERE id='$id'";
        mysql_query( $sqlhapusasuransi );
        //UPDATE t_estimasi
         // echo "$idestimasi";

          $sqlpanel= "SELECT sum(harga_jual_panel) AS totjualpanel,sum(harga_diskon_panel) AS totdiskonpanel, sum(harga_total_estimasi_panel) AS totestimasipanel FROM t_estimasi_panel_detail WHERE fk_estimasi = '$idestimasi'";
            $hpanel= mysql_fetch_array(mysql_query($sqlpanel));
            //jml panel

            $totgrospanel=$hpanel['totjualpanel'];
            $totdiskonpanel=$hpanel['totdiskonpanel'];
            $totnettopanel=$hpanel['totestimasipanel'];

            $updatepanel = "UPDATE t_estimasi set total_gross_harga_panel='$totgrospanel', total_diskon_rupiah_panel='$totdiskonpanel', total_netto_harga_panel='$totnettopanel' WHERE id_estimasi='$idestimasi'";
            mysql_query($updatepanel);

            $sqles= "SELECT sum(total_gross_harga_panel+total_gross_harga_part) as total_gross_harga_jasa,sum(total_diskon_rupiah_panel+total_diskon_rupiah_part) as total_diskon_rupiah_jasa,sum(total_netto_harga_panel+total_netto_harga_part) as total_netto_harga_jasa FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
           
            $hpes= mysql_fetch_array(mysql_query($sqles));

         

            $totgrosjasa=$hpes['total_gross_harga_jasa'];
            $totdiskonjasa=$hpes['total_diskon_rupiah_jasa'];
            $totnettojasa=$hpes['total_netto_harga_jasa'];



           $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_jasa='$totgrosjasa', total_diskon_rupiah_jasa='$totdiskonjasa',total_netto_harga_jasa='$totnettojasa' WHERE id_estimasi='$idestimasi'";
              mysql_query($updateestimasi);

		
		# HAPUS DATA 
		
?>
