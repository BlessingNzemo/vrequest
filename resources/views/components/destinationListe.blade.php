<script>
    // Choisir la destination sur la liste 
    var greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var map = L.map('map').setView([-4.322693, 15.271774], 13);
    var markerDepart = L.marker([0, 0], {
        icon: greenIcon
    }, ).addTo(map);
    var markerArrivee = L.marker([0, 0]).addTo(map);
    var polyline = L.polyline([], {
        color: 'blue'
    }).addTo(map);



    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);



    function updateMap() {
        var lieuDepart = document.getElementById('lieuDepart').value;
        var lieuArrivee = document.getElementById('lieuArrivee').value;

        fetch('/site/' + lieuDepart)
            .then(response => response.json())
            .then(dataDepart => {
                markerDepart.setLatLng([dataDepart.latitude, dataDepart.longitude]);
                map.setView([dataDepart.latitude, dataDepart.longitude], 8);
                markerDepart.bindPopup('<b>Lieu de depart:</b><br>' + lieuDepart).openPopup();

            });

        fetch('/site/' + lieuArrivee)
            .then(response => response.json())
            .then(dataArrivee => {
                markerArrivee.setLatLng([dataArrivee.latitude, dataArrivee.longitude]);
                markerArrivee.bindPopup('<b>Lieu d\'arrivée:</b><br>' + lieuArrivee).openPopup();
                polyline.setLatLngs([
                    [dataDepart.latitude, dataDepart.longitude],
                    [dataArrivee.latitude, dataArrivee.longitude]
                ]);
            });
    }

    document.getElementById('lieuDepart').addEventListener('change', updateMap);
    document.getElementById('lieuArrivee').addEventListener('change', updateMap);

    // Mettre à jour la carte lorsque la page est chargée
    updateMap();
</script>
<script>
    // Récupérez les éléments du formulaire
    const lieuDepartInput = document.getElementById('lieuDepart');
    const longitudeDepartInput = document.getElementById('longitude_depart');
    const latitudeDepartInput = document.getElementById('latitude_depart');

    const lieuArriveeInput = document.getElementById('lieuArrivee');
    const longitudeDestinationInput = document.getElementById('longitude_destination');
    const latitudeDestinationInput = document.getElementById('latitude_destination');

    // Écoutez les changements dans les listes déroulantes
    lieuDepartInput.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        longitudeDepartInput.value = selectedOption.dataset.longitude;
        latitudeDepartInput.value = selectedOption.dataset.latitude;
    });

    lieuArriveeInput.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        longitudeDestinationInput.value = selectedOption.dataset.longitude;
        latitudeDestinationInput.value = selectedOption.dataset.latitude;
    });
</script>
