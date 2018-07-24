<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $id_part = $_GET['id_part'];
    $sqlemp = "SELECT * FROM t_part WHERE id_part='$id_part'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
  ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_partden="true">&times;</span></button>
                        <h4 class="modal-title" id_part="myModalLabel">Edit Data Part</h4>
                    </div>

                     <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formPart">
                        <div class="form-group">
                          <div class="col-sm-3">
                          <label for="kodepart">Kode Part</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $emp['id_part'];?>" readonly>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="namapanel" >Nama</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $emp['nama'];?>" required>
				                  </div>
				                </div>
                            <div class="form-group">
                          <div class="col-sm-3">
                            <label for="satuan">Satuan</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $emp['fk_satuan'];?>"  readonly>
                            <input type="hidden" class="form-control" id="satuannm" name="satuannm" readonly>

                          </div>
                                                  <button type="button" class="btn btn-primary btn-md" onclick="satuane();">Pilih</button>

                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargapokokpanel">Harga Beli</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="hargabeli" name="hargabeli"  value="<?php echo $emp['harga_beli'];?>" required>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="hargajual" >Harga Jual</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="hargajual" name="hargajual"  value="<?php echo $emp['harga_jual'];?>" required>
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="diskonpanel" >Diskon</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="diskon" name="diskon" value="<?php echo $emp['diskon'];?>" required>
                          </div>
                        </div>
                           <div class="form-group">
                            <div class="col-sm-3">
                          <label for="ppnpanel" >PPN</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="ppn" name="ppn" value="<?php echo $emp['ppn'];?>" required>
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="stock" >Stock</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $emp['stock'];?>" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="supplier">Supplier</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="supplier" name="supplier" value="<?php echo $emp['fk_supplier'];?>"  readonly>
                            <!-- <input type="hidden" class="form-control" id="supplier" name="supplier" readonly> -->
                            <input type="hidden" class="form-control" id="suppliernm" name="suppliernm" readonly>
                          </div>
                                                  <button type="button" class="btn btn-primary btn-md" onclick="suppliere();">Pilih</button>

                        </div>

				                <div class="form-group">
                                  <div class="modal-footer">
				                  <div class="col-sm-8">
				                  	<input type="hidden" name="id_parthid" id="id_parthid" value="<?php echo $emp['id_part'];?>">
                            <input type="hidden" name="namahid" id="namahid" value="<?php echo $emp['nama'];?>">
				                  	<button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_partden="true">&nbsp;Batal&nbsp;</button>
				                  </div>
                                </div>
				                </div>
				            </form>
                       </div>
			         </div>
				</div>

</div>
<?php include_once 'part_supplier_tab.php';?>
<?php include_once 'part_satuan_tab.php';?>
<script type="text/javascript">
	$(document).ready(function (){

                      $("#formPart").on('submit', function(e){
                          e.preventDefault();
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'part/part_edit_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        //alert('lolos');
                                                        var hsl=data.trim();
                                                       // alert(hsl);
                                                        if (hsl=='y'){
			                                                alert('Data Sudah ada');
			                                                return false;
			                                                exit();
			                                            }else{
			                                                $("#tablepart").load('part/part_load.php');
                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalEdit').modal('hide');
			                                            }
                                                      }
                                                });
                      });
    });
function satuane(){
    $("#ModalSatuan").modal('show',{backdrop: 'true'});
  }

  function suppliere(){
    $("#ModalSupplier").modal('show',{backdrop: 'true'});
  }
</script>
<style type="text/css">
  .modal-footer {
    padding-top: 10px;
    padding-bottom: 0px;
    padding-left: 0px;
    padding-right: 0px;
  }
  .modal-content {
    height: 575px;
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