<?php
require_once('_config.php');

session_start();

include '_head.php';
$page = "club";
$id = $_GET["id"]; /*id de la page*/

$clubQuery = 'SELECT * FROM club WHERE id = '.$id.';';
$result = $pdo->prepare($clubQuery);
$result->execute();
$clubInfo = $result->fetchAll();

/*ACTIVITE TAGS*/
$tagQuery1 = 'SELECT name_FR FROM tag 
LEFT JOIN club_tag ON tag.id=club_tag.tag_id
WHERE club_tag.club_id='.$id.'
AND tag.type=1;';

$result = $pdo->prepare($tagQuery1);
$result->execute();
$tagInfo = $result->fetchAll();

/*TYPE TAGS*/
$tagQuery2 = 'SELECT name_FR FROM tag 
LEFT JOIN club_tag ON tag.id=club_tag.tag_id
WHERE club_tag.club_id='.$id.'
AND tag.type=2;';

$result = $pdo->prepare($tagQuery2);
$result->execute();
$tag2 = $result->fetchAll();

/*IMAGES*/
$imgQuery = 'SELECT url FROM images 
			WHERE club_id='.$id.';';

$result = $pdo->prepare($imgQuery);
$result->execute();
$img = $result->fetchAll();

/*----------favoris--------------*/
if (isset($_SESSION["id"])) {

/*FAVORIS*/
$favquery = 'SELECT * FROM favoris
WHERE user_id= '.$_SESSION["id"].'
AND page_id= '.$id.'
AND page_type="'.$page.'"
;';

$result1 = $pdo->prepare($favquery);
$result1->execute();
$result1->fetchAll();
$fav = $result1->rowCount();

}
?>

</head>
<body>
<?php include("header.php"); ?>
	<section class="top1">
	
		<a class="revenir" href="recherche.php">Revenir à la recherche</a>
			<h1><?php echo $clubInfo[0]['name']; ?></h1>
			<h4>
<?php
			foreach ($tag2 as $key => $value) {
				if ($key > 0) { echo " / ";};
				echo $tag2[$key]['name_FR'];
			}
?>
			</h4>
	</section>
	<section class="left">
			<hr/>
			<span>
<?php include "inc/evaluation.inc.php"; /*évaluation de préstataire*/?>
			</span>
<?php 
/*--------FAVORI CHECKBOX-------------*/
	if (isset($_SESSION["id"])) { ?>
			<span>
				<input type="checkbox" name="favori" value="favori" id="favori_club<?php echo $id; ?>" <?php if($fav > 0) {echo "checked";} ?> onclick="addFavori(<?php echo $id; ?>, 'club', false)">
				<label for="favori_club<?php echo $id; ?>">
					<?php if($fav > 0) { ?>
				<img src="images/website/icons/heart-pleine.svg" class="heart_icon" alt="supprimer le favori">
<?php					} else { ?>
						<img src="images/website/icons/heart-vide.svg" class="heart_icon" alt="ajouter aux favoris">
<?php }?>
				</label>
			</span>
<?php
} /*----------FIN DE CHECKBOX-------------*/			
?>
		<div>
			<p><?php echo $clubInfo[0]['description_FR']; ?></p>
		</div>

		<div class="bordered">
			<h3>Activités</h3>
			<ul><?php
			foreach ($tagInfo as $key => $value) {
				echo '<li>'; 
				echo $tagInfo[$key]['name_FR'];
				echo '</li>';
			}
			?>
			</ul>
		</div>
		<div>
			<div><?php echo $clubInfo[0]['address']; ?></div>
			<div><?php echo $clubInfo[0]['telephone']; ?></div>
			<div><?php echo $clubInfo[0]['mail']; ?></div>
		</div>
		<section class="comments">
			<?php include("pages/comments/comment_club.php"); ?>
		</section>
	</section>

	<section class="right">

<?php
foreach ($img as $key => $value) {
?>
		<img src="images/clubs/<?php echo $value["url"]; ?>" alt="<?php echo $clubInfo[0]['name']; ?>">
<?php
}

?>		
	</section>
	<?php include("pages/footer.php"); ?>
</body>
</html>