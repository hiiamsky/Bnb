<?php
	 namespace lib;
	 
	 define("DSN","mysql:host=localhost;port=3306;dbname=");
	 define("DB_USERNM","bnbadmin");
	 define("DB_PW","sky_Bnb047");
	 define("DB_UTF8","SET CHARACTER SET utf8");
	 define("BOOKING_STATUS_WAITREMIT",1000);	//待匯款
	 define("BOOKING_STATUS_REMITED",1001);		//已匯款,待入住			  	
	 define("BOOKING_STATUS_CHECKIN",1002);		//已入住
	 define("BOOKING_STATUS_CHECKOUT",1998);	//已退房
	 define("BOOKING_STATUS_CANCEL",1999);		//取消
	 
	 define("TBLROOMINFO","RoomInfo");
	 define("TBLSTATUS","status");
	 define("TBLROOMBOOKINGINFO","RoomBookingInfo");
	 
	 define("MODE_SHOW","SHOW");
	 define("MODE_EDIT","EDIT");
	 define("MODE_ADD","ADD");
	 define("MODE_UPDATE","UPDATE");
	 define("MODE_DELETE","DELETE");

?>