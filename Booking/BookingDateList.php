<?php
	session_start ();
    header("Content-Type:text/html; charset=utf-8");
	include_once '../Login/SessionCheck_Sub.php';
	
	include_once '../lib/DefSet.php';
	include_once '../lib/com/sql.php';
	include_once '../lib/com/html.php';
	include_once '../lib/com/menu/bnbmenu.php';
	include_once '../lib/com/booking/roominfo.php';
	include_once '../lib/com/booking/bookinglistbase.php';
	include_once '../lib/com/booking/BookingListForDate.php';


	
	$bnbID=$_SESSION['BnbID'];
	$bnbDBNm=$_SESSION['BnbDBNm'];
	
	$page=$_REQUEST["page"];
	$pagecount=$_REQUEST["pagecount"];
	$bookingDate=$_REQUEST["bookingDate"]; //預訂日期
	$roomStatus=$_REQUEST["roomStatus"]; //訂房狀態
	
	$BKL=new \lib\com\booking\BookingListForDate($bnbID,$bnbDBNm,"BookingListPage","訂房資訊");
	
	echo $BKL->show($bookingDate, $roomStatus, $page, $pagecount);

	
	exit();
?>