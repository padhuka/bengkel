<?php
		//$skrg = date('Y-m-d');
        include_once '../../lib/config.php';
        $idestimasi = $_GET['idestimasi'];
        $id = $_GET['id'];

        $sqlhapusasuransi = "DELETE FROM t_estimasi_part_detail WHERE id='$id'";
        mysqli_query($objConn,  $sqlhapusasuransi );

       $sqlpart= "SELECT sum(harga_jual_part*qty_part) AS totjualpart,sum(harga_diskon_part*qty_part) AS totdiskonpart, sum(harga_total_estimasi_part) AS totestimasipart FROM t_estimasi_part_detail WHERE fk_estimasi = '$idestimasi'";
            $hpart= mysqli_fetch_array(mysqli_query($objConn, $sqlpart));
            //jml part

            $totgrospart=$hpart['totjualpart'];
            $totdiskonpart=$hpart['totdiskonpart'];
            $totnettopart=$hpart['totestimasipart'];

            $updatepart = "UPDATE t_estimasi set total_gross_harga_part='$totgrospart', total_diskon_rupiah_part='$totdiskonpart', total_netto_harga_part='$totnettopart' WHERE id_estimasi='$idestimasi'";
            mysqli_query($objConn, $updatepart);



            $sqles= "SELECT sum(total_gross_harga_panel+total_gross_harga_part) as total_gross_harga_jasa,sum(total_diskon_rupiah_panel+total_diskon_rupiah_part) as total_diskon_rupiah_jasa,sum(total_netto_harga_panel+total_netto_harga_part) as total_netto_harga_jasa FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
           
            $hpes= mysqli_fetch_array(mysqli_query($objConn, $sqles));

         

            $totgrosjasa=$hpes['total_gross_harga_jasa'];
            $totdiskonjasa=$hpes['total_diskon_rupiah_jasa'];
            $totnettojasa=$hpes['total_netto_harga_jasa'];



           $updateestimasi = "UPDATE t_estimasi SET total_gross_harga_jasa='$totgrosjasa', total_diskon_rupiah_jasa='$totdiskonjasa',total_netto_harga_jasa='$totnettojasa' WHERE id_estimasi='$idestimasi'";
              mysqli_query($objConn, $updateestimasi);
		//HAPUS DATA 
		
?>
