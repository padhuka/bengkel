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
    $idpkb= $_GET['idpkb'];
    //   $sqlpan= "SELECT * FROM t_pkb WHERE id_pkb='$idpkb'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
   <?php
                                    $j=1;
                                    $sqlcatat = "SELECT *,w.nama as warna,g.nama as nmgrup, t.nama as nmtipe, d.nama as nmasuransi, c.nama as nama, d.no_telp as telpasuransi, c.no_telp as no_telp FROM t_pkb e 
                                    left join t_customer c on e.fk_customer=c.id_customer 
                                    left join t_asuransi d on e.fk_asuransi=d.id_asuransi 
                                    left join t_estimasi f on e.fk_estimasi=f.id_estimasi
                                    left join t_inventory_bengkel b on e.fk_no_chasis=b.no_chasis
                                    left join t_tipe_kendaraan t on b.fk_tipe_kendaraan=t.id_tipe_kendaraan
                                    left join t_group_kendaraan g on t.fk_group_kendaraan=g.id_group_kendaraan
                                    left join t_warna_kendaraan w on b.fk_warna_kendaraan=w.id_warna_kendaraan
                                    where e.id_pkb='$idpkb'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                    //echo $sqlcatat;
                                ?>
                                <table width="100%">
                                  <br>
                                  <br>
                                  <br>
                                  <br>
                                  <tr><td align="center" style="font-size: 20px; text-align: center;"><u>PKB BODY REPAIR</u></td></tr>
                                  <tr><td align="center" style="font-size: 18px; text-align: center;"><?php echo $catat['id_pkb'];?></td></tr>
                                </table>
                                <hr width="100%" align="center">                                
                                <table width="100%" align="center"  style="font-size: 12px">
                                  
                                  <tr><td align="left" width="10%">Status WO</td><td align="left" width="100%">: <?php echo $catat['nmasuransi'];?><td width="10%">Foreman</td><td>: </td></tr>                                              
                                  </td></tr>
                                  <tr><td align="left" width="10%">No. Estimasi</td><td align="left">: <?php echo $catat['fk_estimasi'];?>                                    
                                  </td><td width="10%">Teknisi</td><td></td></tr>
                                </table>
                                <hr width="100%" align="center">
                                <table width="100%" align="center"  style="font-size: 12px">
                                  <tr>
                                    <td>Merk/Tipe</td><td  width="45%">: <?php echo $catat['nmgrup'].'/'.$catat['nmtipe'];?></td><td></td>
                                    <td align="left">No.Polisi</td><td>: <?php echo $catat['fk_no_polisi'];?></td>
                                  </tr>
                                  <tr>
                                    <td>Pemilik</td><td>: <?php echo $catat['nama'];?></td><td></td>
                                    <td>No.Rangka</td><td>: <?php echo $catat['fk_no_chasis'];?></td>
                                  </tr>
                                  <tr>
                                    <td>No.Telp</td><td>: <?php echo $catat['no_telp'];?></td><td></td>
                                    <td>No. Mesin</td><td>: <?php echo $catat['fk_no_mesin'];?></td>
                                  </tr>
                                  <tr>
                                    <td>Tgl/Jam Masuk<td>: <?php echo date('d-m-Y H:i:s' , strtotime($catat['tgl']));?></td><td></td>
                                    <td>Warna</td><td>: <?php echo $catat['warna'];?></td>
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
                                <hr width="100%" align="center">  

                                <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"  style="font-size: 12px"><tr><td>Job Descriptions :</td></tr></table><br>
                                <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"  style="font-size: 12px">
                                  <tr><td colspan="2">Panel :</td></tr>
                                    <?php
                                                        $j=1;
                                                        $sqlcatatp = "SELECT * FROM t_pkb_panel_detail a LEFT JOIN t_panel p ON a.fk_panel=p.id_panel WHERE a.fk_pkb='$idpkb'";
                                                        $rescatatp = mysql_query( $sqlcatatp );
                                                        while($catatp = mysql_fetch_array( $rescatatp )){
                                                          $markpanel= $catatp['mark_panel'];
                                                    ?>
                                            <tr>
                                              <td style="font-size: 12px"><?php echo $j++;?></td>
                                              <td  style="font-size: 12px"><?php echo $catatp['nama']; if ($markpanel=='1'){echo ' *';}?></td>
                                            </tr>
                                        <?php }
                                        echo "<tr><td colspan=2><br>Part :</td></tr>";
                                               $j=1;
                                                        $sqlcatat2 = "SELECT * FROM t_pkb_part_detail a LEFT JOIN t_part p ON a.fk_part=p.id_part WHERE a.fk_pkb='$idpkb'";
                                                        $rescatat2 = mysql_query( $sqlcatat2 );
                                                        while($catat2 = mysql_fetch_array( $rescatat2 )){
                                                    ?>
                                            <tr>
                                              <td  style="font-size: 12px"><?php echo $j++;?></td>
                                              <td  style="font-size: 12px"><?php echo $catat2['nama'];?></td>
                                            </tr>
                                        <?php }?>
                                </table>
                                <hr width="100%" align="center"> 
                                 <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"  style="font-size: 12px"><tr><td>Keluhan Pelanggan :</td></tr></table><br>
                                 <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"  style="font-size: 12px"><tr><td>Saran :</td></tr></table><br>
                                <hr width="100%" align="center"> 
                                      
                                 <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px">
                                   <tr><td width="50%" align="center"></td><td width="50%" align="center"><?php echo date('d-m-Y' , strtotime($catat['tgl']));?></td></tr>
                                </table>
                                 <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px">
                                   <tr><td width="50%" align="center">Menyetujui<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td><td width="50%" align="center">Hormat Kami<br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
                                 </table><br>
                               
</body>
</html>