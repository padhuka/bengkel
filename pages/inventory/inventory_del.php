<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $no_chasis = $_GET['no_chasis'];
    $sqlemp = "SELECT * FROM t_inventory_bengkel WHERE no_chasis='$no_chasis'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hno_chasisden="true">&times;</span></button>
                        <h4 class="modal-title" no_chasis="myModalLabel">Hapus Data Inventory</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['no_chasis'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="no_chasis" name="no_chasis" value="<?php echo $no_chasis;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hno_chasisden="true">&nbsp;Batal&nbsp;</button>
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
                            var no_chasis = $('#no_chasis').val();
                           $.ajax({
                                url: 'inventory/inventory_del_save.php?no_chasis='+no_chasis,
                                type: 'GET',
                                success: function (response){
                                      //alert('panel/panel_del_save.php?no_chasis='+no_chasis);
                                      $("#tableinventory").load('inventory/inventory_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 