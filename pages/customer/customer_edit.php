<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $id_customer = $_GET['id_customer'];
    $sqlemp = "SELECT * FROM t_customer WHERE id_customer='$id_customer'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
  ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_customer="true">&times;</span></button>
                        <h4 class="modal-title" id_customer="myModalLabel">Edit Data Customer</h4>
                    </div>

                     <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formCustomer">
                        <div class="form-group">
                          <div class="col-sm-3">
                          <label for="namacustomer">Nama Customer</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="namacustomer" name="namacustomer" value="<?php echo $emp['nama'];?>" >
                          </div>
                        </div>
                          <div class="form-group">
                           <div class="col-sm-3">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                          </div>
                          <div class="col-sm-8">
                         <label class="radio-inline">
                              <input type="radio" name="jeniskelamin" checked="checked" value="L">Laki-Laki
                            </label>
                            <label class="radio-inline">
                              <input type="radio"  name="jeniskelamin" value="P">Perempuan
                            </label>
                             </div>
                        </div>
				               
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="alamatcustomer">Alamat</label>
                        </div>
                          <div class="col-sm-8">
                            <textarea input type="text" class="form-control" id="alamat" name="alamat" required> <?php echo $emp['alamat'];?></textarea>                         
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="noktp" >No KTP</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="no_ktp" name="no_ktp"  value="<?php echo $emp['no_ktp'];?>" required>
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="notelp" >No TELP</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $emp['no_telp'];?>" required>
                          </div>
                        </div>
                            <div class="form-group">
                            <div class="col-sm-3">
                          <label for="emailcustomer">Email</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $emp['email'];?>" required>
                          </div>
                        </div>
				                <div class="form-group">
                                  <div class="modal-footer">
				                  <div class="col-sm-8">
				                  	<input type="hidden" name="id_customerhid" id="id_customerhid" value="<?php echo $emp['id_customer'];?>">
                            <input type="hidden" name="namacustomerhid" id="namacustomerhid" value="<?php echo $emp['nama'];?>">
				                  	<button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_customer="true">&nbsp;Batal&nbsp;</button>
				                  </div>
                                </div>
				                </div>
				            </form>
			         </div>
				</div>

</div>
<script type="text/javascript">
	$(document).ready(function (){

                      $("#formCustomer").on('submit', function(e){
                          e.preventDefault();
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'customer/customer_edit_save.php',
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
			                                                $("#tablecustomer").load('customer/customer_load.php');
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