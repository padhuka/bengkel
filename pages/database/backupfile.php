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
				              <?php
				/*
				 * PHP: Recursively Backup Files & Folders to ZIP-File
				 * MIT-License - 2012-2018 Marvin Menzerath
				*/
				// Make sure the script can handle large folders/files
				ini_set('max_execution_time', 600);
				ini_set('memory_limit', '1024M');
				// Start the backup!
				//zipData('../path/to/folder', '/path/to/backup.zip');
				$d= date("d-m-Y-h-i-s");
				$file='../file/backupfile/backup-'.$d.'.zip';
				zipData('../file',$file);?>
				<p align="center">Backup File telah berhasil !</p><br />
						<p align="center"><a style="cursor:pointer" onclick="location.href='<?php echo $file?>'" title="Download">Download file database</a></p>
				<?php
				// Here the magic happens :)
				function zipData($source, $destination) {
					if (extension_loaded('zip')) {
						if (file_exists($source)) {
							$zip = new ZipArchive();
							if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
								$source = realpath($source);
								if (is_dir($source)) {
									$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST);
									foreach ($files as $file) {
										$file = realpath($file);
										if (is_dir($file)) {
											$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
										} else if (is_file($file)) {
											$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
										}
									}
								} else if (is_file($source)) {
									$zip->addFromString(basename($source), file_get_contents($source));
								}
							}
							return $zip->close();
						}
					}
					return false;
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
