    <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
   ?>
     <div id="ModalPkb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
      <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data PKB <button type="button" class="close" aria-label="Close" onclick="$('#ModalPkb').modal('hide');"><span>&times;</span></button></h4>
                    </div>

                  <div class="box">
                <table id="pkbselection" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No PKB</th>
                          <th>Tanggal</th>
                          <th>No Polisi</th>
                          <th>Customer</th>
                          <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                   $j=1;
                                   $sqlcatat = "SELECT p.id_pkb, p.tgl, p.fk_no_polisi, c.nama as nama_customer
                                              FROM t_pkb p
                                              LEFT JOIN t_customer c ON p.fk_customer = c.id_customer
                                              WHERE p.tgl_batal = '0000-00-00 00:00:00'
                                              ORDER BY p.id_pkb DESC";
                                   $rescatat = mysqli_query($objConn,  $sqlcatat );
                                    while($catat = mysqli_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><?php echo ($catat['id_pkb']);?></td>

                          <td ><?php echo date('d-m-Y', strtotime($catat['tgl'])); ?></td>
                          <td ><?php echo $catat['fk_no_polisi'];?></td>
                          <td ><?php echo $catat['nama_customer'];?></td>

                          <td >

                                        <button type="button" class="btn btn btn-default btn-circle" onclick="selectPKB(
                                         '<?php echo $catat['id_pkb'];?>',
                                         '<?php echo $catat['fk_no_polisi'];?>',
                                         '<?php echo $catat['nama_customer'];?>',
                                         '<?php echo date('d-m-Y', strtotime($catat['tgl']));?>'
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
                $('#pkbselection').DataTable();

               function selectPKB(id_pkb, no_polisi, customer, tgl){
                              $("#id_pkb").val(id_pkb);
                              $("#pkb_info").text("No Polisi: " + no_polisi + ", Customer: " + customer + ", Tgl: " + tgl);
                              $("#ModalPkb").modal('hide');

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
