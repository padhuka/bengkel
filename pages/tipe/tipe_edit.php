<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $id_tipe_kendaraan = $_GET['id_tipe_kendaraan'];
    $sqlemp = "SELECT * FROM t_tipe_kendaraan WHERE id_tipe_kendaraan='$id_tipe_kendaraan'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );

    $sqlgrup=mysql_query("SELECT * FROM t_group_kendaraan WHERE id_group_kendaraan='$emp[fk_group_kendaraan]'");
    $hg=mysql_fetch_array($sqlgrup);
    $nmg=$hg['nama'];
  ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_tipe="true">&times;</span></button>
                        <h4 class="modal-title" id_tipe_kendaraan="myModalLabel">Edit Data Tipe</h4>
                    </div>

                     <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formTipe">
                        <div class="form-group">
                          <div class="col-sm-3">
                          <label for="kodetipe">Kode Tipe Kendaraan</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_tipe_kendaraan" name="id_tipe_kendaraan" value="<?php echo $emp['id_tipe_kendaraan'];?>" readonly>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="namatipelabel" >Nama</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $emp['nama'];?>" required>
				                  </div>
				                </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namatipe">Group Kendaraan</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="hidden" class="form-control" id="group" name="group" value="<?php echo $emp['fk_group_kendaraan'];?>" readonly>
                            <input type="text" class="form-control" id="groupnm" name="groupnm"  value="<?php echo $nmg;?>"  readonly>
                          </div>
                        <button type="button" class="btn btn-primary btn-md data-toggle="modal" data-target="#myModal" onclick="groupe();">Pilih</button>
                        </div>
				                <div class="form-group">
                                  <div class="modal-footer">
				                  <div class="col-sm-8">
				                  	<input type="hidden" name="idtipekendaraan" id="idtipekendaraan" value="<?php echo $emp['id_tipe_kendaraan'];?>">
                            <input type="hidden" name="namakendaraan" id="namakendaraan" value="<?php echo $emp['nama'];?>">
				                  	<button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_tipe="true">&nbsp;Batal&nbsp;</button>
				                  </div>
                                </div>
				                </div>
				            </form>
			         </div>
				</div>

</div>

<?php include_once 'tipe_group_tab.php';?>
<script type="text/javascript">
  function groupe(){  
    $("#ModalGroup").modal('show',{backdrop: 'true'});   
  }
	$(document).ready(function (){
                      $("#formTipe").on('submit', function(e){
                          e.preventDefault();
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'tipe/tipe_edit_save.php',
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
			                                                $("#tabletipe").load('tipe/tipe_load.php');
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