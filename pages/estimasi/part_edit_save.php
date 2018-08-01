<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id = trim($_POST['idep']);
        $id_part = trim($_POST['partep']);
        $idestimasi = trim($_POST['idestimasiep']);
        $diskon = trim($_POST['diskonep']);
        $hargajual= trim($_POST['hargapokokep']);
        $hargajuallm= trim($_POST['hargapokoklmep']);
        $hargadiskon= ($diskon*$hargajual)/100;
        $hargadiskonlm= trim($_POST['hargadiskonlmep']);
        $total= trim($_POST['hargatotalep']);
        $totallm= trim($_POST['hargatotallmep']);

            $sqlpart= "SELECT sum(harga_jual_part) AS totjualpart,sum(harga_diskon_part) AS totdiskonpart, sum(harga_total_estimasi_part) AS totestimasipart FROM t_estimasi_part_detail WHERE fk_estimasi='$idestimasi'";
            $hpart= mysql_fetch_array(mysql_query($sqlpart));
            //jml part
            $sqles= "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
            $hpes= mysql_fetch_array(mysql_query($sqles));

            $totgrospart=$hpart['totjualpart']+$hargajual-$hargajuallm;
            $totdiskonpart=$hpart['totdiskonpart']+$hargadiskon-$hargadiskonlm;
            $totnettopart=$total-$hpart['totestimasipart']+$total-$totallm;

            $totgros=$hpes['total_gross_harga_jasa']+$hargajual-$hargajuallm;
            $totdiskon=$hpes['total_diskon_rupiah_jasa']+$hargadiskon-$hargadiskonlm;
            $totnetto=$hpes['total_netto_harga_jasa']+$total-$totallm;

            $updatepart = "UPDATE t_estimasi_part_detail SET fk_part='$id_part',harga_jual_part='$hargajual', harga_diskon_part='$hargadiskon',harga_total_estimasi_part='$total',diskon_part='$diskon' WHERE id='$id'";
            mysql_query($updatepart);

            $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_part='$totgrospart',total_diskon_rupiah_part='$totdiskonpart', total_netto_harga_part='$totnettopart',total_gross_harga_jasa='$totgros', total_diskon_rupiah_jasa='$totdiskon',total_netto_harga_jasa='$totnetto' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);



?>