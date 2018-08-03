<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id = $_GET['idpkb'];
    $sqlemp = "SELECT * FROM t_pkb WHERE id_pkb='$id'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );

?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Tutup PKB <button type="button" class="close" aria-label="Close" onclick="$('#ModalTutup').modal('hide');"><span>&times;</span></button></h4> 
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menutup PKB ini ( <?php echo $id;?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" onclick="$('#ModalTutup').modal('hide');" >&nbsp;Batal&nbsp;</button>
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
                           $.ajax({
                                url: 'pkbstatus/pkb_tutup_save.php?idpkb=<?php echo $id;?>',
                                type: 'GET',
                                success: function (response){
                                      //alert('panel/panel_del_save.php?id_panel='+id_panel);
                                     $("#tablepkb").load('pkbstatus/pkb_load.php');
                                     $('.modal-body').css('opacity', '');
                                      alert('Data Berhasil Ditutup');
                                      $('#ModalTutup').modal('hide');
                                  }
                            });

                    });
                });
              </script> 