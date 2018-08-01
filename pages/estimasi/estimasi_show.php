<!-- general form elements disabled -->
   <?php
   // include_once '../../lib/sess.php';
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $idestimasi= $_GET['idestimasi'];
 //   $sqlpan= "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi'";
 //  $catat= mysql_fetch_array(mysql_query($sqlpan));
  
   ?>
<div class="modal-dialog">
           <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Estimasi <button type="button" class="close" aria-label="Close" onclick="$('#ModalShow').modal('hide');"><span>&times;</span></button></h4>                    
                    </div>
                  
                    <div class="modal-body">
                <table id="estimasishow" class="table table-condensed table-bordered table-striped table-hover">
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                       <td>
                         <tr class="row">
                        <td>
                        <th class="col-sm-6">
                        <tr> <th>No Estimasi</th> <td ><?php echo $catat['id_estimasi'];?></td></tr>
                        <tr> <th>Tgl Masuk</th> <td ><?php echo $catat['tgl'];?></td></tr>
                        <tr> <th>No Chasis</th>  <td ><?php echo $catat['fk_no_chasis'];?></td></tr>
                        <tr> <th>No Mesin</th> <td ><?php echo $catat['fk_no_mesin'];?></td></tr>
                        <tr> <th>No Polisi</th>   <td ><?php echo $catat['fk_no_polisi'];?></td> </tr>
                        </th>
                        </td>
                        </tr>
                       </td>
                       <td>
                         <tr class="row">
                        <td>
                        <th class="col-sm-2">
                        <tr> <th>No Estimasi</th> <td ><?php echo $catat['id_estimasi'];?></td></tr>
                        <tr> <th>Tgl Masuk</th> <td ><?php echo $catat['tgl'];?></td></tr>
                        <tr> <th>No Chasis</th>  <td ><?php echo $catat['fk_no_chasis'];?></td></tr>
                        <tr> <th>No Mesin</th> <td ><?php echo $catat['fk_no_mesin'];?></td></tr>
                        <tr> <th>No Polisi</th>   <td ><?php echo $catat['fk_no_polisi'];?></td> </tr>
                        </th>
                        </td>
                        </tr>

                       </td>
                      
                
                       
                        
                        
                    <?php }?>
                   
                </tfoot>
              </table>
              
              <script>
            $('#estimasishow').DataTable();
          
          </div>
</div>
</div>

</script>

<style type="text/css">
  .modal-footer {
    padding-top: 10px;
    padding-bottom: 0px;
    padding-left: 0px;
    padding-right: 0px;
  }
  .modal-title {
    font-style: italic;
    background-color: lightcoral;
    text-align: center;
    font-weight: bold;
  }
  .modal-dialog {
    margin-bottom: 0px;
    border: 3px;
    width: 900px;
  }
</style>