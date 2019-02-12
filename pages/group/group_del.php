<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id_group_kendaraan = $_GET['id_group_kendaraan'];
    $sqlgroup = "SELECT * FROM t_group_kendaraan WHERE id_group_kendaraan='$id_group_kendaraan'";
    $groupar = mysql_query( $sqlgroup );
    $emp = mysql_fetch_array( $groupar );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_group="true">&times;</span></button>
                        <h4 class="modal-title" id_group_kendaraan="myModalLabel">Hapus Data Group</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_group_kendaraan" name="id_group_kendaraan" value="<?php echo $id_group_kendaraan;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_group="true">&nbsp;Batal&nbsp;</button>
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
                            var id_group_kendaraan = $('#id_group_kendaraan').val();
                           $.ajax({
                                url: 'group/group_del_save.php?id_group_kendaraan='+id_group_kendaraan,
                                type: 'GET',
                                success: function (response){
                                      //alert('asuransi/asuransi_del_save.php?$id_group_kendaraan='+$id_group_kendaraan);
                                      $("#tablegroup").load('group/group_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 