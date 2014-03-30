<?php
	session_start ();
	include_once 'Login/SessionCheck.php';
	// include_once 'Lib/com/DefSet.php';
	include_once 'lib/com/html.php';	
	include_once 'lib/com/menu/bnbmenu.php';
	$BM=new \lib\com\menu\BnbMenu();
	echo $BM->show();
	//exit();
	// $html=new \lib\com\html;
// 	
	// $titleStr="選單";
	// $CSSStr="";
	// $JSStr="<script src=\"JS/Menu/Menu.js\"></script>\n";;
	// $pageID="bnbMenu";
	// $data_theme="b";
	// $headercontent="<h1>".$titleStr."</h1>\n";
	// $headerdivotherstr=" date-theme=\"".$data_theme."\"";
	// $header=$html->jQueryMobileHeader($headercontent, $headerdivotherstr);
// 	
	// $jMcontent="";
	// $jMcontent.= $html->jQueryMButton("btnBnbInfo","btnBnbInfo","button","民宿資訊"," data-theme=\"".$data_theme."\"");
	// $jMcontent.= $html->jQueryMButton("btnBooking","btnBooking","button","訂房資訊"," data-theme=\"".$data_theme."\"");
	// $jMcontent.= $html->jQueryMButton("btnLogout","btnLogout","button","登出"," data-theme=\"".$data_theme."\"");
	// $content=$html->jQueryMobileContent($jMcontent, "");
// 	
	// $footcontent="<h4>bnb</h4>\n";	
	// $footer=$html->jQueryMobileFooter($footcontent, "");
// 	
// 	
	// echo $html->htmlHead($titleStr, $CSSStr, $JSStr);
// 	
	// echo $html->jQueryMobilePage($pageID, $header, $content, $footer, "");
// 	
	// echo $html->htmlEnd();
	
	
?>