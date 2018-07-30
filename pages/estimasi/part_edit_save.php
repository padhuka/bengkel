<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id = trim($_POST['id']);
        $id_part = trim($_POST['part']);
        $idestimasi = trim($_POST['idestimasi']);
        $diskon = trim($_POST['diskon']);
        $hargajual= trim($_POST['hargapokok']);
        $hargadiskon= ($diskon*$hargajual)/100;
        $total= trim($_POST['hargatotal']);
        $qty= trim($_POST['qty']);

            $sqlpart= "SELECT sum(harga_jual_part*qty_part) AS totjualpart,sum(harga_diskon_part*qty_part) AS totdiskonpart, sum(harga_total_estimasi_part) AS totestimasipart FROM t_estimasi_part_detail WHERE id='$id'";
            $hpart= mysql_fetch_array(mysql_query($sqlpart));
            //jml part
            $sqles= "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
            $hpes= mysql_fetch_array(mysql_query($sqles));

            $totgrospart=$hpes['total_gross_harga_part']+($hargajual*$qty)-$hpart['totjualpart'];
            $totdiskonpart=$hpes['total_diskon_rupiah_part']+($hargadiskon*$qty)-$hpart['totdiskonpart'];
            $totnettopart=$hpes['total_netto_harga_part']+$total-$hpart['totestimasipart'];

            $totgros=$hpes['total_gross_harga_jasa']+($hargajual*$qty)-$hpart['totjualpart'];
            $totdiskon=$hpes['total_diskon_rupiah_jasa']+($hargadiskon*$qty)-$hpart['totdiskonpart'];
            $totnetto=$hpes['total_netto_harga_jasa']+$total-$hpart['totestimasipart'];

            $updatepart = "UPDATE t_estimasi SET fk_part='$id_part',harga_jual_part='$hargajual', harga_diskon_part='$hargadiskon',harga_total_estimasi_part='$total', diskon_part='$diskon',qty_part='$qty' WHERE id='$id'"
            mysql_query($updatepart);

            $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_part='$totgrospart',total_diskon_rupiah_part='$totdiskonpart', total_netto_harga_part='$totnettopart',total_gross_harga_jasa='$totgros', total_diskon_rupiah_jasa='$totdiskon',total_netto_harga_jasa='$totnetto' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);



?>