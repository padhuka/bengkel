<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=reportcash.xls");
 
// Tambahkan table
//include 'data.php';

?>
								      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No PKB</th>
                          <th>Tgl PKB</th>
                          <th>No Chasis</th>
                          <th>No Mesin</th>
                          <th>No Polisi</th>
                          <th>Nama Customer</th>
                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_add();"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_cash 
                                    WHERE tgl_batal='0000:00:00 00:00:00' AND substring(tgl_transaksi,1,10)>='$tgl1' AND  substring(tgl_transaksi,1,10)<='$tgl2' ORDER BY no_bukti DESC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><?php echo ($catat['no_bukti']);?></td>                       
                          <td ><?php echo date('d-m-Y' , strtotime($catat['tgl_transaksi']));?></td>
                          <td ><?php echo $catat['tipe_transaksi'];?></td>
                          <td ><?php echo $catat['diterima_dari'];?></td>
                          <td ><?php echo $catat['no_ref'];?></td>
                          
                           <td ><?php echo rupiah2($catat['total']);?></td>
                           <td ><?php echo $catat['keterangan'];?></td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>