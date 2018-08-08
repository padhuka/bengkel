      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="cash" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No Bukti</th>
                          <th>Tgl</th>
                          <th>Tipe Transaksi</th>
                          <th>Di Terima Dari</th>
                          <th>No Ref</th>
                          <th>Total</th>
                          <th>Keterangan</th>

                     
                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_add();"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = " SELECT * FROM t_cash 
                                    WHERE tgl_batal='0000:00:00 00:00:00' ORDER BY no_bukti DESC ";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><button type="button" class="btn btn-link" id="<?php echo $catat['no_bukti']; ?>" onclick="open_cash(nobukti='<?php echo $catat['no_bukti']; ?>');"><span><?php echo ($catat['no_bukti']);?></span></button></td>
                       
                          <td ><?php echo date('d-m-Y' , strtotime($catat['tgl_transaksi']));?></td>
                          <td ><?php echo $catat['tipe_transaksi'];?></td>
                          <td ><?php echo $catat['diterima_dari'];?></td>
                          <td ><?php echo $catat['no_ref'];?></td>
                          
                           <td ><?php echo rupiah2($catat['total']);?></td>
                           <td ><?php echo $catat['keterangan'];?></td>
                          <td >
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_bukti']; ?>" onclick="open_del(nobukti='<?php echo $catat['no_bukti']; ?>');"><span>Batal</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_bukti']; ?>" onclick="cetak_cash(nobukti='<?php echo $catat['no_bukti']; ?>');"><span>Cetak</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
            $('#cash').DataTable({
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
                    url: "cash/cash_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalPkbAdd").html(ajaxData);
                        $("#ModalPkbAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }
              
           function open_del(x){
                                $.ajax({
                                    url: "cash/cash_del.php?nobukti="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalBatal").html(ajaxData);
                                        $("#ModalBatal").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
      
            function open_cash(z){
                              $.ajax({
                                  url: "cash/cash_show.php?nobukti="+z,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalShow").html(ajaxData);
                                      $("#ModalShow").modal({backdrop: 'static',keyboard: false});
                                  }
                              });
            };

            function cetak_cash(q){
                              $.ajax({
                                  url: "cash/cash_print.php?nobukti="+q,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalCashPrint").html(ajaxData);
                                      $("#ModalCashPrint").modal({backdrop: 'static',keyboard: false});
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