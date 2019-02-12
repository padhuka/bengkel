<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id_warna_kendaraan = $_GET['id_warna_kendaraan'];
    $sqlwarna = "SELECT * FROM t_warna_kendaraan WHERE id_warna_kendaraan='$id_warna_kendaraan'";
    $warnaar = mysql_query( $sqlwarna );
    $emp = mysql_fetch_array( $warnaar );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_warna="true">&times;</span></button>
                        <h4 class="modal-title" id_warna_kendaraan="myModalLabel">Hapus Data warna</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_warna_kendaraan" name="id_warna_kendaraan" value="<?php echo $id_warna_kendaraan;?>">
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
                            var id_warna_kendaraan = $('#id_warna_kendaraan').val();
                           $.ajax({
                                url: 'warna/warna_del_save.php?id_warna_kendaraan='+id_warna_kendaraan,
                                type: 'GET',
                                success: function (response){
                                      //alert('asuransi/asuransi_del_save.php?$id_warna_kendaraan='+$id_warna_kendaraan);
                                      $("#tablewarna").load('warna/warna_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 