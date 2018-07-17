<?php
session_start();
include_once '../lib/config.php';
include_once '../lib/fungsi.php';
//$sesiuidsfa = $_SESSION['sesiuidsfa'];
//$setUser = $_SESSION['lvl'];
if (empty($_SESSION['sesiuidbpn']) && empty($_SESSION['lvl'])){
	url_back('login.php');
}
$seskdlvl = $_SESSION['lvl'];
/*if(!empty($_SESSION['cluterq'])){
	$seskdcluster = $_SESSION['cluterq'];
}*/
//echo $seskdlvl;
?>