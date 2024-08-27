<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between py-5">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Sites') }}
            </h2>
        </div>
    </x-slot>
    {{--
    <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Remplissez ce formulaire </h2>
        
        <form action="{{ route('sites') }}" method="post">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                    <input type="text" name="nom" id="nom" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="">
                </div>
                <div class="w-full">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">longitude</label>
                    <input type="number" step="0.000001" name="longitude" id="longitude"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="">
                </div>
                <div class="w-full">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">latitude</label>
                    <input type="number" step="0.000001" name="latitude" id="latitude"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="">
                </div>

            </div>

            <button
                class="my-6 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                Enregistrer
            </button>
        </form>
    </div> --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Création de Lieux avec OpenStreetMap et Nominatim</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }

            #map {
                height: 400px;
                width: 100%;
                margin-bottom: 20px;
            }

            form {
                max-width: 500px;
                margin: 0 auto;
            }

            input[type="text"],
            input[type="submit"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                box-sizing: border-box;
            }

            label {
                font-weight: bold;
            }
        </style>
    </head>

    <body>


        <div id="map"></div>
        <form id="locationForm" action="{{ route('sites') }}" method="POST">
            @csrf
            <label for="name">Nom du lieu :</label>
            <input type="text" id="nom" name="nom" placeholder="Cliquez sur la carte ou recherchez un lieu"
                required>

            <label for="latitude">Latitude :</label>
            <input type="text" id="latitude" name="latitude"
                placeholder="Cliquez sur la carte pour obtenir la latitude" readonly required>

            <label for="longitude">Longitude :</label>
            <input type="text" id="longitude" name="longitude"
                placeholder="Cliquez sur la carte pour obtenir la longitude" readonly required>

            <input type="submit" value="Enregistrer le lieu">
        </form>

        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
        <script>
            // Initialisation de la carte centrée sur Kinshasa, République Démocratique du Congo
            var map = L.map('map').setView([-4.4419, 15.2663], 13); // Coordonnées de Kinshasa

            // Ajouter le layer OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Initialisation du marqueur
            var marker = L.marker([-4.4419, 15.2663]).addTo(map);

            // Fonction pour récupérer le nom du lieu avec Nominatim
            function getPlaceName(lat, lng) {
                var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}&addressdetails=1`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.display_name) {
                            var placeName = data.display_name;
                            document.getElementById('nom').value = placeName;

                            // Afficher le popup avec le nom du lieu
                            marker.bindPopup(placeName).openPopup();
                        } else {
                            document.getElementById('nom').value = "Nom inconnu";
                            marker.bindPopup("Nom inconnu").openPopup();
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération du nom du lieu:', error);
                        document.getElementById('nom').value = "Erreur de récupération";
                        marker.bindPopup("Erreur de récupération").openPopup();
                    });
            }

            // Mise à jour des champs latitude, longitude et nom lorsque la carte est cliquée
            map.on('click', function(e) {
                var lat = e.latlng.lat.toFixed(6);
                var lng = e.latlng.lng.toFixed(6);

                // Mettre à jour les champs de formulaire
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // Déplacer le marqueur
                marker.setLatLng([lat, lng]).update();

                // Récupérer et afficher le nom du lieu et popup
                getPlaceName(lat, lng);
            });

            // Ajout du contrôle de recherche à la carte
            L.Control.geocoder({
                defaultMarkGeocode: false
            }).on('markgeocode', function(e) {
                var bbox = e.geocode.bbox;
                var latlng = e.geocode.center;

                // Centrer la carte sur le lieu recherché
                map.fitBounds(bbox);

                // Mettre à jour les champs de latitude et longitude
                var lat = latlng.lat.toFixed(6);
                var lng = latlng.lng.toFixed(6);
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // Déplacer le marqueur
                marker.setLatLng(latlng).update();

                // Récupérer et afficher le nom du lieu et popup
                getPlaceName(lat, lng);
            }).addTo(map);

            // Soumission du formulaire
            document.getElementById('locationForm').addEventListener('submit', function(event) {
                event.preventDefault();

                var name = document.getElementById('nom').value;
                var latitude = document.getElementById('latitude').value;
                var longitude = document.getElementById('longitude').value;

                if (name && latitude && longitude) {
                    alert("Lieu enregistré avec succès :\n\nNom : " + name + "\nLatitude : " + latitude +
                        "\nLongitude : " + longitude);
                    // Ici, vous pouvez ajouter le code pour envoyer les données au serveur
                } else {
                    alert("Veuillez remplir tous les champs.");
                }
            });
        </script>

    </body>

    </html>



</x-app-layout>
