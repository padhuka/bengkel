<?php
        include_once '../../lib/config.php';
		 //$ip = ; // Ambil IP Address dari User
    
		$nomorhak = trim($_POST['nomorhak']);
		$jenishak = trim($_POST['jenishak']);
        $kabupaten = trim($_POST['kabupaten']);
        $kecamatan = trim($_POST['kecamatan']);
        $kelurahan = trim($_POST['kelurahan']);
        $photo = $_POST['filescanhid'];
        $photo2 = $_POST['filescanhid2'];
        $photo3 = $_POST['filescanhid3'];

        $id = trim($_POST['id']);
        //$noagendahid = trim($_POST['agendaold']);
        $filelama = trim($_POST['filescanold']);
        $filelama2 = trim($_POST['filescanold2']);
        $filelama3 = trim($_POST['filescanold3']);
		 #cek idsurat
        $sqlcek = "SELECT * FROM t_arsip WHERE nomorhak='$nomorhak' AND nomorhak<>'$nomorhak'";
        $qrycek = mysql_query($sqlcek);
        $row = mysql_fetch_array($qrycek);

        if ($row){
            //echo 'var obat=new Array("'.$row[kode].'","'.$nama.'","'.$harga.'","'.$row[ukuran].'","'.$stkisi.'","'.$stk.'","'.$carabayar.'","'.$byre.'","'.$jl.'");';
            //unlink('../../file/tmp/'.$photo);
            echo 'y';
        }else{
        	if ($photo){
	            //$nmlengkap=$nama_file_barutelp.$doc_hp;
		            if (is_file('../../file/tmp/'.$photo)) // Jika file tersebut ada
		             // Hapus file tersebut
		            //unlink('../file/'.$doc_hpold);//Hapus file lama
		            $source_file = '../../file/tmp/'.$photo;
		            $target_file = '../../file/'.$photo;
		            //move_uploaded_file($_FILES['filetelp']['tmp_name'],$target_file);
		            //move_uploaded_file($source_file,$target_file);
		            copy($source_file,$target_file);
		            unlink('../../file/tmp/'.$photo);
		            //copy($pathphoto,$target_file);
		            //unlink($pathphoto);
		            //message_back($nmlengkap);
		        }else{
		            $photo=$filelama;
		        }

		        if(!empty($_FILES['filescan2']['name'])){
			    $uploadedFile = '';
			        $fileName = $_FILES['filescan2']['name'];
			            $sourcePath = $_FILES['filescan2']['tmp_name'];
			            $targetPath = "../../file/tmp/".$fileName;
			            if(move_uploaded_file($sourcePath,$targetPath)){
			                $uploadedFile = $fileName;
			            }
			    
			}
				if ($photo2){
	            //$nmlengkap=$nama_file_barutelp.$doc_hp;
		            if (is_file('../../file/tmp/'.$photo2)) // Jika file tersebut ada
		             // Hapus file tersebut
		            //unlink('../file/'.$doc_hpold);//Hapus file lama
		            $source_file = '../../file/tmp/'.$photo2;
		            $target_file = '../../file/'.$photo2;
		            //move_uploaded_file($_FILES['filetelp']['tmp_name'],$target_file);
		            //move_uploaded_file($source_file,$target_file);
		            copy($source_file,$target_file);
		            unlink('../../file/tmp/'.$photo2);
		            //copy($pathphoto,$target_file);
		            //unlink($pathphoto);
		            //message_back($nmlengkap);
		        }else{
		            $photo2=$filelama2;
		        }

		        if(!empty($_FILES['filescan3']['name'])){
			    $uploadedFile = '';
			        $fileName = $_FILES['filescan3']['name'];
			            $sourcePath = $_FILES['filescan3']['tmp_name'];
			            $targetPath = "../../file/tmp/".$fileName;
			            if(move_uploaded_file($sourcePath,$targetPath)){
			                $uploadedFile = $fileName;
			            }
			    
			}
				if ($photo3){
	            //$nmlengkap=$nama_file_barutelp.$doc_hp;
		            if (is_file('../../file/tmp/'.$photo3)) // Jika file tersebut ada
		             // Hapus file tersebut
		            //unlink('../file/'.$doc_hpold);//Hapus file lama
		            $source_file = '../../file/tmp/'.$photo3;
		            $target_file = '../../file/'.$photo3;
		            //move_uploaded_file($_FILES['filetelp']['tmp_name'],$target_file);
		            //move_uploaded_file($source_file,$target_file);
		            copy($source_file,$target_file);
		            unlink('../../file/tmp/'.$photo3);
		            //copy($pathphoto,$target_file);
		            //unlink($pathphoto);
		            //message_back($nmlengkap);
		        }else{
		            $photo3=$filelama3;
		        }
		        $sqltbemp = "UPDATE t_arsip SET nomorhak='$nomorhak',jenishak='$jenishak',kabupaten='$kabupaten',kecamatan='$kecamatan',kelurahan='$kelurahan',bukutanah='$photo',suratukur='$photo2',warkah='$photo3' WHERE id='$id'";

        mysql_query($sqltbemp);
            echo 'n';
        }
?>