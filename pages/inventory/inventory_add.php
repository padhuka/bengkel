<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once 'inventory_warna_tab.php';
    include_once 'inventory_tipe_tab.php';
    include_once 'inventory_customer_tab.php';

   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Data Inventory</h4>
                    </div>
				            <!--<div class="box-header with-border">
				              <h3 class="box-title">Horizontal Form</h3>
				            </div>
				             /.box-header -->
				            <!-- form start -->
                    <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formInventory">
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="nochasis">No Chasis</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="nochasis" name="nochasis" required>
                          </div>
                        </div>
				                <div class="form-group">
                          <div class="col-sm-3">
                            <label for="nomesin">No Mesin</label>
                          </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nomesin" name="nomesin" required>
				                  </div>
				                </div>
                         <div class="form-group">
                          <div class="col-sm-3">
                            <label for="nopolisi">No Polisi</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="nopolisi" name="nopolisi" required>
                          </div>
                        </div>
                          <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namastnk">Nama STNK</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="namastnk" name="namastnk" required>
                          </div>
                        </div>
                         <div class="form-group">
                          <div class="col-sm-3">
                            <label for="alamatstnk">Alamat STNK</label>
                          </div>
                          <div class="col-sm-8">
                            <textarea type="text" class="form-control" id="alamatstnk" name="alamatstnk" required></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="tipekendaraan">Tipe Kendaraan</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="hidden" class="form-control" id="tipe" name="tipe" readonly>
                            <input type="text" class="form-control" id="tipenm" name="tipenm" readonly>
                          </div>
                        <button type="button" class="btn btn-primary btn-md" onclick="selecttipe();">Pilih</button>
                        </div>
                         
                         <div class="form-group">
                          <div class="col-sm-3">
                            <label for="Warna">Warna Kendaraan</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="hidden" class="form-control" id="warna" name="warna" readonly>
                            <input type="text" class="form-control" id="warnanm" name="warnanm" readonly>
                          </div>
                        <button type="button" class="btn btn-primary btn-md" onclick="selectwarna();">Pilih</button>
                        </div>
                        
                         <div class="form-group">
                          <div class="col-sm-3">
                            <label for="customer">Customer</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="hidden" class="form-control" id="customer" name="customer" readonly>
                            <input type="text" class="form-control" id="customernm" name="customernm" readonly>
                          </div>
                        <button type="button" class="btn btn-primary btn-md" onclick="selectcustomer();">Pilih</button>
                        </div>
                       
				          		 <div class="form-group">
                           <div class="modal-footer">
				                  <div class="col-sm-8">
				                    <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">&nbsp;Batal&nbsp;</button>
				                  </div>
                        </div>
				                </div>

				            </form>
				          </div>
				</div>
</div>

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
  .modal-content {
    height: 565px;
  }
  .modal-dialog {
    margin-bottom: 0px;
    border: 3px;
  }
    .title-header {
    font-size: 20px;
    text-align: center;
    font-weight: bold;
    font-family: monospace;
  }
</style>

<script type="text/javascript">
	$(document).ready(function (){

                      $("#formInventory").on('submit', function(e){
                          e.preventDefault();
                            //alert(disposisine)                       ;
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'inventory/inventory_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        //alert('lolos');
                                                        var hsl=data.trim();
                                                        //alert(hsl);
                                                        //return false;
                                                        if (hsl=='y'){
			                                                alert('Data Sudah ada');
			                                                return false;
			                                                exit();
			                                              }else{

			                                                $("#tableinventory").load('inventory/inventory_load.php');
                                                                      $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalAdd').modal('hide');
			                                            }
                                                      }
                                                });
                      });
    });

  function selecttipe(){
    $("#ModalTipe").modal({backdrop: 'static',keyboard: false});   
  }
  function selectwarna(){  
    $("#ModalWarna").modal({backdrop: 'static',keyboard: false});   
  }
   function selectcustomer(){  
    $("#ModalCustomer").modal({backdrop: 'static',keyboard: false});   
  }
</script>
