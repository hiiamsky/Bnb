<?php
	if(!isset($_SESSION['BnbID']) && !isset($_SESSION['LoginID'])){		
		header("location: ../Login/Login.php");
		exit();		
	}
?>