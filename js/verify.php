<?php
header('content-type: text/json');

//no need to continue if there is no value in the POST username
if(!isset($_POST['username']))
    exit;
require_once('_config.php');

$query = $db->prepare('SELECT name FROM users WHERE username = :name');
$query->bindParam(':name', $_POST['username']);
$query->execute();

//return the json object containing the result of if the username exists or not. The $.post in our jquery will access it.
echo json_encode('OK');

?>