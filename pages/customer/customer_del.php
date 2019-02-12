<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id_customer = $_GET['id_customer'];
    $sqlemp = "SELECT * FROM t_customer WHERE id_customer='$id_customer'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_asuransiden="true">&times;</span></button>
                        <h4 class="modal-title" id_customer="myModalLabel">Hapus Data Customer</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_customer" name="id_customer" value="<?php echo $id_customer;?>">
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
                            var id_customer = $('#id_customer').val();
                           $.ajax({
                                url: 'customer/customer_del_save.php?id_customer='+id_customer,
                                type: 'GET',
                                success: function (response){
                                      //alert('customer/asuransi_del_save.php?id_customer='+id_customer);
                                      $("#tablecustomer").load('customer/customer_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 