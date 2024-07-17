<?php
//bila buka localhost/bunga/ terus redirect ke login page
// Includes Login Script
include ("login.php") ;
error_reporting(E_ALL ^ E_NOTICE);
$error=$_GET['error'];

if (isset ($_SESSION['login_user'])) {
	header ("location: home.php");
}
?>