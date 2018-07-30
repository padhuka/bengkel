      <?php
            include_once '../../lib/config.php';
      ?>
      <table id="tipe1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Kode Tipe Kendaraan</th>
                          <th>Nama</th>
                           <th>Group Kendaraan</th>
                          <th><button type="button" class="btn btn btn-default btn-circle open_add"><span>Tambah</span></button></th>
                         
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_tipe_kendaraan ORDER BY id_tipe_kendaraan ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['id_tipe_kendaraan'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['fk_group_kendaraan'];?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_tipe_kendaraan']; ?>" onclick="open_modal(idedittipe='<?php echo $catat['id_tipe_kendaraan']; ?>');"><span>Edit</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_tipe_kendaraan']; ?>" onclick="open_del(iddeltipe='<?php echo $catat['id_tipe_kendaraan']; ?>');"><span>Hapus</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
             $('#tipe1').DataTable();
            $(".open_add").click(function (e){
                                //var m = $(this).attr("id_tipe_kendaraan");
                    $.ajax({
                    url: "tipe/tipe_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
            });
           function open_del(){
                                $.ajax({
                                    url: "tipe/tipe_del.php?id_tipe_kendaraan="+iddeltipe,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
            function open_modal(){
                              $.ajax({
                                  url: "tipe/tipe_edit.php?id_tipe_kendaraan="+idedittipe,

                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalEdit").html(ajaxData);
                                      $("#ModalEdit").modal({backdrop: 'static',keyboard: false});
                                  }
                              });
            };
      </script>

<style type="text/css">
  .table {
    border-spacing: 0;
    border-collapse: collapse;
    margin-bottom: 0px;
  }
  .thead-light{
    background-color: lightgrey;
  }
  .btn {
    font-weight: bold;
    padding-bottom: 0px;
    padding-top: 3px;
    padding-left: 4px;
    padding-right: 4px;
  }
</style>