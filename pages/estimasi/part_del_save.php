<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $idestimasi = $_GET['idestimasi'];
        $id = $_GET['id'];
        //UPDATE t_estimasi
        $sqlpart= "SELECT sum(harga_jual_part*qty_part) AS totjualpart,sum(harga_diskon_part*qty_part) AS totdiskonpart, sum(harga_total_estimasi_part) AS totestimasipart FROM t_estimasi_part_detail WHERE id='$id'";
            $hpart= mysql_fetch_array(mysql_query($sqlpart));
            //jml part
            $sqles= "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
            $hpes= mysql_fetch_array(mysql_query($sqles));

            $totgrospart=$hpes['total_gross_harga_part']-$hpart['totjualpart'];
            $totdiskonpart=$hpes['total_diskon_rupiah_part']-$hpart['totdiskonpart'];
            $totnettopart=$hpes['total_netto_harga_part']-$hpart['totestimasipart'];

            $totgros=$hpes['total_gross_harga_jasa']-$hpart['totjualpart'];
            $totdiskon=$hpes['total_diskon_rupiah_jasa']-$hpart['totdiskonpart'];
            $totnetto=$hpes['total_netto_harga_jasa']-$hpart['totestimasipart'];

            $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_part='$totgrospart',total_diskon_rupiah_part='$totdiskonpart', total_netto_harga_part='$totnettopart',total_gross_harga_jasa='$totgros', total_diskon_rupiah_jasa='$totdiskon',total_netto_harga_jasa='$totnetto' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);

		$id = $_GET['id'];
		# HAPUS DATA 
		$sqlhapusasuransi = "DELETE FROM t_estimasi_part_detail WHERE id='$id'";
   		mysql_query( $sqlhapusasuransi );
?>
