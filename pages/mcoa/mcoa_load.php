      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <table id="example1" class="table table-condensed table-bordered table-striped table-hover">
      
                <thead class="thead-light">
                <tr>
                          <th>COA</th>
                          <th>Type Transaction</th>
                          <th>Description</th>
                          
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_akun ORDER BY id ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['coa'];?></td>
                          <td ><?php echo $catat['transaction_type'];?></td>
                           <td ><?php echo $catat['description'];?></td>
                         
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
             $('#example1').DataTable({
              "language": {
                      "search": "Cari",
                      "lengthMenu": "Lihat _MENU_ baris per halaman",
                      "zeroRecords": "Maaf, Tidak di temukan - data",
                      "info": "Terlihat halaman _PAGE_ of _PAGES_",
                      "infoEmpty": "Tidak ada data di database"
                  }
             });
           
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