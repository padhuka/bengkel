      <?php
            include_once '../../lib/config.php';
      ?>
      <table id="example1" class="table table-condensed table-bordered table-striped table-hover">
      
                <thead class="thead-light">
                <tr>
                          <th>Kode Supplier</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>No Telp</th>
                          <th>NPWP</th>
                          <th><button type="button" class="btn btn btn-default btn-circle open_add"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_supplier ORDER BY id_supplier ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['id_supplier'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['alamat'];?></td>
                          <td ><?php echo $catat['no_telp'];?></td>
                          <td ><?php echo $catat['npwp'];?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_supplier']; ?>" onclick="open_modal(ideditas='<?php echo $catat['id_supplier']; ?>');"><span>Edit</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_supplier']; ?>" onclick="open_del(iddelas='<?php echo $catat['id_supplier']; ?>');"><span>Hapus</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
             $('#example1').DataTable();
            $(".open_add").click(function (e){
                                //var m = $(this).attr("id_supplier");
                    $.ajax({
                    url: "supplier/supplier_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
            });
           function open_del(){
                                $.ajax({
                                    url: "supplier/supplier_del.php?id_supplier="+iddelas,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
            function open_modal(){
                              $.ajax({
                                  url: "supplier/supplier_edit.php?id_supplier="+ideditas,
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