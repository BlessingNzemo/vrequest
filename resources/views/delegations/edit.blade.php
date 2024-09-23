<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between py-5">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Modifier la délégation') }}
            </h2>
            

        </div>
    </x-slot>
    <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Remplissez ce formulaire </h2>
        @if ($errors->any())

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:red">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('delegations.update', $delegations->id) }}" method="post">
            @csrf
            @method('put')
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motifs</label>
                    <input type="text" name="motif" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="" value="{{$demandes->motif}}">
                </div>
                <div class="w-full">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jour
                        et Heure de sortie</label>
                    <input type="datetime-local" name="date_deplacement" id="datetime"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="" value="{{$demandes->date_deplacement}}">
                </div>
                <div class="w-full">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de
                        passagers</label>
                    <input type="number" name="nbre_passagers" id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="" value="{{$demandes->nbre_passagers}}">
                </div>
                <div class="w-full">
                    <label for="choix-lieu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choisir
                        un lieu
                        :</label>
                    <div>
                        <label class="text-gray-900 dark:text-white">
                            <input type="radio" name="choix" value="liste" id="choix-liste"> Sur une liste
                        </label>
                    </div>

                    <div>
                        <label class="text-gray-900 dark:text-white">
                            <input type="radio" name="choix" value="carte" id="choix-carte"> Sur une carte
                        </label>
                    </div>
                </div>

                <div id="liste-lieux" class="col-span-2 grid gap-4 sm:grid-cols-2" style="display: none;">

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="col-span-1">
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lieu de
                                depart</label>
                            <select id="lieuDepart" name="lieu_depart"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value=""></option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->nom }}">{{ $site->nom }}</option>
                                    <p class=" text-white" name="longitude_depart" required>
                                        {{ $site->longitude }}
                                    </p>
                                    <span name="latitude_depart" required>{{ $site->latitude }}</span>
                                @endforeach


                            </select>

                        </div>

                        <div class="col-span-1">
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination</label>
                            <select id="lieuArrivee" name="destination"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value=""></option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->nom }}">{{ $site->nom }}</option>
                                @endforeach

                            </select>
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
                            <input type="text" name="lieu_depart" id="depart" value="{{$demandes->lieu_depart}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <ul id="results"></ul>
                        </div>
                        <div class="col-span-1">
                            <label for="destination"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Destination
                            </label>
                            <input type="text" name="destination" id="destination" value="{{$demandes->destination}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    </div>
                    

                </div>

                <div class="relative sm:col-span-2">
                    <div id="mapid"
                        style="height: 300px; width:860px;position: absolute; left: -1000000000000000px"></div>
                </div>




                <div class=" relative sm:col-span-2">

                    <div id="map" style=" height: 300px; width:860px; position: absolute;left:-100000000000px">
                    </div>
                </div>
            </div>
            <button type="submit"
                class="inline-flex items-center  mt-2 sm:mt-6  text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                Modifier la demande
            </button>

        </form>
        {{-- <script src="https://unpkg.com/jquery/dist/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
    </div>
    <x-choixDestination/>
    <x-destinationCarte />
    <x-destinationListe />
</x-app-layout>