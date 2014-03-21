<?php
	session_start ();
	include_once 'Login/SessionCheck.php';
	include_once 'function/html.php';
	include_once 'function/sql.php';
	$titleStr="選單";
	$CSSStr="";
	$JSStr="";
	$tblRoomInfo="RoomInfo";
	$bnbID=$_SESSION['BnbID'];
	
	$html=new html;
	
	$sql=new sql($_SESSION['BnbDBNm']);
	
	$sqlStr="select * from `".$tblRoomInfo."` where `BnbID`=? order by `RoomID`";
	// echo $sql->ErrorStr;
	echo $sqlStr."<br>";
	echo $sql->query($bnbID,$sqlStr);
	// echo $result;
	// $sth->bindParam(1,$bnbID,PDO::PARAM_STR,strlen($bnbID));
	// $sth->execute();
	// $row=$sth->fetch();
	// echo empty($row);
	echo $html->htmlHead($titleStr, $CSSStr, $JSStr);
	// echo $row["RoomID"].$row["RoomNm"].$row["RoomPrice"]."<br>";
	// while(!empty($row)){
		// echo $row["RoomID"].$row["RoomNm"].$row["RoomPrice"]."<br>";
		// $row = $sth->fetch();
	// }
	$sql->Close();
	echo $html->htmlEnd();
	
?>