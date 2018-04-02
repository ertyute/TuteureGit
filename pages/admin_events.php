<?php
require_once('../_config.php');
session_start();
$page = "evenements";

if (isset($_SESSION["type"])) {
	if ($_SESSION["type"] == "normal" OR $_SESSION["type"] == "pro") { header('Location: BackOffice/_nopermission.php');}}
if (!isset($_SESSION["name"])) { header('Location: BackOffice/_nopermission.php');}


/*-------------------------------*/

$query = 'SELECT event.name, event.date, users.name, event.id  FROM event LEFT JOIN users ON event.user_id=users.id;';
$result = $pdo->prepare($query);
$result->execute();
$events = $result->fetchAll();



/* start of HTML _________*/
include ('_head_office.php');
?>
</head>
<body>

<?php include("_header_office.php"); ?>

	<section class="office">
		<h1>Gestion des Evènements</h1>
		<br><br>
		<a class = "btn" href="admin_new_event.php">Nouveau évènement</a>
		<input type="text" id="myInput" onkeyup="search()" placeholder="Cherchez..">
		<table id="myTable">
			<tr>
				<th>Evènement</th>
				<th>Date</th>
				<th>Crée par</th>
			</tr>
<?php
	foreach ($events as $key => $value) {
?>
			<tr>
				<td><a href="../event.php?id=<?php echo $value["id"]; ?>"><?php echo $value[0]; ?></a></td>
				<td><?php echo $value["date"]; ?></td>
				<td><?php echo $value["name"]; ?></td>
				<td>
				<form action="admin_edit_event.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $value['id']?>">
					<input type="submit" class="btn-empty" value="Changer">
				</form>
				<td>
					<form action="Events/delete_event.php" method="POST">
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