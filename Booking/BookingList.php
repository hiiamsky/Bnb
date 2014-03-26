<?php
	session_start ();
	include_once '../Login/session_ck_sub.php';
	include_once '../function/DefSet.php';
	include_once '../function/sql.php';
	include_once '../function/html.php';	

	$tblRoomInfo="RoomInfo";
	$tblRoomBookingInfo="RoomBookingInfo";
	$debugStr="";
	$bnbID=$_SESSION['BnbID'];
	$bnbDBNm=$_SESSION['BnbDBNm'];
	$debugStr.="bnbID:".$bnbID."\n";
	$debugStr.="bnbDBNm:".$bnbDBNm."\n";
	
	$html=new html;		
	$sql=new sql($bnbDBNm);
	$debugStr.="sqlgetDebugMsgStr:".$sql->getDebugMsgStr()."\n";
	
	$sqlStr="select B.* from `".$tblRoomInfo."` `A` ".
			"left join `".$tblRoomBookingInfo."` `B` ".
			"on `A`.`RoomID`=`B`.`RoomID` and `B`.`BnbID`='".$bnbID."' ".
			"where `A`.`BnbID`=:BnbID ".
			"order by `A`.`RoomID`,`B`.`BookingDate`";
	$debugStr.="sqlStr:".$sqlStr."\n";
	$sql->query($sqlStr);
	$sql->bind(':BnbID', $bnbID);
	$row=$sql->resultset();
	// $sql->query($sqlStr);
	// $sql->bind(':BnbID', $bnbID);
	// $row=$sql->resultset();
	// $debugStr.="rowCount:".$sql->rowCount()."\n";

	// while($row){
		// echo $row["CusNm"].$row["CusTel"].$row["BookingDate"];
	// }
	$sql->Close();

?>