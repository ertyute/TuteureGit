<?php
session_start();
require_once('_config.php');
include '_head.php';
$page = "index";

$query="SELECT club.id, club.name, images.url FROM club
LEFT JOIN images ON images.club_id=club.id
GROUP BY club.id
ORDER BY club.evaluation DESC
LIMIT 6
;";
$result = $pdo->prepare($query);
$result->execute();
$clubs = $result->fetchAll();


?>
<script>
	/* header scroll */

	$(window).on("scroll", function() {
	    if ($(window).scrollTop()>100) {
	      $(".nav").removeClass("nav-scroll");
	    }
	    if ($(window).scrollTop()<100) {
	      $(".nav").addClass("nav-scroll");
	    }
	});
</script>

</head>
<body>

	<?php include("header.php"); ?> <!-- not in the header because of scroll issues-->

	<header>
		<div id="filter"><h1>Trouvez votre aventure</h1></div>
		
		<form action="map/map.php" method="GET">
			<input type="text" id="club" name="club" placeholder="Club, préstation, véterinaire...">
			<input type="submit" value="Cherchez">
		</form>
	</header>


	<section class="row">
		<div class="col-3">
			<img src="images/website/1.svg">
			<span>Trouvez votre futur club préféré</span>
		</div>
		<div class="col-3">
			<img src="images/website/1.svg">
			<span>Participez aux évènements de la région</span>
		</div>
		<div class="col-3">
			<img src="images/website/1.svg">
			<span>Partagez vos expériences</span>
		</div>
	</section>

<section >
	<h2>Top clubs</h2>
<?php
	foreach ($clubs as $key => $value) {
?>	<a href="club.php?id=<?php echo $clubs[$key]['id']; ?>">
		<div class="club_item" style="background-image: url('images/clubs/<?php echo $clubs[$key]['url'];?>');">
			<div>
				<h4><?php echo $clubs[$key]['name']; ?></h4>
			</div>
		</div>
		</a>
<?php
	}

?>
</section>
	<section>
		<h2>Découvrir</h2>
		<img src="http://via.placeholder.com/550x400">
		<div>
			<h4>Randonée</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharet</p>
			<div>fleche</div>
		</div>
	</section>
	<section>
		<h2>Sortir</h2>
		<img src="http://via.placeholder.com/350x250">
		<div></div>
			<h4>Titre</h4>
			<span>Sous-titre</span>

			<button>Plus</button>
	</section>
	<section>
		<div id="map"></div>


	</section>

<?php include("pages/footer.php"); ?>


</body>
</html>