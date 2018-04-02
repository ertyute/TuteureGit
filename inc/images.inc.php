<?php
Class Image {

	public function is_Image($tmp) {
		/*-----------------verifier si upload est une image------------*/
		if (isset($tmp)) {
			$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
			$detectedType = exif_imagetype($tmp);

		    if (in_array($detectedType, $allowedTypes)) {
		        return true;

		    } else { 
		    	return false; 
		    }

		}}


	public function resize($width, $height, $newfilename, $path) {
			/* Get original image x y*/
		  list($w, $h) = getimagesize($_FILES['userfile']['tmp_name']);
		  /* calculate new image size with ratio */
		  $ratio = max($width/$w, $height/$h);
		  $h = ceil($height / $ratio);
		  $x = ($w - $width / $ratio) / 2;
		  $w = ceil($width / $ratio);
		  /* new file name */
		  $path = $path.$newfilename;
		  /* read binary data from image file */
		  $imgString = file_get_contents($_FILES['userfile']['tmp_name']);
		  /* create image from string */

		  $image = imagecreatefromstring($imgString);
		  $tmp = imagecreatetruecolor($width, $height);
		  imagecopyresampled($tmp, $image,
		    0, 0,
		    $x, 0,
		    $width, $height,
		    $w, $h);
		  /* Save image */
		  switch ($_FILES['userfile']['type']) {
		    case 'image/jpeg':
		      imagejpeg($tmp, $path, 100);
		      break;
		    case 'image/png':
		      imagepng($tmp, $path, 0);
		      break;
		    case 'image/gif':
		      imagegif($tmp, $path);
		      break;
		    default:
		      exit;
		      break;
		  }
		  return $path;
		  /* cleanup memory */
		  imagedestroy($image);
		  imagedestroy($tmp);
		}


	public function rename($filename, $session_id) {
	/*Renommer l'image*/
		$temp = explode(".", $filename);
		$newfilename = $session_id."_".time().rand(10,99).'.' . end($temp);
		return $newfilename;
	}
}

Class avatar extends Image {

	public $path = "../../images/avatars/";

	public function doesExist($session_id, $pdo) {
			/*Regarder si une image existe déjà sur le serveur*/
		$query_check = 'SELECT * FROM images WHERE user_id='.$session_id.';';
		$result = $pdo->prepare($query_check);
		$result->execute();
		$img = $result->fetchAll();
		$count = $result->rowCount();

		if($count > 0 ) { 
				$url = $img[0]["url"];
				unlink("../../images/avatars/".$url); //supprimer l'image si elle existe deja
				return true;
			} else { 
				return false; }
}}


Class club extends Image {

	public $path = "../../images/clubs/";

		public function delete($id, $pdo) {

		$query_check = 'SELECT url FROM images WHERE id='.$id.';';
		$result = $pdo->prepare($query_check);
		$result->execute();
		$url = $result->fetch();

		$query_check = 'DELETE FROM images WHERE id='.$id.';';
		$result = $pdo->prepare($query_check);
		$result->execute();
		$count = $result->rowCount();

		if($count > 0 ) { 
				unlink("../../images/clubs/".$url[0]); 
				return true;
			} else { 
				return false; }
			
}}

Class event extends Image {

	public $path = "../../images/events/";

		public function delete($id, $pdo) {

		$query_check = 'SELECT url FROM images WHERE id='.$id.';';
		$result = $pdo->prepare($query_check);
		$result->execute();
		$url = $result->fetch();

		$query_check = 'DELETE FROM images WHERE id='.$id.';';
		$result = $pdo->prepare($query_check);
		$result->execute();
		$count = $result->rowCount();

		if($count > 0 ) { 
				unlink("../../images/events/".$url[0]); 
				return true;
			} else { 
				return false; }
			
}}



?>