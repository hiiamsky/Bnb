<?php
	namespace lib\com\booking;	
	// include '../../DefSet.php';
	// include '../sql.php';
	class BookingList{
		
		private $sql;
		private $html;
		private $tblRoomInfo="RoomInfo";
		private $tblRoomBookingInfo="RoomBookingInfo";
		private $bookingDate="";
		private $roomStatus=0;//lib\BOOKING_STATUS_WAITREMIT;
		private $page=0;
		private $pageCount=5;
		private $conditionStr="";
		private $bnbID="";
		private $bnbDBNm="";
		private $debugMsgStr="";
		public function __construct($bnbid,$bnbdbnm){			
			$this->sql=new \lib\com\sql($bnbdbnm);	
			
			// $this->html=new \lib\com\html();
			// $this->bnbID=$bnbID;
			// $this->bnbDBNm=$bnbDBNm;		
			// $this->setDebugMsgStr("BookingList_Class's bnbID",$this->bnbID);
			// $this->setDebugMsgStr("BookingList_Class's bnbDBNm",$this->bnbDBNm=$bnbDBNm);
			// $this->setDebugMsgStr("BOOKING_STATUS_WAITREMIT",BOOKING_STATUS_WAITREMIT);
			echo "BookingList";
		}

		public function show($bookingdate,$roomstatus,$page,$pagecount){
			$this->bookingDate=$bookingdate;
			setDebugMsgStr("bookingDate",$bookingdate);
			$this->roomStatus=$roomstatus;
			setDebugMsgStr("roomStatus",$roomstatus);
			$this->page=$page;			
			$this->pageCount=$pagecount;			
			$this->conditionStr=setConditionStr($bookingdate,$roomstatus);
			setDebugMsgStr("conditionStr",$conditionStr);
			$this->sql->Close();
	
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
		public function sqlClose(){
			$this->sql->Close();
		}
		private function setDebugMsgStr($debugnm,$debugstr){
			$this->debugMsgStr.=$debugnm.":".$debugstr."<br>";
		} 
		public function getDebugMsgStr(){
			return $this->debugMsgStr;
		}
		
	}
?>