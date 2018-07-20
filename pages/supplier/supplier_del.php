<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id_supplier = $_GET['id_supplier'];
    $sqlemp = "SELECT * FROM t_supplier WHERE id_supplier='$id_supplier'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_asuransiden="true">&times;</span></button>
                        <h4 class="modal-title" id_supplier="myModalLabel">Hapus Data Supplier</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_supplier" name="id_supplier" value="<?php echo $id_supplier;?>">
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
                            var id_supplier = $('#id_supplier').val();
                           $.ajax({
                                url: 'supplier/supplier_del_save.php?id_supplier='+id_supplier,
                                type: 'GET',
                                success: function (response){
                                      //alert('supplier/asuransi_del_save.php?id_supplier='+id_supplier);
                                      $("#tablesupplier").load('supplier/supplier_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 