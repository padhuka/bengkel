<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=reportgatepass.xls");
 
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
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan GatePass</center></span>
                                     <span style="font-size: 20px;font-weight: bold;"><center> Per Tgl <?php echo date('d-m-Y' , strtotime($_GET['tgl1']));echo ' s/d '; echo date('d-m-Y' , strtotime($_GET['tgl2'])); ?></center></span>
                                <br>
      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover" style="text-transform: capitalize;">
                <thead class="thead-light">
                
                <tr>
                          <th>No</th>
                          <th>No PKB</th>
                          <th>No Gate Pass</th>
                          <th>No Polisi</th>
                          <th>Tgl PKB</th>
                          <th>Tgl GatePass</th>
                          <th>Tgl Pembayaran</th>
                          <th>Status</th>
                          <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                   //WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_pkb='' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2'
                                   
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    
                                    $j=1;
                                    $sqlcatat = "SELECT C.no_kwitansi AS nokwitansi,D.tgl_transaksi AS lunascash,E.tgl_transaksi AS lunasbank, A.tgl AS tglget, B.tgl AS tglpkb,A.*,B.* FROM t_gate_pass A
                                    LEFT JOIN t_pkb B ON A.fk_pkb=B.id_pkb 
                                    LEFT JOIN t_kwitansi C ON  A.fk_pkb=C.fk_pkb
                                    LEFT JOIN t_cash D ON C.no_kwitansi=D.no_ref AND D.tipe_transaksi='Pelunasan'
                                    LEFT JOIN t_bank E  ON C.no_kwitansi=E.no_ref AND E.tipe_transaksi='Pelunasan'
                                    WHERE substring(A.tgl,1,10)>='$tgl1' AND substring(A.tgl,1,10)<='$tgl2' ORDER BY A.no_gate_pass DESC  
                                    ";
                                    //echo $sqlcatat;
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                    if ($catat['lunascash']){
                                      $tgle=$catat['lunascash'];
                                    }
                                    if ($catat['lunasbank']){
                                      $tgle=$catat['lunasbank'];
                                    }
                                ?>
                        <tr>
                          <td ><?php echo $j++;?>.</td>
                          <td ><?php echo $catat['fk_pkb'];?></td>
                          <td ><?php echo $catat['no_gate_pass'];?></td>
                          <td ><?php echo $catat['fk_no_polisi'];?></td>
                          <td ><?php echo date('d-m-Y',strtotime($catat['tglpkb']));?></td>
                          <td ><?php echo date('d-m-Y',strtotime($catat['tglget']));?></td>   
                          <td><?php echo date('d-m-Y',strtotime($tgle));?></td></td>
                          <td ><?php echo $catat['status'];?></td> 
                          <td></td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>