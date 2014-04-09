<?php
	namespace lib\com;
	class html{
		public function __construct(){
			
  		}
		/**
		 * Html 表頭
		 */
		public function htmlHead($titleStr,$CSSStr,$JSStr){
			$htmlHeadStr="";
			$htmlHeadStr.="<!DOCTYPE html>\n";
			$htmlHeadStr.="<html>\n";
			$htmlHeadStr.="<head>\n";
			$htmlHeadStr.="<meta charset=\"utf-8\">\n";
			$htmlHeadStr.="<meta name=\"viewport\" content=\"width=device-width,inital-scale=1.0\">\n";
			$htmlHeadStr."<title>".$titleStr."</title>\n";		
			//jQuery mobile CSS CDN Link
			$htmlHeadStr.="<link rel=\"stylesheet\" href=\"http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css\" />\n";
			
			
			//$htmlHeadStr.="<link rel=\"stylesheet\ href=\"https://rawgithub.com/arschmitz/jquery-mobile-datepicker-wrapper/v0.1.1/jquery.mobile.datepicker.css\" />\n";
			
			$htmlHeadStr.=$CSSStr."\n";
			
			//jQuery JScript CDN Link
			$htmlHeadStr.="<script src=\"http://code.jquery.com/jquery-1.9.1.min.js\"></script>\n";
			//datepicker Link
    		//$htmlHeadStr.="<script src=\"https://rawgithub.com/jquery/jquery-ui/1.10.4/ui/jquery.ui.datepicker.js\"></script>\n";
    		
			$htmlHeadStr.="<script type=\"text/javascript\">\n";
			$htmlHeadStr.="//設定jQueryMobile必須在Load之前設定\n";
			$htmlHeadStr.="$(document).bind(\"mobileinit\", function(){\n";
			$htmlHeadStr.="	//DateBox官方強烈建議將date降級成使用text\n";
			$htmlHeadStr.="   $.mobile.page.prototype.options.degradeInputs.date = 'text';\n";
			$htmlHeadStr.="});\n";
			$htmlHeadStr.="</script>\n";
			//jQuery mobile JScript CDN Link
			$htmlHeadStr.="<script src=\"http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js\"></script>\n";	
			//mobile-datepicker Link
			//$htmlHeadStr.="<script id=\"mobile-datepicker\" src=\"https://rawgithub.com/arschmitz/jquery-mobile-datepicker-wrapper/v0.1.1/jquery.mobile.datepicker.js\"></script>\n";				
			$htmlHeadStr.=$JSStr."\n";	
			$htmlHeadStr.="</head>\n";
			$htmlHeadStr.="<body>\n";
			return  $htmlHeadStr;
		}
		/**
		 * Html 表尾
		 */
		public function htmlEnd(){
			$htmlEndStr="";
			$htmlEndStr.="</body>\n";
			$htmlEndStr.="</html>\n";
			return  $htmlEndStr;
		}
		public function HiddenText($Nm,$Id,$DefVal,$otherstr){
			return "<input type=\"Hidden\" name=\"".$Nm."\" id=\"".$Id."\" value=\"".$DefVal."\"".$otherstr." />";
		}
		public function jQueryMTextforForm($Nm,$Id,$ShowNm,$DefVal,$otherstr,$isUseFieldContain=true){
			$jMhtmltextStr="";
			$jMhtmltextStr.="<label for=\"".$Nm."\">".$ShowNm."</label>\n".
							"<input type='text' name=\"".$Nm."\" id=\"".$Id."\" value=\"".$DefVal."\"".$otherstr." />\n";
			$jMhtmltextStr=$this->useFieldContainOrNot($isUseFieldContain,$jMhtmltextStr);				
			return  $jMhtmltextStr;					
		}
		public function jQueryMPWTextforForm($Nm,$Id,$ShowNm,$DefVal,$otherstr,$isUseFieldContain=true){
			$jMhtmlPWtextStr="";
			$jMhtmlPWtextStr.="<label for=\"".$Nm."\">".$ShowNm."</label>\n".
							"<input type='password' name=\"".$Nm."\" id=\"".$Id."\" value=\"".$DefVal."\"".$otherstr." />\n";
			$jMhtmlPWtextStr=$this->useFieldContainOrNot($isUseFieldContain,$jMhtmlPWtextStr);
			return  $jMhtmlPWtextStr;					
		}
		
		public function jQueryMDateTextforForm($Nm,$Id,$ShowNm,$DefVal,$otherstr,$isUseFieldContain=true){
			$jMDateTextStr="";
			
			$jMDateTextStr.="<label for=\"".$Nm."\">".$ShowNm."</label>\n";
			$jMDateTextStr.="<input type=\"date\" name=\"".$Nm."\" id=\"".$Id."\" value=\"".$DefVal."\"".$otherstr." />\n";
			$jMDateTextStr=$this->useFieldContainOrNot($isUseFieldContain,$jMDateTextStr);
			return  $jMDateTextStr;	
		}
		
		public function jQueryMTextSerachforForm($Nm,$Id,$ShowNm,$DefVal,$otherstr,$isUseFieldContain=true){
			$jMTextSerachStr="";
			$jMTextSerachStr.="<label for=\"".$Nm."\">".$ShowNm."</label>\n";
			$jMTextSerachStr.="<input type=\"search\" name=\"".$Nm."\" id=\"".$Nm."\" value=\"".$DefVal."\">\n";
			$jMTextSerachStr=$this->useFieldContainOrNot($isUseFieldContain,$jMTextSerachStr);
			return $jMTextSerachStr;
		}
		
		
		public function jQueryMTextAreaforForm($Nm,$Id,$ShowNm,$cols,$rows,$DefVal,$otherstr,$isUseFieldContain=true){
			$jMTextAreaStr="";			
			$jMTextAreaStr.="<label for=\"".$Nm."\">".$ShowNm."</label>\n";
			$jMTextAreaStr.="<textarea cols=\"".$cols."\" rows=\"".$rows."\" name=\"".$Nm."\" id=\"".$Nm."\">".$DefVal."</textarea>\n";
			$jMTextAreaStr=$this->useFieldContainOrNot($isUseFieldContain,$jMTextAreaStr);
			return $jMTextAreaStr;
		}	
		
		public function jQueryMSelectforForm($Nm,$Id,$ShowNm,$options,$DefVal,$otherstr,$isUseFieldContain=true){
			$jMTextSerachfStr="";
			$optionStr=$this->selectOptionStr($options,$DefVal);			
			$jMTextSerachfStr.="<label for=\"".$Nm."\">".$ShowNm."</label>\n";
			$jMTextSerachfStr.="<select name=\"".$Nm."\" id=\"".$Nm."\">\n";
			$jMTextSerachfStr.=$optionStr;
			$jMTextSerachfStr.="</select>\n";
			$jMTextSerachfStr=$this->useFieldContainOrNot($isUseFieldContain,$jMTextSerachfStr);
			return $jMTextSerachfStr;
		}			
		
		public function jQueryMSelectforMultipleforForm($Nm,$Id,$ShowNm,$options,$DefVal,$otherstr,$isUseFieldContain=true){
			$jMSelectforMultipleforFormStr="";
			$optionStr="<option value=\"\">選擇:</option>";
			$optionStr.=$this->selectOptionStr($options,$DefVal);			
			$jMSelectforMultipleforFormStr.="<label for=\"".$Nm."\">".$ShowNm."</label>\n";
			$jMSelectforMultipleforFormStr.="<select multiple=\"multiple\" name=\"".$Nm."\" id=\"".$Nm."\">\n";
			$jMSelectforMultipleforFormStr.=$optionStr;
			$jMSelectforMultipleforFormStr.="</select>\n";
			$jMSelectforMultipleforFormStr=$this->useFieldContainOrNot($isUseFieldContain,$jMSelectforMultipleforFormStr);
			return $jMSelectforMultipleforFormStr;
		}			
		
		
		private function selectOptionStr($options,$selectdefval){
			$returnOptionStr="";
			$OptionSA = split(",", $options);
			
			for($i=0;$i<count($OptionSA);$i++){
				list ($option,$value) = split(";", $OptionSA[$i]);
			
				$returnOptionStr.="<option value='".$value."'";
				$returnOptionStr.=((strlen($value)>0&&$value==$selectdefval)?'selected':'');
				$returnOptionStr.=">";
				$returnOptionStr.=$option."</option>\n";
			}
			return $returnOptionStr;
		}	
		
		public function jQueryMCheckBoxforForm($Nm,$Id,$ShowNm,$DefVal,$isCheck,$otherstr,$isUseFieldContain=true){
			$jMCheckBoxStr.="<input type=\"checkbox\" name=\"".$Nm."\" id=\"".$Nm."\"  value=\"".$DefVal."\" ".($isCheck?"checked":"").">\n";
    		$jMCheckBoxStr.="<label for=\"".$Nm."\">".$ShowNm."</label>\n";		
			$jMCheckBoxStr=$this->useFieldContainOrNot($isUseFieldContain,$jMCheckBoxStr);
			return $jMCheckBoxStr;
		}
		
		public function jQueryMButton($Nm,$Id,$Type,$DefVal,$otherstr,$isUseFieldContain=true){
			$jMButtonStr="";
			$jMButtonStr.="<button name=\"".$Nm."\" id=\"".$Id."\" type=\"".$Type."\"".$otherstr.">".$DefVal."</button>\n";
			$jMButtonStr=$this->useFieldContainOrNot($isUseFieldContain,$jMButtonStr);
			return  $jMButtonStr;					
		}
		
		public function jQueryMRadioforForm($Nm,$Id,$ShowNm,$DefVal,$isCheck,$otherstr,$isUseFieldContain=true){
			$jMRadioStr="";
			$jMRadioStr="<input type=\"radio\" name=\"".$Nm."\" id=\"".$Nm."\"  value=\"".$DefVal."\" ".($isCheck?"checked":"").">";
        	$jMRadioStr.="<label for=\"".$Nm."\">".$ShowNm."</label>\n";	
			$jMRadioStr=$this->useFieldContainOrNot($isUseFieldContain,$jMRadioStr);
			return $jMRadioStr;	
		}	
		
		private function useFieldContainOrNot($isUseFieldContain,$defval){
			$returnStr=$defval;
			if($isUseFieldContain){
				$returnStr=$this->divFieldContain($returnStr);
			}
			return $returnStr;
		}
		private function divFieldContain($content){
			$returnDivFieldContainStr="<div data-role=\"ui-field-contain\">\n".$content."</div>\n";
			return $returnDivFieldContainStr;
		}
		public function jQueryMobilePage($pageid,$header,$content,$footer,$pagedivotherstr){
			$pageStr="";
			$pageStr.= "<div data-role=\"page\"  id=\"".$pageid."\"".$pagedivotherstr.">\n";
			$pageStr.=$header;
			$pageStr.=$content;
			$pageStr.=$footer;
			$pageStr.= "</div>\n";
			return $pageStr;
		}
		public function jQueryMobileHeader($headercontent,$headerdivotherstr){
			$headerStr="";
			$headerStr.= "<div data-role=\"header\"".$headerdivotherstr.">\n";
			$headerStr.= $headercontent;//"<h1>".$nm."</h1>\n";
			$headerStr.= "</div>\n";
			return  $headerStr;
		}
		
		public function jQueryMobileFooter($footcontent,$footerdivotherstr){
			$footerStr="";
			$footerStr.= "<div data-role=\"footer\"".$footerdivotherstr.">\n";
			$footerStr.= $footcontent;//"<h4>bnb</h4>\n";
			$footerStr.= "</div>\n";
			return  $footerStr;
		}
		
		public function jQueryMobileContent($content,$contentdivotherstr){
			$contentStr="";
			$contentStr.= "<div role=\"main\" class=\"ui-content\"".$contentdivotherstr.">\n";
			$contentStr.=$content;		
			$contentStr.= "</div>\n";
			return  $contentStr;
		}
		/**
		 * 今天日期
		 */
		public function today(){
			return date("Y-m-d");
		}
		/**
		 * 日期加減
		 */
		public function addDays($date,$days){
			$date_elements = explode("-" ,$date);
			//, $date_elements[1], $date_elements[2], $date_elements[0]
			$date_years=$date_elements[0];
			$date_months=$date_elements[1];
			$date_days=$date_elements[2];
			return date("Y-m-d",mktime(0,0,0,$date_months,$date_days+($days),$date_years));
		}
		
		public function StringAdd($str,$num){
			$subStr=substr($str,0,($num*(-1)));
			$subNum=substr($str,($num*(-1)));
			$subNum=substr(sprintf("%d",(100000000+(int)$subNum)+1),($num*(-1)));
			return  $subStr.$subNum;
		}
	}

	
	
?>