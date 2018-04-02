<?php
$query_rating = "SELECT ROUND(AVG(rating),0) AS rating FROM ratings
 WHERE
club_id=".$id.";";

$result_rating = $pdo->prepare($query_rating);
$result_rating->execute();
$rating1 = $result_rating->fetchAll();
$niveau = $rating1[0]['rating'];

		for($i = 1; $i <= $niveau; $i++) {
			echo "<img class='star' alt='' src='images/website/icons/pleine.jpg'/>";
		}
		for($j = $i; $j <= 5; $j++) {
			echo "<img class='star' alt='' src='images/website/icons/vide.jpg'/>";
		}

?>