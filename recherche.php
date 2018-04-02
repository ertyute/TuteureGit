<?php

require_once('_config.php');

session_start();

include '_head.php';
$page="recherche";
?>
<script type="text/javascript">
	
$(document).ready(function(){


  $.get("map/liste.inc.php", function(data){
        $('#liste').html(data);
    });


   $('#search_btn1').click(function(){
    var filtreString = [];
    $("#filtres input:checked").each(function() {
        filtreString.push($(this).val());
      });

      $.ajax({
      url: 'map/map1.php',
      type: 'GET',
      data: {club: $('#searchbox').val(),
            filtre: filtreString,
            prestation:  $('#prestations').is(":checked"),
            event: $('#events').is(":checked")
    },
      success: function(data) {
        //alert(data);
                initMap();
                $('#liste').html(data);
          
      },
      error: function(e) {
      
      }
    });
   });

   });




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