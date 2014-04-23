<?php
	namespace lib\com\booking;
	abstract class BookingListBase extends \lib\com\menu\BnbMenu {

	
		private $html;
		private $sql;
		private $bookingDate="";
		private $roomStatus=0;	
		
		private $page=0;		
		private $pageCount=7;
		private $conditionStr="";
		private $bnbID="";
		private $bnbDBNm="";
		private $debugMsgStr="";
		private $titleStr="";
		private $CSSStr="";
		private $JSStr="";
		
		private $pageID="";
		
		private $bookingRoomListPage="BookingRoomList.php";
		
		private $searchChkinDays=7;
	
		private $bookingDateArray=array();
		
		private $roomcount=0;
		
		private $BookingDateFormID="sBookingDateForm";
		
		private $serchBookingDateDivID="serchBookingDateDiv";
		
		public function __construct($bnbid,$bnbdbnm,$pageid,$title){
				
			parent::__construct();
			
			$this->sql=new \lib\com\sql($bnbdbnm);			
			$this->html=new \lib\com\html();
			
			$this->bnbID=$bnbid;
			$this->bnbDBNm=$bnbDBNm;
			
			$this->pageID=$pageid;
			
			$this->titleStr=$title;

		}
		private function setbookingDateArray($bookingdate){
			unset($this->bookingDateArray);
			$roomarray=$this->setRoomArray();
			$dateStr="";
			for($i=0;$i<$this->searchChkinDays;$i++){
				$dateStr=$this->html->addDays($bookingdate,$i);
				$this->bookingDateArray[$dateStr]=array(
											"BookingDate"=>$dateStr,
											"RoomInfo"=>$roomarray
											);
			}

		}		
		protected function setBookingDateRoomInfo($date,$roomid,$status,$roomCusnm,$roomCusTel,$roomMemo){
			
			$this->bookingDateArray[$date]["RoomInfo"][$roomid]["roomStatus"]=$status;			
			$this->bookingDateArray[$date]["RoomInfo"][$roomid]["roomCusnm"]=$roomCusnm;
			$this->bookingDateArray[$date]["RoomInfo"][$roomid]["roomCusTel"]=$roomCusTel;
			$this->bookingDateArray[$date]["RoomInfo"][$roomid]["roomMemo"]=$roomMemo;
		    
		}
		private function setRoomArray(){
			$roomarray=array();			
			$SQLStr="select * from `".\TBLROOMINFO."` where `BnbID`='".$this->bnbID."' order by `RoomID`";			
			$this->sql->query($SQLStr);			
			$row=$this->sql->resultset();
			$roomi=0;
			unset($roomarray);
			if(!empty($row)){				
				foreach ($row as $key => $colvalue){		
					$roomarray[$colvalue['RoomID']]=array(
												"roomID"=>$colvalue['RoomID'],
												"roomNm"=>$colvalue['RoomNm'],
												"roomStatus"=>\BOOKING_STATUS_WAITBOOKING,
												"roomCusnm"=>"",
												"roomCusTel"=>"",
												"roomMemo"=>""
												
											 );
						
					$roomi++;
									 
				}
				$this->roomcount=$roomi;
			}
			return $roomarray;
		}
		protected function getbookingDateArray(){
			return $this->bookingDateArray;
		}


		protected function getRoomStatusNm($roomstatus){
			$returnStatusNm="";
			switch($roomstatus){
				case \BOOKING_STATUS_WAITBOOKING:
					$returnStatusNm="待訂房";
					break;
				case \BOOKING_STATUS_WAITREMIT:
					$returnStatusNm="已訂房,待匯款";
					break;
				case \BOOKING_STATUS_REMITED:
					$returnStatusNm="已匯款,待入住";
					break;
				case \BOOKING_STATUS_CHECKIN:
					$returnStatusNm="已入住";
					break;
				case \BOOKING_STATUS_CHECKOUT:
					$returnStatusNm="已退房";
					break;
				case \BOOKING_STATUS_CANCEL:
					$returnStatusNm="取消";
					break;
			}
			return $returnStatusNm;
		}
		
		protected function getRoomStatusColor($roomstatus){
			$returnStatusColor="";
			switch($roomstatus){
				case \BOOKING_STATUS_WAITREMIT:
					$returnStatusColor="#ff69b4";
					break;
				case \BOOKING_STATUS_REMITED:
					$returnStatusColor="#ffd700";
					break;
				case \BOOKING_STATUS_CHECKIN:
					$returnStatusColor="#006400";
					break;
				case \BOOKING_STATUS_CHECKOUT:
					$returnStatusColor="#afeeee";
					break;
				case \BOOKING_STATUS_CANCEL:
					$returnStatusColor="red";
					break;
				default:
					$returnStatusColor="white";
					break;
			}
			return $returnStatusColor;
		}
		
		
		/**
		 * Booking/BookingList.php 顯示畫面
		 */
		public function show($bookingdate,$roomstatus,$page,$pagecount){
			$showReturnStr="";
			$data_theme="b";
			// $pageID="BookingListPage";
	
			$this->bookingDate=(strlen(trim($bookingdate))>0?$bookingdate:$this->html->today());

			$this->roomStatus=$roomstatus;

			$this->page=$page;			
			$this->pageCount=$pagecount;	
		
			$this->setbookingDateArray($this->bookingDate);			
					
			$this->conditionStr=$this->setConditionStr($this->bookingDate,$roomstatus);
			
			
			$this->sql->query($this->sqlStr());
			
			$row=$this->sql->resultset();
			
			
			$this->JSStr=$this->setJScriptCode();
		
			//jQuery Mobile 表頭
			$headercontent="<h1>".$this->titleStr."</h1>\n";
			//Menu panel button 需要配合 navMenuPanel()
			$headercontent.=parent::btnNavMenuPanel();
			
			//進入訂房畫面的按鈕
			$headercontent.="<a href=\"#".parent::getNewBookigdivID()."\"  data-rel=\"popup\" data-position-to=\"window\" data-transition=\"pop\" class=\"ui-btn ui-shadow ui-corner-all ui-icon-plus ui-btn-icon-notext ui-btn-inline\">Plus</a>\n";
			
			$headerdivotherstr=" date-theme=\"".$data_theme."\" data-position=\"fixed\"";
			$header=$this->html->jQueryMobileHeader($headercontent, $headerdivotherstr);
			
			//jQuery Mobile內容
			$jMcontent=$this->setJMContent($row);

			
			$content=$this->html->jQueryMobileContent($jMcontent, "");
			
			//Menu panel div 需要配合 btnNavMenuPanel()
			$content.=parent::navMenuPanel("");	
			
			$content.=parent::addNewBookingDiv($bookingdate);
			

			$footcontent=$this->setfootContent();//$this->serchBookingDateDiv();
			
			$footer=$this->html->jQueryMobileFooter($footcontent, "");


			
			
			$showReturnStr.=$this->html->htmlHead($this->titleStr,$this->CSSStr,$this->JSStr);
			$showReturnStr.=$this->html->jQueryMobilePage($this->pageID, $header, $content, $footer, "");
			$showReturnStr.=$this->html->htmlEnd();
			
			$this->sql->Close();
			
			return $showReturnStr;
	
		}



		

		
		protected  function setDebugMsgStr($debugnm,$debugstr){
			$this->debugMsgStr.=$debugnm.":".$debugstr."<br>";
		} 
		public function getDebugMsgStr(){
			return $this->debugMsgStr;
		}

		protected function getBnbID(){
			return $this->bnbID;
		}
		protected function getBnbDBNm(){
			return $this->bnbDBNm;
		}
		protected function getSearchChkinDays(){
			return $this->searchChkinDays;
		}
		
		protected function getRoomStatus(){
			return $this->roomStatus;
		}
		
		protected function getConditionStr(){
			return $this->conditionStr;
		}
		
		protected function getBookingRoomListPage(){
			return $this->bookingRoomListPage;
		}
		
		protected function getbookingDate(){
			return $this->bookingDate;
		}
		
		/**
		 * sql 條件式
		 */
		abstract protected  function setConditionStr($bookingdate,$roomstatus);
		
		/**
		 * sql 
		 */
		abstract protected  function sqlStr();
		
		
		abstract protected  function setJMContent($row);

		abstract protected  function setJScriptCode();

		abstract protected function setfootContent();
		
		abstract protected  function setPageJScriptCode();
		
		
		abstract protected function BookingDateListString();
		

	}
?>