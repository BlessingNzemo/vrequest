<x-app-layout>
    <!DOCTYPE html>
    <html lang="fr">

    <x-slot name="header">
        <div class="flex items-center justify-between  py-5">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Demander une course') }}
            </h2>
        </div>
    </x-slot>




    <!-- component -->

    <!-- Left: Image -->

    <div class="py-8  px-4 mx-auto max-w-4xl lg:py-16 shadow-md sm:rounded-lg">
        <h2 id="titre" class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Remplissez ce formulaire pour
            demander
            une course </h2>
        <div id="error" style="color: red"></div>
        @if ($errors->any())

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:red">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('demandes.store') }}" method="post" id="multi-step-form">
            @csrf
            <div id="step1" class="grid gap-4 sm:grid-cols-2 sm:gap-6">
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
                            <input type="hidden" id="latitude_destination" name="latitude_destination"
                                value="">
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





            <div id="step2" class="hidden  w-full h-full ">
                <h2 class="text-center  font-bold"> Veuillez insérer les noms des passagers</h2>
                <div class=" w-full h-full ">

                    <div id="passagers-name">
                        


                    </div>
                    <input type="hidden" id="nombre-passagers" name="nombre-passagers" value="">

                    <div class="flex justify-between items-center">
                        <button type="submit"
                            class=" button my-6 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                            Demander une course
                        </button>

                        <button id="retour" type="button"
                            class="button my-6 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                            Retour
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <x-dateDemande />
    <x-choixDestination />
    <x-destinationCarte />
    <x-destinationListe />
    <x-styleAutocomplete />
    <script src="{{Vite::asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{Vite::asset('node_modules/jquery-ui/dist/jquery-ui.js')}}"></script>
    <script src="{{Vite::asset('node_modules/leaflet/dist/leaflet.js')}}"></script>
    <script src="{{Vite::asset('node_modules/axios/dist/axios.min.js')}}"></script>

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





    <script>
        
        document.getElementById('next-step').addEventListener('click', function() {
            document.getElementById('passagers-name').innerHTML = '';

            document.getElementById('error').style.display = "none";
            // Masquer le bouton Suivant
            if (document.getElementById('motif').value == "") {

                document.getElementById('error').textContent = "Veuillez renseinger le champ motif";
                document.getElementById('error').style.display = "block";

                setTimeout(() => {
                    document.getElementById('error').style.display = "none";
                }, 3000);

                return false;
            }

            if (document.getElementById('datetime').value === "") {

                document.getElementById('error').textContent = "Veuillez renseinger le jour et heure de sortie";
                document.getElementById('error').style.display = "block";

                setTimeout(() => {
                    document.getElementById('error').style.display = "none";
                }, 3000);
                return false;
            }

            var nombre = document.getElementById('price').value;
            document.getElementById('nombre-passagers').value = nombre;



            if (nombre === "" || nombre == 0) {
                document.getElementById('error').textContent = "Veuillez renseinger le  nombre de passagers";
                document.getElementById('error').style.display = "block";

                setTimeout(() => {
                    document.getElementById('error').style.display = "none";
                }, 3000);
                return false;
            }
            if (document.getElementById('lieuDepart').value === "" && document.getElementById('depart').value ===
                "") {

                document.getElementById('error').textContent = "Veuillez selectionner le lieu de depart";
                document.getElementById('error').style.display = "block";

                setTimeout(() => {
                    document.getElementById('error').style.display = "none";
                }, 3000);
                return false;
            }
            if (document.getElementById('lieuArrivee').value === "" && document.getElementById('destination')
                .value === "") {

                document.getElementById('error').textContent = "Veuillez selectionner le lieu de destination";
                document.getElementById('error').style.display = "block";

                setTimeout(() => {
                    document.getElementById('error').style.display = "none";
                }, 3000);
                return false;
            }

            this.style.display = 'none';

            // Afficher la deuxième étape
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('titre').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');

            var passagers = document.getElementById('passagers-name');
            for (var i = 0; i < nombre; i++) {

                var input = document.createElement("input");
                var label = document.createElement("label");
                label.htmlFor = "passager" + i;
                label.textContent = "Passager " + (i + 1);

                input.type = "text";
                input.name = "passager" + i;
                input.id = "passager" + i;
                input.className =
                    "typeahead bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500";

                input.required = true;


                passagers.appendChild(label);
                passagers.appendChild(document.createElement('br'));

                passagers.appendChild(input);

                passagers.appendChild(document.createElement('br'));


            }


        });

        document.getElementById('retour').addEventListener('click', function() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('titre').classList.remove('hidden');
            document.getElementById('next-step').style.display = 'block';
            

        });
    </script>
  
    <script src="{{Vite::asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{Vite::asset('node_modules/bootstrap-3-typeahead/bootstrap3-typeahead.min.js')}}"></script>
 
    <script type="text/javascript">
        document.getElementById('next-step').addEventListener('click', function() {
            var path = "{{ url('autocomplete') }}";
            $('input.typeahead').typeahead({
                source: function(query, process) {
                    return $.get(path, {
                        query: query
                    }, function(data) {
                        return process(data);
                    });
                }
            });
        });
    </script>
   

</x-app-layout>
