<?php
require_once('../_config.php');
session_start();
$page = "commentaires";

if (isset($_SESSION["type"])) {
	if ($_SESSION["type"] == "normal" OR $_SESSION["type"] == "pro") { header('Location: BackOffice/_nopermission.php');}}
if (!isset($_SESSION["name"])) { header('Location: BackOffice/_nopermission.php');}


/*-------------------------------*/

$query = "SELECT comment.id, comment.message, comment.rating_id, comment.date, comment.lang, comment.parent_id, users.name, images.url, comment.page_type, comment.page_id
FROM comment 
LEFT JOIN users ON comment.user_id=users.id
LEFT JOIN images ON users.id=images.user_id
ORDER BY comment.date DESC
;";
$result = $pdo->prepare($query);
$result->execute();
$comments = $result->fetchAll();



/* start of HTML _________*/
include ('_head_office.php');
?>

</head>
<body>

<?php include("_header_office.php"); 
?><section class="comments"><?php
	/*_________-----------affichage des commentaires----------------__________*/

foreach ($comments as $key => $comment) {

?>
		<div class="parent">
			<img class="user_icon" alt ="" src="../images/avatars/<?php echo $comments[$key]['url'];?>">
			<h3><?php echo $comments[$key]['name'];?></h3>
<?php //Afficher les évaluations avec les étoiles
if ($comments[$key]['rating_id'] !== NULL) {
	$niveau = $comments[$key]['rating_id'];

		for($i = 1; $i <= $niveau; $i++) {
			echo "<img class='star' alt='' src='../images/website/icons/pleine.jpg'/>";
		}
		for($j = $i; $j <= 5; $j++) {
			echo "<img class='star' alt='' src='../images/website/icons/vide.jpg'/>";
		}
}

?>
			<hr>
			<div><?php echo $comments[$key]['date'];?></div>
			<p><?php echo $comments[$key]['message'];?></p>
			<button id="btn_repondre_<?php echo $comments[$key]['id']; ?>">Repondre</button> 
			<button id="btn_supprimer_<?php echo $comments[$key]['id']; ?>">Supprimer</button>
		</div>
<?php
	};
?>
	<div id="repondre_<?php echo $comments[$key]['id']; ?>">
 		<form action="pages/comments/comment_post.php" method="POST">
			<img class="user_icon" alt ="" src="images/avatars/<?php echo $_SESSION["avatar"];?>">
			<textarea rows="4" cols="50" name="comment" class="comment"></textarea>
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
			<input type="hidden" name="club_id" value="<?php echo $clubInfo[0]['id']; ?>">
			<input type="hidden" name="parent_id" value="<?php echo $comments[$key]['id'];?>">
			<input type="hidden" name="page_type" value="club">
			<span class="error_msg">Votre commentaire est vide</span>
			<br>
			<button class="submit">Envoyer</button>
		</form>
	</div>
</section>
</body>
</html>