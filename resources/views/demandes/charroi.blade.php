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
            <div class="overflow-hidden rounded-lg border-gray-300">
                <div class="w-full bg-white border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                        <li class="me-2">
                            <button id="services-tab" data-tabs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                <svg fill="#ffffff" width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier"> 
                                    <path d="M30 32h-10c-1.105 0-2-0.895-2-2v-10c0-1.105 0.895-2 2-2h10c1.105 0 2 0.895 2 2v10c0 1.105-0.895 2-2 2zM30 20h-10v10h10v-10zM30 14h-10c-1.105 0-2-0.896-2-2v-10c0-1.105 0.895-2 2-2h10c1.105 0 2 0.895 2 2v10c0 1.104-0.895 2-2 2zM30 2h-10v10h10v-10zM12 32h-10c-1.105 0-2-0.895-2-2v-10c0-1.105 0.895-2 2-2h10c1.104 0 2 0.895 2 2v10c0 1.105-0.896 2-2 2zM12 20h-10v10h10v-10zM12 14h-10c-1.105 0-2-0.896-2-2v-10c0-1.105 0.895-2 2-2h10c1.104 0 2 0.895 2 2v10c0 1.104-0.896 2-2 2zM12 2h-10v10h10v-10z"></path> 
                                    </g>
                                </svg>  
                            </button>
                        </li>
                        <li class="me-2">
                            <button id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab" aria-controls="statistics" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                <svg fill="#ffffff" width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 14h-2c-0.552 0-1 0.448-1 1v2c0 0.552 0.448 1 1 1h2c0.552 0 1-0.448 1-1v-2c0-0.552-0.448-1-1-1zM31 15h-21c-0.552 0-1 0.448-1 1s0.448 1 1 1h21c0.552 0 1-0.448 1-1s-0.448-1-1-1zM3 22h-2c-0.552 0-1 0.448-1 1v2c0 0.552 0.448 1 1 1h2c0.552 0 1-0.448 1-1v-2c0-0.552-0.448-1-1-1zM31 23h-21c-0.552 0-1 0.448-1 1s0.448 1 1 1h21c0.552 0 1-0.448 1-1s-0.448-1-1-1zM3 6h-2c-0.552 0-1 0.448-1 1v2c0 0.552 0.448 1 1 1h2c0.552 0 1-0.448 1-1v-2c0-0.552-0.448-1-1-1zM10 9h21c0.552 0 1-0.448 1-1s-0.448-1-1-1h-21c-0.552 0-1 0.448-1 1s0.448 1 1 1z"></path> </g></svg>
                            </button>
                        </li>
                    </ul>
                    <div id="defaultTabContent">
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                            <table id="example" class="table-auto min-w-full rounded-xl">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-200">
                                        <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize min-w-[150px]"> Motif</th>
                                        <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Destination </th>
                                        <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Date et Heure de deplacement</th>
                                        <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Nombre de passagers </th>
                                        <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Status du traitement </th>
                                        <th scope="col" class="p-5 text-center whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Actions </th>
                                    </tr>
                                <thead>
                                <tbody class="divide-y divide-gray-300 ">
                                    @foreach ($demandes->sortBy('status') as $i => $item)
                                        <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{$item->motif}}</td>
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ substr($item->destination, 0, 50) }}</td>
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ $item->date_deplacement}}</td>
                                            <td class="p-5 text-center whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ $item->nbre_passagers  }}</td>
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                @if (($item->status=='2')||($item->is_validated=='2')) 
                                                        <div class="py-1.5 px-2.5 bg-red-50 rounded-full flex w-20 justify-center items-center gap-1">
                                                            <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                            </svg>
                                                            <span class="font-medium text-xs text-red-600 ">Rejetée</span>
                                                        </div>
                                                @else  
                                                    @if($item->status=='1')
                                                        <div class="py-1.5 px-2.5 bg-emerald-50 rounded-full flex justify-center w-20 items-center gap-1">
                                                            <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="2.5" cy="3" r="2.5" fill="#059669"></circle>
                                                            </svg>
                                                            <span class="font-medium text-xs text-emerald-600 ">Traitée</span>
                                                        </div>
                                                    @elseif($item->status=='0')
                                                        <div class="py-1.5 px-2.5 bg-orange-50 rounded-full flex w-20 justify-center items-center gap-1">
                                                            <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                            </svg>
                                                            <span class="font-medium text-xs text-orange-500 ">En attente</span>
                                                        </div> 
                                                    @endif    
                                                @endif

                                            </td>

                                            <td class="flex justify-center items-center">                                        
                                                <a href="{{ route('demandes.show', $item->Url) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white justify-center items-center"  title="Voir cette demande">                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="w-6 h-6 margin-left: 5px margin-right: 5px">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>                                      
                                                </a>    
                                                @if (Session::get('authUser')->hasRole('charroi'))
                                                    @if (($item->is_validated == 1)  && ($item->status == '0'))
                                                        <a onclick="editdemande(event, {{ $item->id }}, {{$item->nbre_passagers}});"
                                                            data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white justify-center items-center" title="Traiter cette demande">
                                                            
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-6 h-6 margin-left: 5px margin-right: 5px">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            </svg>
                                                        </a>                                                
                                                        <a onclick="rejeter(event);" data-modal-target="rejet-modal"
                                                            data-modal-toggle="rejet-modal"
                                                            href="{{route('rejetDemandeParCharroi',$item->id)}}"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white justify-center items-center" title="Rejeter cette demande">                                                        
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6 margin-left: 5px margin-right: 5px">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>     
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="py-1 px-3" >
                                {{ $demandes->links() }}
                            </div>
                            </div>
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services" role="tabpanel" aria-labelledby="services-tab">
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
                                                                    @if (Session::get('authUser')->hasRole('charroi'))
                                                                        @if (($item->is_validated == 1)  && ($item->status == '0'))
                                                                            <a id="action-traiter" onclick="editdemande(event, {{ $item->id }}, {{$item->nbre_passagers}});"
                                                                                data-modal-target="crud-modal" data-modal-toggle="crud-modal"style="padding-right: 0.7rem"
                                                                                class="block hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white justify-center items-center" title="Traiter cette demande">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                                </svg>
                                                                            </a>
                                                                            <a id="action-rejeter" onclick="rejeter(event);" data-modal-target="rejet-modal"
                                                                                data-modal-toggle="rejet-modal"
                                                                                href="{{route('rejetDemandeParCharroi',$item->id)}}" style="padding-right: 0.7rem"
                                                                                class="block hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white justify-center items-center" title="Rejeter cette demande">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" >
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
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
                                                                            <svg width="5" height="6" viewBox="0 0 5 6" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
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

                </div>
            </div>
        </div>
    </div>
</div>







    <script>
        new DataTable('#example', {
            info: false,
            ordering: false,
            paging: false

            language: {
                paginate: {
                    next: '<span class="next-page">Suivant</span>',
                    previous: '<span class="prev-page">Précédent</span>'
                }
            },
            initComplete: function() {
                // Modifier la couleur de la pagination
                $('.dataTables_paginate .pagination .page-item.active .page-link').css('background-color',
                    '#ff0000');
                $('.dataTables_paginate .pagination .page-item .page-link').css('color', '#ff0000');
            }
        });
    </script>

    <input type="hidden" id="cars" value="{{$vehicules}}">
    <x-deleteDemande :message="__('Voulez-vous vraiment supprimer cette demande ?')" />

    <x-showDemande :message="__('Voulez-vous vraiment voir cette demande?')" />
    <x-deleteDemande :message="__('Voulez-vous vraiment supprimer cette demande ?')" />
    <x-savecourse :demandes="$demandes" :vehicules="$vehicules" :chauffeurs="$chauffeurs" :message="__('Voulez-vous enregistrer une course ?')" />
    <x-rejetDemandeParCharroi :message="__('Voulez-vous vraiment rejeter cette demande?')" />
    <script>
        
        function editdemande(event, demandeId, nombre) {
            event.preventDefault();
           
            form = document.querySelector('#crud-modal div div form div div #demande_id');
            var vehiculeSelect = document.querySelector("#crud-modal div div form div div #vehicule_id")
            value = form.getAttribute('value');
            form.setAttribute('value', demandeId);
            console.log(value);
            const vehicules = JSON.parse(document.querySelector("#cars").value) ;
            console.log(vehicules);
            
            vehiculeSelect.innerHTML = '';
            var opt1 = document.createElement('option');
            opt1.value = 'vehicule';
            opt1.text = 'Sélectionnez un véhicule';
            vehiculeSelect.add(opt1);
            vehicules.map((option)=> {
                if (option.capacite >= nombre) {
                    var opt = document.createElement("option");
                    opt.value = option.id;
                    opt.text = option.plaque + "=" + option.capacite;
                    vehiculeSelect.add(opt);
                }
            });

            
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




</x-app-layout>
