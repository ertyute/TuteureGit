<?php
	session_start();
	//VERIFIER SI UTILISATEUR EST CONNECTE//
	if ( !isset($_SESSION["user"]) ) {
		include("header.php");
	};

?>