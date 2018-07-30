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
                        <h4 class="modal-title" id="myModalLabel">Data Estimasi</h4></h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="kodeestimasi">Tgl Masuk</label>
                          </div>
                          <div class="col-sm-7">
                            <label>:<?php echo tampilTanggal(substr($hes['tgl'],0,10));?></label>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Chasis</label>
                          </div>
                          <div class="col-sm-7">
                            <label>:<?php echo $hes['fk_no_chasis'];?></label>
                          </div>                          
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Mesin</label>
                          </div>
                          <div class="col-sm-7">
                            <label>:<?php echo $hes['fk_no_mesin'];?></label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Polisi</label>
                          </div>
                          <div class="col-sm-7">
                            <label>:<?php echo $hes['fk_no_polisi'];?></label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Warna</label>
                          </div>
                          <div class="col-sm-7">
                            <label>:<?php echo $idestimasi[1];?></label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Kategori</label>
                          </div>
                            <div class="col-sm-8">
                                  <?php
                                    $sqlas = "SELECT * FROM t_asuransi where id_asuransi='$hes[fk_asuransi]'";
                                      $qas = mysql_query( $sqlas );
                                      $has = mysql_fetch_array($qas);
                                  ?>                                  
                                  <label>:<?php echo $has['nama'];?></label>                        
                              </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Polisi</label>
                          </div>
                          <div class="col-sm-7">
                            <label>:<?php echo $hes['km_masuk'];?></label>
                          </div>
                        </div>                          
                                           
                  </div>                  
                <div id="tableestimasidetail"></div>                
                <div class="form-group">
                           <div class="modal-footer">
                                <div class="col-sm-8">
                                    <button type="button" class="btn btn-primary" name="part" onclick="parte('<?php echo $idestimasi[0];?>');">&nbsp;Part&nbsp;</button>
                                    <button type="button" class="btn btn-primary" name="panel" onclick="panele('<?php echo $idestimasi[0];?>');">Panel</button>
                                </div>
                            </div>
                </div> 
                <div class="form-group">
                           <div class="modal-footer">
                                <div class="col-sm-8">
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
  .modal-dialog {
    margin-bottom: 0px;
    border: 3px;
  }
</style>