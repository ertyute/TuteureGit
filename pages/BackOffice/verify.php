<?php
header('content-type: text/json');

//no need to continue if there is no value in the POST username
if(!isset($_POST['username']))
    exit;

//initialize our PDO class. You will need to replace your database credentials respectively
require_once('_config.php');

//prepare our query.
$query = $db->prepare('SELECT * FROM users WHERE username = :name');
//let PDO bind the username into the query, and prevent any SQL injection attempts.
$query->bindParam(':name', $_POST['username']);
//execute the query
$query->execute();

//return the json object containing the result of if the username exists or not. The $.post in our jquery will access it.
echo json_encode(array('exists' => $query->rowCount() > 0));

?>