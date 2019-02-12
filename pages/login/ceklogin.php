<?php
session_start();
include_once '../../lib/config.php';
include_once '../../lib/fungsi.php';

# CEK KODE
/*$kode = $_SESSION['kodecap'];
if($_POST['txt_kode']!=$kode){
		message_back('KODE SALAH');
}else{
*/	
	
	$idne = nosql($_POST['txt_username']);
	$passworde = nosql(md5($_POST['txt_password']));
	//message_back($passworde);
	
	/*
	echo $idne;
	echo $passworde;
	*/
	$sql = "SELECT * FROM t_user WHERE username='$idne' AND password='$passworde'";
	//message_back($sql);
    $res = mysql_query( $sql );
    if ($res === FALSE) {
    	die(mysql_error());
	}

    $rs = mysql_fetch_array($res);
	//message_back($sql);
	if(empty($rs['username']))
    {
        echo 'y';
    }
    else
    {
		$_SESSION['sesiuidbpn']=$rs['username'];
		$_SESSION['lvl']=$rs['level'];	

		echo 'n';

        //url_back('../index.php');
    }
/*}*/
?>