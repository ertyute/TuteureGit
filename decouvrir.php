<?php

require_once('_config.php');

session_start();
	//VERIFIER SI UTILISATEUR EST CONNECTE//
	if ( !isset($_SESSION["user"]) ) {
		$header = "header.php";
	} else {
		$header = "user_header.php";
	}

include '_head.php';
$page="decouvrir";
?>

</head>
<body>
	<?php include($header); ?>

<section>
</section>

	<?php 
	include("pages/footer.php"); 

	?>
</body>
</html>