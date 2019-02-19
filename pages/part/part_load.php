      <?php
            include_once '../../lib/config.php';
      ?>
      <table id="part1" class="table table-condensed table-bordered table-striped table-hover">
      
                <thead class="thead-light">
                <tr>
                          <th>Kode Part</th>
                          <th>Nama</th>
                          <th>Satuan</th>
                          <th>Harga Beli</th>
                          <th>Harga Jual</th>
                          <th>Diskon</th>
                          <th>PPN</th>
                          <th>Stock</th>
                          <th>Supplier</th>
                         

                          <th><button type="button" class="btn btn btn-default btn-circle open_add"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_part ORDER BY id_part ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['id_part'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['fk_satuan'];?></td>
                          <td ><?php echo $catat['harga_beli'];?></td>
                          <td ><?php echo $catat['harga_jual'];?></td>
                          <td ><?php echo $catat['diskon'];?></td>
                          <td ><?php echo $catat['ppn'];?></td>
                          <td ><?php echo $catat['stock'];?></td>
                          <td ><?php echo $catat['fk_supplier'];?></td>
                     
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_part']; ?>" onclick="open_modal(ideditas='<?php echo $catat['id_part']; ?>');"><span>Edit</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_part']; ?>" onclick="open_del(iddelas='<?php echo $catat['id_part']; ?>');"><span>Hapus</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
             $('#part1').DataTable({
              "columnDefs": [
                  { "orderable": false, "targets": 9 }
                ],
              "language": {
                      "search": "Cari",
                      "lengthMenu": "Lihat _MENU_ baris per halaman",
                      "zeroRecords": "Maaf, Tidak di temukan - data",
                      "info": "Terlihat halaman _PAGE_ of _PAGES_",
                      "infoEmpty": "Tidak ada data di database"
                  }
             });
            $(".open_add").click(function (e){
                                //var m = $(this).attr("id_part");
                    $.ajax({
                    url: "part/part_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
            });
           function open_del(){
                                $.ajax({
                                    url: "part/part_del.php?id_part="+iddelas,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
            function open_modal(){
                              $.ajax({
                                  url: "part/part_edit.php?id_part="+ideditas,
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