<?php
	session_start ();
	include_once '../Login/SessionCheck_Sub.php';
	
	include_once '../Lib/DefSet.php';
	include_once '../Lib/com/sql.php';
	
	include_once '../Lib/com/booking/BookList.php';
		

	$tblRoomInfo="RoomInfo";
	$tblRoomBookingInfo="RoomBookingInfo";
	$debugStr="";
	
	$bnbID=$_SESSION['BnbID'];
	$bnbDBNm=$_SESSION['BnbDBNm'];
	
	$debugStr.="bnbID:".$bnbID."<br>\n";
	$debugStr.="bnbDBNm:".$bnbDBNm."<br>\n";
	echo $debugStr;
	$page=$_REQUEST["page"];
	$pagecount=$_REQUEST["pagecount"];
	$bookingDate=$_REQUEST["bookingDate"]; //預訂日期
	$roomStatus=$_REQUEST["roomStatus"]; //訂房狀態
	
	$BKL=new \lib\com\booking\BookingList($bnbID,$bnbDBNm);
	echo $BKL->getDebugMsgStr();
	$BKL->show($bookingdate, $roomstatus, $page, $pagecount);
	echo $BKL->getDebugMsgStr();
	// $bookingDate=$_REQUEST["bookingDate"]; //預訂日期
	// $roomStatus=$_REQUEST["roomStatus"]; //訂房狀態
// 	
	// $conditionStr="`A`.`BnbID`=:BnbID"; //sql 條件式
	// if($roomStatus>0){
		// $conditionStr.=(strlen($conditionStr)>0?"":" and ");
		// $conditionStr.="`A`.`RoomStatus`=".$roomStatus;		
	// }
	// if(strlen(trim($bookingDate))>0){
		// $conditionStr.=(strlen($conditionStr)>0?"":" and ");
		// $conditionStr.="DATE_FORMAT(`A`.`BookingDate`,'%Y-%m-%d')=:bookingDate";
	// }
// 	
// 		
	// $debugStr.="sqlgetDebugMsgStr:".$sql->getDebugMsgStr()."<br>";
// 	
	// $sqlStr="select ".
			// "`A`.`BookingDate`,count(`A`.`BookingDate`) as `BookingDateCount` ".
			// "from `".$tblRoomBookingInfo."` `A`".
			// (strlen(trim($conditionStr))>0?" ":" where ".$conditionStr).			
			// "group by `A`.`BookingDate`";
// 			
	// $debugStr.="sqlStr:".$sqlStr."<br>";
// 	
	// $sql->query($sqlStr);
	// $sql->bind(':BnbID', $bnbID);
	// if(strlen(trim($bookingDate))>0){
		// $sql->bind(':bookingDate', $bookingDate);
	// }
	// $row=$sql->resultset();
	// $debugStr.="rowCount:".$sql->rowCount()."<br>";
// 
	// foreach ($row as $key => $colvalue){
		// echo $colvalue['BookingDate'].$colvalue['BookingDateCount']."<br>";
	// }
	
	// $sql->Close();
	// $BKL->sqlClose();
?>