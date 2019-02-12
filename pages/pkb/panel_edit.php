<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    $idpkb=$_GET['idpkb'];
    $id=$_GET['id'];

    $sqlpan= "SELECT * FROM t_pkb_panel_detail WHERE id='$id'";
    $hslpan= mysql_fetch_array(mysql_query($sqlpan));

    $snm = "SELECT * FROM t_panel WHERE id_panel='$hslpan[fk_panel]'";
    $hnm = mysql_fetch_array(mysql_query($snm));

   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Edit Data Panel <button type="button" class="close" aria-label="Close" onclick="$('#ModalEditPanel').modal('hide');"><span>&times;</span></button></h4> 
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
                            <input type="hidden" class="form-control" id="panele" name="panele" value="<?php echo $hslpan['fk_panel'];?>" required>
				                    <input type="text" class="form-control" id="panelnme" name="panelnme" value="<?php echo $hnm['nama'];?>" readonly required>                            
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargapokokpanel">Harga</label>
                        </div>
                          <div class="col-sm-8">
                         <input type="text" class="form-control" id="hargapokoke" name="hargapokoke" value="<?php echo $hslpan['harga_jual_panel'];?>" required onchange="hargarubah();">
                         <input type="hidden" class="form-control" id="hargapokoklme" name="hargapokoklme" value="<?php echo $hslpan['harga_jual_panel'];?>" readonly required>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="hargajualpanel">Diskon</label>
                        </div>
				                  <div class="col-sm-3">
				                    <input type="text" class="form-control" id="diskone" name="diskone" value="<?php echo $hslpan['diskon_panel'];?>" required onchange="kaliedit();">
                            <input type="hidden" class="form-control" id="hargadiskonlme" name="hargadiskonlme" value="<?php echo $hslpan['harga_diskon_panel'];?>" required readonly>
				                  </div>%
				                </div>
                        
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="ppn">Harga Total</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="hargatotale" name="hargatotale" value="<?php echo $hslpan['harga_total_pkb_panel'];?>" required readonly>
                            <input type="hidden" class="form-control" id="hargatotallm" name="hargatotallm" value="<?php echo $hslpan['harga_total_pkb_panel'];?>" required readonly>
                          </div>
                        </div>
                        
				                <div class="form-group">
                           <div class="modal-footer">
				                  <div class="col-sm-8">
                            <input type="hidden" class="form-control" id="ide" name="ide" value="<?php echo $id?>" required>
                            <input type="hidden" class="form-control" id="idpkbe" name="idpkbe" value="<?php echo $idpkb?>" required>
				                    <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#ModalEditPanel').modal('hide');">&nbsp;Batal&nbsp;</button>
				                  </div>
                        </div>
				                </div>

				            </form>
				          </div>
				</div>
</div>
<script type="text/javascript">
  
  
  function kaliedit(){
    
    var hasile= $("#hargapokoke").val()-($("#diskone").val()*$("#hargapokoke").val()/100);
    $("#hargatotale").val(hasile);
  }

 function hargarubah(){
    
    var hasile= $("#hargapokoke").val()-($("#diskone").val()*$("#hargapokoke").val()/100);
    $("#hargatotale").val(hasile);
  }

	$(document).ready(function (){

                      $("#formPanelEdit").on('submit', function(e){
                          e.preventDefault();
                            //alert(disposisine)                       ;
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'pkb/panel_edit_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){  
                                                      //var hsl = data.trim();
                                                      //alert(hsl);
			                                                $("#pkbpanel").load('pkb/panel_load.php?idpkb=<?php echo $idpkb;?>');
                                                      $('.modal-body').css('opacity', '');

                                                      alert('Data Berhasil Disimpan');
                                                      $('#ModalEditPanel').modal('hide');
                                                      //$("#tablepkbdetail").load('pkb/pkb_detail_tab.php?idpkb=<?php echo $idpkb;?>');
                                                      $("#loaddetail").load('pkb/pkb_edit_detail_load.php?idpkb=<?php echo $idpkb;?>');
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