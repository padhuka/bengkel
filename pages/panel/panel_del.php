<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id_panel = $_GET['id_panel'];
    $sqlemp = "SELECT * FROM t_panel WHERE id_panel='$id_panel'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_panelden="true">&times;</span></button>
                        <h4 class="modal-title" id_panel="myModalLabel">Hapus Data Panel</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_panel" name="id_panel" value="<?php echo $id_panel;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_panelden="true">&nbsp;Batal&nbsp;</button>
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
                            var id_panel = $('#id_panel').val();
                           $.ajax({
                                url: 'panel/panel_del_save.php?id_panel='+id_panel,
                                type: 'GET',
                                success: function (response){
                                      //alert('panel/panel_del_save.php?id_panel='+id_panel);
                                      $("#tablepanel").load('panel/panel_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 