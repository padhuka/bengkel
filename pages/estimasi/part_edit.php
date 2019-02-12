<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    $idestimasi=$_GET['idestimasi'];
    $id=$_GET['id'];

    $sqlpan= "SELECT * FROM t_estimasi_part_detail WHERE id='$id'";
    $hslpan= mysql_fetch_array(mysql_query($sqlpan));

    $snm = "SELECT * FROM t_part WHERE id_part='$hslpan[fk_part]'";
    $hnm = mysql_fetch_array(mysql_query($snm));

   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Edit Data part <button type="button" class="close" aria-label="Close" onclick="$('#ModalEditPart').modal('hide');"><span>&times;</span></button></h4> 
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
                            <input type="hidden" class="form-control" id="parte" name="parte" value="<?php echo $hslpan['fk_part'];?>" required>
                            <input type="text" class="form-control" id="partnme" name="partnme" value="<?php echo $hnm['nama'];?>" readonly required>                            
                          </div><button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="pilihpartep();">Pilih</button>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargapokokpart">Harga</label>
                        </div>
                          <div class="col-sm-8">
                         <input type="text" class="form-control" id="hargapokokep" name="hargapokokep" value="<?php echo $hslpan['harga_jual_part'];?>" required onchange="kaliep();">
                         <input type="hidden" class="form-control" id="hargapokoklmep" name="hargapokoklmep" value="<?php echo $hslpan['harga_jual_part'];?>" readonly required>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargajualpart">Diskon</label>
                        </div>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="diskonep" name="diskonep" value="<?php echo $hslpan['diskon_part'];?>" required onchange="kaliep();">
                            <input type="hidden" class="form-control" id="hargadiskonlmep" name="hargadiskonlmep" value="<?php echo $hslpan['harga_diskon_part'];?>" required readonly>
                          </div>%
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="hargajualpart">Qty</label>
                        </div>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="qtye" name="qtye" required value="<?php echo $hslpan['qty_part'];?>" onchange="kaliep();">
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                          <label for="ppn">Harga Total</label>
                        </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="hargatotalep" name="hargatotalep" value="<?php echo $hslpan['harga_total_estimasi_part'];?>" required readonly>
                            <input type="hidden" class="form-control" id="hargatotallmp" name="hargatotallmp" value="<?php echo $hslpan['harga_total_estimasi_part'];?>" required readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Mark</label>
                          </div>
                          <?php if ($hslpan['mark_part']==1){$ck='checked';}else{$ck='';}?>
                          <div class="col-sm-3">
                            <label class="checkbox-inline"><input type="checkbox" id="cekep" name="cekep" onclick="cekbep();" <?php echo $ck; ?> >Mark</label>
                            <input type="hidden" class="form-control" id="markep" name="markep" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                           <div class="modal-footer">
                          <div class="col-sm-8">
                            <input type="hidden" class="form-control" id="idep" name="idep" value="<?php echo $id?>" required>
                            <input type="hidden" class="form-control" id="idestimasiep" name="idestimasiep" value="<?php echo $idestimasi?>" required>
                            <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#ModalEditPart').modal('hide');">&nbsp;Batal&nbsp;</button>
                          </div>
                        </div>
                        </div>

                    </form>
                  </div>
        </div>
</div>
<?php include_once 'part_pilih_edit.php';?>
<script type="text/javascript">
  function pilihpartep(){ 
    $("#ModalPilihPartEdit").modal({backdrop: 'static', keyboard:false});   
    //alert('milih');
  }
   function cekbep(){
    if(cekep.checked==true){$('#markep').val('1');}else{$('#markep').val('0');}
  }
  function kaliep(){
     var hasil= ($("#hargapokokep").val()-($("#diskonep").val()*$("#hargapokokep").val()/100))*$("#qtye").val();
    $("#hargatotalep").val(hasil);
  }
  $(document).ready(function (){

                      $("#formpartEdit").on('submit', function(e){
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
                                                      //var hsl = data.trim();
                                                      //alert(hsl);
                                                      $("#estimasipart").load('estimasi/part_load.php?idestimasi=<?php echo $idestimasi;?>');
                                                      $("#tableestimasi").load('estimasi/estimasi_load.php');
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