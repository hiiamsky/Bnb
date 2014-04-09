<?php
	namespace lib\com\menu;	
	class BnbMenu{
		private $html;
		private $titleStr="選單";
		private $CSSStr="";
		private $JSStr="";//""<script src=\"JS/Menu/Menu.js\"></script>\n";
		private	$data_theme="b";
		private $pageID="bnbMenu";
		private $btnLogoutID="btnLogout";
		private $btnBookingID="btnBooking";
		private $btnbtnBnbInfoID="btnBnbInfo";
		private $navMenuPanelID="nav-panel";
		private $newBookigdivID="NewBooking";
		private $BookingDateFormID="BookingDateForm";
		private $btnSubmitBookingID="btnSubmitBooking";
		private $fieldBookingdateID="bookingdate";
		private $fieldBookingDaysID="bookingDays";
		public function __construct(){
				
			$this->html=new \lib\com\html;
		}
		public function show(){
			$returnShowStr="";
			
			
			$headercontent="<h1>".$this->titleStr."</h1>\n";
			$headerdivotherstr=" date-theme=\"".$this->data_theme."\"";
			$header=$this->html->jQueryMobileHeader($headercontent, $headerdivotherstr);
			
			
			$jMcontent=$this->menuBody($this->data_theme);

			$content=$this->html->jQueryMobileContent($jMcontent, "");		
			
			
			$footcontent="<h4>bnb</h4>\n";	
			$footer=$this->html->jQueryMobileFooter($footcontent, "");
			
			
			$menuJSContent="$(document).ready(function(){\n".$this->btnBookingJS("").$this->btnLogoutJS("")."});\n";
			$this->JSStr=$this->menuJS($menuJSContent);
			
			
			
			$returnShowStr.=$this->html->htmlHead($this->titleStr, $this->CSSStr, $this->JSStr);	
			$returnShowStr.=$this->html->jQueryMobilePage($this->pageID, $header, $content, $footer, "");	
			$returnShowStr.=$this->html->htmlEnd();
			
			
			return $returnShowStr;
		}
		private function menuJS($content){
			$returnMenuJSStr="";
			$returnMenuJSStr="<script type=\"text/javascript\">\n";
			$returnMenuJSStr.=$content;
			$returnMenuJSStr.="</script>\n";
			return $returnMenuJSStr;
		}
		public function btnBookingJS($pathstr){
			$returnbtnBookingJSStr="";
			$returnbtnBookingJSStr.="\n";
			$returnbtnBookingJSStr.="$(document).on(\"click\",\"#".$this->btnBookingID."\",function(evt){\n".	
							  "document.location.href=\"".$pathstr."Booking/BookingDateList.php\";\n".
							  "});\n";
			return $returnbtnBookingJSStr;
		}
		
		public function btnLogoutJS($pathstr){
			$returnbtnLogoutJSStr="";
			$returnbtnLogoutJSStr.="\n";
			$returnbtnLogoutJSStr.="$(document).on(\"click\",\"#".$this->btnLogoutID."\",function(evt){\n".	
							  "document.location.href=\"".$pathstr."Logout/Logout.php\";\n".
							  "});\n";
			return $returnbtnLogoutJSStr;
		}		
		
		public function menuBody($datatheme,$isshowclosebutton=false){
			$returnMenuBodyStr="";
			// if($isshowclosebutton) $returnMenuBodyStr.="<li data-icon=\"delete\"><a href=\"#\" data-rel=\"close\">Close menu</a></li>\n";
			if($isshowclosebutton)  $returnMenuBodyStr.=$this->html->jQueryMButton("btnClose","btnClose","button","關閉選單"," data-theme=\"".$datatheme."\" data-icon=\"delete\" data-rel=\"close\"");
			$returnMenuBodyStr.= $this->html->jQueryMButton($this->btnBnbInfoID,$this->btnBnbInfoID,"button","民宿資訊"," data-theme=\"".$datatheme."\"  data-icon=\"grid\"");
			$returnMenuBodyStr.= $this->html->jQueryMButton($this->btnBookingID,$this->btnBookingID,"button","訂房資訊"," data-theme=\"".$datatheme."\" data-icon=\"star\"");
			$returnMenuBodyStr.= $this->html->jQueryMButton($this->btnLogoutID,$this->btnLogoutID,"button","登出"," data-theme=\"".$datatheme."\" data-icon=\"alert\"");	
			
			return $returnMenuBodyStr;
		}
		
		public function btnNavMenuPanel(){
			return "<a href=\"#".$this->navMenuPanelID."\" data-icon=\"bars\" data-iconpos=\"notext\">Menu</a>\n";
		}
		
		public function navMenuPanel($datatheme){
			$returnMenuPanelStr="";
			$returnMenuPanelStr.="<div data-role=\"panel\" data-position-fixed=\"true\" data-display=\"push\" data-theme=\"".$this->data_theme."\" id=\"".$this->navMenuPanelID."\">\n";
			$returnMenuPanelStr.=$this->menuBody($datatheme,TRUE)."\n";
			$returnMenuPanelStr.="</div>";
			return $returnMenuPanelStr;
		}
		public function getNewBookigdivID(){
			return $this->newBookigdivID;
		}
		public function getfieldBookingdateID(){
			return $this->fieldBookingdateID;
		}
		public function getfieldBookingDaysID(){
			return $this->fieldBookingDaysID;
		}
		public function addNewBookingDiv($bookingdate){
			$returnNewBookingDivStr="";
			$returnNewBookingDivStr.="<div data-role=\"popup\" id=\"".$this->newBookigdivID."\" data-theme=\"a\" data-overlay-theme=\"b\" class=\"ui-content\" style=\"max-width:480px; padding-bottom:2em;\">\n";
			$returnNewBookingDivStr.="<h3>訂房</h3>";
			$returnNewBookingDivStr.="<form name=\"".$this->BookingDateFormID."\" id=\"".$this->BookingDateFormID."\" action=\"\" method=\"post\">\n";
			$returnNewBookingDivStr.="<ul data-role=\"listview\" data-inset=\"true\">\n";
			$returnNewBookingDivStr.="<li class=\"ui-field-contain\">\n";
			$returnNewBookingDivStr.=$this->html->jQueryMDateTextforForm("bookingdate","bookingdate","預定入住日期",$bookingdate,"",false);
			$returnNewBookingDivStr.="</li>\n";		
			$returnNewBookingDivStr.="<li class=\"ui-field-contain\">\n";
			$returnNewBookingDivStr.="<label for=\"Days\">\n預定入住天數:</label>\n";
			$returnNewBookingDivStr.="<input type=\"range\" name=\"bookingDays\" id=\"bookingDays\" value=\"1\" min=\"1\" max=\"31\" data-highlight=\"true\">\n";
			$returnNewBookingDivStr.="</li>\n";
			$returnNewBookingDivStr.="<li class=\"ui-body ui-body-b\">\n";
			$returnNewBookingDivStr.="<fieldset class=\"ui-grid-a\">\n";//data-rel=\"back\"
			$returnNewBookingDivStr.="<div class=\"ui-block-a\">".$this->html->jQueryMButton($this->btnSubmitBookingID,$this->btnSubmitBookingID,"button","確定"," data-theme=\"".$datatheme."\"  data-icon=\"check\"")."</div>\n";
			$returnNewBookingDivStr.="<div class=\"ui-block-b\"><a href=\"#\" class=\"ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b\" data-rel=\"back\">取消</a></div>\n";
			$returnNewBookingDivStr.="</fieldset>\n";
			$returnNewBookingDivStr.="</li>\n";
			$returnNewBookingDivStr.="</ul>\n";
			$returnNewBookingDivStr.="</form>\n";
			$returnNewBookingDivStr.="</div>\n";
			return $returnNewBookingDivStr;
		}

		protected function btnSubmitBookingJS(){
			$returnbtnSubmitBookingJSStr="";
			$returnbtnSubmitBookingJSStr.="\n";
			$returnbtnSubmitBookingJSStr.="$(document).on(\"click\",\"#".$this->btnSubmitBookingID."\",function(evt){\n";	
			$returnbtnSubmitBookingJSStr.="		if($.trim($(\"#".$this->fieldBookingdateID."\").val())==\"\"){\n";	
			$returnbtnSubmitBookingJSStr.="			alert(\"請輸入預定入住日期\");\n";	
			$returnbtnSubmitBookingJSStr.="			$(\"#".$this->fieldBookingdateID."\").focus();\n";	
			$returnbtnSubmitBookingJSStr.="			return false;\n";	
			$returnbtnSubmitBookingJSStr.="		}\n";	
			$returnbtnSubmitBookingJSStr.="		if(parseInt($(\"#".$this->fieldBookingDaysID."\").val())<1){\n";	
			$returnbtnSubmitBookingJSStr.="			alert(\"輸入預定入住天數錯誤\");\n";	
			$returnbtnSubmitBookingJSStr.="			$(\"#".$this->fieldBookingDaysID."\").focus();\n";	
			$returnbtnSubmitBookingJSStr.="			return false;\n";	
			$returnbtnSubmitBookingJSStr.="		}\n";				
			$returnbtnSubmitBookingJSStr.="});\n";
			return $returnbtnSubmitBookingJSStr;
		}
		
	}
?>