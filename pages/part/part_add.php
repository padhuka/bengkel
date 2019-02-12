<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Data Part</h4>
                    </div>
				            <!--<div class="box-header with-border">
				              <h3 class="box-title">Horizontal Form</h3>
				            </div>
				             /.box-header -->
				            <!-- form start -->
                    <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formpart">
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="kodepart">Kode Part</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_part" name="id_part" required>
                          </div>
                        </div>
				                <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namapart">Nama</label>
                          </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nama" name="nama" required>
				                  </div>
				                </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="satuan">Satuan</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="hidden" class="form-control" id="satuan" name="satuan" readonly>
                            <input type="text" class="form-control" id="satuannm" name="satuannm" readonly>
                          </div>
                        <button type="button" class="btn btn-primary btn-md" onclick="satuane();">Pilih</button>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargapokokpart">Harga Beli</label>
                        </div>
                          <div class="col-sm-8">
                         <input type="text" class="form-control" id="hargabeli" name="hargabeli" required>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="hargabelipart">Harga Jual</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="hargajual" name="hargajual" required>
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="diskon">Diskon</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="diskon" name="diskon" required>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="ppn">PPN</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="ppn" name="ppn" required>
                          </div>
                        </div>
                         <div class="form-group">
                            <div class="col-sm-3">
                          <label for="stok">Stock</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="stock" name="stock" required>
                          </div>
                        </div>
                            <div class="form-group">
                          <div class="col-sm-3">
                            <label for="supplier">Supplier</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="hidden" class="form-control" id="supplier" name="supplier" readonly>
                            <input type="text" class="form-control" id="suppliernm" name="suppliernm" readonly>
                          </div>
                        <button type="button" class="btn btn-primary btn-md" onclick="suppliere();">Pilih</button>
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
<?php include_once 'part_supplier_tab.php';?>
<?php include_once 'part_satuan_tab.php';?>
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
</style>

<script type="text/javascript">
	$(document).ready(function (){

                      $("#formpart").on('submit', function(e){
                          e.preventDefault();
                            //alert(disposisine)                       ;
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'part/part_add_save.php',
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

			                                                $("#tablepart").load('part/part_load.php');
                                                                      $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalAdd').modal('hide');
			                                            }
                                                      }
                                                });
                      });
    });

  function satuane(){
    $("#ModalSatuan").modal({backdrop: 'static',keyboard: false});   

  }

  function suppliere(){  
    $("#ModalSupplier").modal({backdrop: 'static',keyboard: false});   
  }
</script>
