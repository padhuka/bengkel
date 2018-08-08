    <?php
    include_once '../../lib/fungsi.php';
   ?>
     <div id="ModalPkb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
      <div class="col-md-14">
                <div class="modal-content">
                    <div class="modal-header">
                         
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data PKB <button type="button" class="close" aria-label="Close" onclick="$('#ModalPkb').modal('hide');"><span>&times;</span></button></h4>                        
                    </div>

                  <div class="box">
                <table id="pkbwitansi" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No PKB</th>
                          <th>Nama Customer</th>
                          <th>No Chasis</th>
                          <th>No Mesin</th>
                          <th>No Pol</th>
                          <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                   $j=1;
                                   $sqlcatat = "SELECT * FROM t_pkb e LEFT JOIN t_customer c ON e.fk_customer=c.id_customer WHERE tgl_batal='0000-00-00 00:00:00' AND e.status_pkb='Tutup' ORDER BY e.id_pkb DESC";
                                   $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><button type="button" class="btn btn-link" id="<?php echo $catat['id_pkb']; ?>" onclick="open_pkb(idpkb='<?php echo $catat['id_pkb']; ?>');"><span><?php echo ($catat['id_pkb']);?></span></button></td>
                       
                          <td ><?php echo $catat['nama'];?></td>
                          <td ><?php echo $catat['fk_no_chasis'];?></td>
                          <td ><?php echo $catat['fk_no_mesin'];?></td>
                          <td ><?php echo $catat['fk_no_polisi'];?></td>
                       
                          <td >
                                       
                                        <button type="button" class="btn btn btn-default btn-circle" onclick="selectPKB(
                                        '<?php echo $catat['fk_no_chasis'];?>',
                                        '<?php echo $catat['fk_no_mesin'];?>',
                                        '<?php echo $catat['fk_no_polisi'];?>',
                                        '<?php echo $catat['nama'];?>',
                                        '<?php echo $catat['kategori'];?>',
                                        '<?php echo $catat['fk_asuransi'];?>',
                                        '<?php echo rupiah2($catat['total_gross_harga_panel']);?>',
                                        '<?php echo rupiah2($catat['total_diskon_rupiah_panel']);?>',
                                        '<?php echo rupiah2($catat['total_netto_harga_panel']);?>',
                                        '<?php echo rupiah2($catat['total_gross_harga_part']);?>',
                                        '<?php echo rupiah2($catat['total_diskon_rupiah_part']);?>',
                                        '<?php echo rupiah2($catat['total_netto_harga_part']);?>',
                                        '<?php echo rupiah2($catat['total_gross_harga_jasa']);?>',
                                        '<?php echo rupiah2($catat['total_diskon_rupiah_jasa']);?>',
                                        '<?php echo rupiah2($catat['total_netto_harga_jasa']);?>',
                                         '<?php echo $catat['id_pkb'];?>'
                                        );">Pilih</button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script type="text/javascript">
                $('#pkbwitansi').DataTable();

               function selectPKB(b,c,d,e,f,h,j,k,l,m,n,o,p,q,r,s){
                              $("#chasis").html(b);
                              $("#mesin").html(c);
                              $("#polisi").html(d);
                              $("#nama").html(e);
                              $("#kategori").html(f);                              
                              $("#asuransi").html(h);
                              //--
                              $("#grosspanel").html(j);
                              $("#diskonpanel").html(k);
                              $("#nettopanel").html(l);
                              //--
                              $("#grosspart").html(m);
                              $("#diskonpart").html(n);
                              $("#nettopart").html(o);
                              //---
                              $("#grosstotal").html(p);
                              $("#diskontotal").html(q);
                              $("#nettototal").html(r);

                              $("#idpkb").val(s);
                              $("#ModalPkb").modal('hide');
                              
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

