    <?php
    include_once '../../lib/fungsi.php';
   ?>
     <div id="ModalBankP" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
      <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-header">
                         
                        <h4 class="modal-title" id="myModalLabel2" style="text-align: center;padding-right: 0px">Data Kwitansi <button type="button" class="close" aria-label="Close" onclick="$('#ModalBankP').modal('hide');"><span>&times;</span></button></h4>                        
                    </div>

                  <div class="box">
                <table id="bankpartner" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Kode Partner</th>
                          <th>Nama</th>
                          <th></th>
                </tr>

                </thead>
                <tbody>
                <?php
                                   $j=1;
                                   $sqlcatat = "SELECT * from t_partner_bank order by id_partner_bank";
                                   $rescatat = mysql_query( $sqlcatat );
                                   while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                       
                       
                          <td ><?php echo $catat['id_partner_bank'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                       
                          <td >
                                       
                                        <button type="button" class="btn btn btn-default btn-circle" onclick="selectPartnerx('<?php echo $catat['id_partner_bank'];?>','<?php echo $catat['nama'];?>');">Pilih</button>

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
                $('#bankpartner').DataTable();

               function selectPartnerx(x,y){
                              $("#id_partner_bank").val(x);
                              $("#namapartner").val(y);
                              $("#ModalBankP").modal('hide');
                              
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
