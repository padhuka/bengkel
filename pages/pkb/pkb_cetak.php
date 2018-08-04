<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body >
<?php //onload="javascript:window.print()"
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $idpkb= $_GET['idpkb'];
    //   $sqlpan= "SELECT * FROM t_pkb WHERE id_pkb='$idpkb'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
   <?php
                                    $j=1;
                                    $sqlcatat = "SELECT *, d.nama as nmasuransi, c.nama as nama, d.no_telp as telpasuransi, c.no_telp as no_telp FROM t_pkb e 
                                    left join t_customer c on e.fk_customer=c.id_customer 
                                    left join t_asuransi d on e.fk_asuransi=d.id_asuransi 
                                    left join t_estimasi f on e.fk_estimasi=f.id_estimasi
                                    where e.id_pkb='$idpkb'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );

                                ?>
                                <hr width="60%" align="center">                                
                                <table width="60%" align="center">
                                   <tr><td align="left" style="font-size: 24px;" colspan="2">&nbsp;&nbsp;&nbsp;<?php echo $catat['id_pkb'];?></td><td width="10%">Foreman</td><td>: </td></tr>                               
                                  </td></tr>
                                  <tr><td align="left" width="10%">Status WO</td><td align="left" width="60%">: <?php echo $catat['nmasuransi'];?><td width="10%">Teknisi</td><td>: </td></tr>                                              
                                  </td></tr>
                                  <tr><td align="left" width="10%">No. Estimasi</td><td align="left">: <?php echo $catat['fk_estimasi'];?>                                    
                                  </td><td width="10%">Foreman</td><td>: 00:00:00</td></tr>
                                </table>
                                <hr width="60%" align="center">
                                <table width="60%" align="center">
                                  <tr>
                                    <td width="20%">Merk/Tipe/Tahun</td><td width="29%">: Honda/ BRIO E / 2015</td><td width="2%"></td>
                                    <td width="20%">No.Polisi</td><td width="29%">: <?php echo $catat['fk_no_polisi'];?></td>
                                  </tr>
                                  <tr>
                                    <td width="20%">Pemilik</td><td width="29%">: <?php echo $catat['nama'];?></td><td width="2%"></td>
                                    <td width="20%">No.Rangka</td><td width="29%">: <?php echo $catat['fk_no_chasis'];?></td>
                                  </tr>
                                  <tr>
                                    <td>No.Telp</td><td>: <?php echo $catat['no_telp'];?></td><td></td>
                                    <td>No. Mesin</td><td>: <?php echo $catat['fk_no_mesin'];?></td>
                                  </tr>
                                  <tr>
                                    <td>Tgl/Jam Masuk<td>: <?php echo date('d-m-Y H:i:s' , strtotime($catat['tgl']));?></td><td></td>
                                    <td>Warna</td><td>: MODER STEEL METALLIC</td>
                                  </tr>
                                  <tr>
                                    <td>Estimasi Selesai</td><td>: </td><td></td>
                                    <td>KM</td><td>: <?php echo $catat['km_masuk'];?></td>
                                  </tr>
                                  <tr>
                                    <td>Status Pelanggan</td><td>:</td><td></td>
                                    <td>No. Claim</td><td>:</td>
                                  </tr>
                                  
                                </table>
                                <hr width="60%" align="center">  

                                <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0"><tr><td>Job Descriptions :</td></tr></table><br>
                                <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
                                  <tr><td colspan="2">Panel :</td></tr>
                                    <?php
                                                        $j=1;
                                                        $sqlcatatp = "SELECT * FROM t_pkb_panel_detail a LEFT JOIN t_panel p ON a.fk_panel=p.id_panel WHERE a.fk_pkb='$idpkb'";
                                                        $rescatatp = mysql_query( $sqlcatatp );
                                                        while($catatp = mysql_fetch_array( $rescatatp )){
                                                    ?>
                                            <tr>
                                              <td ><?php echo $j++;?></td>
                                              <td ><?php echo $catatp['nama'];?></td>
                                            </tr>
                                        <?php }
                                        echo "<tr><td colspan=2><br>Part :</td></tr>";
                                               $j=1;
                                                        $sqlcatat2 = "SELECT * FROM t_pkb_part_detail a LEFT JOIN t_part p ON a.fk_part=p.id_part WHERE a.fk_pkb='$idpkb'";
                                                        $rescatat2 = mysql_query( $sqlcatat2 );
                                                        while($catat2 = mysql_fetch_array( $rescatat2 )){
                                                    ?>
                                            <tr>
                                              <td ><?php echo $j++;?></td>
                                              <td ><?php echo $catat2['nama'];?></td>
                                            </tr>
                                        <?php }?>
                                </table>
                                <hr width="60%" align="center"> 
                                 <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0"><tr><td>Keluhan Pelanggan :</td></tr></table><br>
                                 <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0"><tr><td>Saran :</td></tr></table><br>
                                <hr width="60%" align="center"> 
                                      
                                 <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
                                   <tr><td width="50%" align="center"></td><td width="50%" align="center"><?php echo date('d-m-Y' , strtotime($catat['tgl']));?></td></tr>
                                </table>
                                 <table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
                                   <tr><td width="50%" align="center">Menyetujui<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td><td width="50%" align="center">Hormat Kami<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
                                 </table><br>
                               
</body>
</html>