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
      
		    $sqltbemp = "INSERT INTO t_estimasi_panel_detail (fk_estimasi,fk_panel,harga_jual_panel,diskon_panel,harga_diskon_panel,harga_total_estimasi_panel) VALUES ('$idestimasi','$id_panel','$hargajual','$diskon','$hargadiskon','$total')";
            mysql_query($sqltbemp);

            //echo 'n';
            //jml panel
            $sqlpanel= "SELECT sum(harga_jual_panel) AS totjualpanel,sum(harga_diskon_panel) AS totdiskonpanel, sum(harga_total_estimasi_panel) AS totestimasipanel FROM t_estimasi_panel_detail WHERE fk_estimasi = '$idestimasi'";
            $hpanel= mysql_fetch_array(mysql_query($sqlpanel));
            //jml part
            $sqlpart= "SELECT sum(harga_jual_part*qty_part) AS totjualpart,sum(harga_diskon_part*qty_part) AS totdiskonpart, sum(harga_total_estimasi_part*qty_part) AS totestimasipart FROM t_estimasi_part_detail WHERE fk_estimasi = '$idestimasi'";
            $hpart= mysql_fetch_array(mysql_query($sqlpart));

            $updateestimasi = "UPDATE SET total_gross_harga_panel='$hpanel[totjualpanel]',total_diskon_rupiah_panel='$hpanel[totdiskonpanel]', total_netto_harga_panel='$hpanel[totestimasipanel]',total_gross_harga_part='$hpart[totjualpart]',total_diskon_rupiah_part='$hpart[totdiskonpart]', total_netto_harga_part='$hpart[totestimasipart]',total_gross_harga_jasa='$hpanel[totjualpanel]+$hpart[totjualpart]', total_diskon_rupiah_jasa='$hpanel[totdiskonpanel]-$hpart[totdiskonpart]',total_netto_harga_jasa=$hpanel[totestimasipanel]-$hpanel[totestimasipart]";

?>