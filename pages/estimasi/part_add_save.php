<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		$id_part = trim($_POST['part']);
        $idestimasi = trim($_POST['idestimasi']);
        $diskon = trim($_POST['diskonp']);
        $hargajual= trim($_POST['hargapokokp']);
        $qty= trim($_POST['qty']);
        $hargadiskon= ($diskon*$hargajual)/100;
        $total= trim($_POST['hargatotalp']);
      
		    $sqltbemp = "INSERT INTO t_estimasi_part_detail (fk_estimasi,fk_part,harga_jual_part,diskon_part,harga_diskon_part,harga_total_estimasi_part,qty_part) VALUES ('$idestimasi','$id_part','$hargajual','$diskon','$hargadiskon','$total','$qty')";
            mysql_query($sqltbemp);
            //echo $sqltbemp;
            //echo 'n';
            //jml part
            $sqlpart= "SELECT sum(harga_jual_part*qty_part) AS totjualpart,sum(harga_diskon_part*qty_part) AS totdiskonpart, sum(harga_total_estimasi_part) AS totestimasipart FROM t_estimasi_part_detail WHERE fk_estimasi = '$idestimasi'";
            $hpart= mysql_fetch_array(mysql_query($sqlpart));
            //jml part
            $sqles= "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
            $hpes= mysql_fetch_array(mysql_query($sqles));

            $totgrospart=$hpart['totjualpart'];
            $totdiskonpart=$hpart['totdiskonpart'];
            $totnettopart=$hpart['totestimasipart'];

            $totgros=($hargajual*$qty)+$hpes['total_gross_harga_part'];
            $totdiskon=($hargadiskon*$qty)+$hpes['total_diskon_rupiah_part'];
            $totnetto=($total*$qty)+$hpes['total_netto_harga_part'];

            $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_part='$totgrospart',total_diskon_rupiah_part='$totdiskonpart', total_netto_harga_part='$totnettopart',total_gross_harga_jasa='$totgros', total_diskon_rupiah_jasa='$totdiskon',total_netto_harga_jasa='$totnetto' WHERE id_estimasi='$idestimasi'";
            mysql_query($updateestimasi);
            //echo $updateestimasi;

?>