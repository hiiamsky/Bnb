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
			//jQuery CSS CDN Link
			$htmlHeadStr.="<link rel=\"stylesheet\" href=\"http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css\" />\n";
			$htmlHeadStr.=$CSSStr."\n";
			//jQuery JScript CDN Link
			$htmlHeadStr.="<script src=\"http://code.jquery.com/jquery-1.9.1.min.js\"></script>\n";
			$htmlHeadStr.="<script src=\"http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js\"></script>\n";		
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
		public function jQueryMTextforForm($Nm,$Id,$ShowNm,$DefVal,$otherstr){
			$jMhtmltextStr="";
			$jMhtmltextStr.="<div data-role=\"fieldcontain\">\n".
							"<label for=\"".$Nm."\">".$ShowNm."</label>\n".
							"<input type='text' name=\"".$Nm."\" id=\"".$Id."\" value=\"".$DefVal."\"".$otherstr." />\n".
							"</div>\n";
			return  $jMhtmltextStr;					
		}
		public function jQueryMPWTextforForm($Nm,$Id,$ShowNm,$DefVal,$otherstr){
			$jMhtmlPWtextStr="";
			$jMhtmlPWtextStr.="<div data-role=\"fieldcontain\">\n".
							"<label for=\"".$Nm."\">".$ShowNm."</label>\n".
							"<input type='password' name=\"".$Nm."\" id=\"".$Id."\" value=\"".$DefVal."\"".$otherstr." />\n".
							"</div>\n";
			return  $jMhtmlPWtextStr;					
		}
		
		public function jQueryMButton($Nm,$Id,$Type,$DefVal,$otherstr){
			$jMhtmlButtonStr="";
			$jMhtmlButtonStr.="<div data-role=\"fieldcontain\">\n".						
							"<button name=\"".$Nm."\" id=\"".$Id."\" type=\"".$Type."\"".$otherstr.">".$DefVal."</button>\n".
							"</div>\n";
			return  $jMhtmlButtonStr;					
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
	}

	
	
?>