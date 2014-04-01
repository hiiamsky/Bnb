<?php
	session_start ();
	include_once 'Login/SessionCheck.php';
	// include_once 'Lib/com/DefSet.php';
	include_once 'lib/com/html.php';	
	include_once 'lib/com/menu/bnbmenu.php';
	$BM=new \lib\com\menu\BnbMenu();
	echo $BM->show();
	exit();
	
?>