<?php	
	//判斷是否有登入
	if(!isset($_SESSION['BnbID']) && !isset($_SESSION['LoginID'])){		
		header("location: Login/Login.php");
		exit();		
	}
?>