<?php
require_once('../_config.php');
session_start();
$page = "utilisateurs";

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
<section>
		<h2><?php echo $_SESSION["name"]; ?></h2>
		<form action="pages/BackOffice/upload_action_avatar.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="MAX_FILE_SIZE" value="300000000" /> 
            <input type="hidden" name="type" value="avatar" /> 
            <input id="idfile" name="userfile" type="file" /> 
            <input name ="envoi" type="submit" value="Envoyer le fichier" />

    	</form>
	</section>
	<img class="user_icon_big" src="images/avatars/<?php echo $_SESSION["avatar"]; ?>">
	<section>
		<div class="msg">d</div>
		<form method="POST" action="pages/user/change_mdp.php">
			<input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>">
			<input type="password" id="mdp_old" name="mdp_old">
            <label for="mdp">L'ancien mot de passe</label>
			<input type="password" id="mdp" name="mdp">
            <label for="mdp">Changer le mot de passe</label>
            <p id="msg_mdp">Le mot de passe doit avoir au moins 5 charactéres</p>
            <br>
            <input type="password" id="mdp1" name="mdp1">
            <label for="mdp1">Mot de passe</label>
            <p id="msg_mdp1">Les mots de passe ne sont pas identiques</p>
            <input type="submit" value="Modifier" id="submit_mdp">
         </form>

        <form method="POST" action="pages/user/change_mail.php">
        	<input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>">
            <input type="text" id="mail" name="mail">
            <label for="name">Mail</label>
            <p id="msg_mail">L'addresse mail n'est pas valide</p>
            <br>
            <input type="text" id="mail1" name="mail1">
            <label for="name">Mail</label>
            <p id="msg_mail1">Les addresses mail ne sont pas identiques</p>
            <input type="submit" value="Modifier" id="submit_mail">
		</form>
	</section>

<div id="error"><?php
	if(isset($_GET["msg"])) {
		if ($_GET["msg"] == "fail1") {
			echo "L'image est trop grande / mauvais format";
		} else { echo " Une erreur est survenue";}

} ?>
	
</div>
<section>
	Supprimer le compte
	<form action="pages/user/delete_user.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $_SESSION["id"];?>">
		<input type="submit" class="delete" value="Supprimer">
	</form>
</section>

</body>
</html>