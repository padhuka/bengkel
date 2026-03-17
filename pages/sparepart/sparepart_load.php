      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="tablesparepart" class="table table-condensed table-bordered table-striped table-hover">

                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>Kode Part</th>
                          <th>Nama Part</th>
                          <th>Harga Beli</th>
                          <th>Harga Jual</th>
                          <th>No PKB</th>
                          <th>No Polisi</th>
                          <th>Nama Customer</th>
                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_add();"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT pp.id, p.id_part, p.nama as nama_part, pp.harga_beli, pp.harga_jual,
                                                       pp.id_pkb, pk.fk_no_polisi, c.nama as nama_customer
                                                FROM t_part_pkb pp
                                                LEFT JOIN t_part p ON pp.id_part = p.id_part
                                                LEFT JOIN t_pkb pk ON pp.id_pkb = pk.id_pkb
                                                LEFT JOIN t_customer c ON pk.fk_customer = c.id_customer
                                                ORDER BY pp.id DESC";
                                    $rescatat = mysqli_query($objConn,  $sqlcatat );
                                    while($catat = mysqli_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $j++; ?></td>
                          <td ><?php echo $catat['id_part']; ?></td>
                          <td ><?php echo $catat['nama_part']; ?></td>
                          <td ><?php echo rupiah2($catat['harga_beli']); ?></td>
                          <td ><?php echo rupiah2($catat['harga_jual']); ?></td>
                          <td ><?php echo $catat['id_pkb']; ?></td>
                          <td ><?php echo $catat['fk_no_polisi']; ?></td>
                          <td ><?php echo $catat['nama_customer']; ?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id']; ?>" onclick="open_edit(ideditas='<?php echo $catat['id']; ?>');"><span>Edit</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id']; ?>" onclick="open_del(iddelas='<?php echo $catat['id']; ?>');"><span>Hapus</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
             $('#tablesparepart').DataTable({
              "columnDefs": [
                  { "orderable": false, "targets": 8 }
                ],
              "language": {
                      "search": "Cari",
                      "lengthMenu": "Lihat _MENU_ baris per halaman",
                      "zeroRecords": "Maaf, Tidak di temukan - data",
                      "info": "Terlihat halaman _PAGE_ of _PAGES_",
                      "infoEmpty": "Tidak ada data di database"
                  }
            });

           function open_add(){
              $.ajax({
                    url: "sparepart/sparepart_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }

           function open_del(){
                                $.ajax({
                                    url: "sparepart/sparepart_del.php?id="+iddelas,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
            function open_edit(){
                              $.ajax({
                                  url: "sparepart/sparepart_edit.php?id="+ideditas,
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
