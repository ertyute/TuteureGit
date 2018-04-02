<?php
require "init_twig.php";
require_once('_config.php');
session_start();

	$avatar = NULL;
	$session_active = true;
	$session_type = NULL;
	$username = NULL;
	$page = "hello";

	if ( isset($_SESSION["name"])) {
		$session_active = true;
		$username = $_SESSION['name'];
		$avatar = "images/avatars/".$_SESSION["avatar"];

		if ($_SESSION["type"] == "normal") { $session_type = "normal"; }
		if ($_SESSION["type"] == "admin") { $session_type = "admin"; }
		if ($_SESSION["type"] == "pro") { $session_type = "pro"; }

	} 


echo $twig->render('template.html.twig', array(

    	'session_active' => $session_active, 
    	'session_type' => $session_type,
    	'avatar' => $avatar,
    	'username' => $username,
    	'page' => $page

    ));
?>