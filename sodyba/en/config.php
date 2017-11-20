<?php
	session_start();
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("606431626689-t6f9prv6m5fl7dtc6tpbs77h2lsvsf5q.apps.googleusercontent.com");
	$gClient->setClientSecret("g_R-N6C7zbyg_nwhq1Gp1OBQ");
	$gClient->setApplicationName("Homestead Login");
	$gClient->setRedirectUri("http://localhost/sodyba/en/g-callback.php");
	$gClient->setScopes (array('https://www.googleapis.com/auth/plus.login', 'https://www.googleapis.com/auth/userinfo.email'));
?>