<?php
        include_once '../../lib/config.php';
		
		$idkab=$_POST['idkab'];
		$sqlcatat = "SELECT * FROM kecamatan WHERE idkab='$idkab' ORDER BY nmkec ASC";
        $rescatat = mysql_query( $sqlcatat );
        echo "<option>-pilih kecamatan-</option>";
        while($catat = mysql_fetch_array( $rescatat )){
        	 //$data[] =  $catat['nmkec'].' - '.$catat['idkec'];
            echo "<option value=".$catat['idkec'].">".$catat['nmkec']."</option>";
        }
         //return json data
    	//echo json_encode($data);

?>	

   