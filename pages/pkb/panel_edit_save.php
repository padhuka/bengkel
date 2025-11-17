<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id = trim($_POST['ide']);
        $id_panel = trim($_POST['panele']);
        $idpkb = trim($_POST['idpkbe']);
        $diskon = trim($_POST['diskone']);
        $hargajual= trim($_POST['hargapokoke']);
        $hargajuallm= trim($_POST['hargapokoklme']);
        $hargadiskon= ($diskon*$hargajual)/100;
        $hargadiskonlm= trim($_POST['hargadiskonlme']);
        $total= trim($_POST['hargatotale']);
        $totallm= trim($_POST['hargatotallme']);

          $updatepanel = "UPDATE t_pkb_panel_detail SET fk_panel='$id_panel',harga_jual_panel='$hargajual', harga_diskon_panel='$hargadiskon',harga_total_pkb_panel='$total',diskon_panel='$diskon'WHERE id='$id'";
            mysqli_query($objConn, $updatepanel);

            $sqlpanel= "SELECT sum(harga_jual_panel) AS totjualpanel,sum(harga_diskon_panel) AS totdiskonpanel, sum(harga_total_pkb_panel) AS totpkbpanel FROM t_pkb_panel_detail WHERE fk_pkb = '$idpkb'";
            $hpanel= mysqli_fetch_array(mysqli_query($objConn, $sqlpanel));
            //jml panel

            $totgrospanel=$hpanel['totjualpanel'];
            $totdiskonpanel=$hpanel['totdiskonpanel'];
            $totnettopanel=$hpanel['totpkbpanel'];

            $updatepanel = "UPDATE t_pkb set total_gross_harga_panel='$totgrospanel', total_diskon_rupiah_panel='$totdiskonpanel', total_netto_harga_panel='$totnettopanel' WHERE id_pkb='$idpkb'";
            mysqli_query($objConn, $updatepanel);


            $sqles= "SELECT sum(total_gross_harga_panel+total_gross_harga_part) as total_gross_harga_jasa,sum(total_diskon_rupiah_panel+total_diskon_rupiah_part) as total_diskon_rupiah_jasa,sum(total_netto_harga_panel+total_netto_harga_part) as total_netto_harga_jasa FROM t_pkb WHERE id_pkb = '$idpkb'";
           
            $hpes= mysqli_fetch_array(mysqli_query($objConn, $sqles));

         

            $totgrosjasa=$hpes['total_gross_harga_jasa'];
            $totdiskonjasa=$hpes['total_diskon_rupiah_jasa'];
            $totnettojasa=$hpes['total_netto_harga_jasa'];



           $updatepkb = "UPDATE t_pkb SET total_gross_harga_jasa='$totgrosjasa', total_diskon_rupiah_jasa='$totdiskonjasa',total_netto_harga_jasa='$totnettojasa' WHERE id_pkb='$idpkb'";
              mysqli_query($objConn, $updatepkb);



?>