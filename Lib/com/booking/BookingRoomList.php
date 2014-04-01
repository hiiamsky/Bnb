<?php
	namespace lib\com\booking;
	class BookingRoomList extends \lib\com\booking\BookingListBase {
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
			"order by `A`.`RoomID`";			
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
			
			$cStr.=(strlen($cStr)>0?" and ":"")."`A`.`RoomStatus`=".$roomstatus;	
			
			return $cStr;
		}
		
		
		protected function setJMContent($row){
			$jMcontent="";			
			if(!empty($row)){
				//利用 jQuery Mobile ListView功能
				$jMcontent.="<ul data-role=\"listview\" data-inset=\"true\" data-theme=\"b\" data-divider-theme=\"a\" data-count-theme=\"a\">\n";
				//echo $jMcontent;
				foreach ($row as $key => $colvalue){
					$lastBookingDate=$colvalue['BookingDate'];
					$jMcontent.="<li data-role=\"list-divider\">".$colvalue['RoomID']."</li>\n";	
					$jMcontent.="<li>";
					$jMcontent.="<a href=\"#\" data-theme=\"a\" data-ajax=\"false\">";
					$jMcontent.=$colvalue['CusNm'].$colvalue['CusTel'];
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
	}
?>