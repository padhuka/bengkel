<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    $idestimasi=$_GET['idestimasi'];
    $id=$_GET['id'];

    $sqlpan= "SELECT * FROM t_estimasi_part_detail WHERE id='id'";
    $hslpan= mysql_fetch_array(mysql_query($sqlpan));

    $snm = "SELECT * FROM t_part WHERE id_part='$id'";
    $hnm = mysql_fetch_array(mysql_query($snm));
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Estimasi Part</h4>
                    </div>
				            <!--<div class="box-header with-border">
				              <h3 class="box-title">Horizontal Form</h3>
				            </div>
				             /.box-header -->
				            <!-- form start -->
                    <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formpart">
                       
				                <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namapart">Nama</label>
                          </div>
				                  <div class="col-sm-6">
                            <input type="text" class="form-control" id="part" name="part" value="<?php echo $hslpan['id'];?>" required>
				                    <input type="text" class="form-control" id="partnm" name="partnm" value="<?php echo $hnm['nama'];?>" readonly required>
                            <button type="button" class="btn btn-primary btn-md data-toggle="modal" data-target="#myModal" onclick="pilihpart();">Pilih</button>
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargapokokpart">Harga</label>
                        </div>
                          <div class="col-sm-8">
                         <input type="text" class="form-control" id="hargapokok" name="hargapokok" value="<?php echo $hslpan['harga_jual_part'];?>" readonly required>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="hargajualpart">Diskon</label>
                        </div>
				                  <div class="col-sm-3">
				                    <input type="text" class="form-control" id="diskon" name="diskon" value="<?php echo $hslpan['diskon_part'];?>" required onchange="kali();">%
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="ppn">Qty</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="qty" name="qty" value="<?php echo $hslpan['qty_part'];?>" required readonly>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="ppn">Harga Total</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="hargatotal" name="hargatotal" value="<?php echo $hslpan['harga_total_estimasi_part'];?>" required readonly>
                          </div>
                        </div>
				                <div class="form-group">
                           <div class="modal-footer">
				                  <div class="col-sm-8">
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $id?>" required>
                            <input type="text" class="form-control" id="idestimasi" name="idestimasi" value="<?php echo $idestimasi?>" required>
				                    <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">&nbsp;Batal&nbsp;</button>
				                  </div>
                        </div>
				                </div>

				            </form>
				          </div>
				</div>
</div>
<?php include_once 'part_pilih.php';?>
<script type="text/javascript">
  function pilihpart(){ 
    $("#ModalPilihpart").modal('show',{backdrop: 'true'});   
  }
  function kali(){
    var hasil= ($("#hargapokok").val()-($("#diskon").val()*$("#hargapokok").val()/100))*$("#qty").val();
    $("#hargatotal").val(hasil);
    //alert(hasil);
  }
	$(document).ready(function (){

                      $("#formpart").on('submit', function(e){
                          e.preventDefault();
                            //alert(disposisine)                       ;
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'estimasi/part_edit_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){  
			                                                $("#estimasipart").load('estimasi/part_load.php?idestimasi=<?php echo $idestimasi;?>');
                                                                      $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalEditPart').modal('hide');
                                                            $("#tableestimasidetail").load('estimasi/estimasi_detail_tab.php?idestimasi=<?php echo $idestimasi;?>');
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