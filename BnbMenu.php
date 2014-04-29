<?php
	session_start ();
    header("Content-Type:text/html; charset=utf-8");
	include_once 'Login/SessionCheck.php';
	// include_once 'Lib/com/DefSet.php';
	include_once 'lib/com/html.php';	
	include_once 'lib/com/menu/bnbmenu.php';

	$BM=new \lib\com\menu\BnbMenu();
	echo $BM->show();
	exit();
	
?>