<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    $idpkb=$_GET['idpkb'];
    $id=$_GET['id'];

    $sqlpan= "SELECT * FROM t_pkb_part_detail WHERE id='$id'";
    $hslpan= mysql_fetch_array(mysql_query($sqlpan));

    $snm = "SELECT * FROM t_part WHERE id_part='$hslpan[fk_part]'";
    $hnm = mysql_fetch_array(mysql_query($snm));

   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Edit Data Part <button type="button" class="close" aria-label="Close" onclick="$('#ModalEditPart').modal('hide');"><span>&times;</span></button></h4> 
                    </div>
				            <!--<div class="box-header with-border">
				              <h3 class="box-title">Horizontal Form</h3>
				            </div>
				             /.box-header -->
				            <!-- form start -->
                    <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formpartEdit">
                       
				                <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namapart">Nama</label>
                          </div>
				                  <div class="col-sm-6">
                            <input type="hidden" class="form-control" id="partep" name="partep" value="<?php echo $hslpan['fk_part'];?>" required>
				                    <input type="text" class="form-control" id="partnmep" name="partnmep" value="<?php echo $hnm['nama'];?>" readonly required>                            
				                  </div>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargapokokpart">Harga</label>
                        </div>
                          <div class="col-sm-8">
                         <input type="text" class="form-control" id="hargapokokep" name="hargapokokep" value="<?php echo $hslpan['harga_jual_part'];?>" required>
                         <input type="hidden" class="form-control" id="hargapokoklmep" name="hargapokoklmep" value="<?php echo $hslpan['harga_jual_part'];?>" readonly required>
                          </div>
                        </div>
				                <div class="form-group">
                            <div class="col-sm-3">
				                  <label for="hargajualpart">Diskon</label>
                        </div>
				                  <div class="col-sm-3">
				                    <input type="text" class="form-control" id="diskonep" name="diskonep" value="<?php echo $hslpan['diskon_part'];?>" required onchange="kaliedite();">
                            <input type="hidden" class="form-control" id="hargadiskonlmep" name="hargadiskonlmep" value="<?php echo $hslpan['harga_diskon_part'];?>" required readonly>
				                  </div>%
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargajualpart">Qty</label>
                        </div>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="qty" name="qty" value="<?php echo $hslpan['qty_part'];?>" required onchange="kaliedite();">
                            <input type="hidden" class="form-control" id="qtylm" name="qtylm" value="<?php echo $hslpan['qty_part'];?>" required readonly>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="ppn">Harga Total</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="hargatotalep" name="hargatotalep" value="<?php echo $hslpan['harga_total_pkb_part'];?>" required readonly>
                            <input type="hidden" class="form-control" id="hargatotallmep" name="hargatotallmep" value="<?php echo $hslpan['harga_total_pkb_part'];?>" required readonly>
                          </div>
                        </div>
                        
				                <div class="form-group">
                           <div class="modal-footer">
				                  <div class="col-sm-8">
                            <input type="hidden" class="form-control" id="idep" name="idep" value="<?php echo $id?>" required>
                            <input type="hidden" class="form-control" id="idpkbep" name="idpkbep" value="<?php echo $idpkb?>" required>
				                    <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#ModalEditPart').modal('hide');">&nbsp;Batal&nbsp;</button>
				                  </div>
                        </div>
				                </div>

				            </form>
				          </div>
				</div>
</div>
<script type="text/javascript">
 
  function kaliedite(){
    
    var hasile= ($("#hargapokokep").val()-($("#diskonep").val()*$("#hargapokokep").val()/100))*$("#qty").val();
    //alert($("#diskone").val());
    $("#hargatotalep").val(hasile);
    //alert(hasil);
  }
	$(document).ready(function (){

                      $("#formpartEdit").on('submit', function(e){
                          e.preventDefault();
                            //alert(disposisine)                       ;
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'pkb/part_edit_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){  
                                                      var hsl = data.trim();
                                                      alert(hsl);
			                                                $("#pkbpart").load('pkb/part_load.php?idpkb=<?php echo $idpkb;?>');
                                                      $('.modal-body').css('opacity', '');

                                                      alert('Data Berhasil Disimpan');
                                                      $('#ModalEditPart').modal('hide');
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