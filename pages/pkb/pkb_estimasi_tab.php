  <?php
  
    include_once '../../lib/fungsi.php';

   ?>
     <div id="ModalEstimasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
      <div class="col-md-14">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Estimasi <button type="button" class="close" aria-label="Close" onclick="$('#ModalEstimasi').modal('hide');"><span>&times;</span></button></h4>
                    </div>
                  <div class="box">
                <table id="estimasipkb" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No Estimasi</th>
                          <th>No Chasis</th>
                          <th>No Mesin</th>
                          <th>No Polisi</th>
                          <th></th>
                </tr>
                </thead>
                <tbody>
                                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT e.*,c.* FROM t_estimasi e 
                                     LEFT JOIN t_customer c ON e.fk_customer=c.id_customer 
                                     LEFT JOIN (SELECT * from t_pkb where tgl_batal='0000-00-00 00:00:00') as p ON e.id_estimasi=p.fk_estimasi
                                     WHERE e.tgl_batal='0000-00-00 00:00:00' AND e.approved='1' AND p.fk_estimasi IS NULL ";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><button type="button" class="btn btn-link" id="<?php echo $catat['id_estimasi']; ?>" onclick="open_est(idestimasi='<?php echo $catat['id_estimasi']; ?>');"><span><?php echo $catat['id_estimasi'];?></span></button></td>
                          <td ><?php echo $catat['fk_no_chasis'];?></td>
                          <td ><?php echo $catat['fk_no_mesin'];?></td> 
                          <td ><?php echo $catat['fk_no_polisi'];?></td>
                          <td >
                            <button type="button" class="btn btn btn-default btn-circle" onclick="selectEstimasi('<?php echo date('d-m-Y' , strtotime($catat['tgl']));?>','<?php echo $catat['fk_no_chasis'];?>','<?php echo $catat['fk_no_mesin'];?>','<?php echo $catat['fk_no_polisi'];?>','<?php echo $catat['nama'];?>','<?php echo $catat['kategori'];?>','<?php echo $catat['km_masuk'];?>','<?php echo $catat['fk_asuransi'];?>','<?php echo $catat['no_telp'];?>','<?php echo rupiah2($catat['total_gross_harga_panel']);?>','<?php echo rupiah2($catat['total_diskon_rupiah_panel']);?>','<?php echo rupiah2($catat['total_netto_harga_panel']);?>','<?php echo rupiah2($catat['total_gross_harga_part']);?>','<?php echo rupiah2($catat['total_diskon_rupiah_part']);?>','<?php echo rupiah2($catat['total_netto_harga_part']);?>','<?php echo rupiah2($catat['total_gross_harga_jasa']);?>','<?php echo rupiah2($catat['total_diskon_rupiah_jasa']);?>','<?php echo rupiah2($catat['total_netto_harga_jasa']);?>','<?php echo $catat['id_estimasi'];?>');">Pilih</button>
                          </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script type="text/javascript">
                $('#estimasipkb').DataTable();

               function selectEstimasi(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s){
                              $("#tgl").html(a);
                              $("#chasis").html(b);
                              $("#mesin").html(c);
                              $("#polisi").html(d);
                              $("#nama").html(e);
                              $("#kategori").html(f);                              
                              $("#kmmasuk").html(g);
                              $("#asuransi").html(h);
                              $("#telp").html(i);
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
                              //-----
                              $("#idestimasi").val(s);
                              $("#ModalEstimasi").modal('hide');
                              
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

