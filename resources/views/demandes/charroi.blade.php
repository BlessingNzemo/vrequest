<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between px-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Demandes à traiter') }}
            </h2>


        </div>
    </x-slot>
    @if (session('success'))
        <div class="flex p-4 mb-4 text-sm rounded-lg bg-green-500 " id="success-message">
            {{ session('success') }}
        </div>
        <script>
            // Faire disparaître le message de succès après 5 secondes
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 5000)
        </script>
    @endif

    @if (session('failed'))
        <div class="flex p-4 mb-4 text-sm rounded-lg bg-red-500 " id="failed-message">
            {{ session('failed') }}
        </div>
        <script>
            // Faire disparaître le message de succès après 5 secondes
            setTimeout(function() {
                document.getElementById('failed-message').style.display = 'none';
            }, 5000)
        </script>
    @endif

    @if (session('rejected'))
        <div class="flex p-4 mb-4 text-sm rounded-lg bg-yellow-300 " id="rejected-message">
            {{ session('rejected') }}
        </div>
        <script>
            // Faire disparaître le message de succès après 5 secondes
            setTimeout(function() {
                document.getElementById('rejected-message').style.display = 'none';
            }, 5000)
        </script>
    @endif



<div class="flex flex-col">
    <div class=" overflow-x-auto pb-4">
        <div class="min-w-full inline-block align-middle">
            <div class="overflow-hidden  border rounded-lg border-gray-300">
                <table class="table-auto min-w-full rounded-xl">
                    <thead>
                        <tr class="bg-gray-100">
                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> N°</th>
                            {{-- <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Date </th> --}}
                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize min-w-[150px]"> Motif</th>
                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Lieu de depart</th>
                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Destination </th>
                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Date et Heure <br>de deplacement</th>
                            {{-- <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Nombre de <br>passagers </th> --}}
                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Status du<br> traitement </th>
                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Actions </th>
                        </tr>
                     </thead>
                     <tbody class="divide-y divide-gray-300 ">
                         @foreach ($demandes->sortBy('status') as $i => $item)
                             <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 "> {{$i+1}}</td>
                                {{-- <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ $item->date }}</td> --}}
                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{$item->motif}}</td>
                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ substr($item->lieu_depart, 0, 50) }}</td>
                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ substr($item->destination, 0, 50) }}</td>
                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ $item->date_deplacement}}</td>
                                {{-- <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ $item->nbre_passagers  }}</td> --}}
                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                    
                                        @if ($item->status=='1')
                                            <div class="py-1.5 px-2.5 bg-emerald-50 rounded-full flex justify-center w-20 items-center gap-1">
                                                <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="2.5" cy="3" r="2.5" fill="#059669"></circle>
                                                </svg>
                                                <span class="font-medium text-xs text-emerald-600 ">Traitée</span>
                                            </div>
                                        @endif
                                        @if ($item->status=='0')
                                            <div class="py-1.5 px-2.5 bg-orange-50 rounded-full flex w-20 justify-center items-center gap-1">
                                                <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                </svg>
                                                <span class="font-medium text-xs text-orange-500 ">En attente</span>
                                            </div>    
                                        @endif
                                    
                                        @if (($item->status=='2'))
                                            <div class="py-1.5 px-2.5 bg-red-50 rounded-full flex w-20 justify-center items-center gap-1">
                                                <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                </svg>
                                                <span class="font-medium text-xs text-red-600 ">Rejetée</span>
                                            </div>
                                        @endif



                                    </td>
                                    <td>
                                        <button id="dropdownMenuIconButton"
                                            data-dropdown-toggle="dropdownDots{{ $i }}"
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 4 15">
                                                <path
                                                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                            </svg>


                                        <!-- Dropdown menu -->
                                        <div id="dropdownDots{{ $i }}"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" 
                                                aria-labelledby="dropdownMenuIconButton">
                                                <li>
                                                    <a href="{{ route('demandes.show', $item->Url) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Voir cette demande">
                                                        
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6 margin-left: 5px margin-right: 5px">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                            
                                                            Voir
                                                    </a>
                                                </li>
                                                
                                                @if (Session::get('authUser')->hasRole('charroi'))
                                                    @if (($item->is_validated == 1)  && ($item->status == '0'))
                                                        <li>
                                                            <a onclick="editdemande(event, {{ $item->id }});"
                                                                data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Traiter cette demande">
                                                                
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 margin-left: 5px margin-right: 5px">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                    </svg>
                                  
                                                                    Traiter 
                                                            </a>
                                                        </li>
                                                    
                                                        <li>
                                                            <a onclick="rejeter(event);" data-modal-target="rejet-modal"
                                                                data-modal-toggle="rejet-modal"
                                                                href="{{route('rejetDemandeParCharroi',$item->id)}}"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Rejeter cette demande">
                                                               
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 margin-left: 5px margin-right: 5px">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                    </svg>  
                                                                    
                                                                Rejeter
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif

                                                </ul>

                                            </div>
                                        </button>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $demandes->links() }}
                </div>
            </div>
        </div>
    </div>





    <script>
        new DataTable('#example', {
            info: false,
            ordering: false,
            paging: false

            // language: {
            //     paginate: {
            //         next: '<span class="next-page">Suivant</span>',
            //         previous: '<span class="prev-page">Précédent</span>'
            //     }
            // },
            // initComplete: function() {
            //     // Modifier la couleur de la pagination
            //     $('.dataTables_paginate .pagination .page-item.active .page-link').css('background-color',
            //         '#ff0000');
            //     $('.dataTables_paginate .pagination .page-item .page-link').css('color', '#ff0000');
            // }
        });
    </script>

    <x-deleteDemande :message="__('Voulez-vous vraiment supprimer cette demande ?')" />

    <x-showDemande :message="__('Voulez-vous vraiment voir cette demande?')" />
    <x-deleteDemande :message="__('Voulez-vous vraiment supprimer cette demande ?')" />
    <x-savecourse :demandes="$demandes" :vehicules="$vehicules" :chauffeurs="$chauffeurs" :message="__('Voulez-vous enregistrer une course ?')" />
    <x-rejetDemandeParCharroi :message="__('Voulez-vous vraiment rejeter cette demande?')" />
    <script>
        
        function editdemande(event, demandeId, vehicules, nombre) {
            event.preventDefault();
           
            form = document.querySelector('#crud-modal div div form div div #demande_id');
            var vehiculeSelect = document.querySelector("#crud-modal div div form div div #vehicule_id")
            value = form.getAttribute('value');
            form.setAttribute('value', demandeId);
            console.log(value);
            vehiculeSelect.innerHTML = '';
            var opt1 = document.createElement('option');
            opt1.value = 'vehicule';
            opt1.text = 'Sélectionnez un véhicule';
            vehiculeSelect.add(opt1);
            vehicules.forEach(function(option) {
                if (option.capacite >= nombre) {
                    var opt = document.createElement("option");
                    opt.value = option.id;
                    opt.text = option.plaque + "=" + option.capacite;
                    vehiculeSelect.add(opt);
                }
            });


        }
    </script>




</x-app-layout>
