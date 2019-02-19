<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=reportkwitansior.xls");
 
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
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan KWITANSI OR</center></span>
                                     <span style="font-size: 20px;font-weight: bold;"><center> Per Tgl <?php echo date('d-m-Y' , strtotime($_GET['tgl1']));echo ' s/d '; echo date('d-m-Y' , strtotime($_GET['tgl2'])); ?></center></span>
                                <br>
      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover" style="text-transform: capitalize;">
                <thead class="thead-light">                  
                <tr>
                          <th>No</th>
                          <th>Tgl Kwitansi</th>
                          <th>No. Kwitansi</th>
                          <th>No. PKB</th>
                          <th>No. Polisi</th>
                          <th>Jenis Kend</th>
                          <th>Customer</th>
                          <th>OR</th>
                          <th>Discount OR</th>
                          <th>Tgl Pelunasan</th>
                          <th>Kode Transaksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                   //WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_pkb='' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2'
                                   
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    $j=1;
                                    $sqlcatat = "SELECT k.no_kwitansi_or, k.tgl_kwitansi_or,e.id_estimasi,e.fk_no_polisi,e.fk_no_chasis,e.fk_no_mesin,c.nama,k.nilai_kwitansi,k.tgl_batal,g.nama as nmkendaraan, d.id_pkb AS nopkb, k.diskon_or AS diskonor from t_kwitansi_or k 
                                      INNER JOIN t_estimasi e ON k.fk_estimasi=e.id_estimasi 
                                      INNER JOIN t_customer c ON e.fk_customer=c.id_customer
                                      INNER JOIN t_pkb d ON e.id_estimasi=d.fk_estimasi
                                      INNER JOIN t_inventory_bengkel f ON e.fk_no_chasis=f.no_chasis
                                      INNER JOIN t_tipe_kendaraan g ON f.fk_tipe_kendaraan=g.id_tipe_kendaraan
                                      WHERE k.tgl_batal='0000:00:00 00:00:00' AND substring(tgl_kwitansi_or,1,10)>='$tgl1' AND  substring(tgl_kwitansi_or,1,10)<='$tgl2' 
                                    ORDER BY k.no_kwitansi_or DESC";
                                   	$rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <th><?php echo $j++;?></th>                                               
                          <td><?php echo date('d-m-Y',strtotime($catat['tgl_kwitansi_or']));?></td>
                          <td><?php echo ($catat['no_kwitansi_or']);?></td>                         
                          <td><?php echo ($catat['nopkb']);?></td>
                          <td><?php echo $catat['fk_no_polisi'];?></td>
                          <td><?php echo $catat['nmkendaraan'];?></td>
                          <td><?php echo $catat['nama'];?></td>
                          <td><?php echo $catat['nilai_kwitansi'];?></td>
                          <td><?php echo $catat['diskonor'];?></td>
                          <td></td>
                          <td></td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>