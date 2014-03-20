<?php
	include '../function/html.php';
	
	$titleStr="登入";
	$JSLinkStr="<script src=\"../JS/Login/Login.js\"></script>\n";
	$CSSStr="";
	$data_theme="b";
	$pageID="LoginPage";
	
	$headercontent="<h1>登入</h1>\n";
	$headerdivotherstr=" date-theme=\"".$data_theme."\"";
	$header=jQueryMobileHeader($headercontent, $headerdivotherstr);
	
	$jMcontent="";
	$jMcontent.="<form name=\"LoginForm\" id=\"LoginForm\" method=\"post\" action=\"ckLogin.php\">\n";
	$jMcontent.= jQueryM_Text("BnbID","BnbID","民宿編號","","");
	$jMcontent.= jQueryM_Text("LoginID","LoginID","使用者名稱","","");
	$jMcontent.= jQueryM_PWText("LoginPW","LoginPW","使用者密碼","","");
	$jMcontent.= jQueryM_Button("btnSumit","btnSumit","button","送出"," data-theme=\"".$data_theme."\"");
	$jMcontent.="</form>\n";
	$content=jQueryMobileContent($jMcontent, "");
	
	$footcontent="<h4>bnb</h4>\n";
	$footer=jQueryMobileFooter($footcontent, "");
	
	echo htmlHead($titleStr, $CSSStr, $JSLinkStr);	
	echo jQueryMobilePage($pageID, $header, $content, $footer, "");
	echo htmlEnd();
	
?>

