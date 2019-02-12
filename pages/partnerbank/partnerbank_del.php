<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id_partner_bank = $_GET['id_partner_bank'];
    $sqlpartnerbank = "SELECT * FROM t_partner_bank WHERE id_partner_bank='$id_partner_bank'";
    $partner = mysql_query( $sqlpartnerbank );
    $emp = mysql_fetch_array( $partner );
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hid_partner_bank="true">&times;</span></button>
                        <h4 class="modal-title" id_partner_bank="myModalLabel">Hapus Data partnerbank</h4>
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $emp['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_partner_bank" name="id_partner_bank" value="<?php echo $id_partner_bank;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hid_partner_bank="true">&nbsp;Batal&nbsp;</button>
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
                            var id_partner_bank = $('#id_partner_bank').val();
                           $.ajax({
                                url: 'partnerbank/partnerbank_del_save.php?id_partner_bank='+id_partner_bank,
                                type: 'GET',
                                success: function (response){
                                      //alert('asuransi/asuransi_del_save.php?$id_partner_bank='+$id_partner_bank);
                                      $("#tablepartnerbank").load('partnerbank/partnerbank_load.php');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDelete').modal('hide');
                                }
                            });

                    });
                });
              </script> 