<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id = trim($_POST['ide']);
        $id_panel = trim($_POST['panele']);
        $idestimasi = trim($_POST['idestimasie']);
        $diskon = trim($_POST['diskone']);
        $hargajual= trim($_POST['hargapokoke']);
        $hargajuallm= trim($_POST['hargapokoklme']);
        $hargadiskon= ($diskon*$hargajual)/100;
        $hargadiskonlm= trim($_POST['hargadiskonlme']);
        $total= trim($_POST['hargatotale']);
        $totallm= trim($_POST['hargatotallme']);

            $sqlpanel= "SELECT sum(harga_jual_panel) AS totjualpanel,sum(harga_diskon_panel) AS totdiskonpanel, sum(harga_total_estimasi_panel) AS totestimasipanel FROM t_estimasi_panel_detail WHERE fk_estimasi='$idestimasi'";
            $hpanel= mysql_fetch_array(mysql_query($sqlpanel));
            //jml part
            $sqles= "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
            $hpes= mysql_fetch_array(mysql_query($sqles));

            $totgrospanel=$hpanel['totjualpanel']+$hargajual-$hargajuallm;
            $totdiskonpanel=$hpanel['totdiskonpanel']+$hargadiskon-$hargadiskonlm;
            $totnettopanel=$total-$hpanel['totestimasipanel']+$total-$totallm;

            $totgros=$hpes['total_gross_harga_jasa']+$hargajual-$hargajuallm;
            $totdiskon=$hpes['total_diskon_rupiah_jasa']+$hargadiskon-$hargadiskonlm;
            $totnetto=$hpes['total_netto_harga_jasa']+$total-$totallm;

            $updatepanel = "UPDATE t_estimasi_panel_detail SET fk_panel='$id_panel',harga_jual_panel='$hargajual', harga_diskon_panel='$hargadiskon',harga_total_estimasi_panel='$total',diskon_panel='$diskon' WHERE id='$id'";
            mysql_query($updatepanel);

            $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_panel='$totgrospanel',total_diskon_rupiah_panel='$totdiskonpanel', total_netto_harga_panel='$totnettopanel',total_gross_harga_jasa='$totgros', total_diskon_rupiah_jasa='$totdiskon',total_netto_harga_jasa='$totnetto' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);



?>