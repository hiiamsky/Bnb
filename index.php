<?php
session_start ();
include 'Login/loginCheck.php';
header("location: ".$_SESSION['BnbNm']."/index.php");
?>