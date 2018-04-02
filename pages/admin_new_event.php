<?php
require_once('../_config.php');
session_start();
$page = "evenements";

if (isset($_SESSION["type"])) {
	if ($_SESSION["type"] == "normal") { header('Location: BackOffice/_nopermission.php');}}
if (!isset($_SESSION["name"])) { header('Location: BackOffice/_nopermission.php');}





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
		<h1 id="changejs">Nouveau évènement</h1>
			<form class="edit_club" action="Events/new_event_action.php" method="POST" enctype="multipart/form-data">

				<div>
					<input type="text" name="name" id="name">
					<br>
					<label for="name">* Nom </label>
				</div>
				<span class="arrow"></span>
				<div>
					<textarea rows="4" cols="50" id="description_FR" name="description_FR"></textarea>
					<br>
					<label for="description_FR">* Description en français</label>
					<br><br><br>
					<textarea name="description_EN" id="description_EN"></textarea>
					<br>
					<label for="description_EN" id="EN">Description in English</label>
					<br><br>
				</div>
				<span class="arrow"></span>
				<div>
					<input type="text" name="date" id="datepicker">
					<br>
					<label for="datepicker">* Date du début</label>
					<br>
					<input type="text" name="site_web" id="site_web">
					<br>
					<label for="site_web">site web</label>
					<br>
					<input type="text" name="mail" id="mail">
					<br>
					<label for="mail">mail</label>
					<br>
					<input type="text" name="address" id="autocomplete">
					<br>
					<label for="autocomplete">* Adresse</label>
					<br>
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
				</div>
				<span class="arrow"></span>

				<div id="input_images">
					<h4>Images</h4>
					<input type="hidden" name="MAX_FILE_SIZE" value="300000000" /> 
           			 <input name="files[]" id="file1" type="file" accept="image/*"/> 
           			 <label for="file1"><span class="arrow_up"></span></label>
           			 <input name="files[]" id="file2" type="file" accept="image/*"/> 
           			 <label for="file2"><span class="arrow_up"></span></label>
           			 <input name="files[]" id="file3" type="file" accept="image/*"/> 
           			 <label for="file3"><span class="arrow_up"></span></label>
				</div>

			
				<div id="edit_btn">
					<p id="error_msg">Veuillez bien remplir le formulaire</p>
					<input type="submit" name="submit" id="submit_new_event" value="Envoyer">
					<input type="button" name="Annuler" value="Annuler">
				</div>
			</form>
	</section>
</body>
</html>