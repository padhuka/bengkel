<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body onload="javascript:window.print()">
<?php
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $idestimasi= $_GET['idestimasi'];
    //   $sqlpan= "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
   <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_estimasi e left join t_customer c on e.fk_customer=c.id_customer where e.id_estimasi='$idestimasi'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                ?>
                                <table width="100%">
                                  <tr><td align="center" style="font-size: 20px; text-align: center;"><u>ESTIMASI BODY REPAIR</u></td></tr>
                                  <tr><td align="center" style="font-size: 18px; text-align: center;"><?php echo $catat['id_estimasi'];?></td></tr>
                                </table>
                                <table width="60%" align="center">
                                  <tr><td width="20%">Merk/Tipe/Tahun</td><td width="29%">: Honda/ BRIO E / 2015</td><td width="2%"></td><td width="20%">No.Rangka</td><td width="29%">: <?php echo $catat['fk_no_chasis'];?></td></tr>
                                  <tr><td>No.Polisi</td><td>: <?php echo $catat['fk_no_polisi'];?></td><td></td><td>No. Mesin</td><td>: <?php echo $catat['fk_no_mesin'];?></td></tr>
                                  <tr><td>Pemilik</td><td>: <?php echo $catat['nama'];?></td><td></td><td>Warna</td><td>: MODER STEEL METALLIC</td></tr>
                                  <tr><td>No. Telephone</td><td>: <?php echo $catat['no_telp'];?></td><td></td><td>KM</td><td>: <?php echo $catat['km_masuk'];?></td></tr>
                                  <tr><td>Asuransi</td><td>: <?php echo $catat['fk_asuransi'];?></td><td></td><td>No. Polis</td><td>:</td></tr>
                                  <tr><td></td><td></td><td></td><td>No. Claim</td><td>:</td></tr>
                                </table>

                                <table width="60%" align="center" border="1" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td align="center" width="3%">NO.</td>
                                              <td align="center">PEKERJAAN</td>
                                              <td align="center">TOTAL</td>
                                            </tr>
                                                      
                                    <?php
                                                        $j=1;
                                                        $sqlcatatp = "SELECT * FROM t_estimasi_panel_detail a LEFT JOIN t_panel p ON a.fk_panel=p.id_panel WHERE a.fk_estimasi='$idestimasi'";
                                                        $rescatatp = mysql_query( $sqlcatatp );
                                                        while($catatp = mysql_fetch_array( $rescatatp )){
                                                    ?>
                                            <tr>
                                              <td ><?php echo $j++;?></td>
                                              <td ><?php echo $catatp['nama'];?></td>
                                              <td align="right"><?php echo rupiah2($catatp['harga_total_estimasi_panel']);?></td>
                                            </tr>
                                        <?php }
                                               $j=$j;
                                                        $sqlcatat2 = "SELECT * FROM t_estimasi_part_detail a LEFT JOIN t_part p ON a.fk_part=p.id_part WHERE a.fk_estimasi='$idestimasi'";
                                                        $rescatat2 = mysql_query( $sqlcatat2 );
                                                        while($catat2 = mysql_fetch_array( $rescatat2 )){
                                                    ?>
                                            <tr>
                                              <td ><?php echo $j++;?></td>
                                              <td ><?php echo $catat2['nama'];?></td>
                                              <td align="right"><?php echo rupiah2($catat2['harga_total_estimasi_part']);?></td>
                                            </tr>
                                        <?php }?>
                                </table>
                                 <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
                                            <tr><td colspan="2" align="center">Sub Total Jasa</td><td align="right"><?php echo rupiah2($catat['total_netto_harga_jasa']);?></td></tr>
                                            <tr><td colspan="2" align="center">PPN</td><td align="right"><?php echo rupiah2((10/100)*$catat['total_netto_harga_jasa']);?></td></tr>
                                            <tr><td colspan="2" align="center">Total Jasa</td><td align="right"><?php echo rupiah2((110/100)*$catat['total_netto_harga_jasa']);?></td></tr>
                                </table>
                                <br>

                                 <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
                                   <tr><td align="center">GRAND TOTAL RP <?php echo rupiah2((110/100)*$catat['total_netto_harga_jasa']);?></td><td width="30%"></td></tr>
                                 </table>
                                <br><br>
                                <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
                                   <tr><td width="50%" align="center"></td><td width="50%" align="center"><?php echo date('d-m-Y' , strtotime($catat['tgl']));?></td></tr>
                                </table>
                                 <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
                                   <tr><td width="50%" align="center">Menyetujui<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td><td width="50%" align="center">Hormat Kami<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
                                 </table><br>
                                 <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
                                   <tr><td>PERHATIAN<br>
1. Perkiraan Tersebut diatas berdasarkan apa yang dapat diketahui sementara, dan <br>dapat berubah sesuai keadaan yang sebenarnya pada saat pelaksanaan kerja perbaikan<br>
2. Perbaikan baru dapat dilaksanakan jika sudah ada surat perintah kerja (SPK)
                                   </td></tr>
                                 </table>
                               
</body>
</html>