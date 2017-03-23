<!DOCTYPE html>
<html>
    <head>
        <!-- Include Google Maps JS API -->
        <script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtS_6mlBUfmxGrmePDkeg3iRS0cgVHUXk&sensor=false">
        </script>
        <style type="text/css">
              #mapDiv { width: 1350px; height: 500px; }
        </style>
        <!-- Map creation is here -->
        <script type="text/javascript">
              //Defining map as a global variable to access from other functions
              //buat variable
              var map;
              var myLatLng = {lat: -25.363, lng: 131.044};
              var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
              var labelIndex = 0;
              //buat map
              function initMap () {
                    //Enabling new cartography and themes
                    google.maps.visualRefresh = true;

                    //Setting starting options of map
                    var mapOptions = {
                          center: myLatLng,
                          zoom: 10,
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    //Getting map DOM element
                    var mapElement = document.getElementById('mapDiv');

                    //Creating a map with DOM element which is just obtained
                    map = new google.maps.Map(mapElement, mapOptions);

                    //mencari lokasi saat ini
                    //Getting coordinates from device and zoom map to that location
                    if (navigator.geolocation) {
                    	navigator.geolocation.getCurrentPosition(function(position) {
                    		var lat = position.coords.latitude;
                    		var lng = position.coords.longitude;
                    		//Creating LatLng object with latitude and longitude.
                    		var devCenter =  new google.maps.LatLng(lat, lng);
                    		map.setCenter(devCenter);
                    		map.setZoom(18);
                    		//console.log(latitude + " -- " + longitude);
                    	});
                    }

                    startButtonEvents();
                     //Marker 
                // This event listener calls addMarker() when the map is clicked.
                google.maps.event.addListener(map, 'click', function(event) {
                  addMarker(event.latLng, map);
                });
                // Add a marker at the center of the map.
                addMarker(devCenter);
              }

              //Lanjutan Marker
              // Adds a marker to the map.
                function addMarker(location, map) {
                  // Add the marker at the clicked location, and add the next-available label
                  // from the array of alphabetical characters.
                  var marker = new google.maps.Marker({
                    position: location,
                    label: labels[labelIndex++ % labels.length],
                    map: map
                  });
                  alert("Lokasi Telah Di Pilih");
                }

              //buat event ganti map 
              //Function that start listening the click events of the buttons.
              function startButtonEvents () {
                  document.getElementById('btnRoad').addEventListener('click', function(){
                      map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
                  });
                  document.getElementById('btnSat').addEventListener('click', function(){
                      map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
                  });
                  document.getElementById('btnHyb').addEventListener('click', function(){
                      map.setMapTypeId(google.maps.MapTypeId.HYBRID);
                  });
                  document.getElementById('btnTer').addEventListener('click', function(){
                      map.setMapTypeId(google.maps.MapTypeId.TERRAIN);
                  });
              }
              function pilihLokasi() {
                alert("Pilih Lokasi Untuk Di Marker!");
              }

              google.maps.event.addDomListener(window, 'load', initMap);
        </script>
    </head>
    <body>
        <h3>Google Map</h3>
        <p>Tipe Map <br>
        <input id="btnRoad" type="button" value="RoadMap">
        <input id="btnSat" type="button" value="Satellite">
        <input id="btnHyb" type="button" value="Hybrid">
        <input id="btnTer" type="button" value="Terrain">
        </p>
        <p>Marker <br>
        <button onclick="pilihLokasi()">Marker</button>
        </p>
        <hr>
        <div id="mapDiv"></div>
    </body>
</html>