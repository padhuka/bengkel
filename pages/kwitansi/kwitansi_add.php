<!-- general form elements disabled -->
   <?php
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
 
   ?>
<div class="modal-dialog">
           <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Tambah Kwitansi <button type="button" class="close" aria-label="Close" onclick="$('#ModalAdd').modal('hide');"><span>&times;</span></button></h4>                    
                    </div>
                    <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formkwitansi">
                 
                    <div class="modal-body">
                      
                      <div class="modal-title-detail">DATA PKB</div>
                      <div class="row">
                       <div class="col-sm-6">
                       <table id="pkbshow" class="table table-condensed table-bordered table-striped table-hover">
                       <td>
                         <th class="col-sm-8">
                        <tr> <th>No PKB</th> <td><input type="text" class="form-control" name="idpkb" id="idpkb" readonly> <button type="button" class="btn btn-primary btn-md data-toggle="modal" data-target="#myModal" onclick="kwitansi();">Pilih</button></td></tr>
                        <tr> <th>No Chasis</th>  <td ><input type="text" class="form-control" name="chasis" id="chasis" readonly></td></tr>
                        <tr> <th>No Mesin</th> <td ><input type="text" class="form-control" name="mesin" id="mesin" readonly></td></tr>
                        
                        </th>
                       </td>
                       </table>
                           </div>
                            <div class="col-sm-6">
                               <table id="pkbshow" class="table table-condensed table-bordered table-striped table-hover">
                          <td>
                         <th class="col-sm-6">

                        <tr> <th>Kategori </th> <td><input type="text" class="form-control" name="kategori" id="kategori" readonly></td></tr>
                        <tr> <th>Asuransi</th>  <td ><input type="text" class="form-control" name="asuransi" id="asuransi" readonly></td></tr>
                        <tr> <th>Nama Customer</th> <td ><input type="text" class="form-control" name="nama" id="nama" readonly></td></tr>
                        </th>
                       </td>
                               </table>
                         </div>

                      </div>

                       <div class="modal-title-detail">NILAI PKB</div>
                      <div class="row">
                       <div class="col-sm-12">
                       <table id="kwitansiform" class="table table-condensed table-bordered table-striped table-hover">
                       <td >
                         <th class="col-sm-2">
                        <tr> 
                            <th>Nilai Panel</th><td><input type="text" class="form-control" name="grosspanel" id="grosspanel" readonly></td> 
                            <th>Disc Panel</th><td ><input type="text" class="form-control" name="diskonpanel" id="diskonpanel" readonly></td>
                            <th>Total Netto</th> <td><input type="text" class="form-control" name="nettopanel" id="nettopanel" readonly></td>
                        </tr>
                        
                        <tr> 
                          <th>Nilai Part</th><td><input type="text" class="form-control" name="grosspart" id="grosspart" readonly></td>
                          <th>Disc Part</th> <td><input type="text" class="form-control" name="diskonpart" id="diskonpart" readonly></td>
                          <th>Total Netto</th> <td><input type="text" class="form-control" name="nettopart" id="nettopart" readonly></td>
                        </tr>
                        <tr class="total"> 
                          <th>Total Gross</th><td><input type="text" class="form-control" name="grosstotal" id="grosstotal" readonly></td>
                          <th>Total Diskon</th> <td><input type="text" class="form-control" name="diskontotal" id="diskontotal" readonly></td>
                          <th>Total Netto</th> <td><input type="text" class="form-control" name="nettototal" id="nettototal" readonly></td>
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
           <?php include_once 'kwitansi_pkb_tab.php';

           // echo $kategori;
           ?>

            <script type="text/javascript">
              function kwitansi(){ 
                $("#ModalPkb").modal({backdrop: 'static',keyboard:false});   
              }
              
            $(document).ready(function (){

                      $("#formkwitansi").on('submit', function(e){
                          var ides=  $("#idpkb").val();
                          if (ides==''){
                            alert('Data ada yang belum diisi');
                            return false;
                          }
                          e.preventDefault();
                                      $.ajax({
                                                  type: 'POST',
                                                  url: 'kwitansi/kwitansi_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        alert(data);
                                                        $("#kwitansi").load('kwitansi/kwitansi_load.php');
                                                        $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalAdd').modal('hide'); 
                                                            var hsl=data.trim();       
                                                           // alert(hsl);

                                                             
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