<?php
        include_once '../../lib/config.php';
        include_once '../../lib/fungsi.php';
      
        $no_bukti = trim($_GET['no_bukti']);
        $fk_akun = trim($_GET['fk_akun']);
        $ref_akun = trim($_GET['ref_akun']); 
        $nominal = trim($_GET['amount']);  
        $amount= str_replace(".", "", $nominal); 
        $description = trim($_GET['description']); 
        $transaction_type=trim($_GET['transaction_type']);
        $tr_date = trim($_GET['tr_date']);
       
       $updateEs = "UPDATE t_acc_bank SET fk_akun='$fk_akun',ref_akun='$ref_akun',amount='$amount',description='$description',transaction_type='$transaction_type',tr_date='$tr_date'WHERE no_bukti='$no_bukti'";
        mysql_query($updateEs);
        
        
?>