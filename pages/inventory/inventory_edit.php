<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    include_once 'inventory_warna_tab.php';
    include_once 'inventory_tipe_tab.php';
    include_once 'inventory_customer_tab.php';
    $no_chasis = $_GET['no_chasis'];
    $sqlemp = "SELECT * FROM t_inventory_bengkel WHERE no_chasis='$no_chasis'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
  ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hno_chasisden="true">&times;</span></button>
                        <h4 class="modal-title" no_chasis="myModalLabel">Edit Data Inventory</h4>
                    </div>

                     <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formInventory">
                        <div class="form-group">
                          <div class="col-sm-3">
                          <label for="nochasis">No Chasis</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_chasis" name="no_chasis" value="<?php echo $emp['no_chasis'];?>" readonly>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="nomesin" >No Mesin</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="no_mesin" name="no_mesin" value="<?php echo $emp['no_mesin'];?>" required>
				                  </div>
				                </div>
                          <div class="form-group">
                            <div class="col-sm-3">
                          <label for="nopolisi" >No Polisi</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_polisi" name="no_polisi" value="<?php echo $emp['no_polisi'];?>" required>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="namastnk">Nama STNK</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="namastnk" name="namastnk"  value="<?php echo $emp['nama_stnk'];?>" required>
                          </div>
                        </div>
                         <div class="form-group">
                            <div class="col-sm-3">
                          <label for="alamatstnk">Alamat STNK</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamatstnk" name="alamatstnk"  value="<?php echo $emp['alamat_stnk'];?>" required>
                          </div>
                        </div>
                            <div class="form-group">
                          <div class="col-sm-3">
                            <label for="tipe">Tipe Kendaraan</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="tipe" name="tipe" value="<?php echo $emp['fk_tipe_kendaraan'];?>"  readonly>
                            <input type="hidden" class="form-control" id="tipenm" name="tipenm" readonly>
                          </div>
                                                  <button type="button" class="btn btn-primary btn-md" onclick="selecttipe();">Pilih</button>

                        </div>
                             <div class="form-group">
                          <div class="col-sm-3">
                            <label for="warna">Warna Kendaraan</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="warna" name="warna" value="<?php echo $emp['fk_warna_kendaraan'];?>"  readonly>
                            <input type="hidden" class="form-control" id="warnanm" name="warnanm" readonly>
                          </div>
                                                  <button type="button" class="btn btn-primary btn-md" onclick="selectwarna();">Pilih</button>

                        </div>

                             <div class="form-group">
                          <div class="col-sm-3">
                            <label for="customer">Customer</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="customer" name="customer" value="<?php echo $emp['fk_customer'];?>"  readonly>
                            <input type="hidden" class="form-control" id="customernm" name="customernm" readonly>
                          </div>
                                                  <button type="button" class="btn btn-primary btn-md" onclick="selectcustomer();">Pilih</button>

                        </div>

				                <div class="form-group">
                                  <div class="modal-footer">
				                  <div class="col-sm-8">
				                  	<input type="hidden" name="no_chasishid" id="no_chasishid" value="<?php echo $emp['no_chasis'];?>">
				                  	<button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hno_chasisden="true">&nbsp;Batal&nbsp;</button>
				                  </div>
                                </div>
				                </div>
				            </form>
                       </div>
			         </div>
				</div>

</div>
<script type="text/javascript">
	$(document).ready(function (){

                      $("#formInventory").on('submit', function(e){
                          e.preventDefault();
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'inventory/inventory_edit_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        //alert('lolos');
                                                        var hsl=data.trim();
                                                        //alert(hsl);
                                                        if (hsl=='y'){
			                                                alert('Data Sudah ada');
			                                                return false;
			                                                exit();
			                                            }else{
			                                                $("#tableinventory").load('inventory/inventory_load.php');
                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalEdit').modal('hide');
			                                            }
                                                      }
                                                });
                      });
    });


  function selecttipe(){
    $("#ModalTipe").modal('show',{backdrop: 'true'});   
  }
  function selectwarna(){  
    $("#ModalWarna").modal('show',{backdrop: 'true'});   
  }
   function selectcustomer(){  
    $("#ModalCustomer").modal('show',{backdrop: 'true'});   
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