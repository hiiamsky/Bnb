<?php
	include '../lib/com/html.php';
	
	$html=new \lib\com\html ;
	
	$titleStr="登入";
	$JSLinkStr="<script src=\"../JS/Login/Login.js\"></script>\n";
	$CSSStr="";
	$data_theme="b";
	$pageID="LoginPage";

	$headercontent="<h1>登入</h1>\n";
	$headerdivotherstr=" date-theme=\"".$data_theme."\"";
	$header=$html->jQueryMobileHeader($headercontent, $headerdivotherstr);
	
	
	$jMcontent="";
	$jMcontent.="<form name=\"LoginForm\" id=\"LoginForm\" data-ajax=\"false\" method=\"post\" action=\"#\">\n";
	$jMcontent.= $html->jQueryMTextforForm("BnbID","BnbID","民宿編號","","");
	$jMcontent.= $html->jQueryMTextforForm("LoginID","LoginID","使用者名稱","","");
	$jMcontent.= $html->jQueryMPWTextforForm("LoginPW","LoginPW","使用者密碼","","");
	//$jMcontent.="<a id=\"btnSumit\" data-ajax=\"false\" href=\"#\" data-role=\"button\" data-theme=\"".$data_theme."\">登入</a>";
	$jMcontent.= $html->jQueryMButton("btnSumit","btnSumit","button","登入"," data-theme=\"".$data_theme."\"");
	$jMcontent.="</form>\n";
	$content=$html->jQueryMobileContent($jMcontent, "");
	
	$footcontent="<h4>bnb</h4>\n";
	$footer=$html->jQueryMobileFooter($footcontent, "");
	
	echo $html->htmlHead($titleStr, $CSSStr, $JSLinkStr);	
	echo $html->jQueryMobilePage($pageID, $header, $content, $footer, "");
	echo $html->htmlEnd();
	exit();
?>

