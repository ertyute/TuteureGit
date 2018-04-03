<?php
require_once('../_config.php');
session_start();
$page ="clubs";

if (isset($_SESSION["type"])) {
	if ($_SESSION["type"] == "normal") { header('Location: BackOffice/_nopermission.php');}}
if (!isset($_SESSION["name"])) { header('Location: BackOffice/_nopermission.php');}


/*-------------------------------*/
$id = $_POST["id"];


$query = 'SELECT * FROM club WHERE id='.$id.';';
$result = $pdo->prepare($query);
$result->execute();
$club = $result->fetchAll();

/*________filtres_______________*/

$query1 = 'SELECT DISTINCT tag.id FROM tag 
LEFT JOIN club_tag ON tag.id=club_tag.tag_id
WHERE club_tag.club_id='.$id.';';

	$result = $pdo->prepare($query1);
	$result->execute();
	$checked = $result->fetchAll();

	$checked_array = []; /*resultats de tous les tags sélectionnés*/
	foreach ($checked as $key => $value) {
		array_push($checked_array, $value["id"]);
	}



function filtre($pdo, $x, $checked)
  {

    $stmt = $pdo->prepare("SELECT id, name_FR FROM tag WHERE type = $x;");
    $stmt->execute();  
    $filtres = $stmt->fetchAll();

				foreach ($filtres as $key => $value) {?>

<input type="checkbox" name="filtre[]" value="<?php echo $value["id"]; ?>"
<?php 
		if (in_array($value["id"], $checked)) {
    			echo "checked";
			}
?>
>
<label for="filtre[]"><?php echo $value["name_FR"]; ?></label>
<?php echo "<br>";
				}};


/* start of HTML _________*/

include ('_head_office.php');
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDd9slKoG41gF1xM8xr_LoEGCxnWrZejoY&libraries=places&callback=initAutocomplete"
        async defer></script>
 <script src="BackOffice/autocomplete.js"></script>


</head>
<body>

<?php include("_header_office.php"); ?>

	<section class="forme">
		<h1>Éditer <?php echo $club[0]["name"]; ?></h1>
			<form class="edit_club" action="BackOffice/edit_club_action.php" method="POST" enctype="multipart/form-data">
				<div>
					<input type="text" name="name" id="name" value="<?php echo $club[0]["name"]; ?>">
					<br>
					<label for="name">* Nom</label>
				</div>
				<span class="arrow"></span>
				<div>
					<textarea rows="4" cols="50" id="description_FR" name="description_FR" ><?php echo $club[0]["description_FR"]; ?></textarea>
					<br>
					<label for="description_FR">* Description en français</label>
					<br><br><br>
					<textarea name="description_EN" id="description_EN"><?php echo $club[0]['description_EN']; ?></textarea>
					<br>
					<label for="description_EN" id="EN">Description in English</label>
					<br><br>
				</div>
				<span class="arrow"></span>


					<div>
						<h4>ACTIVITE</h4>
						<?php filtre($pdo, 1, $checked_array); ?>
					</div>
					<span class="arrow"></span>
					<div>
						<h4>TYPE</h4>
						<?php filtre($pdo, 2, $checked_array); ?>
					</div>
					<span class="arrow"></span>
					<div>
						<h4>AUTRE</h4>
						<?php filtre($pdo, 3, $checked_array); ?>
					</div>
					<span class="arrow"></span>

				<div id="edit_contacts">
					<input type="text" name="site_web" id="site_web" value="<?php echo $club[0]["website"]; ?>">
					<br>
					<label for="site_web">Site web</label>
					<br><br>
					<input type="text" name="mail" id="mail" value="<?php echo $club[0]["mail"]; ?>">
					<br>
					<label for="mail">Mail</label>
					<br><br>
					<input type="text" name="telephone" id="telephone" value="<?php echo $club[0]["telephone"]; ?>">
					<br>
					<label for="telephone">Téléphone</label>
					<br><br>
					<input type="text" name="address" id="autocomplete" value="<?php echo $club[0]["address"]; ?>">
					<br>
					<label for="autocomplete">* Adresse</label>

					<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
				</div>
				<span class="arrow"></span>
				<div id="clearfix">
					<h4>Images</h4>
					<input type="hidden" name="MAX_FILE_SIZE" value="300000000" /> 
<?php
$query = "SELECT id, url FROM images WHERE club_id =".$id.";";
$r = $pdo->prepare($query);
$r->execute();
$imgs = $r->fetchAll();
$count = $r->rowCount();



	foreach ($imgs as $key => $value) {
	?>				
					<div class="input_images">
						<input name="files[]" id="file<?php echo $key; ?>" type="file" accept="image/*"/> 
						<input class = "image_checkbox" type="checkbox" name="delete_img[]" value="<?php echo $value['id']; ?>">
	           			<label for="file<?php echo $key; ?>" class="on_delete"  style="background-image: url('../images/clubs/<?php echo $value['url']; ?>'); ">
	           			 	<span>
	           			 	</span>
	           			</label>
           			</div>	

	<?php
	}

	for ($i=3; $i > $count ; $i--) { 
	?>
				<input name="files[]" id="file<?php echo $i; ?>" type="file" accept="image/*" />
				<label for="file<?php echo $i; ?>"><span class="arrow_up"></span></label>

	<?php
	}
	?>
				</div>
				<span class="arrow"></span>
				<div id="edit_btn">
					<!--message d'erreur-->
					<p id="error_msg">Veuillez bien remplir le formulaire</p>
					<input type="submit" name="submit" id="submit_new_club" value="Envoyer">
					<input type="button" name="Annuler" value="Annuler">
				</div>
			</form>
	</section>
</body>
</html>