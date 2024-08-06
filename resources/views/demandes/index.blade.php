<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between px-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Demandes') }}
            </h2>
            <div class="flex items-center justify-between my-4">
                <a href="{{ route('demandes.create') }}" data-tooltip-target="tooltip-new" type="button"
                    class="inline-flex items-center justify-center w-14 h-14 font-medium bg-orange-400 rounded-full hover:bg-gray-700 group focus:ring-4 focus:ring-blue-200 focus:outline-none dark:focus:ring-gray-700">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="sr-only">New item</span>
                </a>
            </div>      
            <div id="tooltip-new" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-1 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Demander une course
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>



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




    <div class=" py-12 relative  overflow-x-auto ">
        <table id="example" class="  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 shadow-md sm:rounded-lg">
            <thead class="text-xs text-gray-700 uppercase  bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="my-6 py-6 px-2">
                    <th scope="col" class="px-6 py-3">
                        Numéro
                    </th>
                    <th scope="col" class="px-6 my-6 py-4">
                        Date
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Ticket
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        Motifs
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Lieu de depart
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        Destination
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Date et Heure de deplacement
                    </th> --}}

                    {{-- <th scope="col" class="px-6 py-3">
                        Nbr de passagers
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Statut
                    </th> --}}

                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>


                </tr>
            </thead>
            <tbody>

                @foreach ($demandes->sortByDesc('id') as $i => $item)
                    <tr class="bg-white border rounded-lg dark:bg-gray-800 ">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $i + 1 }}
                        </td>
                        <td class="px-6 py-4 ">
                            {{ $item->date }}
                        </td>
                        
                        <td class="px-6 py-4 ">
                            {{ $item->motif }}
                        </td>
                        <td class="px-6 py-4">
                            {{ substr($item->lieu_depart, 0, 50) }}
                        </td> 
                        <td class="px-6 py-4 ">
                            {{ substr($item->destination, 0, 50) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->date_deplacement }}

                        </td> 
                        <td class="px-6 py-4">
                            {{ $item->nbre_passagers}}  
                        </td>

                       <td class="px-6 py-4">
                        @if ( $item->status ==0)
                            en attente
                        @endif
                        @if ( $item->status ==1)
                            traitée
                        @endif
                        @if ( $item->status ==2)
                            rejetée
                        @endif
                       
                        </td> 


                        <td>
                            <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots{{ $i }}"
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
                                            <a href="{{ route('demandes.show', $item->id) }}"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">voir</a>
                                        </li>
                                        @if ($item->is_validated == 0)
                                            <li>
                                                <a href="{{ route('demandes.edit', $item->id) }}"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editer</a>
                                            </li>
                                            <li>
                                                <a onclick="supprimer(event);" data-modal-target="delete-modal"
                                                    data-modal-toggle="delete-modal"
                                                    href="{{ route('demandes.destroy', $item->id) }}"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Supprimer</a>
                                            </li>
                                        @endif
                                        
                                        @if (Session::get('authUser')->hasRole('charroi'))
                                            @if ( ($item->is_validated == 1)  && ($item->status == 0))
                                                <li>
                                                    <a onclick="editdemande(event, {{ $item->id }});"
                                                        data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Traiter</a>
                                                </li>
                                            
                                                <li>
                                                    <a onclick="supprimer(event);" data-modal-target="delete-modal"
                                                        data-modal-toggle="delete-modal"
                                                        href="{{ route('demandes.destroy', $item->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Annuler</a>
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
            {{-- {{ $demandes->links() }} --}}
        </table>
        {{ $demandes->links() }}
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
    <script>
        function changerStatus($demande) {
            $status = "Validé"
            $demande - > update(
                [
                    'status' => $status
                ]
            );
        }
    </script>
    <x-deleteDemande :message="__('Voulez-vous vraiment supprimer cette demande ?')" />

    <x-deleteDemande :message="__('Voulez-vous vraiment supprimer cette demande ?')" />
    <x-savecourse :demandes="$demandes" :vehicules="$vehicules" :chauffeurs="$chauffeurs" :message="__('Voulez-vous enregistrer une course ?')" />
    <script>
        function editdemande(event, demandeId) {
            event.preventDefault();
            form = document.querySelector('#crud-modal div div form div div #demande_id');
            value = form.getAttribute('value');
            form.setAttribute('value', demandeId);
            console.log(value);

            
        }
    </script>




</x-app-layout>
