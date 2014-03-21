<?php	
	if(!isset($_SESSION['BnbID']) && !isset($_SESSION['LoginID'])){
		//echo NOW_DIR."/../Login/Login.php";
		header("location: Login/Login.php");
		exit();		
	}
?>