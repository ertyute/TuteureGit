<?php
require_once('../../_config.php');
session_start();
$user_id = $_SESSION["id"];
$page_id = $_GET["page_id"];
$page_type = $_GET["page_type"];
$checked = $_GET["checked"];

if ($checked == "false") {

	$query = "
DELETE FROM favoris 
WHERE user_id=".$user_id."
AND page_id=".$page_id."
AND page_type = '".$page_type."'
;";

$result= $pdo->prepare($query);
$result->execute();


} else {
	$query = "INSERT INTO favoris (user_id, page_id, page_type)
VALUES (".$user_id.", ".$page_id." , '".$page_type."'); ";

$result= $pdo->prepare($query);
$result->execute();



}
?>