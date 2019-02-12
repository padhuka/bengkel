<!-- general form elements disabled -->
   <?php

    include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $idestimasi= $_GET['idestimasi'];
    $sqlpan= "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi'";
    $catat= mysql_fetch_array(mysql_query($sqlpan));

    $sqlcatat = "SELECT * FROM t_inventory_bengkel A, t_warna_kendaraan B  WHERE A.no_chasis='$catat[fk_no_chasis]' AND A.fk_warna_kendaraan=B.id_warna_kendaraan";  
    
    $swrn= mysql_fetch_array(mysql_query($sqlcatat));
    $wrne=$swrn['nama'];
    $kdwrne=$swrn['fk_warna_kendaraan'];

    $sas = "SELECT * FROM t_asuransi WHERE id_asuransi='$catat[fk_asuransi]'";
    $has= mysql_fetch_array(mysql_query($sas));
    $nmas=$has['nama'];
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"> 

                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Edit Data Estimasi <button type="button" class="close" aria-label="Close" onclick="$('#ModalEdit').modal('hide');"><span>&times;</span></button></h4>
                    </div>
                    <!--<div class="box-header with-border">
                      <h3 class="box-title">Horizontal Form</h3>
                    </div>
                     /.box-header -->
                    <!-- form start -->
                    <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formestimasie">
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="kodeestimasi">Tgl Masuk</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo date('d-m-Y' , strtotime($catat['tgl']));?>" readonly>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Chasis</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="chasise" name="chasise" readonly value="<?php echo $catat['fk_no_chasis'];?>">
                          </div>
                          <button type="button" class="btn btn-primary btn-md data-toggle="modal" data-target="#myModal" onclick="editChasis();">Pilih</button>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Mesin</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="mesine" name="mesine" readonly value="<?php echo $catat['fk_no_mesin'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">No Polisi</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="polisie" name="polisie" readonly value="<?php echo $catat['fk_no_polisi'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Warna</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="hidden" class="form-control" id="warnae" name="warnae" readonly value="<?php echo $wrne;?>">
                            <input type="text" class="form-control" id="warnanme" name="warnanme" readonly value="<?php echo $kdwrne;?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Kategori</label>
                          </div>
                            <div class="col-sm-8">
                                <select id="kategorie" name="kategorie" onchange="selectKategorie();">
                                  <option value="<?php echo $catat['kategori'];?>"><?php echo $catat['kategori'];?></option>
                                  <option value="Pribadi">Pribadi</option>
                                  <option value="Asuransi">Asuransi</option>
                                </select>      
                                <button type="button" class="btn btn-primary btn-md data-toggle="modal" data-target="#myModal" onclick="selectAsuransie();" id="buttonAsuransie">Pilih Asuransi</button>
                                                         
                              </div>
                        </div>
                        <div class="form-group" id="showAsuransie">
                          <div class="col-sm-3">
                            <label for="namaestimasi">Nama Asuransi</label>
                          </div>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="asuransie" name="asuransie" value="<?php echo $catat['fk_asuransi'];?>"> 
                                <input type="text" class="form-control" id="asuransinme" name="asuransinme" readonly value="<?php echo $nmas;?>"> 
                              </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="namaestimasi">KM Masuk</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="kmmasuke" name="kmmasuke" required value="<?php echo $catat['km_masuk'];?>">
                          </div>
                        </div> 
                        
                          <input type="hidden" class="form-control" id="idestimasie" name="idestimasie" value="<?php echo $idestimasi;?>" readonly>
                          <input type="hidden" class="form-control" id="unamee" name="unamee" value="<?php echo $sesuname;?>" readonly>
                          <input type="hidden" class="form-control" id="customere" name="customere" readonly value="<?php echo $catat['fk_customer'];?>">                        
                        <div class="form-group">
                           <div class="modal-footer">
                          <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                   <button type="button" class="btn btn-primary" onclick="$('#ModalEdit').modal('hide');">&nbsp;Batal&nbsp;</button>
                          </div>
                        </div>
                        </div>

                    </form>
                      <!--<table width="100%" border="1">
                        <tr>
                          <td>Panel</td>
                          <td>Part</td>
                        </tr>
                        <tr>
                          <td><div id="tablepanel"></div></td>
                          <td><div id="tablepart"></div></td>
                        </tr>
                      </table>
                  </div>-->
        </div>
</div>
<?php include_once 'estimasi_chasis_edit_tab.php';?>
<?php include_once 'estimasi_asuransi_edit_tab.php';?>
<script type="text/javascript">
  selectKategorie();

  function selectKategorie(){
    var infor = $('#kategorie').val();
    if (infor=='Asuransi') {
      $('#buttonAsuransie').show();$('#showAsuransie').show();
    }

    if (infor=='Pribadi'){
      $('#buttonAsuransie').hide();$('#showAsuransie').hide();$('#asuransie').val('');$('#asuransinme').val('');
    }
    
    //onclick="$('#buttonAsuransie').hide();$('#showAsuransie').hide();"
  }

            /*$(document).ready(function (){
                 $("#tablepanel").load('estimasi/panel_load.php');
                 $("#tablepart").load('estimasi/part_load.php');
            });*/
  function selectAsuransie(){ 
    $("#ModalAsuransiEdit").modal('show',{backdrop: 'static',keyboard:false});   
  }
  function editChasis(){ 
    $("#ModalChasisEdit").modal({backdrop: 'static',keyboard:false});   
  }
  $(document).ready(function (){

                      $("#formestimasie").on('submit', function(e){
                          var chs= $("#chasise").val();
                          var km=  $("#kmmasuke").val();
                          if (chs==''){
                            alert('Data ada yang belum diisi');
                            return false;
                          }
                          e.preventDefault();
                            //alert(disposisine)                       ;
                                      $.ajax({
                                                  type: 'POST',
                                                  url: 'estimasi/estimasi_edit_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        $("#tableestimasi").load('estimasi/estimasi_load.php');
                                                        $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalEdit').modal('hide'); 
                                                            var hsl=data.trim();       

                                                             $.ajax({
                                                                url: "estimasi/estimasi_detail.php?idestimasi="+hsl,
                                                                type: "GET",
                                                                  success: function (ajaxData){
                                                                    $("#ModalEstimasiDet").html(ajaxData);
                                                                    $("#ModalEstimasiDet").modal({backdrop: 'static', keyboard:false});
                                                                  }
                                                                }); 

                                                  }
                                                      
                                                });

                                      
              
                      });
    });

</script>

<style type="text/css">
  .modal-open .modal {
    overflow-y: hidden;
  }
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