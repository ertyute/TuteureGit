<?php
session_start();
require_once('../_config.php');
include_once '../inc/filtres.inc.php';

$elem = new recherche;
$result_count = $elem->count();

if ($result_count == 0) { echo "<div>Pas de résultats</div>";}

for ($i=0; $i < $result_count; $i++)  { 
  $liste = new liste($i, $pdo);

/*----------------favoris----------*/
if (isset($_SESSION["id"])) {

$favquery = 'SELECT * FROM favoris
WHERE user_id= '.$_SESSION["id"].'
AND page_id= '.$liste->id.'
AND page_type="'.$liste->type.'"
;';

$result1 = $pdo->prepare($favquery);
$result1->execute();
$result1->fetchAll();
$fav = $result1->rowCount();

}
/*----------------------------------------*/


  if ($liste->type == "club") { ?>

      <div>
        <img class="club_icon" src="images/clubs/<?php echo $liste->image; ?>" alt="icon">
        <h3><?php echo $liste->name; ?></h3>
        <span><?php echo $liste->addresse; ?></span>
        <div>evaluation</div>
        <div>
<?php
if (isset($_SESSION["id"])) { ?>
          <input type="checkbox" name="favori" value="favori" id="favori_club<?php echo $liste->id; ?>" <?php if($fav > 0) {echo "checked";} ?> onclick="addFavori(<?php echo $liste->id; ?>, 'club', false)">
          <label for="favori_club<?php echo $liste->id; ?>">
          <?php if($fav > 0) { ?>
            <img src="images/website/icons/heart-pleine.svg" class="heart_icon" alt="supprimer le favori">
<?php         } else { ?>
            <img src="images/website/icons/heart-vide.svg" class="heart_icon" alt="ajouter aux favoris">
<?php           }?>
          
        </label>

<?php } ?>
        </div>
        <a class="btn" href="club.php?id=<?php echo $liste->id; ?>">Consulter</a>
      </div>


<?php }
    if ($liste->type == "event") { ?>

      <div>
        <img class="club_icon" src="images/events/<?php echo $liste->image; ?>" alt="icon">
        <h3><?php echo $liste->name; ?></h3>
        <span><?php echo $liste->addresse; ?></span>
        <div>evaluation</div>
        <div>
<?php
if (isset($_SESSION["id"])) { ?>
          <input type="checkbox" name="favori" value="favori" id="favori_event<?php echo $liste->id; ?>" <?php if($fav > 0) {echo "checked";} ?> onclick="addFavori(<?php echo $liste->id; ?>, 'event', false)">
          <label for="favori_event<?php echo $liste->id; ?>">
          <?php if($fav > 0) { ?>
            <img src="images/website/icons/heart-pleine.svg" class="heart_icon" alt="supprimer le favori">
<?php         } else { ?>
            <img src="images/website/icons/heart-vide.svg" class="heart_icon" alt="ajouter aux favoris">
<?php           }?>
          
        </label>
<?php } ?>
        </div>
        <a class="btn" href="event.php?id=<?php echo $liste->id; ?>">Consulter</a>
      </div>


<?php }
    }