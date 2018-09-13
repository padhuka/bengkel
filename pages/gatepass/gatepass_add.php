<!-- general form elements disabled -->
   <?php

    include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalGate" style="text-align: center;padding-right: 0px">Tambah Data Gate Pass <button type="button" class="close" aria-label="Close" onclick="$('#ModalGateAdd').modal('hide');"><span>&times;</span></button></h4>  
                    </div>
                  
                    <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formgate">
                      
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="tgl">Tgl Transaksi</label>
                          </div>
                          <div class="col-sm-8">
                            <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="tgl" name="tgl" required value="<?php echo $harinow;?>">
                          </div>
                          </div>
                        </div> 
                    
                      
                        <div class="form-group" id="gatepkb">
                          <div class="col-sm-3">
                            <label for="namapkb">No PKB</label>
                          </div>
                            <div class="col-sm-7">
                                <!-- <input type="hidden" class="form-control" id="nopkb" name="asuransi">  -->
                                <input type="text" class="form-control" id="idpkb" name="idpkb" readonly> 
                                </div>
                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="selectPkb();" id="buttonTitipan">Pilih</button>
                              
                        </div>
                    
                          <div class="form-group">
                          <div class="col-sm-3">
                            <label for="status">Tipe Transaksi</label>
                          </div>
                            <div class="col-sm-8">
                                <select id="status" name="status"> 

                              <option value="Sementara">Sementara</option>                         
                              <option value="Final">Final</option>
                                
                                </select>  
                                                
                              </div>
                        </div>
                 
                        <div class="form-group">
                           <div class="modal-footer">
                          <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                   <button type="button" class="btn btn-primary" onclick="$('#ModalGateAdd').modal('hide');">&nbsp;Batal&nbsp;</button>
                          </div>
                        </div>
                        </div>

                    </form>
              
        </div>
</div>
<?php include_once 'gatepass_pkb_tab.php';?>

<script type="text/javascript">

  $('#tgl').datepicker({       
        format: 'yyyy-mm-dd',
        autoclose: true,
      });

  function selectPkb(){ 
    $("#ModalGatePkb").modal({backdrop: 'static',keyboard:false});   
  }

  $(document).ready(function (){

                      $("#formgate").on('submit', function(e){
                          e.preventDefault();
                            //alert(disposisine)                       ;
                                      $.ajax({
                                                  type: 'POST',
                                                  url: 'gatepass/gatepass_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        $("#tablegatepass").load('gatepass/gatepass_load.php');
                                                        $('.modal-body').css('opacity', '');
                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalGateAdd').modal('hide'); 
                                                            //var hsl=data.trim();       
                                                              //alert(hsl);
                                                             

                                                  }
                                                      
                                                });

                                      
              
                      });
    });

</script>

<style type="text/css">
  .modal-open .modal {
    overflow-y: hidden;
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
  .modal-dialog {
    margin-bottom: 0px;
    border: 3px;
  }
</style>