<?php
	include_once 'setting.php';
	$objConn = mysql_connect("{$host}", "{$user}", "{$passsw}");
	mysql_select_db( "{$db}", $objConn );
	date_default_timezone_set('Asia/Jakarta');
	$hrini = date('Y-m-d H:i:s');
	$tahunnow = date('Y');
	$harinow = date('Y-m-d');
?>
