<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    $idestimasi=$_GET['idestimasi'];
    $id=$_GET['id'];

    $sqlpan= "SELECT * FROM t_estimasi_panel_detail WHERE id='$id'";
    $hslpan= mysql_fetch_array(mysql_query($sqlpan));

    $snm = "SELECT * FROM t_panel WHERE id_panel='$hslpan[fk_panel]'";
    $hnm = mysql_fetch_array(mysql_query($snm));

   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Estimasi Panel</h4>
                    </div>
				            <!--<div class="box-header with-border">
				              <h3 class="box-title">Horizontal Form</h3>
				            </div>
				             /.box-header -->
				            <!-- form start -->
                    <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formPanelEdit">
                       
				                <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namapanel">Nama</label>
                          </div>
				                  <div class="col-sm-6">
                            <input type="text" class="form-control" id="panel" name="panel" value="<?php echo $hslpan['id'];?>" required>
				                    <input type="text" class="form-control" id="panelnm" name="panelnm" value="<?php echo $hnm['nama'];?>" readonly required>
                            <button type="button" class="btn btn-primary btn-md data-toggle="modal" data-target="#myModal" onclick="pilihpanel();">Pilih</button>
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargapokokpanel">Harga</label>
                        </div>
                          <div class="col-sm-8">
                         <input type="text" class="form-control" id="hargapokoke" name="hargapokoke" value="<?php echo $hslpan['harga_jual_panel'];?>" readonly required>
                         <input type="text" class="form-control" id="hargapokoklm" name="hargapokoklm" value="<?php echo $hslpan['harga_jual_panel'];?>" readonly required>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="hargajualpanel">Diskon</label>
                        </div>
				                  <div class="col-sm-3">
				                    <input type="text" class="form-control" id="diskone" name="diskone" value="<?php echo $hslpan['diskon_panel'];?>" required onchange="kaliedit();">%
                            <input type="text" class="form-control" id="hargadiskonlm" name="hargadiskonlm" value="<?php echo $hslpan['harga_diskon_panel'];?>" required readonly>
				                  </div>
				                </div>
                        
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="ppn">Harga Total</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="hargatotale" name="hargatotale" value="<?php echo $hslpan['harga_total_estimasi_panel'];?>" required readonly>
                            <input type="text" class="form-control" id="hargatotallm" name="hargatotallm" value="<?php echo $hslpan['harga_total_estimasi_panel'];?>" required readonly>
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
<?php include_once 'panel_pilih.php';?>
<script type="text/javascript">
  function pilihpanel(){ 
    $("#ModalPilihPanel").modal('show',{backdrop: 'true'});   
  }
  function kaliedit(){
    
    var hasile= $("#hargapokoke").val()-($("#diskone").val()*$("#hargapokoke").val()/100);
    //alert($("#diskone").val());
    $("#hargatotale").val(hasile);
    //alert(hasil);
  }
	$(document).ready(function (){

                      $("#formPanelEdit").on('submit', function(e){
                          e.preventDefault();
                            //alert(disposisine)                       ;
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'estimasi/panel_edit_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){  
                                                      //var hsl = data.trim();
                                                      //alert(hsl);
			                                                $("#estimasipanel").load('estimasi/panel_load.php?idestimasi=<?php echo $idestimasi;?>');
                                                      $('.modal-body').css('opacity', '');

                                                      alert('Data Berhasil Disimpan');
                                                      $('#ModalEditPanel').modal('hide');
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