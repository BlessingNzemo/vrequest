
<x-app-layout>
   
    <x-slot name="header">
        <div class="flex items-center justify-between px-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Demandes Collaborateurs') }}
            </h2>
            

        </div>
    </x-slot>
    @if(session('success'))
        <div class="flex p-4 mb-4 text-sm rounded-lg bg-green-500 " id="success-message">
            {{session('success')}}
        </div>
        <script>
            // Faire disparaître le message de succès après 5 secondes
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 5000) 
        </script>
    @endif

    
    <div class=" py-12 relative  overflow-x-auto ">
        <table id="example" class="w-full  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 shadow-md sm:rounded-lg">
            <thead class="text-xs text-gray-700 uppercase  bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="my-6 py-6 px-2">
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date et Heure de deplacement
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Ticket
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        Motif
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lieu de depart
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Destination
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date et Heure de deplacement
                    </th>

                     <th scope="col" class="px-6 py-3">
                        Nbr de passagers
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Validation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Traitement
                    </th> 
                    
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                  
                    
                </tr>
            </thead>
            <tbody>

                @foreach ($demandes as $i => $item)
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $i + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->date_deplacement }}
                        </td>
                        {{-- <td class="px-6 py-4">
                            {{ $item->ticket }}
                        </td> --}}
                        <td class="px-6 py-4">
                            {{ $item->motif }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->lieu_depart }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->destination }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->date_deplacement }}

                        </td>
                       
                        <td class="px-6 py-4">
                            {{ $item->nbre_passagers }}

                        </td> 
                        <td class="px-6 py-4">
                            @if($item->is_validated == 0)
                            En attente
                            @elseif($item->is_validated == 1)
                            Validée
                            @else
                            Annulée
                            @endif
                            
                        </td>
                        <td class="px-6 py-4">
                            @if($item->status == 1)
                            Traitée
                            @elseif($item->status == 2)
                            Annulée
                            @else
                            En attente
                            @endif
                        </td> 

                        <td>
                            <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots{{$i}}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                </svg>
                                
                                
                                <!-- Dropdown menu -->
                                <div id="dropdownDots{{$i}}"  class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                        <li>
                                            <a href="{{ route('demandes.show', $item->id) }}" data-modal-target="show-modal" data-modal-toggle="show-modal" onclick="show(event);" 
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">voir</a>
                                        </li>
                                        @if (Session::get('userIsManager') || Session::get('delegation'))
                                            @if($item->is_validated == 0 )
                                                <li>
                                                    <a href="{{route('envoyermailauchefcharroi',$item->id)}}" data-modal-target="popup-modal" data-modal-toggle="popup-modal" onclick="valider(event)" id="ButtonValider" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Valider</a> 
                                                        
                                                </li>
                                                <li>
                                                    <a href="{{route('annulationmailparmanager',$item->id)}}" data-modal-target="suppression-modal"
                                                    data-modal-toggle="suppression-modal" onclick="supprimer(event)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Annuler</a>
                                                </li>
                                            @endif
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
        </table>
    </div>
    <x-deleteDemande :message="__('Voulez-vous vraiment supprimer cette demande ?')" />
    <x-showDemande :message="__('Voulez-vous vraiment voir cette demande?')"/>

    <script>
        function editdemande(event, demandeId) {
            event.preventDefault();
            form = document.querySelector('#crud-modal div div form div div #demande_id');
            value = form.getAttribute('value');
            form.setAttribute('value',demandeId);
            console.log(value);
        }
    </script>
         
        

           
            
    <x-popupvalidation :message="__('Voulez-vous vraiment valider cette demande?')"/>
    <x-popupAnnulationDemandeManager :message="__('Voulez-vous vraiment supprimer cette demande?')"/>
</x-app-layout>



