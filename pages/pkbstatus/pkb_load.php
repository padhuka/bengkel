      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>No PKB</th>
                          <th>Tgl Masuk</th>
                          <th>No Chasis</th>
                          <th>No Mesin</th>
                          <th>No Polisi</th>
                          <th>Nama Customer</th>
                          <th>Status PKB</th>
                          <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT p.*,c.nama FROM t_pkb p
                                    LEFT JOIN t_customer c ON p.fk_customer=c.id_customer
                                    WHERE tgl_batal='0000-00-00 00:00:00' 
                                    ORDER BY id_pkb DESC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><?php echo $j++;?></td>
                          <td><button type="button" class="btn btn-link" id="<?php echo $catat['id_pkb']; ?>" onclick="open_pkb(idpkb='<?php echo $catat['id_pkb']; ?>');"><span><?php echo ($catat['id_pkb']);?></span></button></td>
                       
                          <td ><?php echo date('d-m-Y',strtotime($catat['tgl']));?></td>
                          <td ><?php echo $catat['fk_no_chasis'];?></td>
                          <td ><?php echo $catat['fk_no_mesin'];?></td>
                          <td ><?php echo $catat['fk_no_polisi'];?></td>
                           <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['status_pkb'];?></td>
                          <td >
                                        <?php if($catat['status_pkb']=='Buka'){ ?>
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_pkb']; ?>" onclick="open_tutup(idpkb='<?php echo $catat['id_pkb']; ?>');"><span>Tutup</span></button>
                                        <?php }else{?>
                                        
                                        <?php }?>
                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
            $('#tablepkb1').DataTable({
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
           
              
           function open_tutup(x){
                                $.ajax({
                                    url: "pkbstatus/pkb_tutup.php?idpkb="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalTutup").html(ajaxData);
                                        $("#ModalTutup").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
            function open_buka(x){
                                $.ajax({
                                    url: "pkbstatus/pkb_buka.php?idpkb="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalBuka").html(ajaxData);
                                        $("#ModalBuka").modal({backdrop: 'static',keyboard: false});
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