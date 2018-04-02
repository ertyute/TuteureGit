<?php
include 'inc/filtres.inc.php';

function filtre($pdo, $x)
  {
    $stmt = $pdo->prepare("SELECT name_FR FROM tag WHERE type = $x;");
    $stmt->execute();  
    $filtres = $stmt->fetchAll();

				foreach ($filtres as $key => $value) {?>

<input type="checkbox" name="filtre[]" value="<?php echo $value["name_FR"]; ?>">
<label for="filtre[]"><?php echo $value["name_FR"]; ?></label>
<?php echo "<br>";
				}};
?>


		<div id="make_smaller" class="clicked"><div>
	</div>
</div>
<div class="result_paneau">

		
			<input type="text" name="club" placeholder="Club, préstation, véterinaire..." id="searchbox">
			<input type="button" value="Cherchez" id="search_btn1">
		<div>

			<input type="checkbox" name="clubs_choix" id="prestations" checked>
			<label for="prestations">Préstataires</label>
			<input type="checkbox" name="events" id="events" checked>
			<label for="events">Evènements</label>
			
		</div>
		<div id="filtres">
			<span>ACTIVITE</span>
			<div>
				<?php filtre($pdo, 1); ?>
			</div>
			<span>TYPE</span>
			<div>
				<?php filtre($pdo, 2); ?>
			</div>
			<span>AUTRE</span>
			<div>
				<?php filtre($pdo, 3); ?>
			</div>
		</div>
		<h3>RESULTATS</h3>
		<div id="liste"></div>
</div>






