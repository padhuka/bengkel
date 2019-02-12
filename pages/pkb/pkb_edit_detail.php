<!-- general form elements disabled -->
   <?php
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $idpkb= $_GET['idpkb'];
 //   $sqlpan= "SELECT * FROM t_pkb WHERE id_pkb='$idpkb'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
<div class="modal-dialog">
           <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Edit PKB <button type="button" class="close" aria-label="Close" onclick="$('#ModalEdit').modal('hide');"><span>&times;</span></button></h4>                    
                    </div>
                  <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_pkb e left join t_customer c on e.fk_customer=c.id_customer where e.id_pkb='$idpkb'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                                ?>
                    <div class="modal-body">
                      <div class="modal-title-detail">Data PKB</div>
                      <div class="row">
                       <div class="col-sm-6">
                       <table id="pkbshow" class="table table-condensed table-bordered table-striped table-hover">
                       <td>
                         <th class="col-sm-6">
                        <tr> <th>No pkb</th> <td ><?php echo $catat['id_pkb'];?></td></tr>
                        <tr> <th>Tgl Masuk</th> <td ><?php echo $catat['tgl'];?></td></tr>
                        <tr> <th>No Chasis</th>  <td ><?php echo $catat['fk_no_chasis'];?></td></tr>
                        <tr> <th>No Mesin</th> <td ><?php echo $catat['fk_no_mesin'];?></td></tr>
                        <tr> <th>No Polisi</th>   <td ><?php echo $catat['fk_no_polisi'];?></td> </tr>
                        </th>
                       </td>
                      </table>
                           </div>

                            <div class="col-sm-6">
                               <table id="pkbshow" class="table table-condensed table-bordered table-striped table-hover">
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

                      <div class="modal-title-detail">Nilai PKB</div>
                      <div class="row" id="loaddetail">
                       
                      </div>

                        <div class="form-group">
                     <div class="modal-footer">
                     <div class="but">
                                    <button type="button" class="btn btn-primary" name="part" onclick="partpkb('<?php echo $idpkb;?>');">&nbsp;Part&nbsp;</button>
                                    <button type="button" class="btn btn-primary" name="panel" onclick="panelpkb('<?php echo $idpkb;?>');">Panel</button>
                     </div>
                     </div>
                     </div>
                       <div class="form-group">
                      <div class="modal-footer">
                      <div class="but">
                                    <button type="button" class="btn btn-primary" name="close" onclick="$('#ModalEdit').modal('hide');">Close</button>
                     </div>
                     </div>
                     </div>
               </div>
           </div>
           </div>      
           <div id="ModalAddPanelPkb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
           <div id="ModalAddPartPkb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<script type="text/javascript">
            $(document).ready(function (){
                 $("#loaddetail").load('pkb/pkb_edit_detail_load.php?idpkb=<?php echo $idpkb;?>');
            });
            function panelpkb(x){
              $.ajax({
                    url: "pkb/panel_tab.php?idpkb="+x,
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAddPanelPkb").html(ajaxData);
                        $("#ModalAddPanelPkb").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }

              function partpkb(x){
              $.ajax({
                    url: "pkb/part_tab.php?idpkb="+x,
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAddPartPkb").html(ajaxData);
                        $("#ModalAddPartPkb").modal({backdrop: 'static',keyboard: false});
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