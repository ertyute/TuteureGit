
<?php
// pour rendre le menu navigation invisible en page Index
	if($page == "index") {
		echo '<div class="nav nav-scroll">';
	} else {
		echo '<div class="nav">';
	}
?>
<a href="index.php" id="logo">Equo Vadis</a>
		<div>
				<span>FR</span>
				<span>|</span>
				<span>EN</span>
		</div>

<div>

<?php 
					if ( isset($_SESSION["name"])) {
						$avatar = "images/avatars/".$_SESSION["avatar"];
?>

	<img src="<?php echo $avatar; ?>" alt="avatar" id='user_icon'>					
<div class="user_menu">
<div class="menu_deco"></div>
<div id='username'><?php echo $_SESSION['name']; ?></div>

<?php
						if ($_SESSION["type"] == "normal") {

							}
						if ($_SESSION["type"] == "admin") {
?>
<a href="pages/admin_office.php">BACK OFFICE</a>
<?php
							}
						if ($_SESSION["type"] == "pro") {
?>
<a href="user_pro_club.php">MON CLUB</a>
<?php
							}
?>
	<a href="user_favoris.php">FAVORIS</a>
	<a href="user_compte.php">MON COMPTE</a>
	<a href="pages/logout.php">Déconnecter</a>
</div>
<?php
					} else {

						?>
<a id="connexion" <?php if($page=='login'){echo 'class="active"';}?> href="login.php">Connexion</a>

						<?php
					};

?>
</div>
		<div id="mobile_menu">MENU</div>		 
		<div>		
			<ul>
				<li <?php if($page=='evenements'){echo 'class="active"';}?>><a href="evenements.php">Evènements</a></li>
				<li <?php if($page=='decouvrir'){echo 'class="active"';}?>><a href="decouvrir.php">Découvrir</a></li>
				<li <?php if($page=='recherche'){echo 'class="active"';}?>><a href="recherche.php">Recherche</a></li>
			</ul>
		</div>
</div>

