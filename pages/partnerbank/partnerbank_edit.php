<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $id_partner_bank = $_GET['id_partner_bank'];
    $sqlemp = "SELECT * FROM t_partner_bank WHERE id_partner_bank='$id_partner_bank'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
  ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_partner_bank="true">&times;</span></button>
                        <h4 class="modal-title" id_partner_bank="myModalLabel">Edit Data partnerbank</h4>
                    </div>

                     <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formPartnerBank">
                        <div class="form-group">
                          <div class="col-sm-3">
                          <label for="kodepartnerbank">Kode Partner Bank</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_partner_bank" name="id_partner_bank" value="<?php echo $emp['id_partner_bank'];?>" readonly>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="nama" >Nama</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $emp['nama'];?>" required>
				                  </div>
				                </div>
                         <div class="form-group">
                            <div class="col-sm-3">
                          <label for="nama" >No Telp</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="notelp" name="notelp" value="<?php echo $emp['no_telp'];?>" required>
                          </div>
                        </div>
                        
                          <div class="form-group">
                            <div class="col-sm-3">
                          <label for="alamat" >Alamat</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $emp['alamat'];?>" required>
                          </div>
                        </div>

				                <div class="form-group">
                                  <div class="modal-footer">
				                  <div class="col-sm-8">
				                  	<input type="hidden" name="idpartnerbank" id="idpartnerbank" value="<?php echo $emp['id_partner_bank'];?>">
                            <input type="hidden" name="namapartnerbank" id="namapartnerbank" value="<?php echo $emp['nama'];?>">
				                  	<button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_partner_bank="true">&nbsp;Batal&nbsp;</button>
				                  </div>
                                </div>
				                </div>
				            </form>
			         </div>
				</div>

</div>
<script type="text/javascript">
	$(document).ready(function (){
                      $("#formPartnerBank").on('submit', function(e){
                          e.preventDefault();
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'partnerbank/partnerbank_edit_save.php',
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
			                                                $("#tablepartnerbank").load('partnerbank/partnerbank_load.php');
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