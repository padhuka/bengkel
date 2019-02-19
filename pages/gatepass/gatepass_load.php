      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="gatepass" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>No Gate Pass</th>
                          <th>Tgl</th>
                          <th>No PKB</th>
                          <th>Status</th>
                        
                     
                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_add();"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_gate_pass 
                                    ORDER BY tgl_trx DESC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><?php echo $j++;?></td> 
                          <td ><?php echo $catat['no_gate_pass'];?></td>
                          <td ><?php echo $catat['tgl'];?></td>
                          <td ><?php echo $catat['fk_pkb'];?></td>
                          <td ><?php echo $catat['status'];?></td>
                         
                          <td >
                                        
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_gate_pass']; ?>" onclick="cetak_get(nogatepass='<?php echo $catat['no_gate_pass']; ?>');"><span>Cetak</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
            $('#gatepass').DataTable({
              "columnDefs": [
                  { "orderable": false, "targets": 5}
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
                    url: "gatepass/gatepass_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalGateAdd").html(ajaxData);
                        $("#ModalGateAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }
              
           function open_del(x){
                                $.ajax({
                                    url: "gatepass/gatepass_del.php?nogatepass="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalBatal").html(ajaxData);
                                        $("#ModalBatal").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
      
            function open_gatepass(z){
                              $.ajax({
                                  url: "gatepass/gatepass_show.php?nogatepass="+z,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalShow").html(ajaxData);
                                      $("#ModalShow").modal({backdrop: 'static',keyboard: false});
                                  }
                              });
            };
            function cetak_get(q){
                              $.ajax({
                                  url: "gatepass/gatepass_print.php?nogatepass="+q,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalGatePrint").html(ajaxData);
                                      $("#ModalGatePrint").modal({backdrop: 'static',keyboard: false});
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