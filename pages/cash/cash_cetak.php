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
    $nobukti= $_GET['nobukti'];
    //   $sqlpan= "SELECT * FROM t_pkb WHERE id_pkb='$idpkb'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>

   <?php
                                    $sqlcatat = "SELECT * FROM t_cash WHERE no_bukti='$nobukti'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                ?>
                                <table width="100%" align="center" border="0">
                                  <tr>
                                    <td width="50%"><u style="font-size: 20px;"><strong>GEMILANG BODY & PAINT</strong><br>
                                    </u>
                                    Jl. Setia Budi No.152 <br>
                                    Srondol Kulon Semarang
                                    </td>
                                    <td width="50%" align="center">
                                    No. Kwitansi : <?php echo $nobukti;?>
                                    </td>
                                  </tr> 
                                </table>
                      
                                <hr width="100%" align="center" align="center">
                                <br><br>
                                <table width="100%" border="0"  align="center">
                                  <tr><td class="hurufe" width="30%">Terima Dari</td><td class="hurufe" width="2%">: </td><td class="huruf2"><?php echo $catat['diterima_dari'];?></td></tr>
                                  <tr><td class="hurufe">Uang Sejumlah</td><td class="hurufe">: </td><td class="huruf2">## <?php echo Terbilang($catat['total']);?> rupiah ##</td></tr>
                                  <tr><td  class="hurufe">Untuk Pembayaran</td><td class="hurufe">: </td><td class="huruf2"><?php echo $catat['keterangan'];?></td></tr>
                                </table>
                                <br>
                                <table width="100%" border="0"  align="center">
                                    <tr>
                                      <td>
                                        <table width="60%" border="1"  align="left">
                                            <tr>
                                              <td class="huruf2" align="center">Rp. <?php echo rupiah2($catat['total']);?></td>
                                            </tr>
                                        </table>
                                      </td>
                                      <td>
                                          <table width="100%" border="0"  align="center">
                                            <tr>
                                              <td align="center">Semarang, <?php echo tampilTanggal(substr($catat['tgl_transaksi'],0,10));?><br><br><br><br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
                                            </tr>
                                        </table>
                                      </td>
                                    </tr>
                                </table>
                                      

   <style type="text/css">
  .hurufe {
    font-size: 14px;
    font-weight: bold;
    font-family: monospace;
    text-align: right;
  }
  .huruf2 {
    font-size: 16px;
    font-weight: bold;
    font-family: monospace;
  }
</style>                                                         
</body>
</html>