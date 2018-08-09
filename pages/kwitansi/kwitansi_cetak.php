<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body onload="javascript:window.print()">
<?php //onload="javascript:window.print()"
   // include_once '../../lib/sess.php';
        include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $no_kwitansi= $_GET['no_kwitansi'];
    //   $sqlpan= "SELECT * FROM t_pkb WHERE id_pkb='$idpkb'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
   <?php
                                    $j=1;
                                    $sqlcatat = "SELECT *,kw.nilai_kwitansi as nilaior, c.alamat AS alamatcustomer,c.no_telp AS telpcustomer,c.nama AS nmcustomer,d.nama AS nmasuransi FROM t_kwitansi e
                                    LEFT JOIN t_pkb a ON e.fk_pkb=a.id_pkb
                                    LEFT JOIN t_customer c ON a.fk_customer=c.id_customer 
                                    LEFT JOIN t_asuransi d ON a.fk_asuransi=d.id_asuransi
                                    LEFT JOIN t_kwitansi_or kw ON a.fk_estimasi=kw.fk_estimasi
                                    WHERE e.no_kwitansi='$no_kwitansi'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                    $idpkb=$catat['id_pkb'];

                                ?>
                               <table width="100%" style="font-size: 12px">
                                 <tr><td align="center" style="font-size: 20px; text-align: center;"><u>INVOICE</u></td></tr>                                  
                                  <tr><td align="center" style="font-size: 20px; text-align: center;"><?php echo $no_kwitansi;?></td></tr> 
                                </table>
                      
                                <hr width="100%" align="center">
                                <table width="100%" align="center" style="font-size: 12px">
                                  <tr>
                                    <td width="20%">No PKB</td><td width="29%">: <?php echo $catat['id_pkb'];?></td><td width="2%"></td>
                                    <td width="20%">Kategori</td><td width="29%">: <?php echo $catat['kategori'];?></td>
                                  </tr>
                                  <tr>
                                    <td width="20%">Tgl Masuk</td><td width="29%">: <?php echo date('d-m-Y H:i:s' , strtotime($catat['tgl']));?></td><td width="2%"></td>
                                    <td width="20%">Asuransi</td><td width="29%">: <?php echo $catat['nmasuransi'];?></td>
                                  </tr>
                                  <tr>
                                    <td>No. Chasis</td><td>: <?php echo $catat['fk_no_chasis'];?></td><td></td>
                                    <td>Nama Customer</td><td>: <?php echo $catat['nmcustomer'];?></td>
                                  </tr>
                                  <tr>
                                    <td>No. Mesin<td>: <?php echo $catat['fk_no_mesin'];?></td><td></td>
                                    <td>Telp</td><td>: <?php echo $catat['telpcustomer'];?></td>
                                  </tr>
                                  <tr>
                                    <td>No.Polisi</td><td>: <?php echo $catat['fk_no_polisi'];?></td><td></td>
                                    <td>Alamat</td><td>: <?php echo $catat['alamatcustomer'];?></td>
                                  </tr>
                                  <tr>
                                    <td>KM Masuk</td><td>: <?php echo $catat['km_masuk'];?></td><td></td>
                                    <td></td><td></td>
                                  </tr>
                                  
                                </table>
                                <hr width="100%" align="center">  

                                <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px"><thead class="thead-light">
                        <tr><th>Nama </th><th>Harga</th><th>Qty</th><th>Disc</th><th>Total</th></tr>
                        </thead>
                        <tbody>
                          <tr><td colspan="2"><u>Panel</u> :</td></tr>
                <?php
                                    $j=1;
                                    $sqlcatatp = "SELECT * FROM t_pkb_panel_detail a 
                                    LEFT JOIN t_panel p ON a.fk_panel=p.id_panel
                                    WHERE a.fk_pkb ='$idpkb'";
                                    $rescatatp = mysql_query( $sqlcatatp );
                                    while($catatp = mysql_fetch_array( $rescatatp )){
                                ?>
                        <tr>
                          <td><?php echo $catatp['nama'];?></td>
                          <td><?php echo rupiah2($catatp['harga_jual_panel']);?></td>
                          <td>1</td>
                          <td><?php echo $catatp['diskon'];?></td>
                          <td align="right"><?php echo rupiah2($catatp['harga_total_pkb_panel']);?></td>
                        </tr>
                    <?php }?>
                            <tr><td colspan="2"><u>Part</u> :</td></tr>
                           <?php $j=1;
                                    $sqlcatat2 = "SELECT * FROM t_pkb_part_detail a 
                                    LEFT JOIN t_part p ON a.fk_part=p.id_part 
                                    WHERE a.fk_pkb='$idpkb'";
                                    $rescatat2 = mysql_query( $sqlcatat2 );
                                    while($catat2 = mysql_fetch_array( $rescatat2 )){
                                ?>
                        <tr>
                          <td><?php echo $catat2['nama'];?></td>
                          <td><?php echo rupiah2($catat2['harga_jual_part']);?></td>
                          <td><?php echo $catat2['qty_part'];?></td>
                          <td><?php echo $catat2['diskon'];?></td>
                          <td align="right"><?php echo rupiah2($catat2['harga_total_pkb_part']);?></td>
                        </tr>
                    <?php }?>
                        <tr><td colspan="4" align="right">Sub Total Jasa</td><td align="right"><?php echo rupiah2($catat['total_netto_panel']+$catat['total_netto_part']);?></td></tr>
                        <tr><td colspan="4" align="right">PPN</td><td align="right"><?php echo rupiah2($catat['total_ppn_kwitansi']);?></td></tr>
                        <tr><td colspan="4" align="right">OR</td><td align="right"><?php echo rupiah2($catat['nilaior']);?></td></tr>
                        <tr><td colspan="4" align="right"><strong>Grand Total</strong></td><td align="right"><?php echo rupiah2($catat['total_payment']+$catat['nilaior']);?></td></tr>
                </tfoot>
              </table>
                                </table>
                                
                                <hr width="100%" align="center"> 
                                      
                                 <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px">
                                   <tr><td width="50%" align="center"></td><td width="50%" align="center"><?php echo date('d-m-Y' , strtotime($catat['tgl']));?></td></tr>
                                </table>
                                 <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px">
                                   <tr><td width="50%" align="center">Menyetujui<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td><td width="50%" align="center">Hormat Kami<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
                                 </table><br>
                               
</body>
</html>