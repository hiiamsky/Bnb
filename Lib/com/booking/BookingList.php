<?php
	namespace lib\com\booking;	

	class BookingList extends \lib\com\booking\BookingListBase {
		private $html;
		public function __construct($bnbid,$bnbdbnm,$pageid,$title){		
			parent::__construct($bnbid,$bnbdbnm,$pageid,$title);
			$this->html=new \lib\com\html();
		}

		protected  function setJMContent($row){
			$jMcontent="";
			//echo $row;
			if(!empty($row)){
				$lastBookingDate="";
				$lastRoomStatus=0;
				//利用 jQuery Mobile ListView功能
				$jMcontent.="<ul data-role=\"listview\" data-inset=\"true\" data-theme=\"b\" data-divider-theme=\"a\" data-count-theme=\"a\">\n";
				//echo $jMcontent;
				foreach ($row as $key => $colvalue){
					//echo trim($colvalue['BookingDate']);
					if(strlen(trim($lastBookingDate))==0 || $lastBookingDate!=trim($colvalue['BookingDate'])){			
						$lastBookingDate=$colvalue['BookingDate'];
						$jMcontent.="<li data-role=\"list-divider\">".$lastBookingDate."</li>\n";						
					}
					$lastRoomStatus=$colvalue['RoomStatus'];
					///echo $lastRoomStatus;
					$jMcontent.="<li>";
					$jMcontent.="<a href=\"".parent::getBookingRoomListPage()."?bookingDate=".$lastBookingDate."&roomStatus=".$lastRoomStatus."\" data-theme=\"a\" data-ajax=\"false\">";
					$jMcontent.=$colvalue['StatusContent'];
					$jMcontent.=" <span class=\"ui-li-count\">".$colvalue['RoomStatusCount']."</span>";
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
// 		
		protected  function setJScriptCode(){
			$returnMenuJSStr="";
			$returnMenuJSStr.="<script type=\"text/javascript\">\n";
			$returnMenuJSStr.="$(document).ready(function(){\n";
			$returnMenuJSStr.=parent::btnBookingJS("../");
			$returnMenuJSStr.=parent::btnLogoutJS("../");
			$returnMenuJSStr.="});\n";
			$returnMenuJSStr.="</script>\n";
			return $returnMenuJSStr;
		}
// 
		/**
		 * sql 條件式
		 */
		protected  function setConditionStr($bookingdate,$roomstatus){
			
			$today=$this->html->today();
			$sevenDays=$this->html->addDays($today,parent::getSearchChkinDays());
			$cStr="`A`.`BnbID`='".parent::getBnbID()."'"; //sql 條件式
			$BookingDateStr="DATE_FORMAT(`A`.`BookingDate`,'%Y-%m-%d')";
			//當沒有任何的訂房日期,用今天為起始條件
			if(strlen(trim($bookingdate))>0){				
				$BookingDateStr.="='".$bookingdate."'";
			}else{ 
				$BookingDateStr.=">='".$this->html->today()."' and ".$BookingDateStr."<='".$sevenDays."'";
			}
			$cStr.=(strlen($cStr)>0?" and ":"").$BookingDateStr;
			
			//當沒有任何狀態時,用小於退房的狀態
			if($roomstatus==0){				
				$cStr.=(strlen($cStr)>0?" and ":"")."`A`.`RoomStatus`<".\BOOKING_STATUS_CHECKOUT;	
			}else{
				$cStr.=(strlen($cStr)>0?" and ":"")."`A`.`RoomStatus`=".$roomstatus;	
			}	
			echo $cStr;
			return $cStr;
		}
// 		
		protected  function sqlStr(){

			$sqlReturnStr="";
			$sqlReturnStr="select ".
					"`A`.`BookingDate`,`A`.`RoomStatus`,`B`.`Content` as `StatusContent`,count(`A`.`RoomStatus`) as `RoomStatusCount` ".
					"from `".\TBLROOMBOOKINGINFO."` `A` ".
					"left join `".\TBLSTATUS."` B on `A`.`RoomStatus`=`B`.`StatusID` ".
					(strlen(trim(parent::getConditionStr()))==0?"":"where ".parent::getConditionStr()." ").			
					"group by `A`.`BookingDate`,`A`.`RoomStatus` ".
					"order by `A`.`BookingDate`,`A`.`RoomStatus`";

			return $sqlReturnStr;
		}
		


		
		
		
	}
?>