@props(['vehicules', 'chauffeurs', 'demandes'])
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('details de la Demande') }}
            </h2>
        </div>
    </x-slot>
    <div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Validation Manager
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Validation Chef Charroi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Debut de la course
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fin de la course
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="odd:bg-white  odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td scope="row" class="px-6 py-4  font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <svg class="w-8 h-8 bg-green-500 items-center rounded-full text-white mt-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                                clip-rule="evenodd" />
                        </svg>
                    </td>
                    <td class="px-6 py-4">
                        <svg class="w-8 h-8  bg-green-500 items-center rounded-full text-white mt-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                                clip-rule="evenodd" />
                        </svg>
                    </td>
                    <td class="px-6 py-4">
                        <svg class="w-8 h-8 bg-green-500 items-center rounded-full text-white mt-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                                clip-rule="evenodd" />
                        </svg>
                    </td>
                    <td class="px-6 py-4">
                        <svg class="w-8 h-8 bg-green-500 items-center rounded-full text-white mt-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                                clip-rule="evenodd" />
                        </svg>
                    </td>

                </tr>
            </tbody>
        </table>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">

        @if (session('success'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-orange-800 rounded-lg bg-orange-100 dark:bg-gray-800 dark:text-orange-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Alert</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-orange-500 rounded-lg focus:ring-2 focus:ring-orange-400 p-1.5 hover:bg-orange-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-orange-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">id</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Ticket</th>
                    <th scope="col" class="px-6 py-3">Motifs</th>
                    <th scope="col" class="px-6 py-3">Lieu de depart</th>
                    <th scope="col" class="px-6 py-3">Destination</th>
                    <th scope="col" class="px-6 py-3">Date et Heure de deplacement</th>
                    <th scope="col" class="px-6 py-3">Nbr de passagers</th>
                    <th scope="col" class="px-6 py-3">vehicule</th>
                    <th scope="col" class="px-6 py-3">chauffeur</th>
                    <th scope="col" class="px-6 py-3">commentaire</th>

                </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $demandes->id }}</td>
                    <td class="px-6 py-4">{{ $demandes->date }}</td>
                    <td class="px-6 py-4">{{ $demandes->ticket }}</td>
                    <td class="px-6 py-4">{{ $demandes->motif }}</td>
                    <td class="px-6 py-4">{{ $demandes->lieu_depart }}</td>
                    <td class="px-6 py-4">{{ $demandes->destination }}</td>
                    <td class="px-6 py-4">{{ $demandes->date_deplacement }}</td>
                    <td class="px-6 py-4">{{ $demandes->nbre_passagers }}</td>
                    @if ($courses->count() > 0)
                        @foreach ($courses as $course)
                            <td class="px-6 py-4">{{ $course->vehicule->plaque }}</td>
                            <td class="px-6 py-4">{{ $course->chauffeur->user->username }}</td>
                            <td class="px-6 py-4">{{ $course->commentaire }}</td>

                </tr>
                @endforeach
            @else
                <p class="my-4 px-4">Aucune course associée à cette demande.</p>
                @endif
            </tbody>
        </table> --}}
    </div>

    <ul class="grid w-full gap-6 md:grid-cols-2">
        <li>
            <label for="hosting-small"
                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="block">
                    <div class="w-full text-lg font-semibold">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        id
                                    </th>
                                    <td scope="col" class="px-6 py-3">
                                        {{ $demandes->id }}
                                    </td>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Date
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $demandes->date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Motif
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $demandes->motif }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Lieu de depart
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $demandes->lieu_depart }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Destination
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $demandes->destination }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Nombre de passagers
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $demandes->nbre_passagers }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        vehicule
                                    </th>
                                    <td class="px-6 py-4">
                                        {{-- {{ $demandes->destination }} --}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        chauffeur
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $demandes->nbre_passagers }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </label>
        </li>
        <li>
            <label for="hosting-big"
                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="block">
                    <div class="w-full text-lg font-semibold">
                        <span>Carte</span>
                        <div id="map" style=" width:500px;
                         height: 380px; "></div>
                    </div>
                </div>
                <div class="w-full">
                    <div>
                        <h3>Nom du chauffeur</h3>
                        <h4>Plaque</h4>
                        <h5>455-52AB</h5>
                    </div>
                    <div>
                    </div>

                </div>
                </div>
                <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </label>
        </li>
    </ul>







    <x-savecourse :vehicules="$vehicules" :chauffeurs="$chauffeurs" :demandes="$demandes" :message="__('Voulez-vous enregistrer une course ?')" />
    <x-slot name="scripts">
    </x-slot>
    <script src="https://unpkg.com/jquery/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <x-choixDestination />
    <x-destinationCarte />
    <x-destinationListe />
</x-app-layout>
