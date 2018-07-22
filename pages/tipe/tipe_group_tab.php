           <?php
            //include_once '../../lib/config.php';
          ?>

      <div id="ModalGroup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">          
      <div class="col-md-11">
                <div class="modal-content" style="border-radius:10px">
                    <div class="modal-header" style="padding: 8px;border-top-style: 5px">
                        
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Data Group Kendaraan</h4>                        
                    </div>

                  <div class="box box-info" style="border-top-color:#dd4b39; margin-bottom: 10px;">
              <table id="group1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>Kode Group</th>
                          <th>Nama</th>
                          <th><button type="button" class="btn btn btn-default btn-circle open_add"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_group_kendaraan ORDER BY id_group_kendaraan ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['id_group_kendaraan'];?></td>
                          <td ><?php echo $catat['nama'];?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" onclick="pilih('<?php echo $catat['id_group_kendaraan'];?>','<?php echo $catat['nama'];?>');">Pilih</button>

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
                $('#group1').DataTable();
                function pilih(x,y){
                              $("#group").val(x);
                              $("#groupnm").val(y);
                              $("#ModalGroup").modal('hide');
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
