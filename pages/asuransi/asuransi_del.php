<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id_asuransi = $_GET['id_asuransi'];
    $sqlemp = "SELECT * FROM t_asuransi WHERE id_asuransi='$id_asuransi'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_asuransiden="true">&times;</span></button>
                        <h4 class="modal-title" id_asuransi="myModalLabel">Hapus Data Asuransi</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_asuransi" name="id_asuransi" value="<?php echo $id_asuransi;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_asuransiden="true">&nbsp;Batal&nbsp;</button>
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
                            var id_asuransi = $('#id_asuransi').val();
                           $.ajax({
                                url: 'asuransi/asuransi_del_save.php?id_asuransi='+id_asuransi,
                                type: 'GET',
                                success: function (response){
                                      //alert('asuransi/asuransi_del_save.php?id_asuransi='+id_asuransi);
                                      $("#tabele").load('asuransi/asuransi_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 