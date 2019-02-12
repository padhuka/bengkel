<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id = trim($_POST['idep']);
        $id_part = trim($_POST['parte']);
        $idestimasi = trim($_POST['idestimasiep']);
        $diskon = trim($_POST['diskonep']);
        $qty = trim($_POST['qtye']);
        $hargajual= trim($_POST['hargapokokep']);
        $hargajuallm= trim($_POST['hargapokoklmep']);
        $hargadiskon= ($diskon*$hargajual)/100;
        $hargadiskonlm= trim($_POST['hargadiskonlmep']);
        $total= trim($_POST['hargatotalep']);
        $totallm= trim($_POST['hargatotallmep']);
        $mark= trim($_POST['markep']);

         $updatepart = "UPDATE t_estimasi_part_detail SET fk_part='$id_part',qty_part='$qty',harga_jual_part='$hargajual', harga_diskon_part='$hargadiskon',harga_total_estimasi_part='$total',diskon_part='$diskon',mark_part='$mark' WHERE id='$id'";
            mysql_query($updatepart);


           $sqlpart= "SELECT sum(harga_jual_part*qty_part) AS totjualpart,sum(harga_diskon_part*qty_part) AS totdiskonpart, sum(harga_total_estimasi_part) AS totestimasipart FROM t_estimasi_part_detail WHERE fk_estimasi = '$idestimasi'";
            $hpart= mysql_fetch_array(mysql_query($sqlpart));
            //jml part

            $totgrospart=$hpart['totjualpart'];
            $totdiskonpart=$hpart['totdiskonpart'];
            $totnettopart=$hpart['totestimasipart'];

            $updatepart = "UPDATE t_estimasi set total_gross_harga_part='$totgrospart', total_diskon_rupiah_part='$totdiskonpart', total_netto_harga_part='$totnettopart' WHERE id_estimasi='$idestimasi'";
            mysql_query($updatepart);



            $sqles= "SELECT sum(total_gross_harga_panel+total_gross_harga_part) as total_gross_harga_jasa,sum(total_diskon_rupiah_panel+total_diskon_rupiah_part) as total_diskon_rupiah_jasa,sum(total_netto_harga_panel+total_netto_harga_part) as total_netto_harga_jasa FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
           
            $hpes= mysql_fetch_array(mysql_query($sqles));

         

            $totgrosjasa=$hpes['total_gross_harga_jasa'];
            $totdiskonjasa=$hpes['total_diskon_rupiah_jasa'];
            $totnettojasa=$hpes['total_netto_harga_jasa'];



           $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_jasa='$totgrosjasa', total_diskon_rupiah_jasa='$totdiskonjasa',total_netto_harga_jasa='$totnettojasa' WHERE id_estimasi='$idestimasi'";
              mysql_query($updateestimasi);



?>