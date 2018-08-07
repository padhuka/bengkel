      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="tablekwitansi" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No Kwitansi</th>
                          <th>Tanggal</th>
                          <th>No PKB</th>
                              <th>No Mesin</th>
                          <th>No Chasis</th>
                          <th>Nama Customer</th>
                          <th>Total</th>
                          <th>PPN</th>
                           <th>Total Bayar</th>
                         
                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_add();"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT k.no_kwitansi, k.tgl_kwitansi,p.id_pkb,p.kategori,p.fk_no_chasis,p.fk_no_mesin,c.nama,k.total_kwitansi,k.total_ppn_kwitansi,k.total_payment,k.tgl_batal FROM t_kwitansi k 
                                      INNER JOIN t_pkb p ON k.fk_pkb=p.id_pkb 
                                      INNER JOIN t_customer c ON p.fk_customer=c.id_customer
                                      WHERE k.tgl_batal='0000:00:00 00:00:00'";


                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>  
                          <td><button type="button" class="btn btn-link" id="<?php echo $catat['no_kwitansi']; ?>" onclick="open_kwitansi(idkwitansi='<?php echo $catat['no_kwitansi']; ?>');"><span><?php echo ($catat['no_kwitansi']);?></span></button></td>
                       
                          <td ><?php echo date('d-m-Y',strtotime($catat['tgl_kwitansi']));?></td>
<!--                           <td ><?php echo $catat['id_pkb'];?></td> --> 
                      <td><button type="button" class="btn btn-link" id="<?php echo $catat['id_pkb']; ?>" onclick="open_pkb(idpkb='<?php echo $catat['id_pkb']; ?>');"><span><?php echo ($catat['id_pkb']);?></span></button></td>
                   
                          <td ><?php echo $catat['fk_no_chasis'];?></td>
                          <td ><?php echo $catat['fk_no_mesin'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo rupiah2($catat['total_kwitansi']);?></td>
                          <td ><?php echo rupiah2($catat['total_ppn_kwitansi']);?></td>
                          <td ><?php echo rupiah2($catat['total_payment']);?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_kwitansi']; ?>" onclick="cetak_kw(idkwitansi='<?php echo $catat['no_kwitansi']; ?>');"><span>Cetak</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_kwitansi']; ?>" onclick="open_del(idkwitansi='<?php echo $catat['no_kwitansi']; ?>');"><span>Batal</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
            $('#tablekwitansi').DataTable({
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
                    url: "kwitansi/kwitansi_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }
            
             function open_del(x){
                                $.ajax({
                                    url: "kwitansi/kwitansi_del.php?idkwitansi="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
                         
            function open_pkb(z){
                              $.ajax({
                                  url: "pkb/pkb_show.php?idpkb="+z,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalShow").html(ajaxData);
                                      $("#ModalShow").modal({backdrop: 'static',keyboard: false});
                                  }
                              });
            };
            function cetak_kw(q){
                              $.ajax({
                                  url: "kwitansi/kwitansi_print.php?no_kwitansi="+q,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalKwPrint").html(ajaxData);
                                      $("#ModalKwPrint").modal({backdrop: 'static',keyboard: false});
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