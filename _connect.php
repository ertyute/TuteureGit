<?php

$nom = $_POST['username'];
$mdp_user = $_POST['mdp'];

$query = 'SELECT * FROM user;';
$result = $pdo->query($query);
$login = $result->fetchAll(PDO::FETCH_ASSOC);


try{/*sort de la boucle si le mdp et username sont corrects*/

foreach ($login as $key => $value) {
	$login_name = $login[$key]['name'];
	$login_mdp = $login[$key]['password'];

	if ($login_name == $nom) {
			if(mdp_verify($mdp_user, $login_mdp)) {
				throw new breakException(mdp_verify($mdp_user, $login_mdp));
			}
		} else {
		header("Location: login.php?msg=failed");
		}; 
		}
	
} catch(breakException $e){
}



function mdp_verify($mdp_user, $login_mdp) {
	if (password_verify($mdp_user, $login_mdp)) {
		session_start();
		$_SESSION["nom"] = true;
		header("Location: index.php");
		return true;
	} else {
		header("Location: connexion.php?msg=failed");
		return false;
	}
}

?>