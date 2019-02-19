      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>No PKB</th>
                          <th>Tgl PKB</th>
                          <th>No Chasis</th>
                          <th>No Mesin</th>
                          <th>No Polisi</th>
                          <th>Nama Customer</th>
                          <th>Status PKB</th>
                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_add();"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT p.*,state.status as statuspkb,c.nama,k.no_kwitansi FROM t_pkb p
                                   LEFT JOIN t_customer c ON p.fk_customer=c.id_customer
                                   LEFT JOIN ( SELECT * from t_kwitansi where tgl_batal='0000-00-00 00:00:00') AS k ON p.id_pkb=k.fk_pkb   
                                   LEFT JOIN (SELECT id, fk_pkb, status
                                      FROM t_status_pkb
                                      WHERE id IN (
                                      SELECT MAX(id)
                                      FROM t_status_pkb
                                      GROUP BY fk_pkb
                                    ))AS state ON p.id_pkb=state.fk_pkb
                                   WHERE p.tgl_batal='0000-00-00 00:00:00'
                                   ORDER BY p.tgl DESC";
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
                          <td ><?php echo $catat['statuspkb'];?></td>

                          <td >
                                    <?php 
                                      $sqlkwcash2="SELECT no_kwitansi FROM t_kwitansi WHERE fk_pkb='$catat[id_pkb]' AND tgl_batal<>'0000-00-00 00:00:00'";
                                            $hkwcash2=mysql_fetch_array(mysql_query($sqlkwcash2));
                                            $lunas2=$hkwcash2['no_kwitansi'];
                                    ?>
                                    <?php if($catat['statuspkb']=='PROSES REPAIR' || $lunas2){?>
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_pkb']; ?>" onclick="open_modal(idpkb='<?php echo $catat['id_pkb']; ?>');"><span>Edit</span></button>
                                          
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_pkb']; ?>" onclick="open_del(idpkb='<?php echo $catat['id_pkb']; ?>');"><span>Batal</span></button>

                                         <?php }?>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_pkb']; ?>" onclick="cetak_pkb(idpkb='<?php echo $catat['id_pkb']; ?>');"><span>Cetak</span></button>

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
           
           function open_add(){
              $.ajax({
                    url: "pkb/pkb_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }
                        
           function open_del(x){
                                $.ajax({
                                    url: "pkb/pkb_del.php?idpkb="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
              
            function open_modal(y){
                              $.ajax({
                                  url: "pkb/pkb_edit_detail.php?idpkb="+y,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalEdit").html(ajaxData);
                                      $("#ModalEdit").modal({backdrop: 'static',keyboard: false});
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
             function cetak_pkb(q){
                              $.ajax({
                                  url: "pkb/pkb_print.php?idpkb="+q,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalPkbPrint").html(ajaxData);
                                      $("#ModalPkbPrint").modal({backdrop: 'static',keyboard: false});
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