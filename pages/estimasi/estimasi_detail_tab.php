		      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>

        <table id="estimasixx2" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Item</th>
                          <th>Gros</th>
                          <th>Disc</th>
                          <th>Netto</th>                          
                </tr>
                </thead>
                <tbody>  
                <?php 
                  $idestimasi= $_GET['idestimasi'];
                  $sqlest= "SELECT * FROM t_estimasi WHERE id_estimasi = '$idestimasi'";
                  $hest= mysql_fetch_array(mysql_query($sqlest));
                ?>              
                        <tr>
                          <td>Part</td>
                          <td><?php echo rupiah2($hest['total_gross_harga_part']);?></td>
                          <td><?php echo rupiah2($hest['total_diskon_rupiah_part']);?></td>
                          <td><?php echo rupiah2($hest['total_netto_harga_part']);?></td>
                        </tr>
                        <tr>
                          <td>Panel</td>
                          <td><?php echo rupiah2($hest['total_gross_harga_panel']);?></td>
                          <td><?php echo rupiah2($hest['total_diskon_rupiah_panel']);?></td>
                          <td><?php echo rupiah2($hest['total_netto_harga_panel']);?></td>
                        </tr>                    	
                </tfoot>
              </table>
              <script>
            $('#estimasixx').DataTable();
        </script>