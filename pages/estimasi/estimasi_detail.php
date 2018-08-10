<!-- general form elements disabled -->
   <?php

    include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';

    $idestimasi=explode('-',$_GET['idestimasi']);

    $sqles = "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi[0]'";
    $hes = mysql_fetch_array(mysql_query($sqles));
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Estimasi <button type="button" class="close" aria-label="Close" onclick="$('#ModalEstimasiDet').modal('hide');"><span>&times;</span></button></h4>   
                    </div>
                    
                    <div class="modal-body">

                   <div class="row">
                     <div class="col-sm-12">
                        <table id="estimasishow" class="table table-condensed table-bordered table-striped table-hover">
                          <td>
                         <th class="col-sm-6">
                        <tr> <th>Tgl Masuk</th> <td ><?php echo tampilTanggal(substr($hes['tgl'],0,10));?></td></tr>
                        <tr> <th>No Chasis</th> <td ><?php echo $hes['fk_no_chasis'];?></td></tr>
                        <tr> <th>No Mesin</th>  <td ><?php echo $hes['fk_no_mesin'];?></td></tr>
                        <tr> <th>No Polisi</th> <td ><?php echo $hes['fk_no_polisi'];?></td></tr>
                        <tr> <th>No Warna</th>   <td ><?php echo $idestimasi[1];?></td> </tr>
                        <tr> <th>kategori</th>   <td ><?php echo $hes['kategori'];?></td> </tr>
                        <tr> <th>Asuransi</th>   <td ><?php echo $hes['fk_no_polisi'];?></td> </tr>
                          <tr> <th>KM Masuk</th>   <td ><?php echo $hes['km_masuk'];?></td> </tr>
                        </th>
                       </td>
                        </table>

                     </div>
                   </div>
                    <hr>
                                           
                  </div>                  
                <div id="tableestimasidetail"></div>                
                <div class="form-group">
                           <div class="modal-footer">
                                <div class="but">
                                    <button type="button" class="btn btn-primary" name="part" onclick="parte('<?php echo $idestimasi[0];?>');">&nbsp;Part&nbsp;</button>
                                    <button type="button" class="btn btn-primary" name="panel" onclick="panele('<?php echo $idestimasi[0];?>');">Panel</button>
                                </div>
                            </div>
                </div> 
                <div class="form-group">
                           <div class="modal-footer">
                                <div class="but">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">&nbsp;Simpan&nbsp;</button>
                                </div>
                            </div>
                </div>   
                <br>
        </div>
</div>
        <div id="ModalAddPanelx" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
        <div id="ModalAddPartx" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

        <script type="text/javascript">
            $(document).ready(function (){
                 var idestimasie='<?php echo $idestimasi[0];?>';
                 $("#tableestimasidetail").load('estimasi/estimasi_detail_tab.php?idestimasi='+idestimasie);
            });

            function panele(x){

              $.ajax({
                    url: "estimasi/panel_tab.php?idestimasine="+x,
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAddPanelx").html(ajaxData);
                        $("#ModalAddPanelx").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }

            function parte(y){
              $.ajax({
                    url: "estimasi/part_tab.php?idestimasine="+y,
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAddPartx").html(ajaxData);
                        $("#ModalAddPartx").modal('show',{backdrop: 'true'});
                      }
                    });
              }
        </script>

<style type="text/css">
.modal-open .modal {
    overflow-y: scroll;
   /* overflow-x: scroll;
*/
  }
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
  .modal-content {
    height: 600px;
  }
  .but {
    text-align: center;
  }
  .modal-dialog {
    margin-bottom: 0px;
    border: 3px;
    width: 750px;
  }
</style>