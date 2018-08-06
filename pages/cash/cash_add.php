<!-- general form elements disabled -->
   <?php

    include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalCash" style="text-align: center;padding-right: 0px">Tambah Data Cash <button type="button" class="close" aria-label="Close" onclick="$('#ModalAdd').modal('hide');"><span>&times;</span></button></h4>  
                    </div>
                  
                    <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formcash">
                      
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="tgltransaksi">Tgl Transaksi</label>
                          </div>
                          <div class="col-sm-8">
                            <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="tgltransaksi" name="tgltransaksi" required value="<?php echo $harinow;?>">
                          </div>
                          </div>
                        </div> 
                    
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="tipetransaksi">Tipe Transaksi</label>
                          </div>
                            <div class="col-sm-8">
                                <select id="tipetransaksi" name="tipetransaksi">        
                                <option value="Pelunasan" onclick="$('#buttonPelunasan').show();$('#showPkb').hide();$('#nokwtansi').val('');">Pelunasan</option>                         
                                  <option value="Titipan" onclick="$('#buttonTitipan').show();$('#showPelunasan').hide();$('#nopkb').val('');">Titipan</option>
                                  
                                </select>      
                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="selectPkb();" id="buttonTitipan">Pilih No PKB</button>
                                 <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="selecKwitansi();" id="buttonPelunasan">Pilih No Kwitansi</button>
                                                       
                              </div>
                        </div>

                        <div class="form-group" id="showPkb">
                          <div class="col-sm-3">
                            <label for="namapkb">No PKB</label>
                          </div>
                            <div class="col-sm-8">
                                <!-- <input type="hidden" class="form-control" id="nopkb" name="asuransi">  -->
                                <input type="text" class="form-control" id="nopkb" name="nopkb" readonly> 
                              </div>
                        </div>
                    
                          <div class="form-group" id="showKwitansi">
                          <div class="col-sm-3">
                            <label for="namapkb">No Kwitansi</label>
                          </div>
                            <div class="col-sm-8">
                                <!-- <input type="hidden" class="form-control" id="nopkb" name="asuransi">  -->
                                <input type="text" class="form-control" id="nokwitansi" name="nokwitansi" readonly> 
                              </div>
                        </div>
                         
                          <input type="hidden" class="form-control" id="uname" name="uname" value="<?php echo $sesuname;?>" readonly>
                          <input type="hidden" class="form-control" id="customer" name="customer" readonly>                        
                        <div class="form-group">
                           <div class="modal-footer">
                          <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                   <button type="button" class="btn btn-primary" onclick="$('#ModalAdd').modal('hide');">&nbsp;Batal&nbsp;</button>
                          </div>
                        </div>
                        </div>

                    </form>
              
        </div>
</div>
<?php //include_once 'estimasi_chasis_tab.php';?>
<?php //include_once 'estimasi_asuransi_tab.php';?>

<script type="text/javascript">
  $('#buttonTitipan').hide();
  //$('#buttonPelunasan').hide();
  $('#showPkb').hide();
  //$('#showKwitansi').hide();   


  $('#tgltransaksi').datepicker({       
        format: 'yyyy-mm-dd',
        autoclose: true,
      });
  function selectPkb(){ 
    $("#ModalPkb").modal({backdrop: 'static',keyboard:false});   
  }
  function chasise(){ 
    $("#ModalChasis").modal({backdrop: 'static',keyboard:false});   
  }
  $(document).ready(function (){

                      $("#formcash").on('submit', function(e){
                          var chs= $("#chasis").val();
                          var km=  $("#kmmasuk").val();
                          if (chs==''){
                            alert('Data ada yang belum diisi');
                            return false;
                          }
                          e.preventDefault();
                            //alert(disposisine)                       ;
                                      $.ajax({
                                                  type: 'POST',
                                                  url: 'estimasi/estimasi_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        $("#tableestimasi").load('estimasi/estimasi_load.php');
                                                        $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalAdd').modal('hide'); 
                                                            var hsl=data.trim();       

                                                             $.ajax({
                                                                url: "estimasi/estimasi_detail.php?idestimasi="+hsl,
                                                                type: "GET",
                                                                  success: function (ajaxData){
                                                                    $("#ModalEstimasiDet").html(ajaxData);
                                                                    $("#ModalEstimasiDet").modal({backdrop: 'static', keyboard:false});
                                                                  }
                                                                }); 

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