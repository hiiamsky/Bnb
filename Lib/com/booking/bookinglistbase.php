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
		
		
		
		public function __construct($bnbid,$bnbdbnm,$pageid,$title){
				
			parent::__construct();
			
			$this->sql=new \lib\com\sql($bnbdbnm);			
			$this->html=new \lib\com\html();
			
			$this->bnbID=$bnbid;
			$this->bnbDBNm=$bnbDBNm;
			
			$this->pageID=$pageid;
			
			$this->titleStr=$title;
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
		protected function getRoomStatusNm($roomstatus){
			$returnStatusNm="";
			switch($roomstatus){
				case \BOOKING_STATUS_WAITREMIT:
					$returnStatusNm="待匯款";
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
			
			$this->bookingDate=$bookingdate;

			$this->roomStatus=$roomstatus;

			$this->page=$page;			
			$this->pageCount=$pagecount;	
					
			$this->conditionStr=$this->setConditionStr($bookingdate,$roomstatus);
			
			
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
			$footcontent="<h4>bnb</h4>\n";
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
			$returnMenuJSStr.="});\n";
			$returnMenuJSStr.="</script>\n";
			return $returnMenuJSStr;
		}
		
		protected  function setDebugMsgStr($debugnm,$debugstr){
			$this->debugMsgStr.=$debugnm.":".$debugstr."<br>";
		} 
		public function getDebugMsgStr(){
			return $this->debugMsgStr;
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