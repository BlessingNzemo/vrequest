
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
    @if(session('annuler'))
        <div class="flex p-4 mb-4 text-sm rounded-lg bg-gray-400 " id="annuler-message">
            {{session('annuler')}}
        </div>
        <script>
            // Faire disparaître le message de succès après 5 secondes
            setTimeout(function() {
                document.getElementById('annuler-message').style.display = 'none';
            }, 5000) 
        </script>
    @endif

    <div class="flex flex-col">
        <div class=" overflow-x-auto pb-4">
            <div class="min-w-full inline-block align-middle">
                

                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                            <li class="me-2">
                                <button id="services-tab" data-tabs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    <svg width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier"> 
                                        <path d="M30 32h-10c-1.105 0-2-0.895-2-2v-10c0-1.105 0.895-2 2-2h10c1.105 0 2 0.895 2 2v10c0 1.105-0.895 2-2 2zM30 20h-10v10h10v-10zM30 14h-10c-1.105 0-2-0.896-2-2v-10c0-1.105 0.895-2 2-2h10c1.105 0 2 0.895 2 2v10c0 1.104-0.895 2-2 2zM30 2h-10v10h10v-10zM12 32h-10c-1.105 0-2-0.895-2-2v-10c0-1.105 0.895-2 2-2h10c1.104 0 2 0.895 2 2v10c0 1.105-0.896 2-2 2zM12 20h-10v10h10v-10zM12 14h-10c-1.105 0-2-0.896-2-2v-10c0-1.105 0.895-2 2-2h10c1.104 0 2 0.895 2 2v10c0 1.104-0.896 2-2 2zM12 2h-10v10h10v-10z"></path> 
                                        </g>
                                    </svg>  
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab" aria-controls="statistics" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    <svg width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 14h-2c-0.552 0-1 0.448-1 1v2c0 0.552 0.448 1 1 1h2c0.552 0 1-0.448 1-1v-2c0-0.552-0.448-1-1-1zM31 15h-21c-0.552 0-1 0.448-1 1s0.448 1 1 1h21c0.552 0 1-0.448 1-1s-0.448-1-1-1zM3 22h-2c-0.552 0-1 0.448-1 1v2c0 0.552 0.448 1 1 1h2c0.552 0 1-0.448 1-1v-2c0-0.552-0.448-1-1-1zM31 23h-21c-0.552 0-1 0.448-1 1s0.448 1 1 1h21c0.552 0 1-0.448 1-1s-0.448-1-1-1zM3 6h-2c-0.552 0-1 0.448-1 1v2c0 0.552 0.448 1 1 1h2c0.552 0 1-0.448 1-1v-2c0-0.552-0.448-1-1-1zM10 9h21c0.552 0 1-0.448 1-1s-0.448-1-1-1h-21c-0.552 0-1 0.448-1 1s0.448 1 1 1z"></path> </g></svg>
                                </button>
                            </li>
                        </ul>
                        <div id="defaultTabContent">
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                                <div class="overflow-hidden rounded-lg border-gray-300">
                                <table id="" class="table-auto min-w-full rounded-xl">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> N°</th>
                                            {{-- <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Date </th> --}}
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize min-w-[150px]"> Motif</th>
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize min-w-[150px]"> Demandeur</th>
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize min-w-[150px]"> Manager</th>
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Lieu de depart</th>
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Destination </th>
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Date et Heure <br>de deplacement</th>
                                            {{-- <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Nombre de <br>passagers </th> --}}
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Validation du <br> Manager </th>
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Status du<br> traitement </th>
                                            <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-300 ">
                                        @foreach ($demandes->sortBy('is_validated')->sortBy('status')->sortBy('manager_id') as $i => $item)
                                            <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 "> {{$i+1}}</td>
                                                {{-- <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ $item->date }}</td> --}}
                                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{$item->motif}}</td>
                                                <td class=" px-5 py-3">
                                                    <div class="w-48 flex items-center gap-3">
                                                        {{-- <img src="https://pagedone.io/asset/uploads/1697536419.png" alt="Floyd image"> --}}
                                                        <div class="data">
                                                            <p class="font-normal text-sm text-gray-900"> {{ App\Models\User::find($item->user_id)->username }}</p>
                                                            <p class="font-normal text-xs leading-5 text-gray-400"> {{ App\Models\User::find($item->user_id)->email }} </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class=" px-5 py-3">
                                                    <div class="w-48 flex items-center gap-3">
                                                        {{-- <img src="https://pagedone.io/asset/uploads/1697536419.png" alt="Floyd image"> --}}
                                                        {{-- <div class="data">
                                                            <p class="font-normal text-sm text-gray-900"> {{ App\Models\User::find($item->manager_id)->username }}</p>
                                                            <p class="font-normal text-xs leading-5 text-gray-400"> {{ App\Models\User::find($item->manager_id)->email }} </p>
                                                        </div> --}}
                                                    </div>
                                                </td>
                                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ substr($item->lieu_depart, 0, 50) }}</td>
                                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ substr($item->destination, 0, 50) }}</td>
                                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ $item->date_deplacement}}</td>
                                                {{-- <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ $item->nbre_passagers  }}</td> --}}
                                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                    
                                                        @if ($item->is_validated == 1)
                                                            <div class="py-1.5 px-2.5 bg-emerald-50 rounded-full flex justify-center w-20 items-center gap-1">
                                                                <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <circle cx="2.5" cy="3" r="2.5" fill="#059669"></circle>
                                                                </svg>
                                                                <span class="font-medium text-xs text-emerald-600 ">Validée</span>
                                                            </div>
                                                        @endif
                                                        @if ($item->is_validated == 0)
                                                            <div class="py-1.5 px-2.5 bg-orange-50 rounded-full flex w-20 justify-center items-center gap-1">
                                                                <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                                </svg>
                                                                <span class="font-medium text-xs text-orange-500 ">En attente</span>
                                                            </div>    
                                                        @endif
                                                    
                                                        @if (($item->is_validated == 2))
                                                            <div class="py-1.5 px-2.5 bg-red-50 rounded-full flex w-20 justify-center items-center gap-1">
                                                                <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                                </svg>
                                                                <span class="font-medium text-xs text-red-600 ">Annulée</span>
                                                            </div>    
                                                        @endif
                                                    
                                                    
                                                
                                                </td>
                                                <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                        @if(($item->status=='2') ||($item->is_validated=='2'))
                                                            <div class="py-1.5 px-2.5 bg-red-50 rounded-full flex w-20 justify-center items-center gap-1">
                                                                <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                                </svg>
                                                                <span class="font-medium text-xs text-red-600 ">Rejetée</span>
                                                            </div>
                                                        
                                                        @else
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
                                                                    <a href="{{ route('demandes.show', $item->Url) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                        
                                                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                                stroke="currentColor" class="w-6 h-6 margin-left: 15px margin-right: 5px">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                            </svg> --}}
                                                                            Voir
                                                                            
                                                                    </a>
                                                                </li>
                                                                @if (Session::get('userIsManager'))
                                                                    @if($item->is_validated == 0 )
                                                                        <li>
                                                                            <a href="{{route('envoyermailauchefcharroi',$item->id)}}" data-modal-target="validation-modal" data-modal-toggle="validation-modal" onclick="valider(event)" id="ButtonValider" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                                
                                                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#22cc00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                                                        <path d="M22 4L12 14.01l-3-3"></path>
                                                                                    </svg> --}}
                                                                                Valider
                                                                            
                                                                            </a> 
                                                                                
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{route('annulationmailparmanager',$item->id)}}" data-modal-target="suppression-modal"
                                                                            data-modal-toggle="suppression-modal" onclick="supprimer(event)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                                
                                                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#cc2200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
                                                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                                                        <path d="M15 11L9 17"></path>
                                                                                        <path d="M9 11L15 17"></path>
                                                                                    </svg> --}}
                                                                                    Annuler
                                                                                
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
                            <div class="hidden p-4 bg-white rounded-lg dark:bg-gray-800" id="services" role="tabpanel" aria-labelledby="services-tab">
                                <dl class="grid grid-cols-1 p-4 text-gray-900 sm-grid-cols-1 sm-grid-cols-2 sm-grid-cols-3 sm-grid-cols-4 sm-grid-cols-5 xl:grid-cols-6 dark:text-white">
                                    <?php $n = 1; ?>
                                    @foreach ($demandesGrid->sortBy('status') as $i => $item)
                                        <div style="margin-bottom: 2.5%; margin-right: 2.5%;" class="flex flex-col">
                                            <a href="{{ route('demandes.show', $item->Url) }}">
                                                <div style=" display:inline-block" class="flex flex-col justify-center items-center ">
                                                    <div id="{{ __("card-grid".$n) }}" class="light:bg-white rounded-lg shadow-lg overflow-hidden max-w-lg w-full">
                                                        <div class="p-6">
                                                            <h2 id="{{ __("card-ticket".$n) }}" style="margin-bottom: 7%" class="light:text-white text-2xl font-bold text-gray-800 mb-2">{{ __($item->ticket) }}</h2>
                                                            <div style="justify-content:space-between;" class="flex items-center">
                                                                <div class="flex items-center">
                                                                    <img src="https://png.pngtree.com/png-vector/20210921/ourlarge/pngtree-flat-people-profile-icon-png-png-image_3947764.png" alt="Avatar" class="sm-w-8 sm-h-8 w-8 h-8 rounded-full mr-2 object-cover">
                                                                    <span id="{{ __("card-creater".$n) }}" class="light:text-white sm:creater-size text-gray-800 font-semibold">{{ __($item->user()->first()->last_name." ".$item->user()->first()->first_name ) }}</span>
                                                                </div>
                                                                <div class="sm:flex-button text-gray-600">
                                                                    <a href="{{route('demandes.show', $item->Url) }}" style="padding-right: 0.7rem" class="block hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                                stroke="currentColor" id="{{ __("card-button-show".$n) }}" class="light:text-white" width="20" height="20">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                    @if (Session::get('userIsManager'))
                                                                        @if ($item->is_validated == 0)
                                                                            <a id="ButtonValider" href="{{ route('envoyermailauchefcharroi',$item->id) }}" style="padding-right: 0.7rem" data-modal-target="validation-modal" data-modal-toggle="validation-modal" onclick="valider(event);"
                                                                                class="block hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22cc00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                                                        <path d="M22 4L12 14.01l-3-3"></path>
                                                                                    </svg>
                                                                            </a>
                                                                            <a id="action-cancel" onclick="supprimer(event);" style="padding-right: 0.7rem" data-modal-target="suppression-modal"
                                                                                data-modal-toggle="suppression-modal"
                                                                                href="{{ route('annulationmailparmanager',$item->id) }}"
                                                                                class="block hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#cc2200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
                                                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                                                        <path d="M15 11L9 17"></path>
                                                                                        <path d="M9 11L15 17"></path>
                                                                                    </svg>
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div style="margin-right: 5%;margin-top:3%;" class="flex justify-between items-center">
                                                                <div class="flex items-center">
                                                                    <span id="{{ __("card-createdAt".$n) }}" class="light:text-white sm:creater-size text-gray-600">{{ __($item->created_at->toDateTimeString()) }}</span>
                                                                </div>
                                                                <span style="width:6rem;font-size: 70%" class="text-gray-600">
                                                                    @if($item->is_validated == 0 AND $item->status == '0')
                                                                        <div class="py-1.5 px-2.5 bg-orange-50 rounded-full flex justify-center items-center gap-1">
                                                                            <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                                            </svg>
                                                                            <span class="sm-text-waiting font-medium text-xs text-orange-500 ">En attente</span>
                                                                        </div> 
                                                                    @elseif($item->is_validated == 2 )
                                                                        <div class="py-1.5 px-2.5 bg-red-50 rounded-full flex justify-center items-center gap-1">
                                                                            <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                                            </svg>
                                                                            <span class="font-medium text-xs text-red-600 ">Annulée</span>
                                                                        </div>
                                                                    @elseif($item->is_validated == 1 AND $item->status == '0')
                                                                        <div class="py-1.5 px-2.5 bg-emerald-50 rounded-full flex justify-center items-center gap-1">
                                                                            <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <circle cx="2.5" cy="3" r="2.5" fill="#059669"></circle>
                                                                            </svg>
                                                                            <span class="font-medium text-xs text-emerald-600 ">Validée</span>
                                                                        </div>
                                                                    @elseif ($item->is_validated == 1 AND $item->status == '1' )
                                                                        <div class="py-1.5 px-2.5 bg-emerald-50 rounded-full flex justify-center items-center gap-1">
                                                                            <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <circle cx="2.5" cy="3" r="2.5" fill="#059669"></circle>
                                                                            </svg>
                                                                            <span class="font-medium text-xs text-emerald-600 ">Traitée</span>
                                                                        </div>
                                                                    @elseif ($item->is_validated == 1 AND $item->status == '2' )
                                                                        <div class="py-1.5 px-2.5 bg-red-50 rounded-full flex justify-center items-center gap-1">
                                                                            <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                                            </svg>
                                                                            <span class="font-medium text-xs text-red-600 ">Rejetée</span>
                                                                        </div>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php $n++; ?>
                                    @endforeach
                                </dl>
                                {{ $demandesGrid->links() }}
                            </div>
                        </div>
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
    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            console.log("dark mode!")

            var gridIcon = document.querySelector("#services-tab svg");
            gridIcon.setAttribute("fill", "#ffffff");
            var listIcon = document.querySelector("#statistics-tab svg");
            listIcon.setAttribute("fill","#ffffff");

            var items = '<?= $demandesGrid->count() ?>';
            for(let i=1;i<=items;i++){
                var card = document.getElementById("card-grid"+i);
                var createdAt = document.getElementById("card-createdAt"+i);
                var ticket  = document.getElementById("card-ticket"+i);
                var creater = document.getElementById("card-creater"+i);
                var buttonShow = document.getElementById("card-button-show"+i);

                card.classList.remove("light:bg-white");
                createdAt.classList.remove("light:text-white");
                ticket.classList.remove("light:text-white");
                creater.classList.remove("light:text-white");
                buttonShow.classList.remove("light:text-white");

                card.classList.add("dark:bg-dark");
                createdAt.classList.add("dark:text-dark");
                ticket.classList.add("dark:text-dark");
                creater.classList.add("dark:text-dark");
                buttonShow.classList.add("dark:text-dark");  
            }
        }else{
            console.log("light mode!")

            var gridIcon = document.querySelector("#services-tab svg");
            gridIcon.setAttribute("fill", "#000000");
            var listIcon = document.querySelector("#statistics-tab svg");
            listIcon.setAttribute("fill","#000000");

            var items = '<?= $demandesGrid->count() ?>';
            for(let i=1;i<=items;i++){
                var card = document.getElementById("card-grid"+i);
                var createdAt = document.getElementById("card-createdAt"+i);
                var ticket  = document.getElementById("card-ticket"+i);
                var creater = document.getElementById("card-creater"+i);
                var buttonShow = document.getElementById("card-button-show"+i);

                card.classList.remove("dark:bg-dark");
                createdAt.classList.remove("dark:text-dark");
                ticket.classList.remove("dark:text-dark");
                creater.classList.remove("dark:text-dark");
                buttonShow.classList.remove("dark:text-dark");

                card.classList.add("light:bg-white");
                createdAt.classList.add("light:text-white");
                ticket.classList.add("light:text-white");
                creater.classList.add("light:text-white");
                buttonShow.classList.add("light:text-white");
            }
        }

        window.matchMedia('(prefers-color-scheme: dark)')
            .addEventListener('change',({ matches }) => {
            if (matches) {
                console.log("change to dark mode!")

                var gridIcon = document.querySelector("#services-tab svg");
                gridIcon.setAttribute("fill", "#ffffff");
                var listIcon = document.querySelector("#statistics-tab svg");
                listIcon.setAttribute("fill","#ffffff");

                var items = '<?= $demandesGrid->count() ?>';
                for(let i=1;i<=items;i++){
                    var card = document.getElementById("card-grid"+i);
                    var createdAt = document.getElementById("card-createdAt"+i);
                    var ticket  = document.getElementById("card-ticket"+i);
                    var creater = document.getElementById("card-creater"+i);
                    var buttonShow = document.getElementById("card-button-show"+i);

                    card.classList.remove("light:bg-white");
                    createdAt.classList.remove("light:text-white");
                    ticket.classList.remove("light:text-white");
                    creater.classList.remove("light:text-white");
                    buttonShow.classList.remove("light:text-white");

                    card.classList.add("dark:bg-dark");
                    createdAt.classList.add("dark:text-dark");
                    ticket.classList.add("dark:text-dark");
                    creater.classList.add("dark:text-dark");
                    buttonShow.classList.add("dark:text-dark");  
                }


            } else {
                console.log("change to light mode!")

                var gridIcon = document.querySelector("#services-tab svg");
                gridIcon.setAttribute("fill", "#000000");
                var listIcon = document.querySelector("#statistics-tab svg");
                listIcon.setAttribute("fill","#000000");

                var items = '<?= $demandes->count() ?>';
                for(let i=1;i<=items;i++){
                    var card = document.getElementById("card-grid"+i);
                    var createdAt = document.getElementById("card-createdAt"+i);
                    var ticket  = document.getElementById("card-ticket"+i);
                    var creater = document.getElementById("card-creater"+i);
                    var buttonShow = document.getElementById("card-button-show"+i);

                    card.classList.remove("dark:bg-dark");
                    createdAt.classList.remove("dark:text-dark");
                    ticket.classList.remove("dark:text-dark");
                    creater.classList.remove("dark:text-dark");
                    buttonShow.classList.remove("dark:text-dark");

                    card.classList.add("light:bg-white");
                    createdAt.classList.add("light:text-white");
                    ticket.classList.add("light:text-white");
                    creater.classList.add("light:text-white");
                    buttonShow.classList.add("light:text-white");
                }
            }
        })
    </script>
    <script>
        var paginate = '<?= $paginate ?>';
        var view = '<?= $view ?>';

        var buttonList = document.querySelector("#statistics-tab");
        var getButtonList = buttonList.getAttribute("aria-selected");
        var buttonGrid = document.querySelector("#services-tab");
        var getButtonGrid = buttonGrid.getAttribute("aria-selected");
        
        if(paginate == true  ){
            console.log("Paginate true");

            if(view == 'list' ){
                console.log("view list");
                var buttonList = document.querySelector("#statistics-tab");
                buttonList.setAttribute("aria-selected","true");
                var buttonGrid = document.querySelector("#services-tab");
                buttonGrid.setAttribute("aria-selected","false");
            }else{
                console.log("view grid");
                var buttonList = document.querySelector("#statistics-tab");
                buttonList.setAttribute("aria-selected","false");
                var buttonGrid = document.querySelector("#services-tab");
                buttonGrid.setAttribute("aria-selected","true");
            } 
        }
    </script>   
        

           
            
    <x-popupvalidation :message="__('Voulez-vous vraiment valider cette demande?')"/>
    <x-popupAnnulationDemandeManager :message="__('Voulez-vous vraiment annuler cette demande?')"/>


</x-app-layout> 