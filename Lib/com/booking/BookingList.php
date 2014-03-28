<?php
	namespace lib\com\booking;	

	class BookingList{
		
		private $sql;
		private $html;
		private $tblRoomInfo="RoomInfo";
		private $tblstatus="status";
		private $tblRoomBookingInfo="RoomBookingInfo";
		private $bookingDate="";
		private $roomStatus=0;
		private $page=0;
		private $pageCount=5;
		private $conditionStr="";
		private $bnbID="";
		private $bnbDBNm="";
		private $debugMsgStr="";
		private $titleStr="";
		private $CSSStr="";
		private $JSStr="";
		
		
		public function __construct($bnbid,$bnbdbnm){
			
			$this->sql=new \lib\com\sql($bnbdbnm);			
			$this->html=new \lib\com\html();
			$this->bnbID=$bnbid;
			$this->bnbDBNm=$bnbDBNm;		

		}
		/**
		 * Booking/BookingList.php 顯示畫面
		 */
		public function show($bookingdate,$roomstatus,$page,$pagecount){
			$showReturnStr="";
			$data_theme="b";
			$pageID="BookingListPage";
			
			$this->bookingDate=$bookingdate;

			$this->roomStatus=$roomstatus;

			$this->page=$page;			
			$this->pageCount=$pagecount;	
								
			$this->conditionStr=$this->setConditionStr($bookingdate,$roomstatus);
						
			$this->sql->query($this->sqlStr());
			$row=$this->sql->resultset();
			

			
			
			//jQuery Mobile 表頭
			$headercontent="<h1>訂房資訊</h1>\n";
			$headerdivotherstr=" date-theme=\"".$data_theme."\"";
			$header=$this->html->jQueryMobileHeader($headercontent, $headerdivotherstr);
			
			//jQuery Mobile內容
			$jMcontent="";
			if(!empty($row)){
				$lastBookingDate="";
				$lastRoomStatus=0;
				//利用 jQuery Mobile ListView功能
				$jMcontent.="<ul data-role=\"listview\" data-inset=\"true\" data-theme=\"b\" data-divider-theme=\"a\" data-count-theme=\"a\">\n";
				foreach ($row as $key => $colvalue){
					if(strlen(trim($lastBookingDate))==0 || $lastBookingDate!=trim($colvalue['BookingDate'])){			
						$lastBookingDate=$colvalue['BookingDate'];
						$jMcontent.="<li data-role=\"list-divider\">".$lastBookingDate."</li>\n";						
					}
					$jMcontent.="<li><a href=\"#\" data-theme=\"a\">".$colvalue['StatusContent']." <span class=\"ui-li-count\">".$colvalue['RoomStatusCount']."</span></a></li>\n";
					
				}
				$jMcontent.="</ul>\n";
			}else{
				$jMcontent="目前無任何訂房資訊";
			}
			$content=$this->html->jQueryMobileContent($jMcontent, "");
			
			//jQuery Mobile 表尾
			$footcontent="<h4>bnb</h4>\n";
			$footer=$this->html->jQueryMobileFooter($footcontent, "");
			
			
			$showReturnStr.=$this->html->htmlHead($this->titleStr,$this->CSSStr,$this->JSStr);
			$showReturnStr.=$this->html->jQueryMobilePage($pageID, $header, $content, $footer, "");
			$showReturnStr.=$this->html->htmlEnd();
			
			return $showReturnStr;
	
		}
		/**
		 * sql 條件式
		 */
		private function setConditionStr($bookingdate,$roomstatus){
			$cStr="`A`.`BnbID`='".$this->bnbID."'"; //sql 條件式
			$BookingDateStr="DATE_FORMAT(`A`.`BookingDate`,'%Y-%m-%d')";
			//當沒有任何的訂房日期,用今天為起始條件
			if(strlen(trim($bookingdate))>0){				
				$BookingDateStr.="='".$bookingdate."'";
			}else{ 
				$BookingDateStr.=">='".$this->html->today()."'";
			}
			$cStr.=(strlen($cStr)>0?" and ":"").$BookingDateStr;
			
			//當沒有任何狀態時,用小於退房的狀態
			if($roomstatus==0){				
				$cStr.=(strlen($cStr)>0?" and ":"")."`A`.`RoomStatus`<".\BOOKING_STATUS_CHECKOUT;	
			}else{
				$cStr.=(strlen($cStr)>0?" and ":"")."`A`.`RoomStatus`=".$roomstatus;	
			}	
			return $cStr;
		}
		
		private function sqlStr(){
			$sqlReturnStr="";
			$sqlReturnStr="select ".
					"`A`.`BookingDate`,`A`.`RoomStatus`,`B`.`Content` as `StatusContent`,count(`A`.`RoomStatus`) as `RoomStatusCount` ".
					"from `".$this->tblRoomBookingInfo."` `A` ".
					"left join `".$this->tblstatus."` B on `A`.`RoomStatus`=`B`.`StatusID` ".
					(strlen(trim($this->conditionStr))==0?"":"where ".$this->conditionStr." ").			
					"group by `A`.`BookingDate`,`A`.`RoomStatus` ".
					"order by `A`.`BookingDate`,`A`.`RoomStatus`";
			return $sqlReturnStr;
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