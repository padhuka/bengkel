<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id = trim($_POST['id']);
        $id_panel = trim($_POST['panel']);
        $idestimasi = trim($_POST['idestimasi']);
        $diskon = trim($_POST['diskon']);
        $hargajual= trim($_POST['hargapokok']);
        $hargadiskon= ($diskon*$hargajual)/100;
        $total= trim($_POST['hargatotal']);

            $sqlpanel= "SELECT sum(harga_jual_panel) AS totjualpanel,sum(harga_diskon_panel) AS totdiskonpanel, sum(harga_total_estimasi_panel) AS totestimasipanel FROM t_estimasi_panel_detail WHERE id='$id'";
            $hpanel= mysql_fetch_array(mysql_query($sqlpanel));
            //jml part
            $sqles= "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
            $hpes= mysql_fetch_array(mysql_query($sqles));

            $totgrospanel=$hpes['total_gross_harga_panel']+$hargajual-$hpanel['totjualpanel'];
            $totdiskonpanel=$hpes['total_diskon_rupiah_panel']+$hargadiskon-$hpanel['totdiskonpanel'];
            $totnettopanel=$hpes['total_netto_harga_panel']+$total-$hpanel['totestimasipanel'];

            $totgros=$hpes['total_gross_harga_jasa']+$hargajual-$hpanel['totjualpanel'];
            $totdiskon=$hpes['total_diskon_rupiah_jasa']+$hargadiskon-$hpanel['totdiskonpanel'];
            $totnetto=$hpes['total_netto_harga_jasa']+$total-$hpanel['totestimasipanel'];

            $updatepanel = "UPDATE t_estimasi SET fk_panel='$id_panel',harga_jual_panel='$hargajual', harga_diskon_panel='$hargadiskon',harga_total_estimasi_panel='$total', diskon_panel='$diskon' WHERE id='$id'"
            mysql_query($updatepanel);

            $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_panel='$totgrospanel',total_diskon_rupiah_panel='$totdiskonpanel', total_netto_harga_panel='$totnettopanel',total_gross_harga_jasa='$totgros', total_diskon_rupiah_jasa='$totdiskon',total_netto_harga_jasa='$totnetto' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);



?>