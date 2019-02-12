<!-- Left side column. contains the logo and sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Kode Surat
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Kode Surat</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title"></h3>
            </div>
             /.box-header -->
            <div class="box-body">
             <form enctype="multipart/form-data" method="post" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label">File Database (*.sql)</label>
								<div class="col-sm-7">
									<input type="text" name="nip" class="form-control" maxlength="12">
									<input type="file" name="datafile" size="30" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-7">
									<button type="submit" name="restore" class="btn btn-danger">Restore Database</button>
								</div>
							</div>
						</form>
						<?php
						if(isset($_POST['restore'])){
							$koneksi=mysql_connect($host,$user,$passsw);
							mysql_select_db($db,$koneksi);
							
							$nama_file=$_FILES['datafile']['name'];
							$ukuran=$_FILES['datafile']['size'];
							
							if ($nama_file==""){
								echo "Fatal Error";
							}
							else{
								//definisikan variabel file dan alamat file
								$uploaddir='../file/restore/';
								$alamatfile=$uploaddir.$nama_file;

								if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile)){
									$filename = '../file/restore/'.$nama_file.'';									
									$templine = '';
									$lines = file($filename);

									foreach ($lines as $line){
										if (substr($line, 0, 2) == '--' || $line == '')
											continue;
									 
										$templine .= $line;
										if (substr(trim($line), -1, 1) == ';'){
											mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
											$templine = '';
										}
									}
									echo "<center>Restore Database Telah Berhasil</center>";
								}
								else{
									echo "Restore Database Gagal, kode error = " . $_FILES['location']['error'];
								}	
							}

						}
						else{
							unset($_POST['restore']);
						}
						?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>