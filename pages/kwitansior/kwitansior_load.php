      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="tablekwitansior" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No Kwitansi OR</th>
                          <th>Tanggal</th>
                          <th>No Estimasi</th>
                          <th>No Polisi</th>
                          <th>No Chasis</th>
                          <th>No Mesin</th>
                          <th>Nama Customer</th>
                          <th>Nilai Kwitansi</th>
                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_add();"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT k.no_kwitansi_or, k.tgl_kwitansi_or,e.id_estimasi,e.fk_no_polisi,e.fk_no_chasis,e.fk_no_mesin,c.nama,k.nilai_kwitansi,k.tgl_batal from t_kwitansi_or k 
                                      INNER JOIN t_estimasi e ON k.fk_estimasi=e.id_estimasi 
                                      INNER JOIN t_customer c ON e.fk_customer=c.id_customer
                                      AND k.tgl_batal='0000:00:00 00:00:00'";


                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>  
                          <td><button type="button" class="btn btn-link" id="<?php echo $catat['no_kwitansi_or']; ?>" onclick="open_kwitansior(idkwitansior='<?php echo $catat['no_kwitansi_or']; ?>');"><span><?php echo ($catat['no_kwitansi_or']);?></span></button></td>
                       
                          <td ><?php echo date('d-m-Y',strtotime($catat['tgl_kwitansi_or']));?></td>
<!--                           <td ><?php echo $catat['id_estimasi'];?></td> --> 
                      <td><button type="button" class="btn btn-link" id="<?php echo $catat['id_estimasi']; ?>" onclick="open_est(idestimasi='<?php echo $catat['id_estimasi']; ?>');"><span><?php echo ($catat['id_estimasi']);?></span></button></td>
                     <td ><?php echo $catat['fk_no_polisi'];?></td>
                          <td ><?php echo $catat['fk_no_chasis'];?></td>
                          <td ><?php echo $catat['fk_no_mesin'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo rupiah2($catat['nilai_kwitansi']);?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_kwitansi_or']; ?>" onclick="cetak_or(idkwitansior='<?php echo $catat['no_kwitansi_or']; ?>');"><span>Cetak</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_kwitansi_or']; ?>" onclick="open_del(idkwitansior='<?php echo $catat['no_kwitansi_or']; ?>');"><span>Batal</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
            $('#tablekwitansior').DataTable({
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
                    url: "kwitansior/kwitansior_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }
            
             function open_del(x){
                                $.ajax({
                                    url: "kwitansior/kwitansior_del.php?idkwitansior="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
                         
            function open_est(z){
                              $.ajax({
                                  url: "estimasi/estimasi_show.php?idestimasi="+z,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalShow").html(ajaxData);
                                      $("#ModalShow").modal({backdrop: 'static',keyboard: false});
                                  }
                              });
            };
            function cetak_or(q){
                              $.ajax({
                                  url: "kwitansior/kwitansior_print.php?no_kwitansi_or="+q,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalOrPrint").html(ajaxData);
                                      $("#ModalOrPrint").modal({backdrop: 'static',keyboard: false});
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