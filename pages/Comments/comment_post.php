<?php
require_once('../../_config.php');

$user = $_POST["user_id"];
$club = $_POST["club_id"];
$parent_id = $_POST["parent_id"];
$comment = htmlentities($_POST["comment"]);
$page_type=$_POST["page_type"];
$rating = "NULL";

if (isset($_POST["rating"])) {
	$rating = $_POST["rating"];

	$query = " INSERT INTO ratings 
	(club_id, rating, user_id)
	VALUES
	($club, $rating, $user)
;";
$result = $pdo->prepare($query);
$result->execute();
};



$comment_query = "INSERT INTO comment
(user_id, message, rating_id, date, lang, page_id, parent_id, page_type)
VALUES
($user, '$comment', $rating, now(), 'fr', $club, $parent_id, '$page_type')
;";

 
$result_comment = $pdo->prepare($comment_query);
$result_comment->execute();

if ($page_type == "club") {
	header('Location: ../../club.php?id='.$club);
}
if ($page_type == "event") {
	header('Location: ../../event.php?id='.$club);
}

?>