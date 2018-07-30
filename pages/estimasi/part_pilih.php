           <?php
            include_once '../../lib/config.php';
          ?>

      <div id="ModalPilihPart" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">          
      <div class="col-md-11">
                <div class="modal-content" style="border-radius:10px">
                    <div class="modal-header" style="padding: 8px;border-top-style: 5px">
                        
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data part</h4>                        
                    </div>

                  <div class="box box-info" style="border-top-color:#dd4b39; margin-bottom: 10px;">
              <table id="partestimasi" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Kode part</th>
                          <th>Nama</th>
                          <th>Harga Pokok</th>
                          <th>Harga Jual</th>
                          <th>Diskon</th>
                          <th>PPN</th>
                          <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_part ORDER BY id_part ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                      $diskon= ($catat['diskon']/100)*$catat['harga_jual'];
                                      //$ppn= ($catat['ppn']/100)*$catat['harga_jual'];
                                      $hartot= $catat['harga_jual']-$diskon;
                                ?>
                        <tr>
                          <td><?php echo $catat['id_part'];?></td>
                          <td><?php echo $catat['nama'];?></td>
                          <td><?php echo $catat['harga_beli'];?></td>
                          <td><?php echo $catat['harga_jual'];?></td>
                          <td><?php echo $catat['diskon'];?></td>
                          <td><?php echo $catat['ppn'];?></td>
                          <td>
                                        <button type="button" class="btn btn btn-default btn-circle" onclick="pilihparte('<?php echo $catat['id_part'];?>','<?php echo $catat['nama'];?>','<?php echo $catat['harga_jual'];?>','<?php echo $hartot;?>','<?php echo $catat['diskon'];?>');">Pilih</button>

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
                $('#partestimasi').DataTable();
                function pilihparte(a,b,c,d,e){
                              $("#part").val(a);
                              $("#partnm").val(b);
                              $("#hargapokok").val(c);
                              $("#hargatotal").val(d);                              
                              $("#diskon").val(e);
                              $("#qty").val('1');           
                              $("#ModalPilihPart").modal('hide');
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
