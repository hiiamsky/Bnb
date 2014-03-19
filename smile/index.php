<?php
	session_start ();
	// define("NOW_DIR",dirname(__FILE__));
	include dirname(__FILE__).'/../function/subloginCheck.php';
	include '../function/html.php';
	$titleStr="登入";
	$JSLinkStr="<script src=\"../JS/Login.js\"></script>\n";
	$CSSStr="";
	
	echo htmlHead($titleStr, $CSSStr, $JSLinkStr);
?>