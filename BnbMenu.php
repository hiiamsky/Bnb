<?php
	session_start ();
	include_once 'Login/SessionCheck.php';
	// include_once 'Lib/com/DefSet.php';
	include_once 'Lib/com/html.php';	
	
	$html=new \lib\com\html;
	
	$titleStr="選單";
	$CSSStr="";
	$JSStr="<script src=\"JS/Menu/Menu.js\"></script>\n";;
	
	
	$headercontent="<h1>".$titleStr."</h1>\n";
	$headerdivotherstr=" date-theme=\"".$data_theme."\"";
	$header=$html->jQueryMobileHeader($headercontent, $headerdivotherstr);
	
	$jMcontent="";
	$jMcontent.= $html->jQueryM_Button("btnBnbInfo","btnBnbInfo","button","民宿資訊"," data-theme=\"".$data_theme."\"");
	$jMcontent.= $html->jQueryM_Button("btnBooking","btnBooking","button","訂房資訊"," data-theme=\"".$data_theme."\"");
	$jMcontent.= $html->jQueryM_Button("btnLogout","btnLogout","button","登出"," data-theme=\"".$data_theme."\"");
	$content=$html->jQueryMobileContent($jMcontent, "");
	
	$footcontent="<h4>bnb</h4>\n";	
	$footer=$html->jQueryMobileFooter($footcontent, "");
	
	
	echo $html->htmlHead($titleStr, $CSSStr, $JSStr);
	
	echo $html->jQueryMobilePage($pageID, $header, $content, $footer, "");
	
	echo $html->htmlEnd();
	
	exit();
?>