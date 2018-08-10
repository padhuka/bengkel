      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
            $idestimasi=$_GET['idestimasi'];
      ?>
      <table id="estimasipanel" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Nama</th>
                          <th>Harga</th>
                          <th>Diskon</th>
                          <th>Harga</th>                          
                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_addpanel(idestimasi='<?php echo $idestimasi;?>');"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT ep.*,p.nama FROM t_estimasi_panel_detail ep
                                    LEFT JOIN t_panel p ON ep.fk_panel=p.id_panel
                                    WHERE fk_estimasi='$idestimasi' ORDER BY id ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo rupiah2($catat['harga_jual_panel']);?></td>
                          <td ><?php echo rupiah2($catat['harga_diskon_panel']);?></td>
                          <td ><?php echo rupiah2($catat['harga_total_estimasi_panel']);?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id'];?>" onclick="open_modalpanel(id='<?php echo $catat['id'];?>');"><span>Edit</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id'];?>" onclick="open_delpanel(id='<?php echo $catat['id'];?>');"><span>Hapus</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                   
                </tfoot>
              </table>
              <script>
            $('#estimasipanel').DataTable({
              "pageLength": 5
            });
          
           function open_addpanel(x){
              $.ajax({
                    url: "estimasi/panel_add.php?idestimasi="+x,
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAddPanel").html(ajaxData);
                        $("#ModalAddPanel").modal({backdrop: 'static', keyboard:false});
                      }
                    });
              }
           function open_delpanel(y){
                                $.ajax({
                                    url: "estimasi/panel_del.php?id="+y,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDeletePanel").html(ajaxData);
                                        $("#ModalDeletePanel").modal({backdrop: 'static', keyboard:false});
                                    }
                                });
            };
            function open_modalpanel(z){
                              $.ajax({
                                  url: "estimasi/panel_edit.php?idestimasi=<?php echo $idestimasi;?>&id="+z,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalEditPanel").html(ajaxData);
                                      $("#ModalEditPanel").modal({backdrop: 'static', keyboard:false});
                                  }
                              });
            };
      </script>

<style type="text/css">
.modal-open .modal {
    overflow-y: scroll;
   /* overflow-x: scroll;
*/
  }
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