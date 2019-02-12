<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id = $_GET['nobukti'];
    $sqlemp = "SELECT * FROM t_bank WHERE no_bukti='$id'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );

?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Batal Penerimaan Bank <button type="button" class="close" aria-label="Close" onclick="$('#ModalBatal').modal('hide');"><span>&times;</span></button></h4> 
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-12">
                                   <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formbank">
                                        <div class="alert alert-danger">Apakah anda yakin ingin membatalkan Perimaan Bank ( <?php echo $id;?>) ?</div>
                                    <div class="form-group">
                                      <div class="col-sm-4">
                                        <label for="keteranganbatal"> Keterangan Batal</label>
                                      </div>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="keteranganbatal" name="keteranganbatal" required>
                                      </div>
                                    </div>
                                        <div class="row">
                                         <div class="col-sm-12">
                                        
                                        <div>
                                         <div class="modal-footer">

                                             <div class="but">


                                        <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                                        <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                        <button type="button" class="btn btn-primary" onclick="$('#ModalBatal').modal('hide');" >&nbsp;Batal&nbsp;</button>
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <script type="text/javascript">
                  $(document).ready(function (){
                        $(".save_submit").click(function (e){
                           var keteranganbatal = $('#keteranganbatal').val();
                           $.ajax({
                                url: 'bank/bank_del_save.php?no_bukti=<?php echo $id;?>&keteranganbatal='+keteranganbatal,
                                type: 'GET',
                                success: function (response){
                                  //alert($)
                                      //alert('panel/panel_del_save.php?id_panel='+id_panel);
                                     $("#tablebank").load('bank/bank_load.php');
                                     $('.modal-body').css('opacity', '');
                                      alert('Data Berhasil Dibatalkan');
                                      $('#ModalBatal').modal('hide');
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