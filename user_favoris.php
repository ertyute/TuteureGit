<?php
require_once('_config.php');
session_start();
$page = "favoris";
	//VERIFIER SI UTILISATEUR EST CONNECTE//
	if ( !isset($_SESSION["type"]) ) {
		header("Location: login.php");
	};
/*-----------------------CLUBS------------------------------*/
$query="SELECT club.id, club.name, images.url, favoris.page_id FROM favoris
LEFT JOIN club ON favoris.page_id=club.id
LEFT JOIN images ON images.club_id=club.id
WHERE favoris.user_id=".$_SESSION['id']."
AND favoris.page_type='club'
GROUP BY club.id
;";
$result = $pdo->prepare($query);
$result->execute();
$clubs = $result->fetchAll();

/*--------------------EVENTS---------------------------------*/
$query="SELECT event.id, event.name, event.date, images.url, favoris.page_id FROM favoris
LEFT JOIN event ON favoris.page_id=event.id
LEFT JOIN images ON images.event_id=event.id
WHERE favoris.user_id=".$_SESSION['id']."
AND favoris.page_type='event'
GROUP BY event.id
ORDER BY event.date
;";
$result = $pdo->prepare($query);
$result->execute();
$events = $result->fetchAll();

/**************************************************************/

include '_head.php';
?>
<body>

		<?php include("header.php"); ?>
		<!--<div id="filter"><h1>Vos favoris</h1></div>-->

<section>
	<h1>Clubs</h1>
<?php
	foreach ($clubs as $key => $value) {
?>
	<div class="club_item" style="background-image: url('images/clubs/<?php echo $clubs[$key]['url'];?>');">
		<a href="club.php?id=<?php echo $clubs[$key]['page_id']; ?>">
			<div>
				<h3><?php echo $clubs[$key]['name']; ?></h3>
			</div>
		</a>
			<input type="checkbox" name="favori" value="favori" id="favori_club<?php echo $clubs[$key]['id']; ?>" checked onclick="addFavori(<?php echo $clubs[$key]['id']; ?>, 'club', true)">
			<label for="favori_club<?php echo $clubs[$key]['id']; ?>">
            	<img src="images/website/icons/heart-pleine.svg" class="heart_icon" alt="supprimer le favori">          
        	</label>
	</div>
<?php
	}

?>
</section>
<section>
	<h1>Evenements</h1>
<?php
	foreach ($events as $key => $value) {
?>
	<div class="club_item" style="background-image: url('images/events/<?php echo $events[$key]['url'];?>');">
		<a href="event.php?id=<?php echo $events[$key]['page_id']; ?>">
		<div>
			<h3><?php echo $events[$key]['name']; ?></h3>
			<h4><?php echo $events[$key]['date']; ?></h4>
		</div>
	</a>
		<input type="checkbox" name="favori" value="favori" id="favori_event<?php echo $events[$key]['id']; ?>" checked onclick="addFavori(<?php echo $events[$key]['id']; ?>, 'event', true)">
		<label for="favori_event<?php echo $events[$key]['id']; ?>">
           	<img src="images/website/icons/heart-pleine.svg" class="heart_icon" alt="supprimer le favori">          
        </label>
	</div>
	
<?php
	}

?>
	
</section>

	<?php include("pages/footer.php"); ?>


</body>
</html>