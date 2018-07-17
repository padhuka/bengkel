<?php
        include_once '../../lib/config.php';
		
		$idkec=$_POST['idkec'];
		$sqlcatat = "SELECT * FROM kelurahan WHERE idkec='$idkec' ORDER BY nmkel ASC";
        $rescatat = mysql_query( $sqlcatat );

        while($catat = mysql_fetch_array( $rescatat )){
        	 //$data[] =  $catat['nmkec'].' - '.$catat['idkec'];
            echo "<option value=".$catat['idkel'].">".$catat['nmkel']."</option>";
        }
         //return json data
    	//echo json_encode($data);

?>	

   