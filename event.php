<?php
require_once('_config.php');

session_start();

include '_head.php';
$page = "event";
$id = $_GET["id"];

$clubQuery = 'SELECT * FROM event WHERE id = '.$id.';';
$result = $pdo->prepare($clubQuery);
$result->execute();
$clubInfo = $result->fetchAll();


/*IMAGES*/
$imgQuery = 'SELECT url FROM images 
			WHERE event_id='.$id.';';

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
	<section class="left">
		<div class="arrow"></div><a class="revenir" href="recherche.php">Revenir à la recherche</a>
		<div>
			<h1><?php echo $clubInfo[0]['name']; ?></h1>
			<h4><?php echo $clubInfo[0]['date']; ?></h4>
			<h4><?php echo $clubInfo[0]['address']; ?></h4>
			<hr/>
<?php 
/*--------FAVORI CHECKBOX-------------*/
	if (isset($_SESSION["id"])) { ?>
			<span>
				<input type="checkbox" name="favori" value="favori" id="favori_event<?php echo $id; ?>" 
<?php if($fav > 0) {echo "checked";} ?>
	onclick="addFavori(<?php echo $id; ?>, 'event', false)"
	>

			</span>
<?php
} /*----------FIN DE CHECKBOX-------------*/			
?>
		</div>
		<div>
			<p><?php echo $clubInfo[0]['description_FR']; ?></p>
		</div>

	</section>
	<section class="right">

<?php
foreach ($img as $key => $value) {
?>
		<img src="images/events/<?php echo $value["url"]; ?>" alt="<?php echo $clubInfo[0]['name']; ?>">
<?php
}

?>
	<div>
		<p><?php echo $clubInfo[0]['website']; ?></p>
		<p><?php echo $clubInfo[0]['mail']; ?></p>
	</div>
		
	</section>
	<section class="comments">
<?php include("pages/comments/comment_event.php"); ?>
	</section>
	<?php include("pages/footer.php"); ?>
</body>
</html>