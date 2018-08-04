<!-- general form elements disabled -->
   <?php
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $idestimasi= $_GET['idestimasi'];
    //   $sqlpan= "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
<div class="modal-dialog">
           <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Estimasi <button type="button" class="close" aria-label="Close" onclick="$('#ModalEstPrint').modal('hide');"><span>&times;</span></button></h4>                    
                    </div>
                  <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_estimasi e left join t_customer c on e.fk_customer=c.id_customer where e.id_estimasi='$idestimasi'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                ?>
                    <div class="modal-body">
                      <div class="modal-title-detail" align="center"><h4><u>ESTIMASI BODY REPAIR</u></h4><h5><?php echo $catat['id_estimasi'];?></h5></div>
                      <div class="row">
                       <div class="col-sm-6">
                       <table id="estimasishow" class="">
                       <td>
                         <th class="col-sm-6">
                        <tr> <th>No Estimasi</th> <td ><?php echo $catat['id_estimasi'];?></td></tr>
                        <tr> <th>Tgl Masuk</th> <td ><?php echo $catat['tgl'];?></td></tr>
                        <tr> <th>No Chasis</th>  <td ><?php echo $catat['fk_no_chasis'];?></td></tr>
                        <tr> <th>No Mesin</th> <td ><?php echo $catat['fk_no_mesin'];?></td></tr>
                        <tr> <th>No Polisi</th>   <td ><?php echo $catat['fk_no_polisi'];?></td> </tr>
                        </th>
                       </td>
                      </table>
                           </div>

                            <div class="col-sm-6">
                              <table id="estimasishow" class="">
                              <td>
                                  <th class="col-sm-6">
                                    <tr><th>Kategori </th> <td ><?php echo $catat['kategori'];?></td></tr>
                                    <tr><th>KM Masuk</th> <td ><?php echo $catat['km_masuk'];?></td></tr>
                                    <tr><th>Asuransi</th>  <td ><?php echo $catat['fk_asuransi'];?></td></tr>
                                    <tr><th>Nama Customer</th> <td ><?php echo $catat['nama'];?></td></tr>
                                    <tr><th>Telp</th><td ><?php echo $catat['no_telp'];?></td></tr>
                                  </th>
                              </td>
                              </table>
                         </div>
                      </div>
                       
                <table id="estimasipanel" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                        <tr><th>No</th><th>Pekerjaan</th><th>Total</th></tr>
                        </thead>
                        <tbody>
                <?php
                                    $j=1;
                                    $sqlcatatp = "SELECT * FROM t_estimasi_panel_detail a LEFT JOIN t_panel p ON a.fk_panel=p.id_panel WHERE a.fk_estimasi='$idestimasi'";
                                    $rescatatp = mysql_query( $sqlcatatp );
                                    while($catatp = mysql_fetch_array( $rescatatp )){
                                ?>
                        <tr>
                          <td ><?php echo $j++;?></td>
                          <td ><?php echo $catatp['nama'];?></td>
                          <td align="right"><?php echo rupiah2($catatp['harga_total_estimasi_panel']);?></td>
                        </tr>
                    <?php }
                           $j=$j;
                                    $sqlcatat2 = "SELECT * FROM t_estimasi_part_detail a LEFT JOIN t_part p ON a.fk_part=p.id_part WHERE a.fk_estimasi='$idestimasi'";
                                    $rescatat2 = mysql_query( $sqlcatat2 );
                                    while($catat2 = mysql_fetch_array( $rescatat2 )){
                                ?>
                        <tr>
                          <td ><?php echo $j++;?></td>
                          <td ><?php echo $catat2['nama'];?></td>
                          <td align="right"><?php echo rupiah2($catat2['harga_total_estimasi_part']);?></td>
                        </tr>
                    <?php }?>
                        <tr><td colspan="2" align="center">Sub Total Jasa</td><td align="right"><?php echo rupiah2($catat['total_netto_harga_jasa']);?></td></tr>
                        <tr><td colspan="2" align="center">PPN</td><td align="right"><?php echo rupiah2((10/100)*$catat['total_netto_harga_jasa']);?></td></tr>
                        <tr><td colspan="2" align="center">Total Jasa</td><td align="right"><?php echo rupiah2((110/100)*$catat['total_netto_harga_jasa']);?></td></tr>
                </tfoot>
              </table>
                       <div class="form-group">
                      <div class="modal-footer">
                      <div class="but"><a href="estimasi/estimasi_cetak.php?idestimasi=<?php echo $idestimasi;?>" target="blank"><button type="button" class="btn btn-primary" name="close" onclick="cetak();">Print</button></a>
                                    <button type="button" class="btn btn-primary" name="close" onclick="$('#ModalEstPrint').modal('hide');">Close</button>
                     </div>
                     </div>
                     </div>
               </div>
           </div>
           </div>      
           

