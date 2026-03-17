    <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
   ?>
     <div id="ModalPart" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
      <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Part <button type="button" class="close" aria-label="Close" onclick="$('#ModalPart').modal('hide');"><span>&times;</span></button></h4>
                    </div>

                  <div class="box">
                <table id="partselection" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Kode Part</th>
                          <th>Nama Part</th>
                          <th>Supplier</th>
                          <th>Harga Beli</th>
                          <th>Harga Jual</th>
                          <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                   $j=1;
                                   $sqlcatat = "SELECT p.id_part, p.nama, p.fk_supplier, p.harga_beli, p.harga_jual, s.nama as nama_supplier
                                              FROM t_part p
                                              LEFT JOIN t_supplier s ON p.fk_supplier = s.id_supplier
                                              ORDER BY p.nama ASC";
                                   $rescatat = mysqli_query($objConn,  $sqlcatat );
                                    while($catat = mysqli_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><?php echo ($catat['id_part']);?></td>

                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['nama_supplier'];?></td>
                          <td ><?php echo rupiah2($catat['harga_beli']); ?></td>
                          <td ><?php echo rupiah2($catat['harga_jual']); ?></td>

                          <td >

                                        <button type="button" class="btn btn btn-default btn-circle" onclick="selectPart(
                                         '<?php echo $catat['id_part'];?>',
                                         '<?php echo $catat['nama'];?>',
                                         '<?php echo $catat['harga_beli'];?>',
                                         '<?php echo $catat['harga_jual'];?>'
                                        );">Pilih</button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              </div>
              </div>
              </div>
              </div>
              </div>
              <script type="text/javascript">
                $('#partselection').DataTable();

               function selectPart(id_part, nama_part, harga_beli, harga_jual){
                              // These values will be set to the current row being edited
                              // The actual assignment happens in the parent function
                              if(typeof currentRowId !== 'undefined'){
                                  $("#id_part_" + currentRowId).val(id_part);
                                  $("#part_info_" + currentRowId).text(nama_part);
                                  $("#harga_beli_" + currentRowId).val(harga_beli);
                                  $("#harga_jual_" + currentRowId).val(harga_jual);
                              }
                              $("#ModalPart").modal('hide');

                      };
              </script>

  <style type="text/css">
  .modal-header {
    padding-top: 15px;padding-bottom: 15px;
  }
  .title-header {
    font-size: 20px;
    text-align: center;
    font-weight: bold;
    font-family: monospace;
  }
  .modal-content {
    height: 650px;
  }
  .row {
    margin-left: 0px;
    margin-right: 0px;
    margin-top:10px;
  }
  .modal-title {
    padding-top: 5px;padding-bottom: 5px;
  }
</style>
