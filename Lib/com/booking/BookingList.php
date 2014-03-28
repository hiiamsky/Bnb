<?php
	namespace lib\com\booking;	
	// include '../../DefSet.php';
	// include '../sql.php';
	class BookingList{
		
		private $sql;
		private $html;
		private $tblRoomInfo="RoomInfo";
		private $tblstatus="status";
		private $tblRoomBookingInfo="RoomBookingInfo";
		private $bookingDate="";
		private $roomStatus=0;//\BOOKING_STATUS_CHECKOUT;
		private $page=0;
		private $pageCount=5;
		private $conditionStr="";
		private $bnbID="";
		private $bnbDBNm="";
		private $debugMsgStr="";
		public function __construct($bnbid,$bnbdbnm){
			//echo "BookingList";
			$this->sql=new \lib\com\sql($bnbdbnm);			
			$this->html=new \lib\com\html();
			$this->bnbID=$bnbid;
			$this->bnbDBNm=$bnbDBNm;		
			// $this->setDebugMsgStr("BookingList_Class's bnbID",$this->bnbID);
			// $this->setDebugMsgStr("BookingList_Class's bnbDBNm",$this->bnbDBNm=$bnbDBNm);
			// $this->setDebugMsgStr("BOOKING_STATUS_WAITREMIT",BOOKING_STATUS_WAITREMIT);
			// echo "BookingList";
		}

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
			
			$titleStr="";
			$CSSStr="";
			$JSStr="";
			
			
			
			$headercontent="<h1>訂房資訊</h1>\n";
			$headerdivotherstr=" date-theme=\"".$data_theme."\"";
			$header=$this->html->jQueryMobileHeader($headercontent, $headerdivotherstr);
			
			$jMcontent="";
			if(!empty($row)){
				$lastBookingDate="";
				$lastRoomStatus=0;
				$jMcontent.="<ul data-role=\"listview\" data-inset=\"true\" data-theme=\"b\" data-divider-theme=\"a\" data-count-theme=\"a\">\n";
				foreach ($row as $key => $colvalue){
					if(strlen(trim($lastBookingDate))==0 || $lastBookingDate!=trim($colvalue['BookingDate'])){			
						$lastBookingDate=$colvalue['BookingDate'];
						$jMcontent.="<li data-role=\"list-divider\">".$lastBookingDate."</li>\n";						
					}
					$jMcontent.="<li><a href=\"#\" data-theme=\"a\">".$colvalue['StatusContent']." <span class=\"ui-li-count\">".$colvalue['RoomStatusCount']."</span></a></li>\n";
					//echo $colvalue['BookingDate'].$colvalue['RoomStatus'].$colvalue['RoomStatusCount']."<br>";
				}
				$jMcontent.="</ul>\n";
			}
			$content=$this->html->jQueryMobileContent($jMcontent, "");
			
			$footcontent="<h4>bnb</h4>\n";
			$footer=$this->html->jQueryMobileFooter($footcontent, "");
			
			
			$showReturnStr.=$this->html->htmlHead($titleStr,$CSSStr,$JSStr);
			$showReturnStr.=$this->html->jQueryMobilePage($pageID, $header, $content, $footer, "");
			$showReturnStr.=$this->html->htmlEnd();
			
			return $showReturnStr;
	
		}
		private function setConditionStr($bookingdate,$roomstatus){
			$cStr="`A`.`BnbID`='".$this->bnbID."'"; //sql 條件式
			$BookingDateStr="DATE_FORMAT(`A`.`BookingDate`,'%Y-%m-%d')";
			if(strlen(trim($bookingdate))>0){				
				$BookingDateStr.="='".$bookingdate."'";
			}else{ 
				$BookingDateStr.=">='".$this->html->today()."'";
			}
			$cStr.=(strlen($cStr)>0?" and ":"").$BookingDateStr;
			
			if($roomstatus==0){
				//當沒有任何狀態時,抓小於退房的狀態
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