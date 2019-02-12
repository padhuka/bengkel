<!-- general form elements disabled -->
   <?php
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $no_kwitansi_or= $_GET['no_kwitansi_or'];
    //   $sqlpan= "SELECT * FROM t_kwitansi_or WHERE t_kwitansi_or='$no_kwitansi_or'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
<div class="modal-dialog">
           <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px"> <button type="button" class="close" aria-label="Close" onclick="$('#ModalOrPrint').modal('hide');"><span>&times;</span></button></h4>                    
                    </div>
                  <?php
                                    $j=1;
                                    $sqlcatat = "SELECT *,e.keterangan as ketkw,e.nilai_kwitansi as nilaikw,e.diskon_or AS diskonkw, c.alamat AS alamatcustomer,c.no_telp AS telpcustomer,c.nama AS nmcustomer,d.nama AS nmasuransi FROM t_kwitansi_or e
                                    LEFT JOIN t_estimasi a ON e.fk_estimasi=a.id_estimasi
                                    LEFT JOIN t_customer c ON a.fk_customer=c.id_customer 
                                    LEFT JOIN t_asuransi d ON a.fk_asuransi=d.id_asuransi 
                                    WHERE e.no_kwitansi_or='$no_kwitansi_or'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                    $idestimasi=$catat['id_estimasi'];
                                    $disckw=100-$catat['diskonkw'];
                                ?>
                    <div class="modal-body">
                      <div class="modal-title-detail" align="center"><h4><u>INVOICE</u></h4><h5><?php echo $catat['no_kwitansi_or'];?></h5></div>
                      <div class="row">
                       <div class="col-sm-6">
                       <table id="pkbshow" class="">
                       <td>
                         <th class="col-sm-6">
                        <tr> <th>No Estimasi</th> <td ><?php echo $catat['id_estimasi'];?></td></tr>
                        <tr> <th>Tgl Masuk</th> <td ><?php echo $catat['tgl'];?></td></tr>
                        <tr> <th>No Chasis</th>  <td ><?php echo $catat['fk_no_chasis'];?></td></tr>
                        <tr> <th>No Mesin</th> <td ><?php echo $catat['fk_no_mesin'];?></td></tr>
                        <tr> <th>No Polisi</th>   <td ><?php echo $catat['fk_no_polisi'];?></td> </tr>
                        <tr><th>KM Masuk</th> <td ><?php echo $catat['km_masuk'];?></td></tr>
                        </th>
                       </td>
                      </table>
                           </div>

                            <div class="col-sm-6">
                              <table id="pkbshow" class="">
                              <td>
                                  <th class="col-sm-6">                                    
                                    <tr><th>Kategori </th> <td ><?php echo $catat['kategori'];?></td></tr>
                                    <tr><th>Asuransi</th>  <td ><?php echo $catat['nmasuransi'];?></td></tr>
                                    <tr><th>Nama Customer</th> <td ><?php echo $catat['nmcustomer'];?></td></tr>
                                    <tr><th>Telp</th><td ><?php echo $catat['telpcustomer'];?></td></tr>
                                    <tr><th>Alamat</th><td ><?php echo $catat['alamatcustomer'];?></td></tr>
                                  </th>
                              </td>
                              </table>
                         </div>
                      </div>
                       
                <table id="pkbpanel" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                        <tr><th>Item </th><th>Total</th></tr>
                        </thead>
                        <tbody>
             
                        <tr>
                          <td><?php echo $catat['ketkw'];?></td>                         
                          <td align="right"><?php echo rupiah2($catat['nilaikw']);?></td>
                        </tr>
                          
                        <tr><td align="right">Sub Total</td><td align="right">-</td></tr>  
                        <tr><td align="right">Own Risk</td><td align="right"><?php echo rupiah2($catat['nilaikw']);?></td></tr>
                        <tr><td align="right">Sub Total After OR</td><td align="right">-</td></tr>  
                        <tr><td align="right">PPN</td><td align="right">-</td></tr>
                        <tr><td align="right">Total Invoice</td><td align="right"><?php echo rupiah2($catat['nilaikw']);?></td></tr> 
                </tfoot>
              </table>
                       <div class="form-group">
                      <div class="modal-footer">
                      <div class="but"><a href="kwitansior/kwitansior_cetak.php?no_kwitansi_or=<?php echo $no_kwitansi_or;?>" target="blank"><button type="button" class="btn btn-primary" name="close" onclick="cetak();">Print</button></a>
                                    <button type="button" class="btn btn-primary" name="close" onclick="$('#ModalOrPrint').modal('hide');">Close</button>
                     </div>
                     </div>
                     </div>
               </div>
           </div>
           </div>      
           

