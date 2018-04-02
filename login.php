<?php
session_start();

require_once('_config.php');
include 'inc/login.inc.php';
include '_head.php';
$page = "login";

?>
</head>
<body>
	<?php include("header.php"); ?>
<section>
	<h1>Connexion</h1>
	<form action="login-action.php" method="POST">
    		<input type="text" id="name" name="name">
    		<label for="name">Nom</label>
    		<input type="password" id="mdp" name="mdp">
    		<label for="mdp">Mot de passe</label>
    		<br/>
    		<div>
    		<input type="submit" value="LOGIN">
    		<input type="button" onclick="location.href='../propos.php'" value="ANNULER">
    		</div>
    		Mot de passe oublié
    		<br/><br/><br/>
<?php 
		if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {echo "Le mot de passe et/ou login sont pas valides.";};
?>
		</form>
		<a href="inscription.php">Pas encore membre?</a>
</section>
	<?php include("pages/footer.php"); ?>
</body>
</html>