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
    $nogatepass= $_GET['nogatepass'];
    //   $sqlpan= "SELECT * FROM t_pkb WHERE id_pkb='$idpkb'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
   <?php
                                    $j=1;
                                    $sqlcatat = "SELECT *,kw.no_kwitansi as nokw, c.no_telp as telpcust,e.tgl as tglout,es.tgl as tglin,c.alamat AS alamatcustomer,c.no_telp AS telpcustomer,c.nama AS nmcustomer,d.nama AS nmasuransi FROM t_gate_pass e
                                    LEFT JOIN t_pkb a ON e.fk_pkb=a.id_pkb
                                    LEFT JOIN t_customer c ON a.fk_customer=c.id_customer 
                                    LEFT JOIN t_asuransi d ON a.fk_asuransi=d.id_asuransi
                                    LEFT JOIN t_estimasi es ON a.fk_estimasi=es.id_estimasi
                                    LEFT JOIN t_kwitansi kw ON a.id_pkb=kw.fk_pkb
                                    WHERE e.no_gate_pass='$nogatepass'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                    $idpkb=$catat['id_pkb'];

                                ?>
                                <table width="100%" align="center" border="0">
                                  <tr>
                                    <td width="50%"><u style="font-size: 14px;"><strong>GEMILANG BODY & PAINT</strong><br>
                                    </u>
                                    Jl. Setia Budi No.152 <br>
                                    Srondol Kulon Semarang
                                    </td>
                                    <td width="50%" align="center">
                                    <h1>GATE PASS <?php echo strtoupper($catat['status']);?></h1>
                                    <h3><?php echo $nogatepass;?></h3>
                                    </td>
                                  </tr> 
                                </table>
                              <br>
                               <table width="100%" align="center" border="0" style="font-size: 12px">
                                  <tr>
                                    <td width="50%">
                                        <table border="1" cellpadding="0" cellspacing="0" width="70%">
                                          <tr><td>Bill / Ship To : </td></tr>
                                          <tr><td><?php echo $catat['nmcustomer'];?><br>
                                            <?php echo $catat['alamatcustomer'];?><br><br>
                                            <?php echo $catat['telpcust'];?>
                                          </td></tr>
                                        </table>
                                    </td>                                    
                                    <td width="50%">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tr><td></td></tr>
                                          <tr><td>CHECK IN</td><td>: <?php echo date('d-m-Y H:i:s' , strtotime($catat['tglin']));?></td></tr>
                                          <tr><td>CHECK OUT</td><td>: <?php echo date('d-m-Y H:i:s' , strtotime($catat['tglout']));?></td></tr>
                                          <tr><td>No. Invoice</td><td>: <?php echo $catat['nokw'];?></td></tr>
                                          </td></tr>
                                        </table>
                                    </td>
                                  </tr> 
                                </table>
                                 
                      
                                <hr width="100%" align="center">
                                <table width="100%" align="center" border="0" style="font-size: 12px">
                                  <tr>
                                    <td width="50%">
                                        <table border="1" cellpadding="0" cellspacing="0" width="70%">
                                          <tr><td>
                                                <table>
                                                  <tr><td>Merk/Type</td><td>:</td></tr>
                                                  <tr><td>No.Polisi</td><td>: <?php echo $catat['fk_no_polisi'];?></td></tr>
                                                  <tr><td>Asuransi</td><td>: <?php echo $catat['nmasuransi'];?></td></tr>
                                                  <tr><td>No. PKB</td><td>: <?php echo $catat['id_pkb'];?></td></tr>
                                                  <tr><td>No. Faktur</td><td>: <?php echo $catat['nokw'];?></td></tr>
                                                  <tr><td>Nama SA</td><td>: </td></tr>
                                                </table>
                                                  
                                          </td>
                                          </tr>
                                        </table>
                                    </td>
                                    <td width="50%">
                                        <table border="1" cellpadding="0" cellspacing="0" width="70%" style="font-size: 12px">
                                          <tr><td>CATATAN </td></tr>
                                          <tr><td><br><br><br><br><br><br></td></tr>
                                        </table>
                                    </td>
                                  </tr> 
                                </table>
                                <br><br>
                                <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px">
                                  <tr align="center"><td>Aproved by</td><td>Aproved by</td><td>Aproved by</td><td>Aproved by</td></tr>
                                  <tr><td></td><td></td><td></td><td><br><br><br><br></td></tr>
                                  <tr><td><hr width="80%"></td><td><hr width="80%"></td><td><hr width="80%"></td><td><hr width="80%"></td></tr>
                                  <tr align="center"><td>Manager of body repair</td><td>Head of finance & Adm.</td><td>Service Advisor</td><td>Customer</td></tr>

                                </table>
                                      
                                                         
</body>
</html>