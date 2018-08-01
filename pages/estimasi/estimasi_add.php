<!-- general form elements disabled -->
   <?php

   include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Data Estimasi </h4>  
                    </div>
                    <!--<div class="box-header with-border">
                      <h3 class="box-title">Horizontal Form</h3>
                    </div>
                     /.box-header -->
                    <!-- form start -->
                    <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formestimasi">
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="kodeestimasi">Tgl Masuk</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo tampilTanggal($harinow);?>" readonly>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Chasis</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="chasis" name="chasis" readonly>
                          </div>
                          <button type="button" class="btn btn-primary btn-md data-toggle="modal" data-target="#myModal" onclick="chasise();">Pilih</button>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Mesin</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="mesin" name="mesin" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Polisi</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="polisi" name="polisi" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Warna</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="hidden" class="form-control" id="warna" name="warna" readonly>
                            <input type="text" class="form-control" id="warnanm" name="warnanm" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Kategori</label>
                          </div>
                            <div class="col-sm-8">
                                <select id="kategori" name="kategori">                                 
                                  <option value="Pribadi" onclick="$('#buttonAsuransi').hide();$('#showAsuransi').hide();$('#asuransie').val('');$('#asuransinme').val('');">Pribadi</option>
                                  <option value="Asuransi" onclick="$('#buttonAsuransi').show();$('#showAsuransi').show();">Asuransi</option>
                                </select>      
                                <button type="button" class="btn btn-primary btn-md data-toggle="modal" data-target="#myModal" onclick="selectAsuransi();" id="buttonAsuransi">Pilih Asuransi</button>
                                                         
                              </div>
                        </div>
                        <div class="form-group" id="showAsuransi">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Nama Asuransi</label>
                          </div>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="asuransi" name="asuransi"> 
                                <input type="text" class="form-control" id="asuransinm" name="asuransinm" readonly> 
                              </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">KM Masuk</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="kmmasuk" name="kmmasuk" required>
                          </div>
                        </div> 
                          <input type="hidden" class="form-control" id="uname" name="uname" value="<?php echo $sesuname;?>" readonly>
                          <input type="hidden" class="form-control" id="customer" name="customer" readonly>                        
                        <div class="form-group">
                           <div class="modal-footer">
                          <div class="but">
                            <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                   <button type="button" class="btn btn-primary" onclick="$('#ModalAdd').modal('hide');">&nbsp;Batal&nbsp;</button>
                          </div>
                        </div>
                        </div>

                    </form>
                      <!--<table width="100%" border="1">
                        <tr>
                          <td>Panel</td>
                          <td>Part</td>
                        </tr>
                        <tr>
                          <td><div id="tablepanel"></div></td>
                          <td><div id="tablepart"></div></td>
                        </tr>
                      </table>
                  </div>-->
        </div>
</div>
<?php include_once 'estimasi_chasis_tab.php';?>
<?php include_once 'estimasi_asuransi_tab.php';?>
<script type="text/javascript">
  $('#buttonAsuransi').hide();
  $('#showAsuransi').hide();
            /*$(document).ready(function (){
                 $("#tablepanel").load('estimasi/panel_load.php');
                 $("#tablepart").load('estimasi/part_load.php');
            });*/
  function selectAsuransi(){ 
    $("#ModalAsuransi").modal({backdrop:'static',keyboard:false});   
  }
  function chasise(){ 
    $("#ModalChasis").modal({backdrop:'static',keyboard:false});   
  }

  $(document).ready(function (){

                      $("#formestimasi").on('submit', function(e){
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
    overflow-y:hidden; 
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
    height: 650px;
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