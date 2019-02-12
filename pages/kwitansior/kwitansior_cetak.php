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
    $no_kwitansi_or= $_GET['no_kwitansi_or'];
    //   $sqlpan= "SELECT * FROM t_pkb WHERE id_pkb='$idpkb'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
   <?php
                                    $j=1;
                                    $sqlcatat = "SELECT *,e.keterangan as ketkw,e.nilai_kwitansi as nilaikw,e.diskon_or AS diskonkw, c.alamat AS alamatcustomer,c.no_telp AS telpcustomer,c.nama AS nmcustomer,d.nama AS nmasuransi FROM t_kwitansi_or e
                                    LEFT JOIN t_estimasi a ON e.fk_estimasi=a.id_estimasi
                                    LEFT JOIN t_customer c ON a.fk_customer=c.id_customer 
                                    LEFT JOIN t_asuransi d ON a.fk_asuransi=d.id_asuransi 
                                    WHERE e.no_kwitansi_or='$no_kwitansi_or'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                    $idestimasi=$catat['id_estimasi'];
                                    $disckw=100-$catat['diskonkw'];
                                ?>
                               <table width="100%" style="font-size: 12px">
                                  <tr><td align="center" style="font-size: 20px; text-align: center;"><u>INVOICE</u></td></tr>                                  
                                  <tr><td align="center" style="font-size: 20px; text-align: center;"><?php echo $no_kwitansi_or;?></td></tr> 
                                </table>
                      
                                <hr width="100%" align="center">
                                <table width="100%" align="center" style="font-size: 12px">
                                  <tr>
                                    <td width="20%">No Estimasi</td><td width="29%">: <?php echo $catat['id_estimasi'];?></td><td width="2%"></td>
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

                                <table width="100%" align="center" border="1" cellspacing="0" cellpadding="0" style="font-size: 12px"><thead class="thead-light">
                        <tr><th>Item </th><th>Total</th></tr>
                        </thead>
                        <tbody>
             
                        <tr>
                          <td><?php echo $catat['ketkw'];?></td>                         
                          <td align="right"><?php echo rupiah2($catat['nilaikw']);?></td>
                        </tr>
              </tfoot>
            </table>
              <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px"><thead class="thead-light">
                        
                        <tr><td align="right">Sub Total</td><td align="right">-</td></tr>  
                        <tr><td align="right">Own Risk</td><td align="right"><?php echo rupiah2($catat['nilaikw']);?></td></tr>
                        <tr><td align="right">Sub Total After OR</td><td align="right">-</td></tr>  
                        <tr><td align="right">PPN</td><td align="right">-</td></tr>
                        <tr><td align="right">Total Invoice</td><td align="right"><?php echo rupiah2($catat['nilaikw']);?></td></tr>                        
                
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