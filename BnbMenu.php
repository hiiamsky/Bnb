<?php
	session_start ();
	include_once 'function/DefSet.php';
	include_once 'Login/SessionCheck.php';
	include_once 'function/html.php';
	include_once 'function/sql.php';
	$titleStr="選單";
	$CSSStr="";
	$JSStr="";
	$tblRoomInfo="RoomInfo";
	$bnbID=$_SESSION['BnbID'];
	
	$html=new html;
	
	// $sql=new sql($_SESSION['BnbDBNm']);
	
	$sqlStr="select * from `".$tblRoomInfo."` where `BnbID`=? order by `RoomID`";
	echo $sqlStr."<br>";
	echo $html->htmlHead($titleStr, $CSSStr, $JSStr);

	echo $html->htmlEnd();
	
?>