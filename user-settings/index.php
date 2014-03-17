<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
$page = $_GET['goPage'];
#set the default value of isLogged to false
$isLogged = false;
if($page === '404') {
	$page = '404';
} elseif(isset($_COOKIE['DACC'])) {
	$isLogged = true;
} elseif($page == 'login') {
	$page = 'login';
} elseif($page == null) {
	$page = 'login';
} elseif($page == 'reset-pass') {
	$page = 'reset-pass';
} else {
	header('Location: https://dacc-online.com/login-error/3');
}

#Include the header
if($isLogged === true) {
	require_once('../../bin/user-control/header.php');
	include('../header.php');
}

#include the requested page
include("{$page}.php");

#Include the footer
if($isLogged === true) {
	include('../footer.php');
}
?>