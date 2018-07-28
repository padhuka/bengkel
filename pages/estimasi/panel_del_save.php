<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $idestimasi = $_GET['idestimasi'];
        $id = $_GET['id'];
        //UPDATE t_estimasi
        $sqlpanel= "SELECT sum(harga_jual_panel) AS totjualpanel,sum(harga_diskon_panel) AS totdiskonpanel, sum(harga_total_estimasi_panel) AS totestimasipanel FROM t_estimasi_panel_detail WHERE id='$id'";
            $hpanel= mysql_fetch_array(mysql_query($sqlpanel));
            //jml part
            $sqles= "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
            $hpes= mysql_fetch_array(mysql_query($sqles));

            $totgrospanel=$hpes['total_gross_harga_panel']-$hpanel['totjualpanel'];
            $totdiskonpanel=$hpes['total_diskon_rupiah_panel']-$hpanel['totdiskonpanel'];
            $totnettopanel=$hpes['total_netto_harga_panel']-$hpanel['totestimasipanel'];

            $totgros=$hpes['total_gross_harga_jasa']-$hpanel['totjualpanel'];
            $totdiskon=$hpes['total_diskon_rupiah_jasa']-$hpanel['totdiskonpanel'];
            $totnetto=$hpes['total_netto_harga_jasa']-$hpanel['totestimasipanel'];

            $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_panel='$totgrospanel',total_diskon_rupiah_panel='$totdiskonpanel', total_netto_harga_panel='$totnettopanel',total_gross_harga_jasa='$totgros', total_diskon_rupiah_jasa='$totdiskon',total_netto_harga_jasa='$totnetto' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);

		$id = $_GET['id'];
		# HAPUS DATA 
		$sqlhapusasuransi = "DELETE FROM t_estimasi_panel_detail WHERE id='$id'";
   		mysql_query( $sqlhapusasuransi );
?>
