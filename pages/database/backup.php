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
			error_reporting(0);
			//date_default_timezone_set("ASIA/JAKARTA");
			function backup_tables($host,$user,$pass,$name,$nama_file,$tables = '*')
			{
				//untuk koneksi database
				$link = mysql_connect($host,$user,$pass);
				mysql_select_db($name,$link);
				
				if($tables == '*')
				{
					$tables = array();
					$result = mysql_query('SHOW TABLES');
					while($row = mysql_fetch_row($result))
					{
						$tables[] = $row[0];
					}
				}else{
					//jika hanya table-table tertentu
					$tables = is_array($tables) ? $tables : explode(',',$tables);
				}
				
				//looping dulu ah
				foreach($tables as $table)
				{
					$result = mysql_query('SELECT * FROM '.$table);
					$num_fields = mysql_num_fields($result);
					
					//menyisipkan query drop table untuk nanti hapus table yang lama
					$return.= 'DROP TABLE '.$table.';';
					$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
					$return.= "\n\n".$row2[1].";\n\n";
					
					for ($i = 0; $i < $num_fields; $i++) 
					{
						while($row = mysql_fetch_row($result))
						{
							//menyisipkan query Insert. untuk nanti memasukan data yang lama ketable yang baru dibuat. so toy mode : ON
							$return.= 'INSERT INTO '.$table.' VALUES(';
							for($j=0; $j<$num_fields; $j++) 
							{
								//akan menelusuri setiap baris query didalam
								$row[$j] = addslashes($row[$j]);
								$row[$j] = ereg_replace("\n","\\n",$row[$j]);
								if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
								if ($j<($num_fields-1)) { $return.= ','; }
							}
							$return.= ");\n";
						}
					}
					$return.="\n\n\n";
				}
				
				//simpan file di folder yang anda tentukan sendiri. kalo saya sech folder "DATA"
				//$nama_file;
				$d= date("d-m-Y-h-i-s");
				//echo $d;
				$handle = fopen('../file/backup/db_bpn-'.$d.'.sql','w+');
				//$handle = fopen('./file/tmp/'.$nama_file,'w+');
				fwrite($handle,$return);
				fclose($handle);
			}
			$d= date("d-m-Y-h-i-s");			
			$file='../file/backup/db_bpn-'.$d.'.sql';
			//panggil fungsi dengan memberi parameter untuk koneksi dan nama file untuk backup
			$a = backup_tables($host,$user,$passsw,$db,$file);
			//exit;
			?>

			<p align="center">Backup database telah berhasil !</p><br />
						<p align="center"><a style="cursor:pointer" onclick="location.href='<?php echo $file?>'" title="Download">Download file database</a></p>
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
