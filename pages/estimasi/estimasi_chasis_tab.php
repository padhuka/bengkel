     <div id="ModalChasis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
     <div class="modal-dialog">
      <div class="col-md-14">
                <div class="modal-content" >
                    <div class="modal-header">
                         
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Inventory Kendaraan <button type="button" class="close" aria-label="Close" onclick="$('#ModalChasis').modal('hide');"><span>&times;</span></button></h4>                        
                    </div>

                  <div class="box">
                <table id="tableChasis" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No Chasis</th>
                          <th>No Mesin</th>
                          <th>No Polisi</th>
                          <th>Customer</th>
                          <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php
                 $j=1;
                                    $sqlcatat = "SELECT i.*,c.nama as nama,w.id_warna_kendaraan,w.nama as warna from t_inventory_bengkel i 
                                      LEFT JOIN t_customer c ON i.fk_customer=c.id_customer
                                      LEFT JOIN t_warna_kendaraan w ON i.fk_warna_kendaraan=w.id_warna_kendaraan
                                      ORDER BY no_chasis ASC";
                                                                          $rescatat = mysql_query( $sqlcatat );

                                    while($catat = mysql_fetch_array( $rescatat )){
                                      // $qwrn= mysql_query("SELECT * FROM t_warna_kendaraan WHERE id_warna_kendaraan='$catat[fk_warna_kendaraan]'");
                                      // $swrn= mysql_fetch_array($qwrn);
                                ?>
                        <tr>
                          <td ><?php echo $catat['no_chasis'];?></td>
                          <td ><?php echo $catat['no_mesin'];?></td>
                          <td ><?php echo $catat['no_polisi'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td>
                                        <button type="button" class="btn btn btn-default btn-circle" onclick="selectChasis('<?php echo $catat['no_chasis'];?>','<?php echo $catat['no_mesin'];?>','<?php echo $catat['no_polisi'];?>','<?php echo $catat['id_warna_kendaraan'];?>','<?php echo $catat['warna'];?>','<?php echo $catat['fk_customer'];?>');">Pilih</button>

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
                $('#tableChasis').DataTable({
                  "pageLength": 5,
                    "language": {
                      "search": "Cari",
                      "lengthMenu": "Lihat _MENU_ baris per halaman",
                      "zeroRecords": "Maaf, Tidak di temukan - data",
                      "info": "Terlihat halaman _PAGE_ of _PAGES_",
                      "infoEmpty": "Tidak ada data di database"
                  }

                });
               function selectChasis(a,b,c,d,e,f){
                              $("#chasis").val(a);
                              $("#mesin").val(b);
                              $("#polisi").val(c);
                              $("#warna").val(d);
                              $("#warnanm").val(e);
                              $("#customer").val(f);
                              $("#ModalChasis").modal('hide');
                              /*$.ajax({
                              url: "suratmasuk/suratmasuk_add.php",
                              type: "GET",
                                success: function (ajaxData){
                                  $("#ModalAdd").html(ajaxData);
                                  $("#ModalAdd").modal('show',{backdrop: 'true'});
                                }
                              });*/
                      }; 
              </script>

  <style type="text/css">
  .modal-open .modal {
    overflow-y: hidden;

  }
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
    margin:0;
    padding-top: 5px;padding-bottom: 5px;
  }
</style>

