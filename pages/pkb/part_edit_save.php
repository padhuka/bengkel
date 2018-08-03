<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id = trim($_POST['idep']);
        $id_part = trim($_POST['partep']);
        $idpkb = trim($_POST['idpkbep']);
        $diskon = trim($_POST['diskonep']);
        $hargajual= trim($_POST['hargapokokep']);
        $hargajuallm= trim($_POST['hargapokoklmep']);
        $hargadiskon= ($diskon*$hargajual)/100;
        $hargadiskonlm= trim($_POST['hargadiskonlmep']);
        $total= trim($_POST['hargatotalep']);
        $totallm= trim($_POST['hargatotallmep']);
        $qty= trim($_POST['qty']);

         $updatepart = "UPDATE t_pkb_part_detail SET fk_part='$id_part',harga_jual_part='$hargajual', harga_diskon_part='$hargadiskon',harga_total_pkb_part='$total',diskon_part='$diskon',qty_part='$qty' WHERE id='$id'";
            mysql_query($updatepart);
            //echo $updatepart;


           $sqlpart= "SELECT sum(harga_jual_part*qty_part) AS totjualpart,sum(harga_diskon_part*qty_part) AS totdiskonpart, sum(harga_total_pkb_part) AS totpkbpart FROM t_pkb_part_detail WHERE fk_pkb = '$idpkb'";
            $hpart= mysql_fetch_array(mysql_query($sqlpart));
            //jml part

            $totgrospart=$hpart['totjualpart'];
            $totdiskonpart=$hpart['totdiskonpart'];
            $totnettopart=$hpart['totpkbpart'];

            $updatepart = "UPDATE t_pkb set total_gross_harga_part='$totgrospart', total_diskon_rupiah_part='$totdiskonpart', total_netto_harga_part='$totnettopart' WHERE id_pkb='$idpkb'";
            mysql_query($updatepart);



            $sqles= "SELECT sum(total_gross_harga_panel+total_gross_harga_part) as total_gross_harga_jasa,sum(total_diskon_rupiah_panel+total_diskon_rupiah_part) as total_diskon_rupiah_jasa,sum(total_netto_harga_panel+total_netto_harga_part) as total_netto_harga_jasa FROM t_pkb WHERE id_pkb = '$idpkb'";
           
            $hpes= mysql_fetch_array(mysql_query($sqles));

         

            $totgrosjasa=$hpes['total_gross_harga_jasa'];
            $totdiskonjasa=$hpes['total_diskon_rupiah_jasa'];
            $totnettojasa=$hpes['total_netto_harga_jasa'];



           $updatepkb = "UPDATE t_pkb SET total_gross_harga_jasa='$totgrosjasa', total_diskon_rupiah_jasa='$totdiskonjasa',total_netto_harga_jasa='$totnettojasa' WHERE id_pkb='$idpkb'";
              mysql_query($updatepkb);



?>