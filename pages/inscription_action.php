<?php
require_once('../_config.php');

$name = trim($_POST['username']);
$mdp = trim($_POST['mdp']);
$mdp1 = trim($_POST['mdp1']);
$mail = trim($_POST['mail']);
$mail1 = trim($_POST['mail1']);
$type = trim($_POST['type']);

/*valider si l'addresse mail est valide*/
function validateMail($mail) {
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
  return false;
}
else {return true;}
}

/*valider si la chaîne des characters n'est pas vide*/
function isEmpty($i) {
	if (empty($i)) {
    return false;
  } else {
  	return true;
}}

/*valider si la chaîne des characters ne contient pas des characteres non autorisées*/
function isValid($i) {
	 $security = "!([<>#$%&])|(SELECT)|(UPDATE)|(INSERT)|(DELETE)|(REVOKE)|(GRANT)|(UNION)|(CREATE)|(ALTER)|(DROP)|((\" {1,}\")|(\"\"{1,})|(\"\"))|((\' {1,}\')|(\'\'{1,})|(\'\')|(\"\')|(\'\"))!";

	if ((preg_match($security, $i))) {
		return false;
	} else {
		return true;
	}
}

function validate_match($elt1, $elt2) {
	if($elt1 !== $elt2 ) {
		return false;
	} else {return true; }
}

function validate_username($name, $pdo) {
	$query = "SELECT name FROM users WHERE name ='".$name."';";
	$result = $pdo->prepare($query);
	$result->execute();
	$name = $result->fetchAll();

	$result = count($name);

	if ($result == 1) {
	return false;
	} else {return true;}
}


if (validateMail($mail) 
	&& isEmpty($name) 
	&& isEmpty($mail) 
	&& isEmpty($mdp) 
	&& isValid($name)
	&& isValid($mdp)
	&& isValid($mail)
	&& validate_match($mail, $mail1)
	&& validate_match($mdp, $mdp1)
	&& validate_username($name, $pdo)
	) {
		$mdp = password_hash($mdp, PASSWORD_DEFAULT);
		$insert = 'INSERT INTO users (name, password, mail, type) VALUES ("'.$name.'", "'.$mdp.'", "'.$mail.'", "'.$type.'");';
		$result = $pdo->prepare($insert);
		$result->execute();
		header("Location: ../inscription_end.php");
	
} else {

	if (!isEmpty($name) OR !isValid($name)) { header("Location: ../inscription.php?msg=failed1");
		} else if (!validate_username($name, $pdo)) { header("Location: ../inscription.php?msg=failed2");
		} else if (!isEmpty($mail) OR !validateMail($mail)) { header("Location: ../inscription.php?msg=failed3");
		} else if (!isEmpty($mdp) OR !isValid($mdp)) { header("Location: ../inscription.php?msg=failed4");
		} else { header("Location: ../inscription.php?msg=failed5"); }
}

?>
