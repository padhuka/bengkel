
<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=reportbukubesar.xls");
 
// Tambahkan table
//include 'data.php';php
/*
SELECT * FROM t_akun A 
LEFT JOIN (SELECT * FROM t_acc_cash WHERE no_bukti<>'' AND substring(tr_date,1,4)='2019') AS B ON A.coa=B.ref_akun
LEFT JOIN (SELECT * FROM t_acc_bank WHERE no_bukti<>'' AND substring(tr_date,1,4)='2019') AS C ON A.coa=C.ref_akun
WHERE A.coa LIKE '51%'
GROUP BY A.coa
ORDER BY A.coa ASC
*/

?>
								      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';$tgle = date('d/m/Y');
            $jame = date('H:i:s');
      ?>
      <table width="100%" align="center" border="0">
                                  <tr>
                                    <td width="50%"><u style="font-size: 20px;"><strong>GEMILANG BODY & PAINT</strong><br>
                                    </u>
                                    Jl. Setia Budi No.152 <br>
                                    Srondol Kulon Semarang
                                    </td>
                                    <td align="right">
                                      Tanggal : <?php echo $tgle;?><br>
                                      Jam : <?php echo $jame;?>
                                    </td>                                   
                                  </tr>                                   
                                </table>
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan Biaya </center></span>
                                     <span style="font-size: 20px;font-weight: bold;"><center> Tahun <?php echo date('Y' , strtotime($_GET['tgl1']));?></center></span>
                                <br>
      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>Kode Transaksi</th>
                          <th>Jan</th>
                          <th>Feb</th>
                          <th>Mar</th>
                          <th>Apr</th>
                          <th>Mei</th>
                          <th>Jun</th>
                          <th>Jul</th>
                          <th>Agu</th>
                          <th>Sep</th>
                          <th>Okt</th>
                          <th>Nop</th>
                          <th>Des</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                   //WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_pkb='' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2' 
                                   
                                    $tgl1=$_GET['tgl1'];
                                    $j=1;
                                    $jml=0;
                                   
                                ?>
                                <?php 
                                  $sqlcatat = "SELECT * FROM t_akun WHERE coa LIKE '51%'";
                                  $rescatat = mysql_query($sqlcatat);
                                  while($catat = mysql_fetch_array( $rescatat )){
                                    //cek
                                    $t_acc_cash= mysql_fetch_array(mysql_query("SELECT ref_akun,sum(amount) AS jmlcash1 FROM t_acc_cash WHERE substring(tr_date,1,4)='$tgl1' AND ref_akun='$catat[coa]' AND status<>'Batal' AND no_bukti<>''") );
                                    $t_acc_bank= mysql_fetch_array(mysql_query("SELECT ref_akun,sum(amount) AS jmlbank1 FROM t_acc_bank WHERE substring(tr_date,1,4)='$tgl1' AND ref_akun='$catat[coa]' AND status<>'Batal' AND no_bukti<>''") );
                                    if ($t_acc_cash['ref_akun'] || $t_acc_bank['ref_akun']){
                                ?>
                        <tr>
                            <td><?php echo $j++;?></td>
                            <td><?php echo $catat['description'];?></td>
                            <?php
                            for ( $i = 1; $i <= 12; $i ++ ) {
                              $blne=date('m',strtotime("$i/12/10"));
                              $peri=$tgl1.'-'.$blne;
                              //cash
                              $sqlsum="SELECT sum(amount) AS jmlcashbln FROM t_acc_cash WHERE no_bukti<>''  AND status<>'Batal' AND substring(tr_date,1,7)='$peri' AND ref_akun='$catat[coa]'";
                              $hsum=mysql_fetch_array(mysql_query($sqlsum));

                              //bank
                              $sqlsum2="SELECT sum(amount) AS jmlbankbln FROM t_acc_bank WHERE no_bukti<>''  AND status<>'Batal' AND substring(tr_date,1,7)='$peri' AND ref_akun='$catat[coa]'";
                              $hsum2=mysql_fetch_array(mysql_query($sqlsum2));
                              //echo "<td>".date( 'm', strtotime( "$i/12/10" ) )."</td>";
                              echo "<td align=right>".rupiah2($hsum['jmlcashbln']+$hsum2['jmlbankbln'])."</td>";
                            } ?>
                        </tr>
                    <?php 
                                    }
                      }?>

                      <?php 
                                  $sqlcatat = "SELECT * FROM t_akun WHERE coa LIKE '61%'";
                                  $rescatat = mysql_query($sqlcatat);
                                  while($catat = mysql_fetch_array( $rescatat )){
                                    //cek
                                    $t_acc_cash= mysql_fetch_array(mysql_query("SELECT ref_akun,sum(amount) AS jmlcash2 FROM t_acc_cash WHERE substring(tr_date,1,4)='$tgl1' AND ref_akun='$catat[coa]' AND status<>'Batal' AND no_bukti<>''") );
                                    $t_acc_bank= mysql_fetch_array(mysql_query("SELECT ref_akun,sum(amount) AS jmlbank2 FROM t_acc_bank WHERE substring(tr_date,1,4)='$tgl1' AND ref_akun='$catat[coa]' AND status<>'Batal' AND no_bukti<>''") );
                                    if ($t_acc_cash['ref_akun'] || $t_acc_bank['ref_akun']){
                                ?>
                        <tr>
                            <td><?php echo $j++;?></td>
                            <td><?php echo $catat['description'];?></td>
                            <?php
                            for ( $i = 1; $i <= 12; $i ++ ) {
                              $blne=date('m',strtotime("$i/12/10"));
                              $peri=$tgl1.'-'.$blne;
                              //cash
                              $sqlsum="SELECT sum(amount) AS jmlcashbln FROM t_acc_cash WHERE no_bukti<>''  AND status<>'Batal' AND substring(tr_date,1,7)='$peri' AND ref_akun='$catat[coa]'";
                              $hsum=mysql_fetch_array(mysql_query($sqlsum));

                              //bank
                              $sqlsum2="SELECT sum(amount) AS jmlbankbln FROM t_acc_bank WHERE no_bukti<>''  AND status<>'Batal' AND substring(tr_date,1,7)='$peri' AND ref_akun='$catat[coa]'";
                              $hsum2=mysql_fetch_array(mysql_query($sqlsum2));
                              //echo "<td>".date( 'm', strtotime( "$i/12/10" ) )."</td>";
                              echo "<td align=right>".rupiah2($hsum['jmlcashbln']+$hsum2['jmlbankbln'])."</td>";
                            } ?>
                        </tr>
                    <?php 
                                    }
                      }?>
                    
                     

                      <?php 
                                  $sqlcatat = "SELECT * FROM t_akun WHERE coa LIKE '81%'";
                                  $rescatat = mysql_query($sqlcatat);
                                  while($catat = mysql_fetch_array( $rescatat )){
                                    //cek
                                    $t_acc_cash= mysql_fetch_array(mysql_query("SELECT ref_akun,sum(amount) AS jmlcash3 FROM t_acc_cash WHERE substring(tr_date,1,4)='$tgl1' AND ref_akun='$catat[coa]' AND status<>'Batal' AND no_bukti<>''") );
                                    $t_acc_bank= mysql_fetch_array(mysql_query("SELECT ref_akun,sum(amount) AS jmlbank3 FROM t_acc_bank WHERE substring(tr_date,1,4)='$tgl1' AND ref_akun='$catat[coa]' AND status<>'Batal' AND no_bukti<>''") );
                                    if ($t_acc_cash['ref_akun'] || $t_acc_bank['ref_akun']){
                                ?>
                        <tr>
                            <td><?php echo $j++;?></td>
                            <td><?php echo $catat['description'];?></td>
                            <?php
                            for ( $i = 1; $i <= 12; $i ++ ) {
                              $blne=date('m',strtotime("$i/12/10"));
                              $peri=$tgl1.'-'.$blne;
                              //cash
                              $sqlsum="SELECT sum(amount) AS jmlcashbln FROM t_acc_cash WHERE no_bukti<>''  AND status<>'Batal' AND substring(tr_date,1,7)='$peri' AND ref_akun='$catat[coa]'";
                              $hsum=mysql_fetch_array(mysql_query($sqlsum));

                              //bank
                              $sqlsum2="SELECT sum(amount) AS jmlbankbln FROM t_acc_bank WHERE no_bukti<>''  AND status<>'Batal' AND substring(tr_date,1,7)='$peri' AND ref_akun='$catat[coa]'";
                              $hsum2=mysql_fetch_array(mysql_query($sqlsum2));
                              //echo "<td>".date( 'm', strtotime( "$i/12/10" ) )."</td>";
                              echo "<td align=right>".rupiah2($hsum['jmlcashbln']+$hsum2['jmlbankbln'])."</td>";
                            } ?>
                        </tr>
                    <?php 
                                    }
                      }?>


                </tfoot>
              </table>