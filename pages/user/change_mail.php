<?php
require_once('../../_config.php');

$id = trim($_POST['id']);
$mail = $_POST['mail'];

	$query = "UPDATE users
	SET mail = '".$mail."'WHERE id=".$id."; ";

	$result = $pdo->prepare($query);
	$result->execute();


	header("Location: ../../user_compte.php?msg=success");

?>