<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $id = $_GET['id'];
    $sqlemp = "SELECT * FROM t_user WHERE id='$id'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
    
  ?>  
    
<div class="modal-dialog">
			<div class="col-md-8">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Data admin</h4>                   
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
				                  <label for="inputEmail3" class="col-sm-4 control-label">Username</label>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $emp['username'];?>" required>
				                  </div>
				                </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label">Password</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="password" name="password" required>
                          </div>
                        </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nama" name="nama"  value="<?php echo $emp['nama'];?>" required>
				                  </div>
				                </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label">Nip</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $emp['nip'];?>" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label">Level</label>
                          <div class="col-sm-8">
                               <select name="level" id="level">
                               		<option value="<?php echo $emp['level'];?>"><?php echo $emp['level'];?></option>  <option value="Admin">Admin</option>
                                    <option value="SuratMasuk">SuratMasuk</option>
                                    <option value="SuratKeluar">SuratKeluar</option>
                                    <option value="SuratKeputusan">SuratKeputusan</option>
                                    <option value="Arsip">Arsip</option>
                                </select> 
                          </div>
                        </div>
                        		                
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label"></label>
				                  <div class="col-sm-8">
				                  	<input type="hidden" name="id" id="id" value="<?php echo $emp['id'];?>">
				                  	<input type="hidden" name="usernamehid" id="usernamehid" value="<?php echo $emp['username'];?>">
				                  	<input type="hidden" name="passwordhid" id="passwordhid" value="<?php echo $emp['password'];?>">
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
                          
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'admin/admin_edit_save.php',
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
			                                            	
			                                                $("#tabele").load('admin/admin_load.php');
                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalEdit').modal('hide');
			                                            }   
                                                      }
                                                });
                      });
    });
	
					

</script>