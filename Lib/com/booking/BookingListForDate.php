<?php
	namespace lib\com\booking;	

	class BookingListForDate extends \lib\com\booking\BookingListBase {
		private $html;
		
		private $BookingDateFormID="sBookingDateForm";
		
		private $goBookingFormID="goBookingForm";
		
		private $searchBookingDateDivID="searchBookingDateDiv";
		
		
		public function __construct($bnbid,$bnbdbnm,$pageid,$title){		
			parent::__construct($bnbid,$bnbdbnm,$pageid,$title);
			$this->html=new \lib\com\html();
			echo $this->RoomInfo->arrayFieldNm_roomBookingStatus;
		}

		protected function setJMContent($row){			
			$jMcontent="";			
			if(!empty($row)){
				foreach ($row as $key => $colvalue){		
					$this->setBookingDateRoomInfo($colvalue['BookingDate'],
												   $colvalue['RoomID'], 
												   $colvalue['RoomStatus'], 
												   $colvalue['CusNm'],
												   $colvalue['CusTel'],
												   $colvalue['Memo']);
				}
			}
			
			//利用 jQuery Mobile ListView功能
			
			$jMcontent.=$this->BookingDateListString();

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
			$searchChkinDays=$this->html->addDays($bookingdate,$this->getSearchChkinDays()-1);
			$cStr="`A`.`BnbID`='".$this->getBnbID()."'"; //sql 條件式
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
					(strlen(trim($this->getConditionStr()))==0?"":"where ".$this->getConditionStr()." ").			
					"order by `A`.`BookingDate`";
			// echo $sqlReturnStr;
			return $sqlReturnStr;
		}
		
		protected function BookingDateListString(){
			$isWAITBOOKING=FALSE;
			$isBOOKINGCANCEL=FALSE;
			$returnBookingDateLiString="";
			$roomstatus=0;
			$returnBookingDateLiString.="<div data-role=\"collapsibleset\" data-theme=\"a\" data-content-theme=\"b\">";
			foreach($this->getbookingDateArray() as $bookingDateArraykey => $bookingDateArraycolvalue){
			// for($datei=0;$datei<$this->searchChkinDays;$datei++){

				$returnBookingDateLiString.="<div data-role=\"collapsible\">\n";
				$returnBookingDateLiString.="<h4>".$bookingDateArraycolvalue["BookingDate"]."</h4>\n";
				$returnBookingDateLiString.="<ul data-role=\"listview\" data-theme=\"b\" data-split-icon=\"edit\" data-split-theme=\"a\">\n";
				
				foreach($bookingDateArraycolvalue["RoomInfo"] as $RoomInfokey => $RoomInfocolvalue){
					
					$roomstatus=$RoomInfocolvalue[\arrayFieldNm_roomBookingStatus];
					$isWAITBOOKING=($roomstatus==\BOOKING_STATUS_WAITBOOKING);				
					$isBOOKINGCANCEL=($roomstatus==\BOOKING_STATUS_CANCEL);			
					
					// $returnBookingDateLiString.="<li data-role=\"list-divider\">".$RoomInfocolvalue["roomNm"]."</li>\n";
					$returnBookingDateLiString.="<li>\n";
					$returnBookingDateLiString.="<a href=\"#\">\n";
					$returnBookingDateLiString.="<h3>".$RoomInfocolvalue[\arrayFieldNm_roomNm];
					$returnBookingDateLiString.="<font color=\"".$this->getRoomStatusColor($roomstatus)."\">&nbsp;&nbsp;&nbsp;".$this->getRoomStatusNm($roomstatus)."</font>\n";
					$returnBookingDateLiString.="</h3>";
					if(!$isWAITBOOKING && !$isBOOKINGCANCEL){
						$returnBookingDateLiString.="<div data-role=\"collapsible\" data-collapsed-icon=\"carat-d\" data-expanded-icon=\"carat-u\">\n";
						$returnBookingDateLiString.="<h4>入住資訊</h4>\n";
						$returnBookingDateLiString.="<p><strong>入住人:".$RoomInfocolvalue[\arrayFieldNm_roomBookingCusnm]."</strong></p>\n";
						$returnBookingDateLiString.="<p><strong>聯絡電話:".$RoomInfocolvalue[\arrayFieldNm_roomBookingCusTel]."</strong></p>\n";
						$returnBookingDateLiString.="<p><strong>備註:".$RoomInfocolvalue[\arrayFieldNm_roomBookingMemo]."</strong></p>\n";
						$returnBookingDateLiString.="</div>\n";
					}
					$returnBookingDateLiString.="</a>\n";
					$returnBookingDateLiString.="<a href=\"#\" data-ajax=\"false\" onclick=\"javascript:goBooking('".($isWAITBOOKING?\MODE_ADD:\MODE_EDIT)."','".$roomstatus."','".$bookingDateArraycolvalue["BookingDate"]."','".$RoomInfocolvalue["roomID"]."')\">修改</a>\n";

					$returnBookingDateLiString.="</li>\n";					
					// $returnBookingDateLiString.="<li><a href=\"index.html\">".$colvalue["roomNm"]."</a></li>\n";
				}
				$returnBookingDateLiString.="</ul>\n";
				$returnBookingDateLiString.="</div>\n";
				
			}
			$returnBookingDateLiString.="</div>";//"</ul>\n";
			return $returnBookingDateLiString;
		}

		protected function setfootContent(){
			$serchChkinDays=$this->getSearchChkinDays();
			$bookingDate=$this->getbookingDate();
			$lastserchChkinDaysDate=$this->html->addDays($bookingDate,($serchChkinDays*-1));
			$nextserchChkinDaysDate=$this->html->addDays($bookingDate,($serchChkinDays));
			
			$footcontent="<div data-role=\"navbar\" data-iconpos=\"bottom\">\n";
			$footcontent.="<ul>\n";
			$footcontent.="<li><a href=\"#\" data-ajax=\"false\" onclick=\"javascript:searchBookingDate('".$lastserchChkinDaysDate."')\" data-icon=\"arrow-l\">".$lastserchChkinDaysDate."</a></li>\n";
			$footcontent.="<li><a href=\"#\" data-ajax=\"false\" onclick=\"javascript:searchBookingDate('".$this->html->today()."')\" data-icon=\"star\">今天</a></li>\n";
			$footcontent.="<li><a href=\"#".$this->searchBookingDateDivID."\"  data-rel=\"popup\" data-position-to=\"window\" data-transition=\"pop\" data-icon=\"calendar\">搜尋</a></li>\n";
			$footcontent.="<li><a href=\"#\" data-ajax=\"false\" onclick=\"javascript:searchBookingDate('".$nextserchChkinDaysDate."')\" data-icon=\"arrow-r\">".$nextserchChkinDaysDate."</a></li>\n";
			$footcontent.="</ul>\n";
			$footcontent.="</div><!-- /navbar -->\n";
			
			
			//訂房日期的form
			$footcontent.=$this->setBookingDateForm();
			//搜尋訂房日期的DIV
			$footcontent.=$this->searchBookingDateDiv();
			return $footcontent;
		}
		protected  function setJScriptCode(){
			$returnMenuJSStr="";
			$returnMenuJSStr.="<script type=\"text/javascript\">\n";
			$returnMenuJSStr.="$(document).ready(function(){\n";
			$returnMenuJSStr.=$this->btnBookingJS("../");
			$returnMenuJSStr.=$this->btnLogoutJS("../");
			$returnMenuJSStr.=$this->btnSubmitBookingJS();
			$returnMenuJSStr.=$this->setPageJScriptCode();
			$returnMenuJSStr.=$this->btnSerchBookingDateJS();
			$returnMenuJSStr.="});\n";
			
			$returnMenuJSStr.=$this->searchBookingDateJS();			
			$returnMenuJSStr.=$this->goBookingJS();
			
			$returnMenuJSStr.="</script>\n";
			return $returnMenuJSStr;
		}
		
		private function searchBookingDateJS(){
			$returnsearchBookingDateJSStr="";
			$returnsearchBookingDateJSStr.="function searchBookingDate(sbookingdate){\n";
			$returnsearchBookingDateJSStr.="	$(\"#bookingDate\").val(sbookingdate);\n";
			$returnsearchBookingDateJSStr.="	$(\"#".$this->BookingDateFormID."\").submit();\n";
			$returnsearchBookingDateJSStr.="}\n";
			return $returnsearchBookingDateJSStr;
		}
		private function goBookingJS(){
			$returnBookingJSStr="";
			$returnBookingJSStr.="function goBooking(bookingmode,bookingstatus,bookingdate,bookingroomid){\n";
			$returnBookingJSStr.="	$(\"#BookingDtatus\").val(bookingstatus);\n";
			$returnBookingJSStr.="	$(\"#BookingDate\").val(bookingdate);\n";
			$returnBookingJSStr.="	$(\"#BookingRoomId\").val(bookingroomid);\n";
			$returnBookingJSStr.="	$(\"#BookingMode\").val(bookingmode);\n";
			$returnBookingJSStr.="	$(\"#".$this->goBookingFormID."\").submit();\n";
			$returnBookingJSStr.="}\n";
			return $returnBookingJSStr;
		}
		private function btnSerchBookingDateJS(){
			$returnbtnSubmitBookingJSStr="";
			$returnbtnSubmitBookingJSStr.="\n";
			$returnbtnSubmitBookingJSStr.="$(document).on(\"click\",\"#btnSerchBookingDate\",function(evt){\n";	
			$returnbtnSubmitBookingJSStr.="		if($.trim($(\"#serchbookingdate\").val())==\"\"){\n";	
			$returnbtnSubmitBookingJSStr.="			alert(\"請輸入搜尋日期\");\n";	
			$returnbtnSubmitBookingJSStr.="			$(\"#serchbookingdate\").focus();\n";	
			$returnbtnSubmitBookingJSStr.="			return false;\n";	
			$returnbtnSubmitBookingJSStr.="		}\n";	
			$returnbtnSubmitBookingJSStr.="		searchBookingDate($(\"#serchbookingdate\").val());\n";
			$returnbtnSubmitBookingJSStr.="});\n";
			return $returnbtnSubmitBookingJSStr;
		}
		
		
		private function searchBookingDateDiv(){
			$returnNewBookingDivStr="";
			$returnNewBookingDivStr.="<div data-role=\"popup\" id=\"".$this->searchBookingDateDivID."\" data-theme=\"a\" data-overlay-theme=\"b\" class=\"ui-content\" style=\"max-width:480px; padding-bottom:2em;\">\n";

			$returnNewBookingDivStr.="<ul data-role=\"listview\" data-inset=\"true\">\n";
			$returnNewBookingDivStr.="<li class=\"ui-field-contain\">\n";
			$returnNewBookingDivStr.=$this->html->jQueryMDateTextforForm("serchbookingdate","serchbookingdate","搜尋日期",$bookingdate," placeholder=\"".$this->html->today()."\"",false);
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
		
		private function setBookingDateForm(){
			$returnFormStr="";
			$returnFormStr.="<form name=\"".$this->BookingDateFormID."\" id=\"".$this->BookingDateFormID."\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\" data-ajax=\"false\">\n";
			$returnFormStr.=$this->html->HiddenText("bookingDate","bookingDate","","");
			$returnFormStr.="</form>\n";
			
			$returnFormStr.="<form name=\"".$this->goBookingFormID."\" id=\"".$this->goBookingFormID."\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\" data-ajax=\"false\">\n";
			$returnFormStr.=$this->html->HiddenText("BookingDate","BookingDate","","");
			$returnFormStr.=$this->html->HiddenText("BookingDtatus","BookingDtatus","","");
			$returnFormStr.=$this->html->HiddenText("BookingRoomId","BookingRoomId","","");
			$returnFormStr.=$this->html->HiddenText("BookingMode","BookingMode","","");
			$returnFormStr.="</form>\n";	
			
						
			return $returnFormStr;
		}		
	}

?>