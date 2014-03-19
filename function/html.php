<?php

	function htmlHead($titleStr,$CSSStr,$JSStr){
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
		echo $htmlHeadStr;
	}
	function htmlEnd(){
		$htmlEndStr="";
		$htmlEndStr.="</body>\n";
		$htmlEndStr.="</html>\n";
		echo $htmlEndStr;
	}
	function jQueryM_Text($Nm,$Id,$ShowNm,$DefVal,$otherstr){
		$jMhtmltextStr="";
		$jMhtmltextStr.="<div data-role=\"fieldcontain\">\n".
						"<label for=\"".$Nm."\">".$ShowNm."</label>".
						"<input type='text' name=\"".$Nm."\" id=\"".$Id."\" value=\"".$DefVal."\"".$otherstr." />\n".
						"</div>\n";
		echo $jMhtmltextStr;					
	}
	function jQueryM_PWText($Nm,$Id,$ShowNm,$DefVal,$otherstr){
		$jMhtmlPWtextStr="";
		$jMhtmlPWtextStr.="<div data-role=\"fieldcontain\">\n".
						"<label for=\"".$Nm."\">".$ShowNm."</label>".
						"<input type='password' name=\"".$Nm."\" id=\"".$Id."\" value=\"".$DefVal."\"".$otherstr." />\n".
						"</div>\n";
		echo $jMhtmlPWtextStr;					
	}
	
	function jQueryM_Button($Nm,$Id,$Type,$DefVal,$otherstr){
		$jMhtmlButtonStr="";
		$jMhtmlButtonStr.="<div data-role=\"fieldcontain\">\n".						
						"<button name=\"".$Nm."\" id=\"".$Id."\" type=\"".$Type."\"".$otherstr.">".$DefVal."</button>\n".
						"</div>\n";
		echo $jMhtmlButtonStr;					
	}
	function jQueryMobilePage($pageID,$header,$content,$footer,$divotherstr){
		$pageStr="";
		$pageStr.= "<div data-role=\"page\"  id=\"".$pageID."\"".$divotherstr.">\n";
		$pageStr.=$header;
		$pageStr.=$content;
		$pageStr.=$footer;
		$pageStr.= "</div>\n";
		echo $pageStr;
	}
	function jQueryMobileHeader($headercontent,$divotherstr){
		$headerStr="";
		$headerStr.= "<div data-role=\"header\"".$divotherstr.">\n";
		$headerStr.= $content;//"<h1>".$nm."</h1>\n";
		$headerStr.= "</div>\n";
		echo $headerStr;
	}
	
	function jQueryMobileFooter($footcontent,$divotherstr){
		$footerStr="";
		$footerStr.= "<div data-role=\"footer\"".$divotherstr.">\n";
		$footerStr.= $footcontent;//"<h4>bnb</h4>\n";
		$footerStr.= "</div>\n";
		echo $footerStr;
	}
	
	function jQueryMobileContent($content,$divotherstr){
		$contentStr="";
		$contentStr.= "<div data-role=\"content\"".$divotherstr.">\n";
		$contentStr.=$content;
		// $pageStr.= "<form name=\"LoginForm\" id=\"LoginForm\" method=\"post\" action=\"\">\n";
// 	
		// $pageStr.= jQueryM_Text("BnbID","BnbID","民宿編號","");
		// $pageStr.= jQueryM_Text("LoginID","LoginID","使用者名稱","");
		// $pageStr.= jQueryM_PWText("LoginPW","LoginPW","使用者密碼","");
		// $pageStr.= jQueryM_Button("btnSumit","btnSumit","button","送出");		
// 					
		// $pageStr.= "</form>\n";
				
		$pageStr.= "</div>\n";
	}
	
	
	
?>