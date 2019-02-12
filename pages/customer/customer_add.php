<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Data Customer</h4>
                    </div>
				            <!--<div class="box-header with-border">
				              <h3 class="box-title">Horizontal Form</h3>
				            </div>
				             /.box-header -->
				            <!-- form start -->
                    <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formCustomer">
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namacustomer">Nama Customer</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="namacustomer" name="namacustomer" required>
                          </div>
                        </div>
				                <div class="form-group">
                           <div class="col-sm-3">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                          </div>
                          <div class="col-sm-8">
                         <label class="radio-inline">
                              <input type="radio" name="jeniskelamin" value="L" checked="checked">Laki-Laki
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
                            <textarea type="text" class="form-control" id="alamat" name="alamat" required></textarea>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="telpcustomer">No KTP</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" required>
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="npwpcustomer">No Telepon</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                          </div>
                        </div>
                         <div class="form-group">
                            <div class="col-sm-3">
                          <label for="emailcustomer">Email</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" name="email" required>
                          </div>
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
<script type="text/javascript">
	$(document).ready(function (){

                      $("#formCustomer").on('submit', function(e){
                          e.preventDefault();
                            //alert(disposisine)                       ;
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'customer/customer_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
			                                                $("#tablecustomer").load('customer/customer_load.php');
                                                                      $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalAdd').modal('hide');
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
   .title-header {
    font-size: 20px;
    text-align: center;
    font-weight: bold;
    font-family: monospace;
  }
</style>