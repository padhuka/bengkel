<!-- general form elements disabled -->
   <?php
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalBank" style="text-align: center;padding-right: 0px">Tambah Data bank <button type="button" class="close" aria-label="Close" onclick="$('#ModalAdd').modal('hide');"><span>&times;</span></button></h4>  
                    </div>
                  
                    <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formbank">
                      
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

                              <option value="Pelunasan" onclick="$('#buttonPelunasan').show();$('#buttonTitipan').hide();$('#showPkb').hide();$('#showKwitansi').show();$('#nokwitansi').val('');">Pelunasan</option>                         
                                <option value="Titipan" onclick="$('#buttonTitipan').show();$('#buttonPelunasan').hide();$('#showKwitansi').hide();$('#showPkb').show();$('#nopkb').val('');">Titipan</option>
                                
                                </select>  

                                
                               
                               
                                                       
                              </div>
                        </div>

                        <div class="form-group" id="showPkb">
                          <div class="col-sm-3">
                            <label for="namapkb">No Ref</label>
                          </div>
                            <div class="col-sm-7">
                                <!-- <input type="hidden" class="form-control" id="nopkb" name="asuransi">  -->
                                <input type="text" class="form-control" id="idpkb" name="idpkb" readonly> 
                                </div>
                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="selectPkb();" id="buttonTitipan">Pilih</button>
                              
                        </div>
                    
                          <div class="form-group" id="showKwitansi">
                          <div class="col-sm-3">
                            <label for="nokwitansi">No Ref</label>
                          </div>
                            <div class="col-sm-7">
                                <!-- <input type="hidden" class="form-control" id="nopkb" name="asuransi">  -->
                                <input type="text" class="form-control" id="nokwitansi" name="nokwitansi" readonly> 
                                 </div>
                                  <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="selectKwi();" id="buttonPelunasan">Pilih</button>
                             
                        </div>




                           <div class="form-group">
                            <div class="col-sm-3">
                          <label for="diterima">DiTerima Dari/Diberikan Kepada</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="diterima" name="diterima" required>
                          </div>
                        </div>
                        
                           <div class="form-group">
                          <div class="col-sm-3">
                            <label for="viabayar">Via Bayar</label>
                          </div>
                            <div class="col-sm-8">
                                <select id="viabayar" name="viabayar"> 

                              <option value="Transfer" onclick="$('#buttonPartner').hide();$('#showPartner').hide();">Transfer</option>                         
                              <option value="Debit Card" onclick="$('#buttonPartner').show();$('#showPartner').show();">Debit Card</option>
                              <option value="Credit Card" onclick="$('#buttonPartner').show();$('#showPartner').show();">Credit Card</option> 


                                </select>  

                              </div>
                        </div>
                        
                             <div class="form-group" id="showPartner">
                          <div class="col-sm-3">
                            <label for="partnerbank">Partner Bank</label>
                          </div>
                            <div class="col-sm-7">
                                <!-- <input type="hidden" class="form-control" id="nopkb" name="asuransi">  -->
                                <input type="text" class="form-control" id="namapartner" name="namapartner" readonly> 
                                <input type="hidden" class="form-control" id="id_partner_bank" name="id_partner_bank" readonly> 
                                 </div>
                                  <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="selectPartner();" id="buttonPartner">Pilih</button>
                             
                        </div>

                          <div class="form-group">
                            <div class="col-sm-3">
                          <label for="total">Total</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="nilai" name="nilai" required>
                          </div>
                        </div>




                          <div class="form-group">
                            <div class="col-sm-3">
                          <label for="keterangan">Keterangan</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                          </div>
                        </div>
                                            
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
<?php include_once 'bank_pkb_tab.php';?>
<?php include_once 'bank_kwitansi_tab.php';?>
<?php include_once 'bank_partner_tab.php';?>

<script type="text/javascript">
  $('#buttonTitipan').hide();
  $('#showPkb').hide();
  $('#buttonPartner').hide();
  $('#showPartner').hide();


  $('#tgltransaksi').datepicker({       
        format: 'yyyy-mm-dd',
        autoclose: true,
      });

  function selectKwi(){ 
    $("#ModalBankKwitansi").modal({backdrop: 'static',keyboard:false});   

  }
  function selectPkb(){ 
    $("#ModalBankPkb").modal({backdrop: 'static',keyboard:false});   
  }
  function selectPartner(){ 
    $("#ModalBankP").modal({backdrop: 'static',keyboard:false});   
  }

  $(document).ready(function (){

                      $("#formbank").on('submit', function(e){
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
                                                  url: 'bank/bank_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        $("#tablebank").load('bank/bank_load.php');
                                                        $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalAdd').modal('hide'); 
                                                            var hsl=data.trim();       
                                                              alert(hsl);
                                                           
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