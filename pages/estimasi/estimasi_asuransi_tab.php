            <div id="ModalAsuransi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">          
      <div class="col-md-11">
                <div class="modal-content" style="border-radius:10px">
                    <div class="modal-header" style="padding: 8px;border-top-style: 5px">                        
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Info Kendaraan</h4>                        
                    </div>
              <div class="box">
              <table id="tableasuransi" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Kode Asuransi</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>No Telp</th>
                          <th>NPWP</th>
                          <th><button type="button" class="btn btn btn-default btn-circle open_add"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_asuransi ORDER BY id_asuransi ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['id_asuransi'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['alamat'];?></td>
                          <td ><?php echo $catat['no_telp'];?></td>
                          <td ><?php echo $catat['npwp'];?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" onclick="pilih('<?php echo $catat['no_chasis'];?>','<?php echo $catat['no_mesin'];?>','<?php echo $catat['no_polisi'];?>','<?php echo $swrn['id_warna_kendaraan'];?>','<?php echo $swrn['nama'];?>','<?php echo $catat['fk_customer'];?>');">Pilih</button>
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
                $('#tableasuransi').DataTable();
                function pilih(a,b,c,d,e,f){
                              $("#chasis").val(a);
                              $("#mesin").val(b);
                              $("#polisi").val(c);
                              $("#warna").val(d);
                              $("#warnanm").val(e);
                              $("#customer").val(f);
                              $("#ModalAsuransi").modal('hide');
                            
                      }; 
              </script>