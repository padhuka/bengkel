<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id_tipe_kendaraan = $_GET['id_tipe_kendaraan'];
    $sqlwarna = "SELECT * FROM t_tipe_kendaraan WHERE id_tipe_kendaraan='$id_tipe_kendaraan'";
    $warnaar = mysql_query( $sqlwarna );
    $emp = mysql_fetch_array( $warnaar );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_warna="true">&times;</span></button>
                        <h4 class="modal-title" id_tipe_kendaraan="myModalLabel">Hapus Data Tipe Kendaraan</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_tipe_kendaraan" name="id_tipe_kendaraan" value="<?php echo $id_tipe_kendaraan;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_warna="true">&nbsp;Batal&nbsp;</button>
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
                            var id_tipe_kendaraan = $('#id_tipe_kendaraan').val();
                           $.ajax({
                                url: 'tipe/tipe_del_save.php?id_tipe_kendaraan='+id_tipe_kendaraan,
                                type: 'GET',
                                success: function (response){
                                      //alert('asuransi/asuransi_del_save.php?$id_tipe_kendaraan='+$id_tipe_kendaraan);
                                      $("#tabletipe").load('tipe/tipe_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 