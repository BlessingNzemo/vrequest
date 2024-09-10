<script>
    // Couleur du marker
    var greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Choisir la destination sur la carte
    var mapid = L.map('mapid').setView([-4.322693, 15.271774], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapid);
    // Stocker les marqueurs de départ et de destination
    var departMarker = null;
    var destinationMarker = null;
    

    

    // Ajouter un événement de clic sur la carte
    mapid.on('click', function(e) {
       
        // Supprimer les marqueurs précédents, s'ils existent
        /*
        if (departMarker) {
            mapid.removeLayer(departMarker);
        }
            
         
        if (destinationMarker) {
            mapid.removeLayer(destinationMarker);
        }

    */
       

        // Effectuer la recherche via l'API Nominatim de OpenStreetMap
        axios.get('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + e.latlng.lat + '&lon=' + e.latlng.lng + '&zoom=18&addressdetails=1')
            .then(function(res) {
                var data = res.data;
                var placeName = data.display_name;
                var depart = document.getElementById('depart');
                var destination = document.getElementById('destination');
   
           
                // Ajouter un marqueur sur la carte

               depart.addEventListener('focus', function(){
                depart.value = "";
                mapid.removeLayer(departMarker);
            
                

               });
               destination.addEventListener('focus', function(){
                destination.value = "";
                mapid.removeLayer(destinationMarker);
               
                
               });
          
              
                   
                if(depart.value === ''){
                  
                    if (departMarker) {
                    mapid.removeLayer(departMarker);
                 
                   }
                    departMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(mapid);
                    departMarker.bindPopup('<b>' + placeName + '</b>').openPopup();
                    $('#latitude_depart1').val(e.latlng.lat);
                    $('#longitude_depart1').val(e.latlng.lng);
                    $('#depart').val(placeName);
                  
              

               }

                  
                else  {
                    if (destinationMarker) {
                    mapid.removeLayer(destinationMarker);
                 
                   }
                 
                    
                    destinationMarker = L.marker([e.latlng.lat, e.latlng.lng],{icon: greenIcon}).addTo(mapid);
                    destinationMarker.bindPopup('<b>' + placeName + '</b>').openPopup();
                    $('#latitude_destination1').val(e.latlng.lat);
                    $('#longitude_destination1').val(e.latlng.lng);
                    $('#destination').val(placeName);
                }
            
         
              
            })
            .catch(function(error) {
                console.error('Erreur lors de la recherche:', error);
            });
    });

    $(function() {
        $("#depart, #destination").autocomplete({
            source: function(request, response) {
                // Effectuer la recherche via l'API Nominatim de OpenStreetMap
                axios.get('https://nominatim.openstreetmap.org/search?format=json&q=' + request
                        .term)
                    .then(function(res) {
                        var data = res.data;
                        var results = data.map(function(item) {
                            return {
                                label: item.display_name,
                                value: item.display_name,
                                lat: parseFloat(item.lat),
                                lon: parseFloat(item.lon)
                            };
                        });
                        response(results);
                    })
                    .catch(function(error) {
                        console.error('Erreur lors de la recherche:', error);
                        response([]);
                    });
            },
            select: function(event, ui) {
                // Récupérer la latitude et la longitude du lieu sélectionné
                var latitude = ui.item.lat;
                var longitude = ui.item.lon;

                // Centrer la carte sur le lieu sélectionné
                mapid.setView([latitude, longitude], 13);

                // Ajouter un marqueur sur la carte
                var marker = L.marker([latitude, longitude], 13).addTo(mapid);
                // Afficher le nom du lieu dans le popup du marqueur
                if (event.target.id === 'depart') {
                    marker.bindPopup('<b>Départ:</b><br>' + ui.item.value).openPopup();
                    $('#latitude_depart1').val(latitude);
                    $('#longitude_depart1').val(longitude);
                } else {
                    marker.bindPopup('<b>Destination:</b><br>' + ui.item.value).openPopup();
                    $('#latitude_destination1').val(latitude);
                    $('#longitude_destination1').val(longitude);
                }
            },
            minLength: 2 // Nombre de caractères minimum pour déclencher l'autocomplétion
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div>" + item.label + "</div>")
                .appendTo(ul);
        };
    });
</script>
