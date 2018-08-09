<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
		 //$ip = ; // Ambil IP Address dari User
		//$id_customer = trim($_POST['id_customer']);
        $namacustomer = trim($_POST['namacustomer']);
        $jeniskelamin = trim($_POST['jeniskelamin']);
        $alamatcustomer = trim($_POST['alamat']);
        $noktpcustomer = trim($_POST['no_ktp']);
        $telpcustomer = trim($_POST['no_telp']);
        $email = trim($_POST['email']);
        //message_back($id_customer);
		$hrn2= date('dmy' , strtotime($hrini));
        $kodeawal2 = 'CUST_BR.';
        $kodeawal = 'CUST_BR.'.$hrn2.'.';
        //$sqljur = "SELECT * FROM t_estimasi WHERE id_estimasi LIKE '$kodeawal%' ORDER BY id_estimasi DESC";
        $sqljur = "SELECT * FROM t_customer WHERE id_customer LIKE '$kodeawal2%' ORDER BY id_customer DESC";
        $resultjur = mysql_query( $sqljur );
        $jur = mysql_fetch_array( $resultjur );
        if (empty($jur['id_customer'])){
            $kodeakhir = '000001';
        }else{
            # GENERATE
            $kode = $jur['id_customer'];
            $pecah = explode('.',$kode);
            $nilbaru = $pecah[2] + 1;
            $panj = strlen($nilbaru);
            //message_back($panj);
            switch($panj){
                default : break;
                case '1' : $kodeakhir='00000'.$nilbaru; break;
                case '2' : $kodeakhir='0000'.$nilbaru; break;
                case '3' : $kodeakhir='000'.$nilbaru; break;
                case '4' : $kodeakhir='00'.$nilbaru; break;
                case '5' : $kodeakhir='0'.$nilbaru; break;
                case '6' : $kodeakhir=$nilbaru; break;
            }
        }
        
        $kodebaru = $kodeawal.$kodeakhir;     


        
		    $sqltbemp = "INSERT INTO t_customer (id_customer,nama,jenis_kelamin,alamat,no_ktp,no_telp,email) VALUES ('$kodebaru','$namacustomer','$jeniskelamin','$alamatcustomer','$noktpcustomer','$telpcustomer','$email')";
            mysql_query($sqltbemp);
?>