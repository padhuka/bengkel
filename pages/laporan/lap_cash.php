			<?php
        		include_once '../../lib/config.php';
        	?>
          <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
			<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  		    <th>No Hak</th>
                          <th>Jenis Tanah</th>
                          <th>Kelurahan</th>
                          <th>Kecamatan</th>
                          <th>Kabupaten</th>           
                </tr>
                </thead>
                <tbody>
                <?php
                                    if (isset($_GET['tgl'])){
                                      $tgl1=$_GET['tgl'];  
                                    }
                                     if (isset($_GET['tgl2'])){
                                      $tgl2=$_GET['tgl2'];  
                                    }

                                    if (isset($tgl1) AND isset($tgl2)){
                                        $sqlcatat = "SELECT * FROM t_arsip WHERE tgl_surat>='$tgl1' AND  tgl_surat<='$tgl2' ORDER BY id ASC";
                                      }else{
                                        $sqlcatat = "SELECT * FROM t_arsip ORDER BY id ASC";
                                    }
                                    $j=1;
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                        $sqlkab="SELECT * FROM kelurahan A, kecamatan B, kabupaten C WHERE A.idkel='$catat[kelurahan]' AND A.idkec=B.idkec AND B.idkab=C.idkab";
                                      $hslkab= mysql_fetch_array(mysql_query($sqlkab));
                                ?>
                        <tr>
                          <td><?php echo $catat['nomorhak'];?></td>
                          <td><?php echo $catat['jenishak'];?></td>
                          <td><?php echo $hslkab['nmkel'];?></td>
                          <td><?php echo $hslkab['nmkec'];?></td>
                          <td><?php echo $hslkab['nmkab'];?></td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <div id="tbl">
              <table>
                <thead>
                <tr>
                          <<th>No Hak</th>
                          <th>Jenis Tanah</th>
                          <th>Kelurahan</th>
                          <th>Kecamatan</th>
                          <th>Kabupaten</th>                        
                </tr>
                </thead>
                <tbody>
                <?php
                                    if (isset($_GET['tgl'])){
                                      $tgl1=$_GET['tgl'];  
                                    }
                                     if (isset($_GET['tgl2'])){
                                      $tgl2=$_GET['tgl2'];  
                                    }

                                    if (isset($tgl1) AND isset($tgl2)){
                                        $sqlcatat = "SELECT * FROM t_arsip WHERE tgl_surat>='$tgl1' AND  tgl_surat<='$tgl2' ORDER BY id ASC";
                                      }else{
                                        $sqlcatat = "SELECT * FROM t_arsip ORDER BY id ASC";
                                    }
                                    $j=1;
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                        $sqlkab="SELECT * FROM kelurahan A, kecamatan B, kabupaten C WHERE A.idkel='$catat[kelurahan]' AND A.idkec=B.idkec AND B.idkab=C.idkab";
                                      $hslkab= mysql_fetch_array(mysql_query($sqlkab));
                                ?>
                        <tr>
                         <td><?php echo $catat['nomorhak'];?></td>
                          <td><?php echo $catat['jenishak'];?></td>
                          <td><?php echo $hslkab['nmkel'];?></td>
                          <td><?php echo $hslkab['nmkec'];?></td>
                          <td><?php echo $hslkab['nmkab'];?></td>                  
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
      </div>
              <script>
              $('#tbl').hide();
			  $(document).ready(function(){
			       $('#example1').DataTable();
			  });

         function ekspor(){//table_search                
                window.open('data:application/vnd.ms-excel,' + $('#tbl').html());
                e.preventDefault();
            }
			</script>