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
				                  </div><button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="pilihpanele();">Pilih</button>
				                </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargapokokpanel">Harga</label>
                        </div>
                          <div class="col-sm-8">
                         <input type="text" class="form-control" id="hargapokoke" name="hargapokoke" value="<?php echo $hslpan['harga_jual_panel'];?>" required onchange="kaliedit();">
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
                            <input type="text" class="form-control" id="hargatotale" name="hargatotale" value="<?php echo $hslpan['harga_total_estimasi_panel'];?>" required readonly>
                            <input type="hidden" class="form-control" id="hargatotallm" name="hargatotallm" value="<?php echo $hslpan['harga_total_estimasi_panel'];?>" required readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Mark</label>
                          </div>
                          <?php if ($hslpan['mark_panel']==1){$ck='checked';}else{$ck='';}?>
                          <div class="col-sm-3">
                            <label class="checkbox-inline"><input type="checkbox" id="ceke" name="ceke" onclick="cekbe();" <?php echo $ck; ?> >Mark</label>
                            <input type="hidden" class="form-control" id="marke" name="marke" readonly>
                          </div>
                        </div>
				                <div class="form-group">
                           <div class="modal-footer">
				                  <div class="col-sm-8">
                            <input type="hidden" class="form-control" id="ide" name="ide" value="<?php echo $id?>" required>
                            <input type="hidden" class="form-control" id="idestimasie" name="idestimasie" value="<?php echo $idestimasi?>" required>
				                    <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#ModalEditPanel').modal('hide');">&nbsp;Batal&nbsp;</button>
				                  </div>
                        </div>
				                </div>

				            </form>
				          </div>
				</div>
</div>
<?php include_once 'panel_pilih_edit.php';?>
<script type="text/javascript">
  function pilihpanele(){ 
    $("#ModalPilihPanelEdit").modal({backdrop: 'static', keyboard:false});   
    //alert('milih');
  }
  function cekbe(){
    if(ceke.checked==true){$('#marke').val('1');}else{$('#marke').val('0');}
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
			                                                $("#tablepanel").load('estimasi/panel_load.php?idestimasi=<?php echo $idestimasi;?>');
                                                      $("#tableestimasi").load('estimasi/estimasi_load.php');
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