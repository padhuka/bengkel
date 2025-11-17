<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	include_once 'setting.php';

	// Create mysqli connection
	$objConn = mysqli_connect("{$host}", "{$user}", "{$passsw}", "{$db}");

	// Check connection
	if (!$objConn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	date_default_timezone_set('Asia/Jakarta');
	$hrini = date('Y-m-d H:i:s');
	$tahunnow = date('Y');
	$harinow = date('Y-m-d');
?>
