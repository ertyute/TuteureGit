<?php
require_once('_config.php');
require "init_twig.php";

session_start();
if ( !isset($_SESSION["type"]) ) {
		header("Location: login.php");
	};

$page="monclub";

//VERIFIER SI UTILISATEUR EST CONNECTE//

	$query = "SELECT * FROM club WHERE user_id=".$_SESSION['id'].";";
	$result = $pdo->prepare($query);
	$result->execute();
	$monclub = $result->fetchAll();
	$count = $result->rowCount();
	




echo $twig->render('user_pro_club.html.twig', array(

    	'club' => $monclub,
    	'count' => $count
    	

    ));

?>

