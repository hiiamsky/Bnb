<?php
	namespace lib\com\booking;	

	class BookingListForDate extends \lib\com\booking\BookingListBase {
		private $html;
		public function __construct($bnbid,$bnbdbnm,$pageid,$title){		
			parent::__construct($bnbid,$bnbdbnm,$pageid,$title);
			$this->html=new \lib\com\html();
		}

		protected  function setJMContent($row){
			
			$jMcontent="";
			
			if(!empty($row)){
				foreach ($row as $key => $colvalue){		
					parent::setBookingDateRoomInfo($colvalue['BookingDate'], $colvalue['RoomID'], $colvalue['RoomStatus'],"");
				}
			}
			
			//利用 jQuery Mobile ListView功能
			
			$jMcontent.=parent::getBookingDateLiString();

			return $jMcontent;
		}
// 
// 		
		protected  function setPageJScriptCode(){
			$returnMenuJSStr="";
			return $returnMenuJSStr;
		}
// 
		/**
		 * sql 條件式
		 */
		protected  function setConditionStr($bookingdate,$roomstatus){
			
			$today=$this->html->today();
			$searchChkinDays=$this->html->addDays($bookingdate,parent::getSearchChkinDays()-1);
			$cStr="`A`.`BnbID`='".parent::getBnbID()."'"; //sql 條件式
			$BookingDateStr="DATE_FORMAT(`A`.`BookingDate`,'%Y-%m-%d')";
			$BookingDateStr.=">='".$bookingdate."' and ".$BookingDateStr."<='".$searchChkinDays."'";
			$cStr.=(strlen($cStr)>0?" and ":"").$BookingDateStr;
			
			//當沒有任何狀態時,用小於退房的狀態
			if($roomstatus==0){				
				$cStr.=(strlen($cStr)>0?" and ":"")."`A`.`RoomStatus`<".\BOOKING_STATUS_CHECKOUT;	
			}else{
				$cStr.=(strlen($cStr)>0?" and ":"")."`A`.`RoomStatus`=".$roomstatus;	
			}	

			return $cStr;
		}
// 		
		protected  function sqlStr(){

			$sqlReturnStr="";
			$sqlReturnStr="select * ".
					"from `".\TBLROOMBOOKINGDATA."` `A` ".
					(strlen(trim(parent::getConditionStr()))==0?"":"where ".parent::getConditionStr()." ").			
					"order by `A`.`BookingDate`";
			// echo $sqlReturnStr;
			return $sqlReturnStr;
		}
		


		
		
		
	}

?>