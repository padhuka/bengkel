                      <?php
                                    include_once '../../lib/config.php';
                                    include_once '../../lib/fungsi.php';
                                    $idpkb=$_GET['idpkb'];
                                    $sqlcatat = "SELECT * FROM t_pkb WHERE id_pkb='$idpkb'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
                      ?>
                      <div class="col-sm-12">
                       <table id="pkbshow" class="table table-condensed table-bordered table-striped table-hover">
                       <td >
                         <th class="col-sm-2">
                        <tr> 
                            <th>Nilai Panel</th><td><?php echo rupiah2($catat['total_gross_harga_panel']);?></td> 
                            <th>Disc</th><td ><?php echo rupiah2($catat['total_diskon_rupiah_panel']);?></td>
                            <th>Total Netto</th> <td><?php echo rupiah2($catat['total_netto_harga_panel']);?></td>
                        </tr>
                        
                        <tr> 
                          <th>Nilai Part</th><td><?php echo rupiah2($catat['total_gross_harga_part']);?></td>
                          <th>Disc</th> <td><?php echo rupiah2($catat['total_diskon_rupiah_part']);?></td>
                          <th>Total Netto</th> <td><?php echo rupiah2($catat['total_netto_harga_part']);?></td>
                        </tr>
                        <tr class="total"> 
                          <th>Total Gross</th><td><?php echo rupiah2($catat['total_gross_harga_jasa']);?></td>
                          <th>Total Diskon</th> <td><?php echo rupiah2($catat['total_diskon_rupiah_jasa']);?></td>
                          <th>Total Netto</th> <td><?php echo rupiah2($catat['total_netto_harga_jasa']);?></td>
                        </tr>

                        </th>
                       </td>
                      </table>
                           </div>