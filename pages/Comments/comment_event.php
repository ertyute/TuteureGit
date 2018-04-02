<?php
$c_query = "SELECT comment.id, comment.message, ratings.rating, comment.date, comment.lang, comment.parent_id, users.name, images.url
FROM comment 
LEFT JOIN users ON comment.user_id=users.id
LEFT JOIN images ON users.id=images.user_id
LEFT JOIN ratings ON users.id=ratings.user_id
WHERE comment.page_id=".$clubInfo[0]['id']."
AND comment.page_type='event'
;";

$c_result = $pdo->prepare($c_query);
$c_result->execute();
$comments = $c_result->fetchAll();
/*_________commentaire forme submission__________*/
if (isset($_SESSION["name"])) {

?>		<div>
 		<form action="pages/comments/comment_post.php" method="POST">
			<img class="user_icon" alt="" src="images/avatars/<?php echo $_SESSION["avatar"]; ?>">
			<textarea rows="4" cols="50" name="comment" class="comment"></textarea>
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
			<input type="hidden" name="club_id" value="<?php echo $clubInfo[0]['id']; ?>">
			<input type="hidden" name="parent_id" value="NULL">
			<input type="hidden" name="page_type" value="event">
			<br>
			<input type="submit" class="submit" value="Envoyer">
			<span class="error_msg">Votre commentaire est vide</span>
		</form>
		</div>
<?php
} else {
	echo "Only registered users can write comments. <a href='login.php' >Log in</a>";
};
/*_________-----------affichage des commentaires----------------__________*/

foreach ($comments as $key => $comment) {

	if ($comments[$key]['parent_id'] == NULL) { /*afficher les comments sans parents (originaux */
?>
		<div class="parent">
			<img class="user_icon" alt ="" src="images/avatars/<?php echo $comments[$key]['url'];?>">
			<h3><?php echo $comments[$key]['name'];?></h3>
			<hr>
			<div><?php echo $comments[$key]['date'];?></div>
			<p><?php echo $comments[$key]['message'];?></p>
<?php
		if (isset($_SESSION["name"])) { /*repondre au commentaire*/
?>
			<button id="btn_repondre_<?php echo $comments[$key]['id']; ?>">Repondre</button> 
<?php
	};
?>	</div>
	<div id="repondre_<?php echo $comments[$key]['id']; ?>">
 		<form action="pages/comments/comment_post.php" method="POST">
			<img class="user_icon" alt ="" src="images/avatars/<?php echo $_SESSION["avatar"];?>">
			<textarea rows="4" cols="50" name="comment" class="comment"></textarea>
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
			<input type="hidden" name="club_id" value="<?php echo $clubInfo[0]['id']; ?>">
			<input type="hidden" name="parent_id" value="<?php echo $comments[$key]['id'];?>">
			<input type="hidden" name="page_type" value="event">
			<span class="error_msg">Votre commentaire est vide</span>
			<br>
			<button class="submit">Envoyer</button>
		</form>
	</div>
<?php


foreach ($comments as $k => $v) {
		if ($comments[$k]['parent_id'] == $comments[$key]['id']) {
?>
		<div class="enfant">
			<img class="user_icon" src="images/avatars/<?php echo $comments[$k]['url'];?>" alt="user icon">
			<h3><?php echo $comments[$k]['name'];?></h3>
			<hr>
			<div><?php echo $comments[$k]['date'];?></div>
			<p><?php echo $comments[$k]['message'];?></p>
<?php
		if (isset($_SESSION["name"])) { /*repondre au commentaire*/
?>
			<button id="btn_repondre_<?php echo $comments[$k]['id']; ?>">Repondre</button> 
<?php
	};
		?></div>
		<div id="repondre_<?php echo $comments[$k]['id']; ?>">
 		<form action="pages/comments/comment_post.php" method="POST">
			<img class="user_icon" alt ="" src="images/avatars/<?php echo $_SESSION["avatar"];?>">
			<textarea rows="4" cols="50" name="comment" class="comment"></textarea>
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
			<input type="hidden" name="club_id" value="<?php echo $clubInfo[0]['id']; ?>">
			<input type="hidden" name="parent_id" value="<?php echo $comments[$key]['id'];?>">
			<input type="hidden" name="page_type" value="event">
			<span class="error_msg">Votre commentaire est vide</span>
			<br>
			<button class="submit">Envoyer</button>
		</form>
	</div>

		<?php
	}
	}}
} //end of foreach principal

?>
		

