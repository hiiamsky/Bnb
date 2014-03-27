<?php
	namespace lib\com\booking;	
	include_once '../sql.php';
	include_once '../html.php';
	class BookingList{
		
		private $sql;
		private $html;
		private $tblRoomInfo="RoomInfo";
		private $tblRoomBookingInfo="RoomBookingInfo";
		private $bookingDate="";
		private $roomStatus=BOOKING_STATUS_WAITREMIT;
		private $page=0;
		private $pageCount=5;
		private $conditionStr="";
		private $bnbID="";
		private $bnbDBNm="";
		public function __construct($db,$bnbID,$bnbDBNm){			
			$this->sql=new \lib\com\sql($db);	
			$this->html=new \lib\com\html();
			$this->bnbID=$bnbID;
			$this->bnbDBNm=$bnbDBNm;		
		}

		public function show($bookingdate,$roomstatus,$page,$pagecount){
			$this->bookingDate=$bookingdate;
			$this->roomStatus=$roomstatus;
			$this->page=$page;
			$this->pageCount=$pagecount;
			$this->conditionStr=setConditionStr($bookingdate,$roomstatus);
	
		}
		private function setConditionStr($bookingdate,$roomstatus){
			$cStr="`A`.`BnbID`='".$this->bnbID."'"; //sql 條件式
			if($roomstatus>0){
				$cStr.=(strlen($conditionStr)>0?"":" and ");
				$cStr.="`A`.`RoomStatus`=".$roomstatus;		
			}
			if(strlen(trim($bookingdate))>0){
				$cStr.=(strlen($cStr)>0?"":" and ");
				$cStr.="DATE_FORMAT(`A`.`BookingDate`,'%Y-%m-%d')='".$bookingdate."'";
			}
			return $cStr;
		}
	}
?>