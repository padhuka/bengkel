<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $id_supplier = $_GET['id_supplier'];
    $sqlemp = "SELECT * FROM t_supplier WHERE id_supplier='$id_supplier'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
  ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_asuransiden="true">&times;</span></button>
                        <h4 class="modal-title" id_supplier="myModalLabel">Edit Data Supplier</h4>
                    </div>

                     <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formSupplier">
                        <div class="form-group">
                          <div class="col-sm-3">
                          <label for="kodesuplier">Kode Supplier</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_supplier" name="id_supplier" value="<?php echo $emp['id_supplier'];?>" readonly>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="namasupplier" >Nama</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $emp['nama'];?>" required>
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="alamatsupplier">Alamat</label>
                        </div>
                          <div class="col-sm-8">
                            <textarea input type="text" class="form-control" id="alamat" name="alamat" required> <?php echo $emp['alamat'];?></textarea>
                          
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="telpsupplier" >Telp</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="no_telp" name="no_telp"  value="<?php echo $emp['no_telp'];?>" required>
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="npwpsupplier" >NPWP</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="npwp" name="npwp" value="<?php echo $emp['npwp'];?>" required>
                          </div>
                        </div>
				                <div class="form-group">
                                  <div class="modal-footer">
				                  <div class="col-sm-8">
				                  	<input type="hidden" name="id_asuransihid" id="id_asuransihid" value="<?php echo $emp['id_supplier'];?>">
                            <input type="hidden" name="namahid" id="namahid" value="<?php echo $emp['nama'];?>">
				                  	<button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_asuransiden="true">&nbsp;Batal&nbsp;</button>
				                  </div>
                                </div>
				                </div>
				            </form>
			         </div>
				</div>

</div>
<script type="text/javascript">
	$(document).ready(function (){

                      $("#formSupplier").on('submit', function(e){
                          e.preventDefault();
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'supplier/supplier_edit_save.php',
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
			                                                $("#tablesupplier").load('supplier/supplier_load.php');
                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalEdit').modal('hide');
			                                            }
                                                      }
                                                });
                      });
    });
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