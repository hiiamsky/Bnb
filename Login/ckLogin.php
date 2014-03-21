<?php
	session_start ();
	
	$bnbID="";
	$loginID="";
	$loginPW="";
	if(isset($_REQUEST["BnbID"])){
		$bnbID=trim($_REQUEST["BnbID"]);
	}
	if(isset($_REQUEST["LoginID"])){
		$loginID=trim($_REQUEST["LoginID"]);
	}
	if(isset($_REQUEST["LoginPW"])){
		$loginPW=trim($_REQUEST["LoginPW"]);
	}	
	try{
		$dbh=new PDO("mysql:host=localhost;port=3306;dbname=bnbdatabase","bnbadmin","sky_Bnb047");
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$dbh->exec("SET CHARACTER SET utf8");
		
		$_SESSION['BnbID']="";
		$_SESSION['LoginID']="";
		$_SESSION['BnbDBNm']="";
	}catch(PDOException $str){
		error_log($str->getMessage());
		die();
		echo "FALSE";
	}

?>