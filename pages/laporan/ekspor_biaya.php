
<?php
// Fungsi header dengan mengirimkan raw data excel
///header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
///header("Content-Disposition: attachment; filename=reportbukubesar.xls");
 
// Tambahkan table
//include 'data.php';php

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
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan Buku Besar </center></span>
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
                                  $sqlcatat = "SELECT A.coa, A.description AS nm FROM t_akun A
                                  LEFT JOIN t_acc_cash B ON A.coa=B.fk_akun
                                  LEFT JOIN t_acc_cash C ON A.coa=C.fk_akun
                                  WHERE B.no_bukti<>'' AND C.no_bukti<>'' AND substring(B.tr_date,1,4)='$tgl1' AND substring(C.tr_date,1,4)='$tgl1' AND substring(A.coa,1,2)=51
                                  GROUP BY A.coa";
                                  //AND A.transaction_type='D' AND A.description LIKE '%kas%'
                                  $rescatat = mysql_query( $sqlcatat );
                                  while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                            <td><?php echo $j++;?></td>
                            <td><?php echo $catat['nm'];?></td>
                            <?php
                            for ( $i = 1; $i <= 12; $i ++ ) {
                              $blne=date('m',strtotime("$i/12/10"));
                              $peri=$tgl1.'-'.$blne;
                              $sqlsum="SELECT sum(B.amount) AS jmle FROM t_akun A
                              LEFT JOIN t_acc_cash B ON A.coa=B.fk_akun
                              LEFT JOIN t_acc_cash C ON A.coa=C.fk_akun
                              WHERE B.no_bukti<>'' AND C.no_bukti<>'' AND substring(B.tr_date,1,7)='$peri' AND substring(C.tr_date,1,7)='$peri' AND A.coa='$catat[coa]'";
                              $hsum=mysql_fetch_array(mysql_query($sqlsum));
                              //echo "<td>".date( 'm', strtotime( "$i/12/10" ) )."</td>";
                              echo "<td>".rupiah2($hsum['jmle'])."</td>";
                            } ?>
                        </tr>
                    <?php }?>
                    
                </tfoot>
              </table>