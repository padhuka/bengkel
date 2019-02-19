      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="example1" class="table table-condensed table-bordered table-striped table-hover">
      
                <thead class="thead-light">
                <tr>
                          <th>Kode Panel</th>
                          <th>Nama</th>
                          <th>Harga Pokok</th>
                          <th>Harga Jual</th>
                          <th>Diskon</th>
                          <th>PPN</th>
                          <th><button type="button" class="btn btn btn-default btn-circle open_add"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_panel ORDER BY id_panel ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['id_panel'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo rupiah2($catat['harga_pokok']);?></td>
                          <td ><?php echo rupiah2($catat['harga_jual']);?></td>
                          <td ><?php echo $catat['diskon'];?>%</td>
                          <td ><?php echo $catat['ppn'];?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_panel']; ?>" onclick="open_modal(ideditas='<?php echo $catat['id_panel']; ?>');"><span>Edit</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_panel']; ?>" onclick="open_del(iddelas='<?php echo $catat['id_panel']; ?>');"><span>Hapus</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
             $('#example1').DataTable({
              "columnDefs": [
                  { "orderable": false, "targets": 6 }
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
                                //var m = $(this).attr("id_panel");
                    $.ajax({
                    url: "panel/panel_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal('show',{backdrop: 'true'});
                      }
                    });
            });
           function open_del(){
                                $.ajax({
                                    url: "panel/panel_del.php?id_panel="+iddelas,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal('show',{backdrop: 'true'});
                                    }
                                });
            };
            function open_modal(){
                              $.ajax({
                                  url: "panel/panel_edit.php?id_panel="+ideditas,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalEdit").html(ajaxData);
                                      $("#ModalEdit").modal('show',{backdrop: 'true'});
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