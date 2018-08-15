    <?php
    include_once '../../lib/fungsi.php';
   ?>
     <div id="ModalBankKwitansi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
      <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-header">
                         
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Kwitansi <button type="button" class="close" aria-label="Close" onclick="$('#ModalBankKwitansi').modal('hide');"><span>&times;</span></button></h4>                        
                    </div>

                  <div class="box">
                <table id="bankkwitansi" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No Kwitansi</th>
                          <th>Nilai</th>
                          <th></th>
                </tr>

                </thead>
                <tbody>
                <?php
                                   $j=1;
                                   $sqlcatat = "SELECT k.no_kwitansi as no_kwitansi,k.total_payment as nilai,c.no_ref,c.total as titip_cash ,b.total as titip_bank from t_kwitansi k
                                    LEFT JOIN t_cash c ON k.fk_pkb=c.no_ref
                                    LEFT JOIN t_bank b ON k.fk_pkb=b.no_ref
                                       UNION
                                    SELECT ko.no_kwitansi_or as no_kwitansi ,ko.nilai_kwitansi as nilai, s.no_ref,s.total as titip_cash,bk.total as titip_bank from t_kwitansi_or ko
                                    LEFT JOIN t_cash s ON ko.fk_estimasi=s.no_ref
                                    LEFT JOIN t_bank bk ON ko.fk_estimasi=bk.no_ref";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                       
                       
                          <td ><?php echo $catat['no_kwitansi'];?></td>
                          <td ><?php echo ($catat['nilai']-($catat['titip_bank']+$catat['titip_cash']));?></td>
                       
                          <td >
                                       
                                        <button type="button" class="btn btn btn-default btn-circle" onclick="selectKwitansi('<?php echo $catat['no_kwitansi'];?>','<?php echo $catat['nilai'];?>');">Pilih</button>

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
                $('#bankkwitansi').DataTable();

               function selectKwitansi(a,b){
                              $("#nokwitansi").val(a);
                              $("#nilai").val(b);
                              $("#ModalBankKwitansi").modal('hide');
                              
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

