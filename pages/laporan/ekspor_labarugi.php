<?php
// Fungsi header dengan mengirimkan raw data excel
///header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
///header("Content-Disposition: attachment; filename=reportbukubesar.xls");
 
// Tambahkan table
//include 'data.php';

?>
								      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      $tgle = date('d/m/Y');
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
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan Laba Rugi </center></span>
                                     <span style="font-size: 20px;font-weight: bold;"><center> Per Tgl <?php echo date('d-m-Y' , strtotime($_GET['tgl1']));echo ' s/d '; echo date('d-m-Y' , strtotime($_GET['tgl2'])); ?></center></span>
                                <br>
      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>Kode Transaksi</th>
                          <th>Tanggal Transaksi</th>
                          <th>Nama Rekening</th>
                          <th>Keterangan</th>
                          <th>Tanggal Kirim</th>
                          <th>Terima/Debet</th>
                          <th>Keluar/Kredit</th>
                          <th>Saldo</th>

                </tr>
                </thead>
                <tbody>
                <?php
                                   //WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_pkb='' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2' 
                                   
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    $j=1;
                                    $jml=0;
                                    $jmlD=0;
                                    $jmlC=0;
                                    $sqlcatat = "SELECT A.coa AS kode, B.tr_date AS tgl,C.tr_date AS tglb, A.description AS nmrek, B.description AS ket, C.description ketb, B.transaction_type AS kredit, C.transaction_type AS kreditb, B.amount AS jmle, C.amount AS jmleb FROM t_akun A
                                      LEFT JOIN t_acc_cash B ON A.coa=B.fk_akun AND B.tr_date>='$tgl1' AND B.tr_date<='$tgl2'
                                      LEFT JOIN t_acc_bank C ON A.coa=C.fk_akun AND C.tr_date>='$tgl1' AND C.tr_date<='$tgl2'  
                                      WHERE B.no_bukti<>'' OR C.no_bukti<>''
                                      ORDER BY kode";
                                      echo $sqlcatat;
                                   	$rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                        //$jml=$jml+$catat['jumlah'];  
                                ?>
                        <tr>
                          <th><?php echo $j++;?></th>                 
                          <td><?php echo $catat['kode'];?></td>
                          <td><?php echo $catat['tgl'];?><?php echo $catat['tglb'];?></td>
                          <td><?php echo $catat['nmrek'];?></td>
                          <td><?php echo $catat['ket'];?><?php echo $catat['ketb'];?></td>
                          <td><?php //echo rupiah2($catat['jumlah']);?></td>   
                          <td><?php if ($catat['kredit']=='D') {echo $catat['jmle'];$jmlD=$jmlD+$catat['jmle'];};  if ($catat['kreditb']=='D') {echo $catat['jmleb'];$jmlD=$jmlD+$catat['jmleb'];}?></td>
                          <td><?php if ($catat['kredit']=='C') {echo $catat['jmle'];$jmlC=$jmlC+$catat['jmle'];}; if ($catat['kreditb']=='C') {echo $catat['jmleb'];$jmlC=$jmlC+$catat['jmleb'];}?></td>
                          <td><?php echo rupiah2($jmlD-$jmlC);?></td>   
                        </tr>
                    <?php }?>
                    <tr><td colspan="18" align="right">Total</td><td><?php echo rupiah2($jmlD-$jmlC);?></td></tr>
                </tfoot>
              </table>