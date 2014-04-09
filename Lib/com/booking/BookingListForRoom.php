<?php
	namespace lib\com\booking;
	class BookingListForRoom extends \lib\com\booking\BookingListBase {
		public function __construct($bnbid,$bnbdbnm,$pageid,$title){			
			parent::__construct($bnbid,$bnbdbnm,$pageid,$title);
		}
		
		/**
		 * sql 
		 */
		protected function sqlStr(){
			$sqlReturnStr="";
			$sqlReturnStr="select * from `".\TBLROOMBOOKINGINFO."` `A` ".
			(strlen(trim(parent::getConditionStr()))==0?" ":"where ".parent::getConditionStr()." ").
			"order by `A`.`RoomID`,`A`.`RoomStatus`";			
			return $sqlReturnStr;
		}		
	
		
		/**
		 * sql 條件式
		 */
		protected  function setConditionStr($bookingdate,$roomstatus){			
			$cStr="";
			$cStr="`A`.`BnbID`='".parent::getBnbID()."'"; //sql 條件式			
			$BookingDateStr="DATE_FORMAT(`A`.`BookingDate`,'%Y-%m-%d')='".$bookingdate."'";			
			$cStr.=(strlen($cStr)>0?" and ":"").$BookingDateStr;
			
			//當沒有任何狀態時,用小於退房的狀態
			if($roomstatus==0){				
				$cStr.=(strlen($cStr)>0?" and ":"")."`A`.`RoomStatus`<".\BOOKING_STATUS_CHECKOUT;	
			}else{
				$cStr.=(strlen($cStr)>0?" and ":"")."`A`.`RoomStatus`=".$roomstatus;	
			}		
			
			return $cStr;
		}
		
		
		protected function setJMContent($row){
			$jMcontent="";	
			// $jMcontent.="<p>".parent::getRoomStatusNm()."</p>";		
			if(!empty($row)){
				//利用 jQuery Mobile ListView功能
				$jMcontent.="<ul data-role=\"listview\" data-inset=\"true\" data-theme=\"b\" data-divider-theme=\"a\" data-count-theme=\"a\">\n";
				//echo $jMcontent;
				foreach ($row as $key => $colvalue){
					$lastBookingDate=$colvalue['BookingDate'];
					$jMcontent.="<li data-role=\"list-divider\">".$colvalue['RoomID']."<font color='".parent::getRoomStatusColor($colvalue['RoomStatus'])."'>(".parent::getRoomStatusNm($colvalue['RoomStatus']).")</font>"."</li>\n";	
					$jMcontent.="<li>";
					$jMcontent.="<a href=\"#\" data-theme=\"a\" data-ajax=\"false\">";
					$jMcontent.="姓名:".$colvalue['CusNm']."<br>".
								"電話:".$colvalue['CusTel'];
					// $jMcontent.=" <span class=\"ui-li-count\">".$colvalue['RoomStatusCount']."</span>";
					$jMcontent.="</a>\n";
					$jMcontent.="</li>\n";
					
				}
				//echo "end";
				$jMcontent.="</ul>\n";
			}else{
				$jMcontent="目前無任何訂房資訊";
			}
			//echo $jMcontent;
			return $jMcontent;			
		}


		
// 
		protected  function setPageJScriptCode(){
			$returnMenuJSStr="";
			return $returnMenuJSStr;
		}
	}
?>