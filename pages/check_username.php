<?php
require_once('../_config.php');

$name = $_POST['name'];
$query = "SELECT name FROM users WHERE name ='".$name."';";
$result = $pdo->prepare($query);
$result->execute();
$name = $result->fetchAll();

$result = count($name);

if ($result == 1) {
	echo "Désolé, ce nom existe déjà";
}
?>