<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=reportestimasi.xls");
 
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
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan Estimasi</center></span>
                                     <span style="font-size: 20px;font-weight: bold;"><center> Per Tgl <?php echo date('d-m-Y' , strtotime($_GET['tgl1']));echo ' s/d '; echo date('d-m-Y' , strtotime($_GET['tgl2'])); ?></center></span>
                                <br>

      <table><tr><td>ESTIMASI</td></tr></table>    
      <table id="tableestimasi1" class="table table-condensed table-bordered table-striped table-hover">
                
                <tr>
                          <td>No</td>
                          <td>No Estimasi</td>
                          <td>Tgl Masuk</td>
                          <td>No Chasis</td>
                          <td>No Mesin</td>
                          <td>No Polisi</td>
                          <td>Nama Customer</td>
                          <td>Total Estimasi</td>
                </tr>
                
                <?php
                                   //WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_estimasi='' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2' 
                                   
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    $j=1;
                                           $jml=0;
                                    $sqlcatat = "SELECT * FROM t_estimasi p 
                                  LEFT JOIN t_kwitansi_or k ON p.id_estimasi=k.fk_estimasi
                                   LEFT JOIN t_customer c ON p.fk_customer=c.id_customer                                  
                                   WHERE p.tgl_batal='0000-00-00 00:00:00' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2' 
                                   ORDER BY p.id_estimasi DESC";                           
                                   	$rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                              $jml=$jml+$catat['total_netto_harga_jasa'];  
                                ?>
                        <tr>
                          <td><?php echo $j++;?></td>
                          <td><?php echo ($catat['id_estimasi']);?></td>                       
                          <td ><?php echo date('d-m-Y',strtotime($catat['tgl']));?></td>
                          <td ><?php echo $catat['fk_no_chasis'];?></td>
                          <td ><?php echo $catat['fk_no_mesin'];?></td>                          
                          <td ><?php echo $catat['fk_no_polisi'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                           <td ><?php echo rupiah2($catat['total_netto_harga_jasa']);?></td>                          
                        </tr>
                    <?php }?>
                 <tr><td colspan="6" align="right">Total</td><td><?php echo rupiah2($jml);?></td></tr>
              </table>
<br>
<table><tr><td>ESTIMASI BATAL</td></tr></table>    
      <table id="tableestimasi1" class="table table-condensed table-bordered table-striped table-hover">
                <tr>
                          <td>No</td>
                          <td>No Estimasi</td>
                          <td>Tgl Masuk</td>
                          <td>No Chasis</td>
                          <td>No Mesin</td>
                          <td>No Polisi</td>
                          <td>Nama Customer</td>
                          <td>Total Estimasi</td>
                </tr>
                <?php
                                   //WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_estimasi='' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2' 
                                   
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_estimasi p 
                                  LEFT JOIN t_kwitansi_or k ON p.id_estimasi=k.fk_estimasi
                                   LEFT JOIN t_customer c ON p.fk_customer=c.id_customer                                  
                                   WHERE p.tgl_batal<>'0000-00-00 00:00:00' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2' 
                                   ORDER BY p.id_estimasi DESC";                 
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><?php echo $j++;?></td>
                          <td><?php echo ($catat['id_estimasi']);?></td>                       
                          <td ><?php echo date('d-m-Y',strtotime($catat['tgl']));?></td>
                          <td ><?php echo $catat['fk_no_chasis'];?></td>
                          <td ><?php echo $catat['fk_no_mesin'];?></td>                          
                          <td ><?php echo $catat['fk_no_polisi'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['total_netto_harga_jasa'];?></td>
                          
                        </tr>
                    <?php }?>
                    
              </table>
