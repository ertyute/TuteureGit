<?php
require_once('../_config.php');
session_start();
$page = "clubs";

if (isset($_SESSION["type"])) {
	if ($_SESSION["type"] == "normal" OR $_SESSION["type"] == "pro") { header('Location: BackOffice/_nopermission.php');}}
if (!isset($_SESSION["name"])) { header('Location: BackOffice/_nopermission.php');}


/*-------------------------------*/

$query = 'SELECT club.name, club.evaluation, users.name, club.id FROM club LEFT JOIN users ON club.user_id=users.id;';
$result = $pdo->prepare($query);
$result->execute();
$clubs = $result->fetchAll();



/* start of HTML _________*/
include ('_head_office.php');
?>
</head>
<body>

<?php include("_header_office.php"); ?>

	<section class="office">
		<h1>Gestion des Clubs</h1>
		<br><br>
		<a class = "btn" href="admin_new_club.php">nouveau club</a>
		<input type="text" id="myInput" onkeyup="search()" placeholder="Cherchez..">
		<table id="myTable">
			<tr>
				<th>Club</th>
				<th>Evaluation</th>
				<th>Crée par</th>
			</tr>
<?php
	foreach ($clubs as $key => $value) {
?>
			<tr>
				<td><a href="../club.php?id=<?php echo $value['id']?>"><?php echo $value[0]; ?></a></td>
				<td><?php echo $value["evaluation"]; ?></td>
				<td><?php echo $value["name"]; ?></td>
				<td>
				<form action="admin_edit_club.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $value['id']?>">
					<input type="submit" class="btn-empty" value="Changer">
				</form>
				<td>
					<form action="BackOffice/delete_club.php" method="POST">
						<input type="hidden" name="id" value="<?php echo $value['id']?>">
						<input type="submit" class="delete" value="Supprimer">
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