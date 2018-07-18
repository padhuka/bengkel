<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
   ?>
<div class="modal-dialog">
			<div class="col-md-8">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Data Asuransi</h4>                        
                    </div>

				          <div class="box box-info">
				            <!--<div class="box-header with-border">
				              <h3 class="box-title">Horizontal Form</h3>
				            </div>
				             /.box-header -->
				            <!-- form start -->
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="fupForm">
				              <div class="box-body">
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label">Id Asuransi</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_asuransi" name="id_asuransi" required>
                          </div>
                        </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nama" name="nama" required>
				                  </div>
				                </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label">Alamat</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                          </div>
                        </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Telp</label>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="no_telp" name="no_telp" required>
				                  </div>
				                </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label">NPWP</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="npwp" name="npwp" required>
                          </div>
                        </div>
                                                		                
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label"></label>
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
</div>
<script type="text/javascript">
	$(document).ready(function (){		

                      $("#fupForm").on('submit', function(e){
                          e.preventDefault();
                          
                            //alert(disposisine)                       ;
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'asuransi/asuransi_add_save.php',
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
			                                            	
			                                                $("#tabele").load('asuransi/asuransi_load.php');
                                                                      $('.modal-body').css('opacity', '');

                                                           // alert('Data Berhasil Disimpan rere');
                                                           //echo "<span class='label label-info'>Your feedback has been submitted with above details!</span>";

                                                            $('#ModalAdd').modal('hide');
			                                            }   
                                                      }
                                                });
                      });
    });
	
					

</script>