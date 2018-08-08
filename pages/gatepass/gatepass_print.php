<!-- general form elements disabled -->
   <?php
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $nogatepass= $_GET['nogatepass'];
    //   $sqlpan= "SELECT * FROM t_kwitansi WHERE t_kwitansi='$nogatepass'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
<div class="modal-dialog">
           <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px"> <button type="button" class="close" aria-label="Close" onclick="$('#ModalGatePrint').modal('hide');"><span>&times;</span></button></h4>                    
                    </div>
                  <?php
                                    $j=1;
                                    $sqlcatat = "SELECT *,e.tgl as tglout,es.tgl as tglin,c.alamat AS alamatcustomer,c.no_telp AS telpcustomer,c.nama AS nmcustomer,d.nama AS nmasuransi FROM t_gate_pass e
                                    LEFT JOIN t_pkb a ON e.fk_pkb=a.id_pkb
                                    LEFT JOIN t_customer c ON a.fk_customer=c.id_customer 
                                    LEFT JOIN t_asuransi d ON a.fk_asuransi=d.id_asuransi
                                    LEFT JOIN t_estimasi es ON a.fk_estimasi=es.id_estimasi
                                    WHERE e.no_gate_pass='$nogatepass'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                    $idpkb=$catat['id_pkb'];
                                ?>
                    <div class="modal-body">
                      <div class="modal-title-detail" align="center">

                        <h4><u>GET PASS FINAL</u></h4><h5><?php echo $catat['no_gate_pass'];?></h5>
                      </div>
                      <div class="row">
                       <div class="col-sm-6">
                       <table id="pkbshow" class="">
                       <td>
                         <th class="col-sm-6">
                        <tr> <th>No PKB</th> <td ><?php echo $catat['id_pkb'];?></td></tr>
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
                      <hr>
                      <table>
                        <tr><th>Check In</th><td >: <?php echo $catat['tglin'];?></td></tr>
                        <tr><th>Check Out</th><td >: <?php echo $catat['tglout'];?></td></tr>
                      </table>
                
                       <div class="form-group">
                      <div class="modal-footer">
                      <div class="but"><a href="gatepass/gatepass_cetak.php?nogatepass=<?php echo $nogatepass;?>" target="blank"><button type="button" class="btn btn-primary" name="close" onclick="cetak();">Print</button></a>
                                    <button type="button" class="btn btn-primary" name="close" onclick="$('#ModalGatePrint').modal('hide');">Close</button>
                     </div>
                     </div>
                     </div>
               </div>
           </div>
           </div>      
           

