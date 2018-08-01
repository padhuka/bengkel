<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_panel = trim($_POST['panel']);
        $idestimasi = trim($_POST['idestimasi']);
        $diskon = trim($_POST['diskon']);
        $hargajual= trim($_POST['hargapokok']);
        $hargadiskon= ($diskon*$hargajual)/100;
        $total= trim($_POST['hargatotal']);
      
		    $sqltbemp = "INSERT INTO t_estimasi_panel_detail (fk_estimasi,fk_panel,harga_jual_panel,diskon_panel,harga_diskon_panel,harga_total_estimasi_panel,mark) VALUES ('$idestimasi','$id_panel','$hargajual','$diskon','$hargadiskon','$total')";
            mysql_query($sqltbemp);

            //echo 'n';
            //jml panel
            $sqlpanel= "SELECT sum(harga_jual_panel) AS totjualpanel,sum(harga_diskon_panel) AS totdiskonpanel, sum(harga_total_estimasi_panel) AS totestimasipanel FROM t_estimasi_panel_detail WHERE fk_estimasi = '$idestimasi'";
            $hpanel= mysql_fetch_array(mysql_query($sqlpanel));
            //jml part
            $sqles= "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
            $hpes= mysql_fetch_array(mysql_query($sqles));

            $totgrospanel=$hpanel['totjualpanel'];
            $totdiskonpanel=$hpanel['totdiskonpanel'];
            $totnettopanel=$hpanel['totestimasipanel'];

            $totgros=$hargajual+$hpes['total_gross_harga_panel'];
            $totdiskon=$hargadiskon+$hpes['total_diskon_rupiah_panel'];
            $totnetto=$total+$hpes['total_netto_harga_panel'];

            $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_panel='$totgrospanel',total_diskon_rupiah_panel='$totdiskonpanel', total_netto_harga_panel='$totnettopanel',total_gross_harga_jasa='$totgros', total_diskon_rupiah_jasa='$totdiskon',total_netto_harga_jasa='$totnetto' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);
            //echo $updateestimasi;

?>