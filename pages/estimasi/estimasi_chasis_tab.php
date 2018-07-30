           <?php
            //include_once '../../lib/config.php';
          ?>

      <div id="ModalChasis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">          
      <div class="col-md-11">
                <div class="modal-content" style="border-radius:10px">
                    <div class="modal-header" style="padding: 8px;border-top-style: 5px">
                        
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Info Kendaraan</h4>                        
                    </div>

                  <div class="box box-info" style="border-top-color:#dd4b39; margin-bottom: 10px;">
              <table id="group1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No Chasis</th>
                          <th>No Mesin</th>
                          <th>No Polisi</th>
                          <th>Warna</th>
                          <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_inventory_bengkel ORDER BY no_chasis ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                    	$qwrn= mysql_query("SELECT * FROM t_warna_kendaraan WHERE id_warna_kendaraan='$catat[fk_warna_kendaraan]'");
                                    	$swrn= mysql_fetch_array($qwrn);
                                ?>
                        <tr>
                          <td ><?php echo $catat['no_chasis'];?></td>
                          <td ><?php echo $catat['no_mesin'];?></td>
                          <td ><?php echo $catat['no_polisi'];?></td>
                          <td ><?php echo $swrn['nama'];?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" onclick="pilih('<?php echo $catat['no_chasis'];?>','<?php echo $catat['no_mesin'];?>','<?php echo $catat['no_polisi'];?>','<?php echo $swrn['id_warna_kendaraan'];?>','<?php echo $swrn['nama'];?>','<?php echo $catat['fk_customer'];?>');">Pilih</button>
                                    </td>
                          <td>

                        </tr>
                    <?php }?>
                        <tr><td colspan="5"><button type="button" class="btn btn-primary" onclick="$('#ModalChasis').modal('hide');">&nbsp;Close&nbsp;</button></td></td></tr>
                </tfoot>
              </table>
              </div>
              </div>
              </div>
              </div>
              </div>
              <script type="text/javascript">
                $('#group1').DataTable();
                function pilih(a,b,c,d,e,f){
                              $("#chasis").val(a);
                              $("#mesin").val(b);
                              $("#polisi").val(c);
                              $("#warna").val(d);
                              $("#warnanm").val(e);
                              $("#customer").val(f);
                              $("#ModalChasis").modal('hide');
                              /*$.ajax({
                              url: "suratmasuk/suratmasuk_add.php",
                              type: "GET",
                                success: function (ajaxData){
                                  $("#ModalAdd").html(ajaxData);
                                  $("#ModalAdd").modal('show',{backdrop: 'true'});
                                }
                              });*/
                      }; 
              </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font 
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
        <!-- jQuery 3 -->
