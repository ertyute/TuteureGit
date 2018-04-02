<?php
require_once('../_config.php');
session_start();
$page = "evenements";

if (isset($_SESSION["type"])) {
	if ($_SESSION["type"] == "normal") { header('Location: BackOffice/_nopermission.php');}}
if (!isset($_SESSION["name"])) { header('Location: BackOffice/_nopermission.php');}


/*-------------------------------*/
$id = $_POST["id"];


$query = 'SELECT * FROM event WHERE id='.$id.';';
$result = $pdo->prepare($query);
$result->execute();
$event = $result->fetchAll();

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
		<h1>Éditer <?php echo $event[0]["name"]; ?></h1>
			<form class="edit_club" action="Events/edit_event_action.php" method="POST" enctype="multipart/form-data">
			<div>
				<input type="text" name="name" value="<?php echo $event[0]["name"]; ?>">
				<br>
				<label for="name">* Nom</label>
			</div>
			<span class="arrow"></span>
			<div>
				<textarea rows="4" cols="50" name="description_FR"><?php echo $event[0]["description_FR"]; ?></textarea>
				<br>
				<label for="description_FR" id="FR">Description en français</label>
				<br><br><br>
				<textarea name="description_EN"><?php echo $event[0]["description_EN"]; ?></textarea>
				<br>
				<label for="description_EN" id="EN">Description in English</label>
			</div>
			<span class="arrow"></span>
			<div id="edit_contacts">
				<input type="text" name="date" value="<?php echo $event[0]["date"]; ?>" id="datepicker">
				<br>
				<label for="date">* Date</label>
				<br><br>
				<input type="text" name="address" id="autocomplete" value="<?php echo $event[0]["address"]; ?>">
				<br>
				<label for="address">* Adresse</label>
				<br><br>
				<input type="text" name="site_web" value="<?php echo $event[0]["website"]; ?>">
				<br>
				<label for="site_web">Site web</label>
				<br><br>
				<input type="text" name="mail" value="<?php echo $event[0]["mail"]; ?>">
				<br>
				<label for="mail">Mail</label>

				<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
			</div>
			<span class="arrow"></span>
			<div id="input_images">
				<h4>Images</h4>
					<input type="hidden" name="MAX_FILE_SIZE" value="300000000" /> 
<?php
$query = "SELECT id, url FROM images WHERE event_id =".$id.";";
$r = $pdo->prepare($query);
$r->execute();
$imgs = $r->fetchAll();
$count = $r->rowCount();



	foreach ($imgs as $key => $value) {
	?>				
					<div class="input_images">
						<input name="files[]" id="file<?php echo $key; ?>" type="file" accept="image/*"/> 
						<input class = "image_checkbox" type="checkbox" name="delete_img[]" value="<?php echo $value['id']; ?>">
	           			<label for="file<?php echo $key; ?>" class="on_delete"  style="background-image: url('../images/events/<?php echo $value['url']; ?>'); ">
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
					<input type="submit" name="submit" id="submit_new_event">
					<input type="button" name="Annuler" value="Annuler">
				</div>
			</form>
	</section>
</body>
</html>