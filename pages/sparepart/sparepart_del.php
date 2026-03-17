<?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $id = $_GET['id'];
    $sqlemp = "SELECT pp.*, p.nama as nama_part, pp.id_pkb
              FROM t_part_pkb pp
              LEFT JOIN t_part p ON pp.id_part = p.id_part
              WHERE pp.id='$id'";
    $resemp = mysqli_query($objConn,  $sqlemp );
    $emp = mysqli_fetch_array( $resemp );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Data Sparepart PKB</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama_part'];?> - PKB: <?php echo $emp['id_pkb'];?> )?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">&nbsp;Batal&nbsp;</button>
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
                            var id = $('#id').val();
                           $.ajax({
                                url: 'sparepart/sparepart_del_save.php?id='+id,
                                type: 'GET',
                                success: function (response){
                                      $("#tablesparepartContainer").load('sparepart/sparepart_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script>
