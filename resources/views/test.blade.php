<x-app-layout>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire Multi-étapes</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            .step-container {
                display: flex;
                justify-content: space-between;
                gap: 2%;
                flex-wrap: wrap;
            }

            .step-content {
                width: 45%;
                background-color: #f9fafb;
                padding: 10px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
            }

            @media (max-width: 1024px) {
                .step-content {
                    width: 100%;
                }
            }

            .step.active .step-number {
                background-color: #ff6611;
                color: white;
            }

            .step {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .step-number {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background-color: #e5e7eb;
                color: #6b7280;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                margin-bottom: 8px;
            }

            .step-title {
                font-size: 0.875rem;
                color: #374151;
                text-align: center;
            }

            .progress-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 40px;
                width: 100%;
            }

            .progress-line {
                flex: 1;
                height: 2px;
                background-color: #e5e7eb;
                margin: 0 16px;
            }

            .progress-line.active {
                background-color: #3b82f6;
            }
        </style>
    </head>

    <body>
        <div class="container mx-auto p-6">
            <!-- Barre de progression -->
            <div class="progress-bar">
                <div class="step active" id="progress-step1">
                    <div class="step-number">1</div>
         
                </div>
                <div class="progress-line" id="progress-line1"></div>
                <div class="step" id="progress-step2">
                    <div class="step-number">2</div>
                    
                </div>
            </div>
            <!-- Conteneur des étapes -->
            <form action="{{ route('demandes.store') }}" method="post" id="multi-step-form">
                <div class="step-container">
                    <!-- Étape 1 -->
                    <div id="step1" class="step-content">
                        <div id="error" style="color: red" ></div>
                        @if ($errors->any())

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color:red">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motifs</label>
                    <input type="text" name="motif" id="motif"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="">
                </div>
                <div class="w-full hidden">
                    <label for="brand"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                    <input type="text" name="date" id="date" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="">
                </div>

                <div class="w-full">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jour
                        et Heure de sortie</label>
                    <input type="datetime-local" name="date_deplacement" id="datetime"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="">
                </div>
                <div class="w-full">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de
                        passagers</label>
                    <input type="number" name="nbre_passagers" id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="">
                </div>
                <div class="w-full">
                    <label for="choix-lieu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choisir
                        un lieu
                        :</label>
                    <div>
                        <label class="text-gray-900 dark:text-white" for="choix-liste">
                            <input type="radio" name="choix" value="choix-liste" id="choix-liste"> Sur une
                            liste
                        </label>
                    </div>

                    <div>
                        <label class="text-gray-900 dark:text-white">
                            <input type="radio" name="choix" value="choix-carte" id="choix-carte"> Sur une
                            carte
                        </label>
                    </div>
                </div>

                <div id="liste-lieux" class="col-span-2 grid gap-4 sm:grid-cols-2" style="display: none;">

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="col-span-1">
                            <label for="lieuDepart"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lieu de
                                depart</label>
                            <select id="lieuDepart" name="lieu_depart1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value=""></option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->nom }}" data-longitude="{{ $site->longitude }}"
                                        data-latitude="{{ $site->latitude }}">{{ $site->nom }}</option>
                                @endforeach

                            </select>
                            <input type="hidden" id="longitude_depart" name="longitude_depart" value="">
                            <input type="hidden" id="latitude_depart" name="latitude_depart" value="">


                        </div>

                        <div class="col-span-1">
                            <label for="lieuArrivee"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination</label>
                            <select id="lieuArrivee" name="destination1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value=""></option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->nom }}" data-longitude="{{ $site->longitude }}"
                                        data-latitude="{{ $site->latitude }}">{{ $site->nom }}</option>
                                @endforeach

                            </select>
                            <input type="hidden" id="longitude_destination" name="longitude_destination"
                                value="">
                            <input type="hidden" id="latitude_destination" name="latitude_destination" value="">
                        </div>

                    </div>

                </div>

                <div id="carte-lieux" style="display: none;" class="col-span-2 grid gap-4 sm:grid-cols-2">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="col-span-1">
                            <label for="depart"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lieu
                                de Depart
                            </label>
                            <input type="text" name="lieu_depart" id="depart"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <input type="hidden" name="latitude_depart1" id="latitude_depart1">
                            <input type="hidden" name="longitude_depart1" id="longitude_depart1">
                            <ul id="results"></ul>
                        </div>
                        <div class="col-span-1">
                            <label for="destination"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Destination
                            </label>
                            <input type="text" name="destination" id="destination"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <input type="hidden" name="latitude_destination1" id="latitude_destination1">
                            <input type="hidden" name="longitude_destination1" id="longitude_destination1">
                        </div>
                    </div>


                </div>

                <div class="relative sm:col-span-2">
                    <div id="mapid"
                        style="height: 300px; width:100%; position: absolute; left: -1000000000000000px"></div>
                </div>

                <div class="relative sm:col-span-2">

                    <div id="map" style=" height: 300px; width:100%; position: absolute;left:-100000000000px">
                    </div>
                </div>
            </div>
                        <button type="button" id="next-step"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Suivant</button>

                    </div>

                    <!-- Étape 2 -->
                    <div id="step2" class="step-content hidden">
                       
                        @if ($errors->any())

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color:red">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                       <div id="passagers-name"> <h2 class="text-center  font-bold"> Veuillez insérer les noms des passagers</h2>
                     

                       </div>
                       <input type="hidden" id="nombre-passagers" name="nombre-passagers" value="">

                        <button type="submit"
                            class="bg-green-500 text-white my-9 px-4 py-2 rounded-lg hover:bg-green-600">Demander
                            une course</button>

                    </div>

                </div>
            </form>
        </div>
        <script>
            document.getElementById('next-step').addEventListener('click', function() {
         
                
           
                document.getElementById('error').style.display = "none";
                // Masquer le bouton Suivant
                if(document.getElementById('motif').value == ""){
                     
                      document.getElementById('error').textContent = "Veuillez renseinger le champ motif";
                      document.getElementById('error').style.display = "block";
                      
                    setTimeout(() => {
                      document.getElementById('error').style.display = "none";
                    }, 3000);
                     
                    return false;
                }
              
                if(document.getElementById('datetime').value === ""){
                     
                     document.getElementById('error').textContent = "Veuillez renseinger le jour et heure de sortie";
                     document.getElementById('error').style.display = "block";
                     
                   setTimeout(() => {
                     document.getElementById('error').style.display = "none";
                   }, 3000); 
                   return false;
               }
               
                var nombre = document.getElementById('price').value;
                document.getElementById('nombre-passagers').value = nombre;
             
             
                
                if(nombre === "" || nombre == 0){
                    document.getElementById('error').textContent = "Veuillez renseinger le  nombre de passagers";
                    document.getElementById('error').style.display = "block";
                      
                      setTimeout(() => {
                        document.getElementById('error').style.display = "none";
                      }, 3000); 
                      return false;
                }
                if(document.getElementById('lieuDepart').value === "" && document.getElementById('depart').value === ""){
                     
                     document.getElementById('error').textContent = "Veuillez selectionner le lieu de depart";
                     document.getElementById('error').style.display = "block";
                     
                   setTimeout(() => {
                     document.getElementById('error').style.display = "none";
                   }, 3000); 
                   return false;
               }
               if(document.getElementById('lieuArrivee').value === "" && document.getElementById('destination').value === ""){
                     
                     document.getElementById('error').textContent = "Veuillez selectionner le lieu de destination";
                     document.getElementById('error').style.display = "block";
                     
                   setTimeout(() => {
                     document.getElementById('error').style.display = "none";
                   }, 3000); 
                   return false;
               }
         
                this.style.display = 'none';

                // Afficher la deuxième étape
                document.getElementById('step2').classList.remove('hidden');
               
                var passagers = document.getElementById('passagers-name');
                for (var i = 0; i <nombre; i++) {

                    var input = document.createElement("input");
                    var label = document.createElement("label");
                    label.htmlFor = "passager" + i;
                    label.textContent = "Passager " + (i+1);
                    
                    input.type = "text";
                    input.name = "passager" +i;
                    input.id = "passager" + i; // Give each input a unique ID
                    input.className = "typeahead bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500";
                    
                    input.required = true;

                    // Append the input to the passagers element
                    passagers.appendChild(label);
                    passagers.appendChild(document.createElement('br'));
                    
                    passagers.appendChild(input);
                    
                    // Add a line break
                    passagers.appendChild(document.createElement('br'));
                  
                    
                }
                

                // Mettre à jour la barre de progression
                document.getElementById('progress-step2').classList.add('active');
                document.getElementById('progress-line1').classList.add('active');

                // Réorganiser les étapes pour être côte à côte
                // document.getElementById('step1').style.width = '35%';
                // document.getElementById('step2').style.width = '50%';
            });
        </script>
        <!-- Script JavaScript -->
        <script>
            // Aucun script JavaScript supplémentaire n'est nécessaire puisque tout le formulaire est validé d'un coup
            document.getElementById('multi-step-form').addEventListener('submit', function(event) {
                // Si vous avez besoin de vérifier quoi que ce soit avant l'envoi du formulaire
                if (!this.checkValidity()) {
                    event.preventDefault(); // Empêche la soumission si le formulaire n'est pas valide
                }
            });
        </script>
      <x-dateDemande />
      <x-choixDestination />
      <x-destinationCarte />
      <x-destinationListe />
      <x-styleAutocomplete />
      <script src="https://unpkg.com/jquery/dist/jquery.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
      <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      <script>
          // Ajoutez un écouteur d'événement pour le champ "Nombre de passagers"
          const passengerInput = document.getElementById('price');
          passengerInput.addEventListener('input', () => {
              const value = parseInt(passengerInput.value);
              if (value < 1 || value > 50) {
                  passengerInput.setCustomValidity('Le nombre de passagers doit être compris entre 1 et 50.');
              } else {
                  passengerInput.setCustomValidity('');
              }
          });
      </script>
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <script type="text/javascript">
        document.getElementById('next-step').addEventListener('click', function() {
           var path = "{{ url('autocomplete') }}";
                $('input.typeahead').typeahead({
                    source:  function (query, process) {
                    return $.get(path, { query: query }, function (data) {
                            return process(data);
                        });
                    }
                });
            });
            </script>

</x-app-layout>
