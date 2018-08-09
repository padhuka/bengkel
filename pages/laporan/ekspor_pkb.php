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
                                    $sqlcatat = "SELECT p.*,c.nama,k.no_kwitansi FROM t_pkb p
                                   LEFT JOIN t_customer c ON p.fk_customer=c.id_customer
                                   LEFT JOIN t_kwitansi k ON p.id_pkb=k.fk_pkb
                                   WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_pkb='Buka' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2' 
                                   ORDER BY p.id_pkb DESC";
                                   	$rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><button type="button" class="btn btn-link" id="<?php echo $catat['id_pkb']; ?>" onclick="open_pkb(idpkb='<?php echo $catat['id_pkb']; ?>');"><span><?php echo ($catat['id_pkb']);?></span></button></td>
                       
                          <td ><?php echo date('d-m-Y',strtotime($catat['tgl']));?></td>
                          <td ><?php echo $catat['fk_no_chasis'];?></td>
                          <td ><?php echo $catat['fk_no_mesin'];?></td>
                          
                          <td ><?php echo $catat['fk_no_polisi'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_pkb']; ?>" onclick="open_modal(idpkb='<?php echo $catat['id_pkb']; ?>');"><span>Edit</span></button>
                                           <?php if ($catat['no_kwitansi'] =='') { ?>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_pkb']; ?>" onclick="open_del(idpkb='<?php echo $catat['id_pkb']; ?>');"><span>Batal</span></button>

                                         <?php }?>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_pkb']; ?>" onclick="cetak_pkb(idpkb='<?php echo $catat['id_pkb']; ?>');"><span>Cetak</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>