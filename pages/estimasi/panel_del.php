<?php
    include_once '../../lib/config.php';
    //include_once '../../lib/fungsi.php';
    $id = $_GET['id'];
    $sqlemp = "SELECT * FROM t_estimasi_panel_detail WHERE id='$id'";
    $resemp = mysql_query( $sqlemp );
    $emp = mysql_fetch_array( $resemp );
    $idestimasi=$emp['fk_estimasi'];
    //echo $sqlemp;
    $nmpanel="SELECT * FROM t_panel WHERE id_panel='$emp[fk_panel]'";
    $hpanel=mysql_fetch_array(mysql_query($nmpanel));
?>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Hapus Data Panel <button type="button" class="close" aria-label="Close" onclick="$('#ModalDeletePanel').modal('hide');"><span>&times;</span></button></h4> 
                    </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <form>
                                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ( <?php echo $hpanel['nama'];?>) ?</div>
                                        <div class="form-group">
                                            <input type="hidden" id="fk_panel" name="fk_panel" value="<?php echo $id;?>">
                                            <button type="button" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;</button>
                                            <button type="button" class="btn btn-primary" onclick="$('#ModalDeletePanel').modal('hide');" >&nbsp;Batal&nbsp;</button>
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
                        	//alert('estimasi/panel_del_save.php?id=<?php echo $id;?>&idestimasi=<?php echo $idestimasi;?>');
                        	//return false();
                           $.ajax({
                                url: 'estimasi/panel_del_save.php?id=<?php echo $id;?>&idestimasi=<?php echo $idestimasi;?>',
                                type: 'GET',
                                success: function (response){
                                      //alert('panel/panel_del_save.php?id_panel='+id_panel);
                                     $("#tablepanel").load('estimasi/panel_load.php?idestimasi=<?php echo $idestimasi;?>');
                                     $("#tableestimasi").load('estimasi/estimasi_load.php');
                                     $('.modal-body').css('opacity', '');
                                      alert('Data Berhasil Dihapus');
                                      $('#ModalDeletePanel').modal('hide');
                                      $("#tableestimasidetail").load('estimasi/estimasi_detail_tab.php?idestimasi=<?php echo $idestimasi;?>');
                                }
                            });

                    });
                });
              </script> 