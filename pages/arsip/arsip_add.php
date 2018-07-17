<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';    	
   ?>
    <style>      
            .ui-autocomplete {
                position: absolute;
                z-index: 1000;
                cursor: default;
                padding: 0;
                margin-top: 2px;
                list-style: none;
                background-color: #ffffff;
                border: 1px solid #ccc;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            }
            .ui-autocomplete > li {
                padding: 3px 10px;
            }
            .ui-autocomplete > li.ui-state-focus {
                background-color: #3399FF;
                color:#ffffff;
            }
            
        </style>
<div class="modal-dialog">
			<div class="col-md-11">
                 <div class="modal-content" style="border-radius:10px">
                    <div class="modal-header" style="padding: 8px;border-top-style: 5px">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">Tambah Data Arsip</h4>                        
                    </div>

				         <div class="box box-info" style="border-top-color:#dd4b39">
				            <!--<div class="box-header with-border">
				              <h3 class="box-title">Horizontal Form</h3>
				            </div>
				             /.box-header -->
				            <!-- form start -->
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="fupForm">
				              <div class="box-body">
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Nomor Hak</label>
				                  <div class="col-sm-8">
				                    <input type="text" class="form-control" id="nomorhak" name="nomorhak">
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Jenis Hak</label>
				                  <div class="col-sm-8">
				                  	<select id="jenishak" name="jenishak">
				                  		<option value="HM (Hak Milik)">HM (Hak Milik)</option>
				                  		<option value="HGB (Hak Guna Bangunan)">HGB (Hak Guna Bangunan)</option>
				                  		<option value="HP (Hak Pakai)">HP (Hak Pakai)</option>
				                  		<option value="HGU (Hak Guna Usaha)">HGU (Hak Guna Usaha)</option>
										<option value="HPL (Hak Pengelolaan)">HPL (Hak Pengelolaan)</option>
				                  	</select>				                    
				                  </div>
				                </div>
				                 <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Kabupaten</label>
				                  <div class="col-sm-8">

				                  	<?php 	$sqlkab="SELECT * FROM kabupaten ORDER BY nmkab";
				                  			$qry= mysql_query($sqlkab);
				                  	?>
				                  		<select id="kabupaten" name="kabupaten">
				                  			<option value="">-Pilih Kabupaten-</option>
				                  			<?php while($hslkab = mysql_fetch_array($qry)){
				                  			?>
				                  			<option value="<?php echo $hslkab['idkab']?>"><?php echo $hslkab['nmkab'];?></option>
				                  			<?php }?>
				                  		</select>
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Kecamatan</label>
				                  <div class="col-sm-8">
				                    	<select id="kecamatan" name="kecamatan">
				                    		
				                    	</select>
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Kelurahan</label>
				                  <div class="col-sm-8">
				                    <select id="kelurahan" name="kelurahan">
				                    		
				                    	</select>
				                  </div>
				                </div>			
				               
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Buku Tanah</label>
				                  <div class="col-sm-8">
				                    <input type="file" class="form-control" id="filescan" name="filescan">
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Surat Tanah</label>
				                  <div class="col-sm-8">
				                    <input type="file" class="form-control" id="filescan2" name="filescan2">
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label">Warkah</label>
				                  <div class="col-sm-8">
				                    <input type="file" class="form-control" id="filescan3" name="filescan3">
				                  </div>
				                </div>								
				                <div class="form-group">
				                  <label for="inputEmail3" class="col-sm-4 control-label"></label>
				                  <div class="col-sm-8">
				                  	<input type="hidden" id="filescanhid"  name="filescanhid">
				                  	<input type="hidden" id="filescanhid2"  name="filescanhid2">
				                  	<input type="hidden" id="filescanhid3"  name="filescanhid3">
				                  	<input type="hidden" id="asalsurathid"  name="asalsurathid">
				                  	<input type="hidden" id="disposisi"  name="disposisi">
				                    <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">&nbsp;Batal&nbsp;</button>
				                  </div>
				                </div>

				              </div>
				            </form>
				          </div>
				</div>
			</div>
			
</div>
<script type="text/javascript">

	
	$(document).ready(function (){
						
					$('#kabupaten').change(function(){
						var idkab = $('#kabupaten').val();
						$('#kelurahan').html('');
						//alert(idkab);
							$.ajax({
								type:'POST',
								url: 'arsip/kecamatan.php',
								data: 'idkab='+idkab,
								success: function(response){
									$('#kecamatan').html(response);
								}
							});
					});


					$('#kecamatan').change(function(){
						var idkec = $('#kecamatan').val();
						//alert(idkab);
							$.ajax({
								type:'POST',
								url: 'arsip/kelurahan.php',
								data: 'idkec='+idkec,
								success: function(response){
									$('#kelurahan').html(response);
								}
							});
					});
						
                      document.getElementById("filescan").addEventListener("change", 
                      function () {
                           var ph= document.getElementById('filescan').files[0].name;
                          $("#filescanhid").val(ph);
                      });

                       document.getElementById("filescan2").addEventListener("change", 
                      function () {
                           var ph= document.getElementById('filescan2').files[0].name;
                          $("#filescanhid2").val(ph);
                      });

                        document.getElementById("filescan3").addEventListener("change", 
                      function () {
                           var ph= document.getElementById('filescan3').files[0].name;
                          $("#filescanhid3").val(ph);
                      });

                      $("#fupForm").on('submit', function(e){
                          e.preventDefault();
                          var idkel = $('#kelurahan').val();
                          /*var idkec = $('#kecamatan').val();
                          var idkab = $('#kabupaten').val();
                          alert(idkab+' '+idkec+' '+idkel);*/
                          //alert(idkel);
                          //return false;
                            //alert(disposisine)                       ;
                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'arsip/arsip_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){                              
                                                        //alert('lolos');
                                                        var hsl=data.trim();
                                                        //alert(hsl);
                                                        if (hsl=='y'){
			                                                alert('Data Sudah ada');  
			                                                return false;
			                                                exit();
			                                            }else{
			                                            	
			                                                $("#tabele").load('arsip/arsip_load.php');
                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalAdd').modal('hide');
			                                            }   
                                                      }
                                                });
                      });
    });
	
					

</script>