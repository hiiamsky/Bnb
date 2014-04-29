<?php
	namespace lib\com\booking;
	class RoomInfo{
		private $html;
		private $sql;
		private $roomID="";
		private $RoomInfoArray=array();

		
		public function __construct($bnbid,$bnbdbnm){
			//echo "RoomInfo";
			$this->sql=new \lib\com\sql($bnbdbnm);			
			$this->html=new \lib\com\html();
            $this->bnbID=$bnbid;
			// $this->roomID=$roomid;
			// $this->RoominfoArray=$this->setRoomInfoArray();
		}
		// public function getRoomInfoArray(){
			// return $this->RoominfoArray;
		// }
		public function getRoomInfoArray($roomid){
			$roomarray=array();			
			$SQLStr="select * from `".\TBLROOMINFO."` where `BnbID`='".$this->bnbID."'";
			if(strlen(trim($roomid))>0){
				$SQLStr.=" and `RoomID`='".$roomid."'";
			}
			$SQLStr.=" order by `RoomID`";
			//echo $SQLStr;			
			$this->sql->query($SQLStr);			
			$row=$this->sql->resultset();
			$roomi=0;
			unset($roomarray);
			if(!empty($row)){				
				foreach ($row as $key => $colvalue){		
					$roomarray[$colvalue['RoomID']]=array(
												\arrayFieldNm_roomID=>$colvalue['RoomID'],
												\arrayFieldNm_roomNm=>$colvalue['RoomNm'],
												\arrayFieldNm_roomPrice=>"",
												\arrayFieldNm_roomHolidayPrice=>"",
												\arrayFieldNm_roomNonHolidayPrice=>"",
												\arrayFieldNm_roomSPrice=>"",
												\arrayFieldNm_roomBookingStatus=>\BOOKING_STATUS_WAITBOOKING,
												\arrayFieldNm_roomBookingCusnm=>"",
												\arrayFieldNm_roomBookingCusTel=>"",
												\arrayFieldNm_roomBookingMemo=>""												
											 );						
									 
				}
				
			}
			return $roomarray;
		}

		public function sqlClose(){
			$this->sql->Close();
		}
	}
?>