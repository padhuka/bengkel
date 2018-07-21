<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id_part = $_GET['id_part'];
    $sqlemp = "SELECT * FROM t_part WHERE id_part='$id_part'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_partden="true">&times;</span></button>
                        <h4 class="modal-title" id_part="myModalLabel">Hapus Data Part</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_part" name="id_part" value="<?php echo $id_part;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_partden="true">&nbsp;Batal&nbsp;</button>
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
                            var id_part = $('#id_part').val();
                           $.ajax({
                                url: 'part/part_del_save.php?id_part='+id_part,
                                type: 'GET',
                                success: function (response){
                                      //alert('panel/panel_del_save.php?id_part='+id_part);
                                      $("#tablepart").load('part/part_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 