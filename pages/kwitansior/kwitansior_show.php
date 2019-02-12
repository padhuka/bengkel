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
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Estimasi <button type="button" class="close" aria-label="Close" onclick="$('#ModalShow').modal('hide');"><span>&times;</span></button></h4>                    
                    </div>
                  <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_estimasi e 
                                                  left join t_customer c
                                                  on e.fk_customer=c.id_customer
                                                  where e.id_estimasi='$idestimasi'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                    <div class="modal-body">
                      <div class="modal-title-detail">ESTIMASI PKB</div>
                      <div class="row">
                       <div class="col-sm-6">
                       <table id="estimasishow" class="table table-condensed table-bordered table-striped table-hover">
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
                               <table id="estimasishow" class="table table-condensed table-bordered table-striped table-hover">
                          <td>
                         <th class="col-sm-6">
                        <tr> <th>Kategori </th> <td ><?php echo $catat['kategori'];?></td></tr>
                        <tr> <th>KM Masuk</th> <td ><?php echo $catat['km_masuk'];?></td></tr>
                        <tr> <th>Asuransi</th>  <td ><?php echo $catat['fk_asuransi'];?></td></tr>
                        <tr> <th>Nama Customer</th> <td ><?php echo $catat['nama'];?></td></tr>
                        <tr> <th>Telp</th>   <td ><?php echo $catat['no_telp'];?></td> </tr>
                        </th>
                       </td>
                               </table>
                         </div>

                      </div>

                       <div class="modal-title-detail">NILAI ESTIMASI </div>
                      <div class="row">
                       <div class="col-sm-12">
                       <table id="estimasishow" class="table table-condensed table-bordered table-striped table-hover">
                       <td >
                         <th class="col-sm-2">
                        <tr> 
                            <th>Nilai Panel</th><td><?php echo rupiah2($catat['total_gross_harga_panel']);?></td> 
                            <th>Disc</th><td ><?php echo rupiah2($catat['total_diskon_rupiah_panel']);?></td>
                            <th>Total Netto</th> <td><?php echo rupiah2($catat['total_netto_harga_panel']);?></td>
                        </tr>
                        
                        <tr> 
                          <th>Nilai Part</th><td><?php echo rupiah2($catat['total_gross_harga_part']);?></td>
                          <th>Disc</th> <td><?php echo rupiah2($catat['total_diskon_rupiah_part']);?></td>
                          <th>Total Netto</th> <td><?php echo rupiah2($catat['total_netto_harga_part']);?></td>
                        </tr>
                        <tr class="total"> 
                          <th>Total Gross</th><td><?php echo rupiah2($catat['total_gross_harga_jasa']);?></td>
                          <th>Total Diskon</th> <td><?php echo rupiah2($catat['total_diskon_rupiah_jasa']);?></td>
                          <th>Total Netto</th> <td><?php echo rupiah2($catat['total_netto_harga_jasa');?></td>
                        </tr>

                        </th>
                       </td>
                      </table>
                      <?php }?>
                           </div>
                      </div>
                        <div class="form-group">
                     <div class="modal-footer">
                     <div class="but">
                                    <button type="button" class="btn btn-primary" name="part" onclick="partshow('<?php echo $idestimasi;?>');">&nbsp;Part&nbsp;</button>
                                    <button type="button" class="btn btn-primary" name="panel" onclick="panelshow('<?php echo $idestimasi;?>');">Panel</button>
                     </div>
                     </div>
                     </div>
                       <div class="form-group">
                      <div class="modal-footer">
                      <div class="but">
                                    <button type="button" class="btn btn-primary" name="close" onclick="$('#ModalShow').modal('hide');">Close</button>
                     </div>
                     </div>
                     </div>
               </div>
           </div>
           </div>      
           <div id="ModalPanelShow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
           <div id="ModalPartShow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<script type="text/javascript">
  
            function partshow(y){
              $.ajax({
                    url: "estimasi/part_show_tab.php?idestimasine="+y,
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalPartShow").html(ajaxData);
                        $("#ModalPartShow").modal({backdrop: 'static', keyboard:false});
                      }
                    });
              }
              function panelshow(z){
              $.ajax({
                    url: "estimasi/panel_show_tab.php?idestimasine="+z,
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalPanelShow").html(ajaxData);
                        $("#ModalPanelShow").modal({backdrop: 'static', keyboard:false});
                      }
                    });
              }

  
</script>        

<style type="text/css">
  .modal-footer {
    padding-top: 10px;
    padding-bottom: 0px;
    padding-left: 0px;
    padding-right: 0px;
  }
  .modal-title {
    font-style: italic;
    background-color: lightcoral;
    text-align: center;
    font-weight: bold;
  }
  .total {
  font-weight: bold;border-top:   inset;
  }
    .but {
    text-align: center;
  }
  .modal-title-detail {
    font-style: italic;
    background-color: lightblue;
    text-align: center;
    font-weight: bold;
  }
  .modal-dialog {
    margin-bottom: 0px;
    border: 3px;
    width: 800px;
  }
</style>