      <?php
            include_once '../../lib/config.php';
      ?>
      <table id="partnerbank1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Kode Partner</th>
                          <th>Nama</th>
                          <th>No Telp</th>
                          <th>Alamat</th>
                          <th><button type="button" class="btn btn btn-default btn-circle open_add" ><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_partner_bank ORDER BY id_partner_bank ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['id_partner_bank'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['no_telp'];?></td>
                          <td ><?php echo $catat['alamat'];?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_partner_bank']; ?>" onclick="open_modal(ideditpartnerbank='<?php echo $catat['id_partner_bank']; ?>');"><span>Edit</span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id_partner_bank']; ?>" onclick="open_del(iddelpartnerbank='<?php echo $catat['id_partner_bank']; ?>');"><span>Hapus</span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
             $('#partnerbank1').DataTable();
            $(".open_add").click(function (e){
                    $.ajax({
                    url: "partnerbank/partnerbank_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
            });
           function open_del(){
                                $.ajax({
                                    url: "partnerbank/partnerbank_del.php?id_partner_bank="+iddelpartnerbank,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
            function open_modal(){
                              $.ajax({
                                  url: "partnerbank/partnerbank_edit.php?id_partner_bank="+ideditpartnerbank,

                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalEdit").html(ajaxData);
                                      $("#ModalEdit").modal({backdrop: 'static',keyboard: false});
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