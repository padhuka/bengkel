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
                                    $sqlcatat = "SELECT k.no_kwitansi_or, k.tgl_kwitansi_or,e.id_estimasi,e.fk_no_polisi,e.fk_no_chasis,e.fk_no_mesin,c.nama,k.nilai_kwitansi from t_kwitansi_or k LEFT JOIN t_estimasi e
                                      ON k.fk_estimasi=e.id_estimasi LEFT JOIN t_customer c 
                                      ON e.fk_user=c.id_customer
                                      ";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>  
                          <td><button type="button" class="btn btn-link" id="<?php echo $catat['no_kwitansi_or']; ?>" onclick="open_kwitansior(idkwitansior='<?php echo $catat['no_kwitansi_or']; ?>');"><span><?php echo ($catat['no_kwitansi_or']);?></span></button></td>
                       
                          <td ><?php echo date('d-m-Y',strtotime($catat['tgl_kwitansi_or']));?></td>
                          <td ><?php echo $catat['id_estimasi'];?></td>
                          <td ><?php echo $catat['fk_no_polisi'];?></td>
                          <td ><?php echo $catat['fk_no_chasis'];?></td>
                          <td ><?php echo $catat['fk_no_mesin'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['nilai_kwitansi'];?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_kwitansi_or']; ?>" onclick="open_modal(idkwitansior='<?php echo $catat['no_kwitansi_or']; ?>');"><span>Edit</span></button>
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
              
                         
            function open_kwitansior(z){
                              $.ajax({
                                  url: "kwitansior/kwitansior_show.php?idkwitansior="+z,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalShow").html(ajaxData);
                                      $("#ModalShow").modal({backdrop: 'static',keyboard: false});
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