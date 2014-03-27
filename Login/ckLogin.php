<?php
	session_start ();
	include_once '../lib/DefSet.php';
	$bnbID="";
	$loginID="";
	$loginPW="";
	$returnAjaxVal="FALSE";
	$tblBnbUserInfo="BnbUserInfo";
	$tblBnBInfo="BnBInfo";
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
		$DSN=lib\DSN."bnbdatabase";
		$dbh=new PDO($DSN,\lib\DB_USERNM,\lib\DB_PW);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$dbh->exec(\lib\DB_UTF8);
		$sqlStr="select ".
				"`A`.*,`B`.`BnbDBNm` ".
				"from `".$tblBnbUserInfo."` `A` ".
				"left join `".$tblBnBInfo."` ".
				"`B` on `A`.`BnbID`=`B`.`BnbID` ".
				"where `A`.`BnbID`=?";
		
		$sth=$dbh->prepare($sqlStr);
		$sth->bindParam(1,$bnbID,PDO::PARAM_STR,strlen($bnbID));
		$sth->execute();
		$row=$sth->fetch();
		if(!empty($row)){
			if($row["UserID"]==$loginID && $row["UserPW"]==$loginPW){
				$_SESSION['BnbID']=$bnbID;
				$_SESSION['LoginID']=$loginID;
				$_SESSION['BnbDBNm']=$row["BnbDBNm"];
				$_SESSION['UserPower']=$row["Power"];
				$returnAjaxVal="TRUE";
			}
		}
		$dbh=NULL;
	}catch(PDOException $str){
		error_log($str->getMessage());
		die($str->getMessage());		
	}
	echo $returnAjaxVal;
?>