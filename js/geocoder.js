 function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(43.740559, 6.380062),
          zoom: 8
        });
        var infoWindow = new google.maps.InfoWindow;

        var iconBase = 'images/website/icons/';
        var icons = {
          club: {
            name: 'club',
            icon: iconBase + 'club.png'
          },
          event: {
            name: 'event',
            icon: iconBase + 'event.png'
          }
        };
               // Create markers.

          // Change this depending on the name of your PHP or XML file
          downloadUrl("map/map.xml", function(data) {

            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');

            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var idclub = markerElem.getAttribute('id');

              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('longt')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');

              var button = document.createElement('a');
              button.classList.add("btn");
              /*changer l'URL selon le type de prestataire*/
              var type = markerElem.getAttribute('type');
                if (type =="club") {
                  button.setAttribute("href", 'club.php?id='+idclub);
                }
                if (type =="event") {
                  button.setAttribute("href", 'event.php?id='+idclub);
                }

              

              button.textContent = "Consulter";

              text.textContent = address;
              infowincontent.appendChild(text);
              infowincontent.appendChild(button);

              var type = markerElem.getAttribute('type');
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icons[type].icon
              });

              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            callback(request);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }


