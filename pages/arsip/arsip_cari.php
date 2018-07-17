<?php
        include_once '../../lib/config.php';
		
		$term=$_GET['term'];
		$sqlcatat = "SELECT * FROM t_pengirim WHERE (kode LIKE '%".$term."%') OR (nama LIKE '%".$term."%') ORDER BY kode ASC";
        $rescatat = mysql_query( $sqlcatat );
        while($catat = mysql_fetch_array( $rescatat )){
        	 $data[] =  $catat['nama'].' - '.$catat['kode'];
        }
         //return json data
    	echo json_encode($data);

?>	

   