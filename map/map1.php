<?php

require_once('../_config.php');

$recherche = '%'.trim($_GET['club']).'%';

/*
https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet
*/
$query = "
SELECT DISTINCT club.id, club.name, club.address, club.longt, club.lat, tag.name_FR FROM club 
LEFT JOIN club_tag ON club_tag.club_id=club.id
LEFT JOIN tag ON club_tag.tag_id=tag.id
WHERE 
( club.name LIKE :recherche
OR
club.address LIKE :recherche
OR
tag.name_FR LIKE :recherche )
".tags('tag.name_FR').";";


$result = $pdo->prepare($query);
$result->bindValue(':recherche', $recherche, PDO::PARAM_STR);
$result->execute();
$item = $result->fetchAll();

$etat = $result->rowCount();

/*____XML__________________________*/
include '../inc/filtres.inc.php';
$makeXML = new recherche;

/*-----------------------------------------------------------------------------*/
$query_event = "
SELECT id, name, address, longt, lat  FROM event
WHERE 
( name LIKE :recherche
OR
address LIKE :recherche
OR
tags LIKE :recherche
)
".tags('tags').";";


$result1 = $pdo->prepare($query_event);
$result1->bindValue(':recherche', $recherche, PDO::PARAM_STR);
$result1->execute();
$item1 = $result1->fetchAll();


$etat1 = $result1->rowCount();

/*____XML__________________________*/

if ($_GET['event'] == "false") { 
    $makeXML->writeXML($item, FALSE); 
} 

if ($_GET['prestation'] == "false") { 
    $makeXML->writeXML(FALSE, $item1); 
}
if ($_GET['prestation'] == "false" && $_GET['event'] == "false") {
  $makeXML->writeXML(FALSE, FALSE);
} 

if ($_GET['prestation'] == "true" && $_GET['event'] == "true") {
  $makeXML->writeXML($item, $item1);
} 


/*----------------affichage de liste-------------*/
include 'liste.inc.php';



/*----------------------------------------*/

function tags($elt) {
  $tags = "";

  if (isset($_GET['filtre'])) {
  foreach($_GET['filtre'] as $order => $selected){
    if($order == 0) { $tags .= ' AND ( '.$elt.' LIKE "%'.$selected.'%"'; 
      } else { $tags .= ' OR '.$elt.' LIKE "%'.$selected.'%"'; }
}
    $tags .= ")";
}
return $tags;
}

?>



