<?php

class liste {

	private $myXMLData;

	public function __construct($i, $pdo) {
		$xml = simplexml_load_file("map.xml") or die("Le liste n'a pas pu d'être affiché");
		$this->myXMLData = "map.xml";
		$this->id = $xml->marker[$i]->attributes()->id;
		$this->type = $xml->marker[$i]->attributes()->type;
		$this->name = $xml->marker[$i]->attributes()->name;
		$this->addresse = $xml->marker[$i]->attributes()->address;
		$this->image = self::getImage($pdo);
	}


	public function getImage($pdo) {
		$query = "SELECT url FROM images WHERE club_id=".$this->id." LIMIT 1;";
		$result = $pdo->prepare($query);
		$result->execute();
		$img = $result->fetchAll();
		$count = $result->rowCount();

		if($count > 0) {
			$url = $img[0]['url'];
		} else {
			$url = "default.jpg";
		}
		return $url;
	}


}

Class recherche {

		public function writeXML($item, $item2) {
		$xml = new DOMDocument('1.0', 'utf-8');
	    $xml->formatOutput = true; 
	    $xml->preserveWhiteSpace = false;


		$root=$xml->createElement('markers');
		$root=$xml->appendChild($root);

		$idarray = array(); /*tableau pour éviter les doublures*/

		if ($item != FALSE) {
			foreach ($item as $row) {
		    if (!in_array($row['id'], $idarray)) { /*if not dans l'Idarray', on l'ajoute*/
		    
		    array_push($idarray, $row['id']); /*on ajoute l'ID dans le tableau des id*/
		    $club=$xml->createElement('marker');
		    $club=$root->appendChild($club);


		   $club->setAttribute('id', $row['id']);
		   $club->setAttribute('type', 'club');
		   $club->setAttribute('name', $row['name']);
		   $club->setAttribute('address', $row['address']);
		   $club->setAttribute('longt', $row['longt']);
		   $club->setAttribute('lat', $row['lat']);

		}}
		}
		
		
		$idarray2 = array();
		if ($item2 != FALSE) {
			foreach ($item2 as $row) {
			    if (!in_array($row['id'], $idarray2)) {
			    
			    array_push($idarray2, $row['id']);
			    $club=$xml->createElement('marker');
			    $club=$root->appendChild($club);


			   $club->setAttribute('id', $row['id']);
			   $club->setAttribute('type', 'event');
			   $club->setAttribute('name', $row['name']);
			   $club->setAttribute('address', $row['address']);
			   $club->setAttribute('longt', $row['longt']);
			   $club->setAttribute('lat', $row['lat']);

			}}
		}

		    $xml->save('../map/map.xml');
	}


	public function count() {
		$xml = simplexml_load_file("map.xml") or die("Pas de résultats"); //affiché si il n'y a pas de résultats
		$count =  count($xml->children());
		return $count;
		
	}

}

?>
