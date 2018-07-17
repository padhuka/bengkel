			<?php
        		include_once '../../lib/config.php';
        	?>
			<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  		  <th>No Hak</th>
                          <th>Jenis Tanah</th>
                          <th>Kelurahan</th>
                          <th>Kecamatan</th>
                          <th>Kabupaten</th>
                          <th>Buku Tanah</th>
                          <th>Surat Ukur</th>
                          <th>Warkah</th>
                          <th><button type="button" class="btn btn btn-default btn-circle open_add"><span class="glyphicon glyphicon-plus"></span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_arsip ORDER BY id ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                      //kab
                                      $sqlkab="SELECT * FROM kelurahan A, kecamatan B, kabupaten C WHERE A.idkel='$catat[kelurahan]' AND A.idkec=B.idkec AND B.idkab=C.idkab";
                                      $hslkab= mysql_fetch_array(mysql_query($sqlkab));
                                      
                                ?>
                        <tr>
                          <td><?php echo $catat['nomorhak'];?></td>
                          <td><?php echo $catat['jenishak'];?></td>
                          <td><?php echo $hslkab['nmkel'];?></td>
                          <td><?php echo $hslkab['nmkec'];?></td>
                          <td><?php echo $hslkab['nmkab'];?></td>
                          <td><span onclick="pdfe('<?php echo substr($catat['bukutanah'],0,-
                          4);?>','<?php echo substr($catat['bukutanah'],
                          -4);?>');"  onMouseOver="this.style.cursor='pointer'"><?php echo $catat['bukutanah'];?></span></td>
                          <td><span onclick="pdfe('<?php echo substr($catat['suratukur'],0,-
                          4);?>','<?php echo substr($catat['suratukur'],
                          -4);?>');"  onMouseOver="this.style.cursor='pointer'"><?php echo $catat['suratukur'];?></span></td>
                          <td><span onclick="pdfe('<?php echo substr($catat['warkah'],0,-
                          4);?>','<?php echo substr($catat['warkah'],
                          -4);?>');"  onMouseOver="this.style.cursor='pointer'"><?php echo $catat['warkah'];?></span></td>
                          <td>                                       
                                       
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id']; ?>" onclick="open_modal(idedit=<?php echo $catat['id']; ?>);"><span class="glyphicon glyphicon-pencil"></span></button>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['id']; ?>" onclick="open_del(iddel=<?php echo $catat['id']; ?>);"><span class="glyphicon glyphicon-remove"></span></button>

                                    </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              
              <script>
              /*var tbl = document.getElementById("example1");

                if (tbl != null) {
                            for (var i = 0; i < tbl.rows.length; i++) {
                                for (var j = 0; j < tbl.rows[i].cells.length; j++)
                                    tbl.rows[i].cells[j].onclick = function () { getval(this); };
                            }
                        }        
                        function getval(cel) {
                            //alert(cel.innerHTML);
                            var w = window.open('../file/'+cel.innerHTML);
                        } */
			       $('#example1').DataTable();

            function pdfe(x,y){
                //alert(x);
                $.ajax({
                    url: "suratmasuk/suratmasuk_pdf.php?id="+x+''+y,
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalPdf").html(ajaxData);
                        $("#ModalPdf").modal('show',{backdrop: 'true'});
                      }
                    });
            }; 

  			    $(".open_add").click(function (e){
  					                    //var m = $(this).attr("id");
  					        $.ajax({
  					        url: "arsip/arsip_add.php",
  					        type: "GET",
  				            success: function (ajaxData){
  				            	$("#ModalAdd").html(ajaxData);
  				            	$("#ModalAdd").modal('show',{backdrop: 'true'});
  				            }
  				          });
  				  }); 
            function open_del(){
                                $.ajax({
                                    url: "arsip/arsip_del.php?id="+iddel,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal('show',{backdrop: 'true'});
                                    }
                                });
            }; 	

           function open_modal(){
                              $.ajax({
                                  url: "arsip/arsip_edit.php?id="+idedit,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalEdit").html(ajaxData);
                                      $("#ModalEdit").modal('show',{backdrop: 'true'});
                                  }
                              });
            };	

			</script>