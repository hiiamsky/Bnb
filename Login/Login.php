<?php
	include '../function/html.php';
	$html=new html();
	
	$titleStr="登入";
	$JSLinkStr="<script src=\"../JS/Login/Login.js\"></script>\n";
	$CSSStr="";
	$data_theme="b";
	$pageID="LoginPage";
	
	$headercontent="<h1>登入</h1>\n";
	$headerdivotherstr=" date-theme=\"".$data_theme."\"";
	$header=$html->jQueryMobileHeader($headercontent, $headerdivotherstr);
	
	
	$jMcontent="";
	$jMcontent.="<form name=\"LoginForm\" id=\"LoginForm\" method=\"post\" action=\"ckLogin.php\">\n";
	$jMcontent.= $html->jQueryM_Text("BnbID","BnbID","民宿編號","","");
	$jMcontent.= $html->jQueryM_Text("LoginID","LoginID","使用者名稱","","");
	$jMcontent.= $html->jQueryM_PWText("LoginPW","LoginPW","使用者密碼","","");
	$jMcontent.= $html->jQueryM_Button("btnSumit","btnSumit","button","送出"," data-theme=\"".$data_theme."\"");
	$jMcontent.="</form>\n";
	$content=$html->jQueryMobileContent($jMcontent, "");
	
	$footcontent="<h4>bnb</h4>\n";
	$footer=$html->jQueryMobileFooter($footcontent, "");
	
	echo $html->htmlHead($titleStr, $CSSStr, $JSLinkStr);	
	echo $html->jQueryMobilePage($pageID, $header, $content, $footer, "");
	echo $html->htmlEnd();
	
?>

