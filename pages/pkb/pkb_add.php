<!-- general form elements disabled -->
   <?php
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    //$idestimasi= 'EST_BR.020818.000001';
 //   $sqlpan= "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
<div class="modal-dialog">
           <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Tamba Data PKB <button type="button" class="close" aria-label="Close" onclick="$('#ModalAdd').modal('hide');"><span>&times;</span></button></h4>                    
                    </div>
                    <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formpkb">
                 
                    <div class="modal-body">
                      
                      <div class="modal-title-detail">DATA ESTIMASI</div>
                      <div class="row">
                       <div class="col-sm-6">
                       <table id="estimasishow" class="table table-condensed table-bordered table-striped table-hover">
                       <td>
                         <th class="col-sm-8">
                        <tr> <th>No Estimasi</th> <td ><input type="text" class="form-control" name="idestimasi" id="idestimasi" readonly><button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="estimasie();">Pilih</button></td></tr>
                        <tr> <th>Tgl Masuk</th> <td ><label id="tgl"></label></td></tr>
                        <tr> <th>No Chasis</th>  <td ><label id="chasis"></label></td></tr>
                        <tr> <th>No Mesin</th> <td ><label id="mesin"></label></td></tr>
                        <tr> <th>No Polisi</th>   <td ><label id="polisi"></label></td> </tr>
                        </th>
                       </td>
                      </table>
                           </div>
                            <div class="col-sm-6">
                               <table id="estimasishow" class="table table-condensed table-bordered table-striped table-hover">
                          <td>
                         <th class="col-sm-6">
                        <tr> <th>Kategori </th> <td ><label id="kategori"></label></td></tr>
                        <tr> <th>KM Masuk</th> <td ><label id="kmmasuk"></label></td></tr>
                        <tr> <th>Asuransi</th>  <td ><label id="asuransi"></label></td></tr>
                        <tr> <th>Nama Customer</th> <td ><label id="nama"></label></td></tr>
                        <tr> <th>Telp</th>   <td ><label id="telp"></label></td> </tr>
                        </th>
                       </td>
                               </table>
                         </div>

                      </div>

                       <div class="modal-title-detail">NILAI ESTIMASI </div>
                      <div class="row">
                       <div class="col-sm-12">
                       <table id="estimasishow" class="table table-condensed table-bordered table-striped table-hover">
                       <td >
                         <th class="col-sm-2">
                        <tr> 
                            <th>Nilai Panel</th><td><label id="grosspanel"></label></td> 
                            <th>Disc</th><td ><label id="diskonpanel"></label></td>
                            <th>Total Netto</th> <td><label id="nettopanel"></label></td>
                        </tr>
                        
                        <tr> 
                          <th>Nilai Part</th><td><label id="grosspart"></label></td>
                          <th>Disc</th> <td><label id="diskonpart"></label></td>
                          <th>Total Netto</th> <td><label id="nettopart"></label></td>
                        </tr>
                        <tr class="total"> 
                          <th>Total Gross</th><td><label id="grosstotal"></label></td>
                          <th>Total Diskon</th> <td><label id="diskontotal"></label></td>
                          <th>Total Netto</th> <td><label id="nettototal"></label></td>
                        </tr>

                        </th>
                       </td>
                      </table>
                           </div>
                      </div>
                       
                       <div class="form-group">
                      <div class="modal-footer">
                      <div class="but">
                                    <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" name="close" onclick="$('#ModalAdd').modal('hide');">Close</button>
                     </div>
                     </div>
                     </div>
               </div>
             </form>
           </div>
           </div>      
           <?php include_once 'pkb_estimasi_tab.php';?>
           <div id="ModalPanelShow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
           <div id="ModalPartShow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<script type="text/javascript">
              function estimasie(){ 
                $("#ModalEstimasi").modal({backdrop: 'static',keyboard:false});   
              }
              
            $(document).ready(function (){

                      $("#formpkb").on('submit', function(e){
                          var ides=  $("#idestimasi").val();
                          if (ides==''){
                            alert('Data ada yang belum diisi');
                            return false;
                          }
                          e.preventDefault();
                            //alert(disposisine)                       ;
                                      $.ajax({
                                                  type: 'POST',
                                                  url: 'pkb/pkb_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        $("#tablepkb").load('pkb/pkb_load.php');
                                                        $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalAdd').modal('hide'); 
                                                            //var hsl=data.trim();       
                                                            //alert(hsl);

                                                             
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
  .total {
  font-weight: bold;border-top:   inset;
  }
    .but {
    text-align: center;
  }
  .modal-title-detail {
    font-style: italic;
    background-color: lightblue;
    text-align: center;
    font-weight: bold;
  }
  .modal-dialog {
    margin-bottom: 0px;
    border: 3px;
    width: 800px;
  }
</style>