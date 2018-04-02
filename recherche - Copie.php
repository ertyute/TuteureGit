<?php

require_once('_config.php');

session_start();

include '_head.php';
$page="recherche";
?>
<script type="text/javascript" language="javascript">

$(document).ready(function() { /// Wait till page is loaded
   $('#search_btn1').click(function(){
   		$.ajax({
		  url: 'map/map.php',
		  type: 'GET',
		  data: 'Cannes',
		  success: function(data) {
				$('#map').load('map/map.php #map', function() {
           			initMap();
      			});
		  },
		  error: function(e) {
			//called when there is an error
			//console.log(e.message);
		  }
		});
   });
}); //// End of Wait till page is loaded
</script>
</head>
<body>
	<?php include("header.php"); ?>

<section>
	<?php include("pages/recherche/filtres.php"); ?>
	<div id=map></div>
</section>

	<?php 
	include("pages/footer.php"); 

	?>
</body>
</html>