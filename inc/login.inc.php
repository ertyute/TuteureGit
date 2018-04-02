<?php

class connect {

	private $mdp_user;

    public function __construct() {

    }

    public function users_array($pdo) {
    	$query = 'SELECT * FROM users;';
		$result = $pdo->prepare($query);
		$login = $pdo->fetchAll();
		return $login;

    }

    public function avatar($pdo, $login) { /*sauvegarde avatar d'user dans la session*/
    	$query = "SELECT url FROM IMAGES WHERE user_id=".$login.";";
		$result = $pdo->prepare($query);
		$result->execute();
		$avatar0 = $result->fetchAll();
		$count = $result->rowCount();
				
		if ($count > 0) {
			$avatar = $avatar0[0]["url"];
			} else {
			$avatar = "default.svg"; }
			return $avatar;
    }

    public function verifyLogin($login, $pdo){
    	foreach ($login as $key => $value) {
			$login_name = $login[$key]['name'];
			$login_mdp = $login[$key]['password'];

			$user = trim($_POST['name']);
			$user_mdp = trim($_POST['mdp']);
			$avatar = self::avatar($pdo, $login[$key]['id']);

				if ($user == $login_name) {
					if(self::mdp_verify($user_mdp, $login_mdp)) {
						
						$_SESSION["type"] = $login[$key]['type'];
						$_SESSION["name"] = $_POST['name'];
						$_SESSION["id"] = $login[$key]['id'];
						$_SESSION["avatar"] = $avatar;
						return true; }
				} 
			
		}
		return false;

    }

    
    public function mdp_verify($mdp_user, $login_mdp) {
	if (password_verify($mdp_user, $login_mdp)) {
		return true;
	} else {
		return false;
	}



}}


