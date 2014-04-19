<?php
	namespace lib\com\booking;
	class BookingInfo{
		private $html;
		private $Serial="";	 //序號
		private $BookingNo="";
		private $BnbID="";	 //民宿編號
		private $RoomID="";	 //房間編號
		private $CusNm="";	 //房客
		private $CusTel="";	 //房客電話
		private $BookingDate="";//預訂入住日期		
		private $BookingDays="";//入住天數		
		private $BookingCheckOutDate="";//預訂退房日期		
		private $Price="";	//單價
		private $BookingDiscount="";//折扣		
		private $Amount="";	//總價
		private $RemitNo="";	//匯款帳號後五碼		
		private $RemitAmount="";	//匯款金額
		private $CkRemitDate=""; 	//匯款日期	
		private $RoomStatus="";		//狀態
		private $CkInDateTime=""; //Check in date time
		private $CkOutDateTime="";	//Check out date time
		private $Receptionist="";	//接待人員
		private $Memo="";		//備註
		private $CID="";		//建立人
		private $CDate="";		//建立日期時間
		private $MID="";		//修改人
		private $MDate="";		//修改時間
		// private $BookingInfoArray=array(
										// 'Serial' 				=> '', 
										// 'BnbID'  				=> '',
										// 'RoomID' 				=> '',
										// 'CusNm'  				=> '',
										// 'CusTel'  				=> '',
										// 'BookingDate'  			=> '',
										// 'BookingDays'  			=> '',
										// 'BookingCheckOutDate'	=> '',
										// 'Price'  				=> '',
										// 'BookingDiscount'  		=> '',
										// 'RemitNo'  				=> '',
										// 'RemitAmount'  			=> '',
										// 'CkRemitDate'  			=> '',
										// 'RoomStatus'  			=> '',
										// 'CkInDateTime'  		=> '',
										// 'CkOutDateTime'  		=> '',
										// 'Receptionist'  		=> '',
										// 'Memo'  				=> '',
										// 'CID'  					=> '',
										// 'CDate'  				=> '',
										// 'MID'  					=> '',
										// 'MDate'  				=> ''
										// );
		public function __construct($bnbnm){
			$this->html=new \lib\com\html();
			$this->sql=new \lib\com\sql($bnbnm);
			$this->setBookingInfoDefValue();
		}
		private function setBookingInfoDefValue(){
			$this->setSerial("");
			$this->BookingNo("");
			$this->setBnbID("");
			$this->setRoomID("");
			$this->setCusNm("");
			$this->setCusTel("");
			$this->setBookingDate("");
			$this->setBookingDays("");
			$this->setBookingCheckOutDate("");
			$this->setPrice("");
			$this->setBookingDiscount("");
			$this->setAmount("");
			$this->setRemitNo("");
			$this->setRemitAmount("");
			$this->setCkRemitDate("");
			$this->setRoomStatus("");
			$this->setCkInDateTime("");
			$this->setCkOutDateTime("");
			$this->setReceptionist("");
			$this->setMemo("");
			$this->setCID("");
			$this->setCDate("");
			$this->setMID("");
			$this->setMDate("");
		}
		public function setBookingInfoValue($row){
			if(!empty($row)){
				foreach ($row as $key => $colvalue){
					$this->setSerial($colvalue['Serial']);
					$this->setBookingNo($colvalue['BookingNo']);
					$this->setBnbID($colvalue['BnbID']);
					$this->setRoomID($colvalue['RoomID']);
					$this->setCusNm($colvalue['CusNm']);
					$this->setCusTel($colvalue['CusTel']);
					$this->setBookingDate($colvalue['BookingDate']);
					$this->setBookingDays($colvalue['BookingDays']);
					$this->setBookingCheckOutDate($colvalue['BookingCheckOutDate']);
					$this->setPrice($colvalue['Price']);
					$this->setBookingDiscount($colvalue['BookingDiscount']);
					$this->setAmount($colvalue['Amount']);
					$this->setRemitNo($colvalue['RemitNo']);
					$this->setRemitAmount($colvalue['RemitAmount']);
					$this->setCkRemitDate($colvalue['CkRemitDate']);
					$this->setRoomStatus($colvalue['RoomStatus']);
					$this->setCkInDateTime($colvalue['CkInDateTime']);
					$this->setCkOutDateTime($colvalue['CkOutDateTime']);
					$this->setReceptionist($colvalue['Receptionist']);
					$this->setMemo($colvalue['Memo']);
					$this->setCID($colvalue['CID']);
					$this->setCDate($colvalue['CDate']);
					$this->setMID($colvalue['MID']);
					$this->setMDate($colvalue['MDate']);
				}				
			}else{
				$this->setBookingInfoDefValue();
			}

		}
		private function setSerial($serial){
			$this->Serial=$seiral;
		}
		private function setBookingNo($bookingno){
			$this->BookingNo=$bookingno;
		}
		private function setBnbID($bnbid){
			$this->BnbID=$bnbid;
		}
		private function setRoomID($roommid){
			$this->RoomID=$roommid;
		}
		private function setCusNm($cusnm){
			$this->CusNm=$cusnm;
		}
		private function setCusTel($custel){
			$this->CusTel=$custel;
		}
		private function setBookingDate($bookingdate){
			$this->BookingDate=$bookingdate;
		}	
		private function setBookingDays($bookingdays){
			$this->BookingDays=$bookingdays;
		}
		private function setBookingCheckOutDate($bookingcheckoutdate){
			$this->BookingCheckOutDate=$bookingcheckoutdate;
		}		
		private function setPrice($price){
			$this->Price=$price;
		}
		private function setBookingDiscount($bookingdiscount){
			$this->BookingDiscount=$bookingdiscount;
		}	
		private function setAmount($amount){
			$this->Amount=$amount;
		}
		private function setRemitNo($remitno){
			$this->RemitNo=$remitno;
		}
		private function setRemitAmount($remitamount){
			$this->RemitAmount=$remitamount;
		}
		private function setCkRemitDate($ckremitdate){
			$this->CkRemitDate=$ckremitdate;
		}
		private function setRoomStatus($roomstatus){
			$this->RoomStatus=$roomstatus;
		}
		private function setCkInDateTime($ckindatetime){
			$this->CkInDateTime=$ckindatetime;
		}
		private function setCkOutDateTime($ckoutdatetime){
			$this->CkOutDateTime=$ckoutdatetime;
		}
		private function setReceptionist($receptionist){
			$this->Receptionist=$receptionist;
		}
		private function setMemo($memo){
			$this->Memo=$memo;
		}
		private function setCID($cid){
			$this->CID=$cid;
		}
		private function setCDate($cdate){
			$this->CDate=$cdate;
		}
		private function setMID($mid){
			$this->MID=$mid;
		}
		private function setMDate($mdate){
			$this->MDate=$mdate;
		}
		
		
		
		public function getSerial(){
			return $this->Serial;
		}
		public function getBookingNo(){
			return $this->BookingNo;
		}
		public function getBnbID(){
			return $this->BnbID;
		}
		public function getRoomID(){
			return$this->RoomID;
		}
		public function getCusNm(){
			return $this->CusNm;
		}
		public function getCusTel(){
			return $this->CusTel;
		}
		public function getBookingDate(){
			return $this->BookingDate;
		}	
		public function getBookingDays(){
			return $this->BookingDays;
		}
		public function getBookingCheckOutDate(){
			return $this->BookingCheckOutDate;
		}		
		public function getPrice(){
			return $this->Price;
		}
		public function getBookingDiscount(){
			return $this->BookingDiscount;
		}	
		public function getAmount(){
			return $this->Amount;
		}
		public function getRemitNo(){
			return $this->RemitNo;
		}
		public function getRemitAmount(){
			return $this->RemitAmount;
		}
		public function getCkRemitDate(){
			return $this->CkRemitDate;
		}
		public function getRoomStatus(){
			return $this->RoomStatus;
		}
		public function getCkInDateTime(){
			return $this->CkInDateTime;
		}
		public function getCkOutDateTime(){
			return $this->CkOutDateTime;
		}
		public function getReceptionist(){
			return $this->Receptionist;
		}
		public function getMemo(){
			$this->Memo=$memo;
		}
		public function getCID(){
			$this->CID=$cid;
		}
		public function getCDate(){
			$this->CDate=$cdate;
		}
		public function getMID(){
			$this->MID=$mid;
		}
		public function getMDate(){
			$this->MDate=$mdate;
		}
		
		
		
		private function fieldSerial(){
			return $this->HiddenText("Serial","Serial",$this->getSerial(),"");
		}
		private function fieldBookingNo($bookingno,$mode){			
			return $this->HiddenText("BookingNo","BookingNo",$this->getBookingNo(),"");;
		}

		private function fieldRoomID($roommid,$mode){
			$this->RoomID=$roommid;
		}
		private function fieldCusNm($defval,$mode){
			$fieldNm="CusNm";
			$fieldSNm="入住人";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}
		private function fieldCusTel($defval,$mode){
			$fieldNm="CusTel";
			$fieldSNm="電話";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}
		private function fieldBookingDate($defval,$mode){
			$fieldNm="BookingDate";
			$fieldSNm="預定入住日期";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval," readonly");
			}
			return $fieldStr;
		}	
		private function fieldBookingDays($defval,$mode){
			$fieldNm="BookingDays";
			$fieldSNm="預定入住天數";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}
		private function fieldBookingCheckOutDate($defval,$mode){
			$fieldNm="BookingCheckOutDate";
			$fieldSNm="預定退房日期";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}		
		private function fieldPrice($defval,$mode){
			$fieldNm="Price";
			$fieldSNm="單價";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}
		private function fieldBookingDiscount($defval,$mode){
			$fieldNm="BookingDiscount";
			$fieldSNm="折扣";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}	
		private function fieldAmount($defval,$mode){
			$fieldNm="Amount";
			$fieldSNm="總價";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}
		private function fieldRemitNo($defval,$mode){
			$fieldNm="RemitNo";
			$fieldSNm="匯款帳號後五碼";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}
		private function fieldRemitAmount($defval,$mode){
			$fieldNm="RemitAmount";
			$fieldSNm="匯款金額";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}
		private function fieldCkRemitDate($defval,$mode){
			$fieldNm="CkRemitDate";
			$fieldSNm="匯款日期";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}

		private function fieldReceptionist($defval,$mode){
			$fieldNm="Receptionist";
			$fieldSNm="接待人";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}
		private function fieldMemo($defval,$mode){
			$fieldNm="Memo";
			$fieldSNm="備註";
			$fieldStr="";
			if($mode==\MODE_SHOW){
				$fieldStr=$fieldSNm.":".$defval."\n";
			}else{
				$fieldStr=$this->html->jQueryMTextforForm($fieldNm,$fieldNm,$fieldSNm,$defval,"");
			}
			return $fieldStr;
		}

		
		
		
		
		
		
		
		protected function insertIntoSQLStr(){
			
			$SQLStr="INSERT INTO ".
					"`".\TBLROOMBOOKINGINFO."`(".
					"`BookingNO`,`BnbID`,`RoomID`,`CusNm`,".
					"`CusTel`,`BookingDate`,`BookingDays`,".
					"`BookingCheckOutDate`,`Price`,`BookingDiscount`,".
					"`Amount`,`RoomStatus`,`Memo`,".
					"`CID`,`CDate`".
					"`) VALUES (".
					"'".$this->getNewBookingNo()."',:BnbID,:RoomID,:CusNm,".
					":CusTel,:BookingDate,:BookingDays,".
					":BookingCheckOutDate,:Price,:BookingDiscount,".
					":Amount,".\BOOKING_STATUS_WAITREMIT.",:Memo,".
					":CID,now()".
					")";
			return $SQLStr;			
		}	
		private function getNewBookingNo(){
			$newBookingNo="";
			$SQLStr="select `BookingNo` ".
					"from `".\TBLROOMBOOKINGINFO."` ".
					"where ".
					"DATE_FORMAT(`CDate`,'%Y-%m-%d')='".$this->html->today()."' ".
					"order by `BookingNo` desc limit 0,1";					
			$this->sql->query($SQLStr);
			$row = $this->sql->single();	
			if($this->sql->rowCount()>0){
				foreach ($row as $key => $colvalue){
					$newBookingNo=$colvalue['BookingNo'];
				}
			}else{
				$newBookingNo= str_replace("-","",$this->html->today())."000";
				
			}
			$newBookingNo=$this->html->StringAdd($newBookingNo,3);	
			return $newBookingNo;
		}			
		public function sqlClose(){
			$this->sql->Close();
		}
	}
?>