      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
            $idestimasi=$_GET['idestimasi'];
      ?>
      <table id="estimasipart" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Nama</th>
                          <th>Harga</th>
                          <th>Diskon</th>
                          <th>Harga</th>                          
                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_addpart(idestimasi='<?php echo $idestimasi;?>');"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT ep.*,p.nama FROM t_estimasi_part_detail  ep
                                    LEFT JOIN t_part p ON ep.fk_part=p.id_part
                                    WHERE fk_estimasi='$idestimasi' ORDER BY id ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo rupiah2($catat['harga_jual_part']);?></td>
                          <td ><?php echo rupiah2($catat['harga_diskon_part']);?></td>
                          <td ><?php echo rupiah2($catat['harga_total_estimasi_part']);?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id'];?>" onclick="open_modalpart(id='<?php echo $catat['id'];?>');"><span>Edit</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id'];?>" onclick="open_delpart(id='<?php echo $catat['id'];?>');"><span>Hapus</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                   
                </tfoot>
              </table>
              <script>
            $('#estimasipart').DataTable();
          
           function open_addpart(x){
              $.ajax({
                    url: "estimasi/part_add.php?idestimasi="+x,
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAddPart").html(ajaxData);
                        $("#ModalAddPart").modal({backdrop: 'static', keyboard:false});
                      }
                    });
              }
           function open_delpart(y){
                                $.ajax({
                                    url: "estimasi/part_del.php?id="+y,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDeletePart").html(ajaxData);
                                        $("#ModalDeletePart").modal({backdrop: 'static', keyboard:false});
                                    }
                                });
            };
            function open_modalpart(z){
                              $.ajax({
                                  url: "estimasi/part_edit.php?idestimasi=<?php echo $idestimasi;?>&id="+z,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalEditPart").html(ajaxData);
                                      $("#ModalEditPart").modal({backdrop: 'static', keyboard:false});
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