
window.onload = function() {


$(".delete").on("click", function() {
  var msg = confirm("Voulez vous supprimer cet élèment?");
  if(msg) {
    return true;
  } else { return false;}
})

/*animation de changement de H1 sur les pages des insertion de données*/
var initialvalue = $("#changejs").html(); //valeur initiale de H1
$("#name").on("input", function() {
  
  var text = $("#name").val();
  if (text.length > 0) {
    $("#changejs").html(text);
  } else {
    $("#changejs").html(initialvalue);
  }

})

/*-----------GESTION D'UPLOAD DES IMAGES---------------------*/
/*Préaffichage d'une image avant l'upload*/


$("[id^='file']").click(function(e) {
  var label = "label[for="+$(this).attr("id")+"]";
  var x = $(this).val(); //valeur d'input de file

    if (!x) { // if valeur est non definie, on ajoute une nouvelle image
      $(this).change(function() {
        voir_image(this, label);
});

    } else { // sinon on supprime l'image existante
      e.preventDefault();
      remove_image(this, label);
    }
});

$(".image_checkbox").click(function() { /*simulation visuelle de suppression d'une image*/
  var inputfile = $(this).prev();
  var label = "label[for="+$(inputfile).attr("id")+"]";

  $(this).css("display", "none");
  remove_image(inputfile, label);
})

function voir_image(elt, label) {
   
    var reader = new FileReader();

    reader.onload = function(e) {
      var img = e.target.result;
      $(label).addClass("on_delete");
      $(label).css("background-image", "url("+img+")");
      $(label+" span").removeClass("arrow_up");

    }
    reader.readAsDataURL(elt.files[0]);

}


function remove_image(elt, label) {
  $(elt).replaceWith($(elt).val('').clone(true));
   $(label).removeClass("on_delete");
   $(label).css("background-image", "none");
   $(label+" span").addClass("arrow_up");

}




/*-------------COMMENTAIRES-----------------------------------*/
/*pour l'affichage du champ de réponse aux commentaires*/
$("[id^=btn_repondre_]").on("click", function() {
  $("[id^=repondre_]").css("display", "none");
  var comment = $(this).parent().next().toggle();
})


/*verifier si le commentaire n'est pas vide*/
$(".submit").click(function() {
  var form = $(this).parent();
  var textarea = form.find(".comment");
  var error_msg = form.find(".error_msg");
  if (textarea.val().length < 1) { //verifie le longueur 
    textarea.addClass("error");
    $(error_msg).css("display", "block");
    return false;
  } else { 
    return true;
  }
})


/*------------------------------------------------------------*/
/*pour le message affiché après une action*/
$("#msg").click(function() {
  $(this).css("display", "none");
})

/*Toogle le menu User on click -------------------*/
	$( "#user_icon" ).click(function() {
  		$(".user_menu").toggle();
});


    $(document).on("click", function(event){
        var $trigger = $(".nav");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $(".user_menu").hide();
        }            
    });
/*Toogle le menu on click -------------------*/
  $( "#mobile_menu" ).click(function() {
      $("#mobile_menu + div").toggle();
});


/*------------NEW CLUB vérification des donnees---------------------*/
  $("#submit_new_club").bind("click", function() {
  var t1 = validate_length('input[name="name"]', 1);
  var t2 = validate_length('input[name="address"]', 1);

  if(t1 && t2) {
    return true;
  } else { 
    $("#error_msg").css("display", "block");
    return false; }
});

    $("#submit_new_event").bind("click", function() {
  var t1 = validate_length('input[name="name"]', 1);
  var t2 = validate_length('input[name="address"]', 1);
  var t3 = validate_length('input[name="date"]', 1);


  if(t1 && t2 && t3) {
    return true;
  } else { 
    $("#error_msg").css("display", "block");
    return false; }
});





/*------------Forme d'inscription: validation des données---------------------*/

$("#submit_inscription").on("click", function() {
  var result = true; //decide si on peut soumettre le formulaire

  if (!validate_length("#mdp", 6)) { //verifie le longueur de mot de passe
    $("#msg_mdp").css("display", "block");
    result = false;
  } else { 
    $("#msg_mdp").css("display", "none");
  }

  if (!validate_length("#username", 4)) { //verifie le longueur de username
    $("#msg_nom").css("display", "block");
    result = false;
  } else { 
    $("#msg_nom").css("display", "none");
  }

  if (!validate_match("#mdp", "#mdp1")) { ////verifie si les deux mdp sont idéntiques
    $("#msg_mdp1").css("display", "block");
    result = false;
  } else { 
    $("#msg_mdp1").css("display", "none");
  }

  if (!validate_mail("#mail")) { //verifie si le mail est valide
    $("#msg_mail").css("display", "block");
    result = false;
  } else { 
    $("#msg_mail").css("display", "none");
  }

  if (!validate_match("#mail", "#mail1")) { //verifie si les deux mails sont idéntiques
    $("#msg_mail1").css("display", "block");
    result = false;
  } else { 
    $("#msg_mail1").css("display", "none");
  }

  $.post("pages/check_username.php", //verifie si l'username existe déjà
    {
        name: $("#username").val(),
    },
    function(data){   
        $(".result").html(data);
        if (data.length > 1) {
          $("#username").addClass( "error" );
          result = false;
        } else { $("#username").removeClass( "error" ); }
    });


return result; 
})

$("#submit_mdp").on("click", function() { //valider les mdp
  var result = true;

  if (!validate_length("#mdp", 6)) { //verifie le longueur de mot de passe
    $("#msg_mdp").css("display", "block");
    result = false;
  } else { 
    $("#msg_mdp").css("display", "none");
  }

  if (!validate_match("#mdp", "#mdp1")) { ////verifie si les deux mdp sont idéntiques
    $("#msg_mdp1").css("display", "block");
    result = false;
  } else { 
    $("#msg_mdp1").css("display", "none");
  }
  return result;

});

$("#submit_mail").on("click", function() { //valider les mdp
  var result = true;

  if (!validate_length("#mail", 6)) { //verifie le longueur de mot de passe
    $("#msg_mail").css("display", "block");
    result = false;
  } else { 
    $("#msg_mail").css("display", "none");
  }

  if (!validate_match("#mail", "#mail1")) { ////verifie si les deux mdp sont idéntiques
    $("#msg_mail1").css("display", "block");
    result = false;
  } else { 
    $("#msg_mail1").css("display", "none");
  }
  return result;

});


/*voir si les deux champs sont identiques*/
function validate_match(elt1, elt2) {

  if($(elt1).val() !== $(elt2).val()) { 
      $(elt2).addClass( "error" );
      return false;
    } else {
      $(elt2).removeClass( "error" );
      return true;
    }
}



function validate_length(elt, length) {
  var value = document.querySelector(elt).value;
  if(value.length < length) { 
      $(elt).addClass( "error" );
      $(elt).on("input", function() {
      if(($(this).val().length > 1)) {
        $(this).removeClass("error" );} 
})
      return false;
    } else {
      return true;
    }
}

function validate_mail(mail) {
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
    if($(mail).val().match(mailformat)) { 
      $(mail).removeClass( "error" );
      return true;
    } else {
      $(mail).addClass( "error" );
      return false;
};
}


/*-------------------------------------------------*/

/*verification des informations et champs */

$("#username").on("input", function() {
  var name = $(this).val();
  if(name.length > 2) {
    return false;
  } 
})


function checkname(name)
{

 if(name)
 {
  $.ajax({
  type: 'post',
  url: 'verify.php',
  data: {
   username:name,
  },
  success: function (response) {
   $( '#msg_nom' ).html(response);
   if(response=="OK") 
   {
    return true;  
   }
   else
   {
    return false; 
   }
  }
  });
 }
 else
 {
  $( '#name_status' ).html("");
  return false;
 }
}



/*------------CONTROLE DES FILTRES DE LA RECHERCHE---------------------*/

/*----------Bouton pour reduire le menu------------------*/
$("#make_smaller").click(function() {
    if($(this).hasClass("clicked")){
        $(this).removeClass("clicked");
        $(".result_paneau").animate({left: "-400px"}, { duration: 200, queue: false });
        $(this).animate({left: "1px"}, { duration: 200, queue: false });
        $("#make_smaller div").css("transform", "rotate(-135deg)");

    }else{
        $(this).addClass("clicked");
        $(".result_paneau").animate({left: "0px"}, { duration: 200, queue: false });
        $(this).animate({left: "375px"}, { duration: 200, queue: false });
        $("#make_smaller div").css("transform", "rotate(45deg)");
    }
});


/*----------filtres------------------*/

$("#filtres div").css("display", "none"); /*CACHE Les options*/

$("#filtres span").click(function() {
  $("+div", this).slideToggle();
})

}

/*----------filtrer les résultats de la recherche------------------*/

function search() {
  
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
/*----------Gestion des clubs et evenements------------------*/

  $( function() {
    $( "#datepicker" ).datepicker({
    dateFormat: "yy-mm-dd"
});
  } );


/*---------------------FAVORIS----------------------------*/


function addFavori(page_id, page_type, poof) { // poof supprime l'element sur la page des favoris.
    var eltId = $('#favori_'+page_type+page_id);
    var label = "label[for='favori_"+page_type+page_id+"'] .heart_icon";

  if (poof) { // il s'agit d'une page avec plusieurs favoris'
    var checked = false;
    eltId.parent().css("display", "none");

  } else { // il s'agit de la page d'un club avec un seul favori

    var checked = eltId.is(":checked");

    /*changement d'icone de favori*/
    if(checked) {
      $(label).attr("src", "images/website/icons/heart-pleine.svg");
    } else {
      $(label).attr("src", "images/website/icons/heart-vide.svg");
    }
  }

  $.get("pages/Favoris/add_favori.php", 
      { page_id: page_id, 
        page_type: page_type, 
        checked: checked
        });

}



