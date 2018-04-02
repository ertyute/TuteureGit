<div class="nav">
		<a href="../index.php" id="logo">Equo Vadis</a>
		<div>
		</div>
<div>

<?php 
					if ( isset($_SESSION["name"])) {
?>
		<img id="user_icon" alt="" src="../images/avatars/<?php echo $_SESSION["avatar"]; ?>">
		<div id='username'><?php echo $_SESSION['name']; ?></div>
<?php
}
?>

<div class="user_menu">

	<a href="../index.php">RETOUR AU SITE</a>
	<a href="user_comments.php">COMMENTAIRES</a>
	<a href="user_compte.php">MON COMPTE</a>
	<a href="logout.php">Déconnecter</a>
	
</div>
</div>
				 
		<div>		
			<ul>
				<li <?php if($page=='evenements'){echo 'class="active"';}?>><a href="admin_events.php">Evènements</a></li>
				<li <?php if($page=='clubs'){echo 'class="active"';}?>><a href="admin_clubs.php">Clubs</a></li>
				<li <?php if($page=='utilisateurs'){echo 'class="active"';}?>><a href="admin_utilisateurs.php">Utilisateurs</a></li>
				<li <?php if($page=='commentaires'){echo 'class="active"';}?>><a href="admin_comments.php">Commentaires</a></li>
			</ul>
		</div>
</div>

