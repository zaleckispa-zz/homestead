<?php
	session_start();
	require_once "config.php";
	unset($_SESSION['access_token']);
	$gClient->revokeToken();
	session_destroy();
	header('Location: https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/sodyba/en/visitor.php' . $_SERVER['localhost'] . $_SERVER['/sodyba/en/visitor.php']);
	exit();
?>