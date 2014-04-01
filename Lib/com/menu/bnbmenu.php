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
			$returnbtnBookingJSStr.="";
			$returnbtnBookingJSStr.="$(document).on(\"click\",\"#".$this->btnBookingID."\",function(evt){\n".	
							  "document.location.href=\"".$pathstr."Booking/BookingList.php\";\n".
							  "});\n";
			return $returnbtnBookingJSStr;
		}
		
		public function btnLogoutJS($pathstr){
			$returnbtnLogoutJSStr="";
			$returnbtnLogoutJSStr.="";
			$returnbtnLogoutJSStr.="$(document).on(\"click\",\"#".$this->btnLogoutID."\",function(evt){\n".	
							  "document.location.href=\"".$pathstr."Logout/Logout.php\";\n".
							  "});\n";
			return $returnbtnLogoutJSStr;
		}		
		
		public function menuBody($datatheme){
			$returnMenuBodyStr="";
			
			$returnMenuBodyStr.= $this->html->jQueryMButton($this->btnBnbInfoID,$this->btnBnbInfoID,"button","民宿資訊"," data-theme=\"".$datatheme."\"");
			$returnMenuBodyStr.= $this->html->jQueryMButton($this->btnBookingID,$this->btnBookingID,"button","訂房資訊"," data-theme=\"".$datatheme."\"");
			$returnMenuBodyStr.= $this->html->jQueryMButton($this->btnLogoutID,$this->btnLogoutID,"button","登出"," data-theme=\"".$datatheme."\"");	
			
			return $returnMenuBodyStr;
		}
		
		public function btnNavMenuPanel(){
			return "<a href=\"#".$this->navMenuPanelID."\" data-icon=\"bars\" data-iconpos=\"notext\">Menu</a>\n";
		}
		
		public function navMenuPanel($datatheme){
			$returnMenuPanelStr="";
			$returnMenuPanelStr.="<div data-role=\"panel\" data-position-fixed=\"true\" data-display=\"push\" data-theme=\"".$this->data_theme."\" id=\"".$this->navMenuPanelID."\">\n";
			$returnMenuPanelStr.=$this->menuBody($datatheme)."\n";
			$returnMenuPanelStr.="</div>";
			return $returnMenuPanelStr;
		}
		
		
		
	}
?>