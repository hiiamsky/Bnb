<?php
	namespace lib\com\booking;
	abstract class BookingListBase extends \lib\com\menu\BnbMenu {

	
		private $html;
		private $sql;
		protected $bookingDate="";
		protected $roomStatus=0;	
		
		protected $page=0;		
		protected $pageCount=7;
		protected $conditionStr="";
		protected $bnbID="";
		protected $bnbDBNm="";
		protected $debugMsgStr="";
		protected $titleStr="";
		protected $CSSStr="";
		protected $JSStr="";
		
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
		protected function setBookingDateRoomInfo($date,$roomid,$status,$bookingifno){
			
			$this->bookingDateArray[$date]["RoomInfo"][$roomid]["roomstatus"]=$status;
			
			$this->bookingDateArray[$date]["RoomInfo"][$roomid]["bookingifno"]=$bookingifno;
		    
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
												"roomid"=>$colvalue['RoomID'],
												"roomnm"=>$colvalue['RoomNm'],
												"roomstatus"=>\BOOKING_STATUS_WAITBOOKING,
												"bookingifno"=>""
											 );
						
					$roomi++;	
	
									 
				}
				$this->roomcount=$roomi;
			}		
		
			return $roomarray;
		}
		protected function getBookingDateLiString(){
			$jMcontent="";
			$roomstatus=0;
			$jMcontent.="<div data-role=\"collapsibleset\" data-theme=\"a\" data-content-theme=\"b\">";
			foreach($this->bookingDateArray as $bookingDateArraykey => $bookingDateArraycolvalue){
			// for($datei=0;$datei<$this->searchChkinDays;$datei++){

				$jMcontent.="<div data-role=\"collapsible\">\n";
				$jMcontent.="<h4>".$bookingDateArraycolvalue["BookingDate"]."</h4>\n";
				$jMcontent.="<ul data-role=\"listview\" data-theme=\"b\">\n";
				
				foreach($bookingDateArraycolvalue["RoomInfo"] as $RoomInfokey => $RoomInfocolvalue){
					$roomstatus=$RoomInfocolvalue["roomstatus"];
					// $jMcontent.="<li data-role=\"list-divider\">".$RoomInfocolvalue["roomnm"]."</li>\n";
					$jMcontent.="<li><a href=\"#\">\n";
					$jMcontent.="<h3>".$RoomInfocolvalue["roomnm"];
					$jMcontent.="<font color=\"".$this->getRoomStatusColor($roomstatus)."\">&nbsp;&nbsp;&nbsp;".$this->getRoomStatusNm($roomstatus)."</font>\n";
					$jMcontent.="</h3>";
					$jMcontent.="</a></li>\n";					
					// $jMcontent.="<li><a href=\"index.html\">".$colvalue["roomnm"]."</a></li>\n";
				}
				$jMcontent.="</ul>\n";
				$jMcontent.="</div>\n";
				
			}
			$jMcontent.="</div>";//"</ul>\n";
			return $jMcontent;
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
			
		
			//jQuery Mobile 表頭
			$headercontent="<h1>".$this->titleStr."</h1>\n";
			//Menu panel button 需要配合 navMenuPanel()
			$headercontent.=parent::btnNavMenuPanel();//"<a href=\"#nav-panel\" data-icon=\"bars\" data-iconpos=\"notext\">Menu</a>\n";
			//$headercontent.="<a href=\"#\" class=\"ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext ui-btn-inline\">Search</a>\n";
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

			
			
			
			
			
			
			//jQuery Mobile 表尾
			//$footcontent="<h4>bnb</h4>\n";
			$footcontent="<div data-role=\"navbar\" data-iconpos=\"bottom\">\n";
			$footcontent.="<ul>\n";
			$footcontent.="<li><a href=\"#\" data-ajax=\"false\" onclick=\"javascript:BookingDate('".$this->html->addDays($this->bookingDate,($this->getSearchChkinDays()*-1))."')\" data-icon=\"arrow-l\">往前".$this->getSearchChkinDays()."天</a></li>\n";
			$footcontent.="<li><a href=\"#\" data-ajax=\"false\" onclick=\"javascript:BookingDate('".$this->html->today()."')\" data-icon=\"star\">今日</a></li>\n";
			$footcontent.="<li><a href=\"#".$this->serchBookingDateDivID."\"  data-rel=\"popup\" data-position-to=\"window\" data-transition=\"pop\" data-icon=\"calendar\">搜尋</a></li>\n";
			$footcontent.="<li><a href=\"#\" data-ajax=\"false\" onclick=\"javascript:BookingDate('".$this->html->addDays($this->bookingDate,($this->getSearchChkinDays()))."')\" data-icon=\"arrow-r\">往後".$this->getSearchChkinDays()."天</a></li>\n";
			$footcontent.="</ul>\n";
			$footcontent.="</div><!-- /navbar -->\n";
			$footcontent.="<form name=\"".$this->BookingDateFormID."\" id=\"".$this->BookingDateFormID."\" action=\"\" method=\"post\" data-ajax=\"false\">\n";
			$footcontent.=$this->html->HiddenText("bookingDate","bookingDate","","");
			$footcontent.="</form>\n";
			$footcontent.=$this->serchBookingDateDiv();
			$footer=$this->html->jQueryMobileFooter($footcontent, "");


			$this->JSStr=$this->setJScriptCode();
			
			$showReturnStr.=$this->html->htmlHead($this->titleStr,$this->CSSStr,$this->JSStr);
			$showReturnStr.=$this->html->jQueryMobilePage($this->pageID, $header, $content, $footer, "");
			$showReturnStr.=$this->html->htmlEnd();
			
			$this->sql->Close();
			
			return $showReturnStr;
	
		}

		private  function setJScriptCode(){
			$returnMenuJSStr="";
			$returnMenuJSStr.="<script type=\"text/javascript\">\n";
			$returnMenuJSStr.="$(document).ready(function(){\n";
			$returnMenuJSStr.=parent::btnBookingJS("../");
			$returnMenuJSStr.=parent::btnLogoutJS("../");
			$returnMenuJSStr.=parent::btnSubmitBookingJS();
			$returnMenuJSStr.=$this->setPageJScriptCode();
			$returnMenuJSStr.=$this->btnSerchBookingDateJS();
			$returnMenuJSStr.="});\n";
			$returnMenuJSStr.="function BookingDate(sbookingdate){\n";
			$returnMenuJSStr.="$(\"#bookingDate\").val(sbookingdate);\n";
			$returnMenuJSStr.="$(\"#".$this->BookingDateFormID."\").submit();\n";
			$returnMenuJSStr.="}\n";
			$returnMenuJSStr.="</script>\n";
			return $returnMenuJSStr;
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
		
		public function serchBookingDateDiv(){
			$returnNewBookingDivStr="";
			$returnNewBookingDivStr.="<div data-role=\"popup\" id=\"".$this->serchBookingDateDivID."\" data-theme=\"a\" data-overlay-theme=\"b\" class=\"ui-content\" style=\"max-width:480px; padding-bottom:2em;\">\n";
			//$returnNewBookingDivStr.="<h3>訂房日期</h3>";
			// $returnNewBookingDivStr.="<form name=\"".$this->BookingDateFormID."_SDate\" id=\"".$this->BookingDateFormID."_SDate\" action=\"\" method=\"post\">\n";
			$returnNewBookingDivStr.="<ul data-role=\"listview\" data-inset=\"true\">\n";
			$returnNewBookingDivStr.="<li class=\"ui-field-contain\">\n";
			$returnNewBookingDivStr.=$this->html->jQueryMDateTextforForm("serchbookingdate","serchbookingdate","搜尋日期",$bookingdate,"placeholder=\"".$this->html->today()."\"",false);
			$returnNewBookingDivStr.="</li>\n";		

			$returnNewBookingDivStr.="<li class=\"ui-body ui-body-b\">\n";
			$returnNewBookingDivStr.="<fieldset class=\"ui-grid-a\">\n";//data-rel=\"back\"
			$returnNewBookingDivStr.="<div class=\"ui-block-a\">".$this->html->jQueryMButton("btnSerchBookingDate","btnSerchBookingDate","button","確定"," data-theme=\"".$datatheme."\"  data-icon=\"check\"")."</div>\n";
			$returnNewBookingDivStr.="<div class=\"ui-block-b\"><a href=\"#\" class=\"ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b\" data-rel=\"back\">取消</a></div>\n";
			$returnNewBookingDivStr.="</fieldset>\n";
			$returnNewBookingDivStr.="</li>\n";
			$returnNewBookingDivStr.="</ul>\n";
			// $returnNewBookingDivStr.="</form>\n";
			$returnNewBookingDivStr.="</div>\n";
			return $returnNewBookingDivStr;
		}
		
		
		protected function btnSerchBookingDateJS(){
			$returnbtnSubmitBookingJSStr="";
			$returnbtnSubmitBookingJSStr.="\n";
			$returnbtnSubmitBookingJSStr.="$(document).on(\"click\",\"#btnSerchBookingDate\",function(evt){\n";	
			$returnbtnSubmitBookingJSStr.="		if($.trim($(\"#serchbookingdate\").val())==\"\"){\n";	
			$returnbtnSubmitBookingJSStr.="			alert(\"請輸入搜尋日期\");\n";	
			$returnbtnSubmitBookingJSStr.="			$(\"#serchbookingdate\").focus();\n";	
			$returnbtnSubmitBookingJSStr.="			return false;\n";	
			$returnbtnSubmitBookingJSStr.="		}else{\n";	
			$returnbtnSubmitBookingJSStr.="			BookingDate($(\"#serchbookingdate\").val());\n";
			$returnbtnSubmitBookingJSStr.="		}\n";	
			
			$returnbtnSubmitBookingJSStr.="});\n";
			return $returnbtnSubmitBookingJSStr;
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
// 
		// abstract protected  function setJScriptCode();
// 

		abstract protected  function setPageJScriptCode();
		
		
		protected function getConditionStr(){
			return $this->conditionStr;
		}
		
		protected function getBookingRoomListPage(){
			return $this->bookingRoomListPage;
		}

	}
?>