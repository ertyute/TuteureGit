<?php
require_once('../_config.php');
session_start();
$page="office";

if (isset($_SESSION["type"])) {
	if ($_SESSION["type"] == "normal" OR $_SESSION["type"] == "pro") { header('Location: BackOffice/_nopermission.php');}}
if (!isset($_SESSION["name"])) { header('Location: BackOffice/_nopermission.php');}

/* start of HTML */
include ('_head_office.php');
?>

</head>
<body>

		<?php include("_header_office.php"); ?>
<section>
	<h1>Back Office</h1>
	<a href="admin_utilisateurs.php">
		<div class="menu_square">
		Utilisateurs
		</div>
	</a>
	<a href="admin_clubs.php">
		<div class="menu_square">
			Clubs
		</div>
	</a>
	<a href="admin_evenements.php">
		<div class="menu_square">
			Evènements
		</div>
	</a>
	<a href="admin_comments.php">
		<div class="menu_square">
			Commentaires
		</div>
	</a>
</section>
</body>
</html>