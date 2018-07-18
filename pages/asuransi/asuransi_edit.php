<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $id_asuransi = $_GET['id_asuransi'];
    $sqlemp = "SELECT * FROM t_asuransi WHERE id_asuransi='$id_asuransi'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
    
  ?>  
    
<div class="modal-dialog">
			<div class="col-md-8">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_asuransiden="true">&times;</span></button>
                        <h4 class="modal-title" id_asuransi="myModalLabel">Edit Data Asuransi</h4>                   
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
                            <input type="text" class="form-control" id="id_asuransi" name="id_asuransi" value="<?php echo $emp['id_asuransi'];?>" required>
                          </div>
                        </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $emp['nama'];?>" required>
				                  </div>
				                </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label">Alamat</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $emp['alamat'];?>" required>
                          </div>
                        </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Telp</label>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="no_telp" name="no_telp"  value="<?php echo $emp['no_telp'];?>" required>
				                  </div>
				                </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label">NPWP</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="npwp" name="npwp" value="<?php echo $emp['npwp'];?>" required>
                          </div>
                        </div>
                        
                        		                
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label"></label>
				                  <div class="col-sm-8">
				                  	<input type="hidden" name="id_asuransihid" id="id_asuransihid" value="<?php echo $emp['id_asuransi'];?>">				                  	
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
</div>
<script type="text/javascript">
	$(document).ready(function (){

                      $("#fupForm").on('submit', function(e){
                          e.preventDefault();
                          
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'asuransi/asuransi_edit_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){                              
                                                        //alert('lolos');
                                                        var hsl=data.trim();
                                                        alert(hsl);
                                                        if (hsl=='y'){
			                                                alert('Data Sudah ada');  
			                                                return false;
			                                                exit();
			                                            }else{
			                                            	
			                                                $("#tabele").load('asuransi/asuransi_load.php');
                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalEdit').modal('hide');
			                                            }   
                                                      }
                                                });
                      });
    });
	
					

</script>