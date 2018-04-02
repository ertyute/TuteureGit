<?php
require_once('../../_config.php');

$id = trim($_POST['id']);
$mdp_old = $_POST['mdp_old'];
$mdp0 = trim($_POST['mdp']);
$mdp = password_hash($mdp0, PASSWORD_DEFAULT);

$mdp_query = "SELECT password FROM users WHERE id=".$id.";";
$result = $pdo->prepare($mdp_query);
$result->execute();
$bdd_mdp = $result->fetchAll();

$bdd_mdp = $bdd_mdp[0]["password"];

$verify = password_verify($mdp_old, $bdd_mdp);

if ($verify) {
	$query = "UPDATE users
	SET password = '".$mdp."'
	WHERE id=".$id."; ";
	$result = $pdo->prepare($query);
	$result->execute();
	header("Location: ../../user_compte.php?msg=success");
} else {
	header("Location: ../../user_compte.php?msg=failure");
}
?>