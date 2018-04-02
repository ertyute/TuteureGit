<?php
require_once('../_config.php');
session_start();
$page = "utilisateurs";

if (isset($_SESSION["type"])) {
	if ($_SESSION["type"] == "normal" OR $_SESSION["type"] == "pro") { header('Location: BackOffice/_nopermission.php');}}
if (!isset($_SESSION["name"])) { header('Location: BackOffice/_nopermission.php');}


/*-------------------------------*/

$query = 'SELECT id, name, mail, type FROM users;';
$result = $pdo->prepare($query);
$result->execute();
$users = $result->fetchAll();



/* start of HTML _________*/
include ('_head_office.php');
?>
</head>
<body>

<?php include("_header_office.php"); ?>

	<section class="office">
		<h1>Gestion des Utilisateurs</h1>
		<br><br>
		<input type="text" id="myInput" onkeyup="search()" placeholder="Cherchez..">
		<table id="myTable">
			<tr>
				<th>Utilisateur</th>
				<th>Mail</th>
				<th>Type</th>
			</tr>
<?php
	foreach ($users as $key => $value) {
?>
			<tr>
				<td><?php echo $value["name"]; ?></td>
				<td><?php echo $value["mail"]; ?></td>
				<td><?php echo $value["type"]; ?></td>
				<td>
					<form action="admin_edit_user.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $value['id']?>">
					<input type="submit" class="btn-empty" value="Changer">
				</form>
				</td>
				<td>
					<form action="BackOffice/delete_user.php" method="POST">
						<input type="hidden" name="id" value="<?php echo $value['id']?>">
						<input type="submit" class="btn-empty" value="Supprimer">
					</form>
				</td>
			</tr>
<?php
	}
?>
		</table>
	
	</section>
<?php
	if (isset($_GET["msg"])) {
		echo "<div id='msg'>";
		echo $_GET["msg"];
		echo "</div>";
	}
?>

</body>
</html>