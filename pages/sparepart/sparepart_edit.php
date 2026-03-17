<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $id = $_GET['id'];
    $sqlemp = "SELECT pp.*, p.nama as nama_part, pk.fk_no_polisi, c.nama as nama_customer
              FROM t_part_pkb pp
              LEFT JOIN t_part p ON pp.id_part = p.id_part
              LEFT JOIN t_pkb pk ON pp.id_pkb = pk.id_pkb
              LEFT JOIN t_customer c ON pk.fk_customer = c.id_customer
              WHERE pp.id='$id'";
    $resemp = mysqli_query($objConn,  $sqlemp );
    $emp = mysqli_fetch_array( $resemp );
  ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Data Sparepart PKB</h4>
                    </div>

                     <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formSparepart">
                        <div class="form-group">
                          <div class="col-sm-3">
                          <label for="id_pkb">No PKB</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_pkb" name="id_pkb" value="<?php echo $emp['id_pkb'];?>" readonly>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="id_part" >Kode Part</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $emp['id_part'];?>" readonly>
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="nama_part">Nama Part</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $emp['nama_part'];?>" readonly>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="harga_beli" >Harga Beli</label>
                        </div>
				                  <div class="col-sm-8">
				                    <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo $emp['harga_beli'];?>" required min="0" step="0.01">
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="harga_jual" >Harga Jual</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?php echo $emp['harga_jual'];?>" required min="0" step="0.01">
                          </div>
                        </div>
				                <div class="form-group">
                                  <div class="modal-footer">
				                  <div class="col-sm-8">
				                  	<input type="hidden" name="id" id="id" value="<?php echo $emp['id'];?>">
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

                      $("#formSparepart").on('submit', function(e){
                          e.preventDefault();
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'sparepart/sparepart_edit_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        var hsl=data.trim();
                                                        if (hsl=='y'){
			                                                alert('Gagal menyimpan data');
			                                                return false;
			                                                exit();
			                                            }else{
			                                                $("#tablesparepartContainer").load('sparepart/sparepart_load.php');
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
