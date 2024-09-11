@props(['users'])
<x-app-layout>
   
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Liste des chauffeurs') }}
            </h2>
        </div>
    </x-slot>

  
        @if (session('error'))
    <div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-700" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Alert</span>
        <div class="ms-3 text-sm font-medium">
            {{ session('error') }}
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-red-700 rounded-lg focus:ring-2 focus:ring-red-600 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
        </button>
      </div>
        @endif
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">N°</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                            <th scope="col" class="px-6 py-3">nom</th>
                            <th scope="col" class="px-6 py-3">status</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chauffeurs as $i=>$chauffeur)
                          
                              
                         
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ $i+1}}</td>
                                <td class="px-6 py-4">{{ $chauffeur->created_at->format('d-m-Y') }}</td>

                                <td class="px-6 py-4">{{ $chauffeur->user->username }}</td>
                                <td class="px-6 py-4">
                                    @if ($chauffeur->status==1)
                                         <div class="py-1.5 px-2.5 bg-emerald-50 rounded-full flex justify-center w-20 items-center gap-1">
                                             <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <circle cx="2.5" cy="3" r="2.5" fill="#059669"></circle>
                                             </svg>
                                             <span class="font-medium text-xs text-emerald-600 ">Activé</span>
                                         </div>
                                     @endif
                                     @if ($chauffeur->status==0)
                                         <div class="py-1.5 px-2.5 bg-red-50 rounded-full flex w-20 justify-center items-center gap-1">
                                             <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                             </svg>
                                             <span class="font-medium text-xs text-red-600 ">Désactivé</span>
                                         </div>    
                                     @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($chauffeur->status==1)
                                        
                                   
                                        <a onclick="desactiver(event);" data-modal-target="desactiver"
                                        data-modal-toggle="desactiver" href="{{ route('chauffeurs-status', $chauffeur->id) }}"
                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-xs px-5 py-2.5 text-center me-2 mb-2">Desactiver</a>
                                    @endif
                                    @if ($chauffeur->status==0)
                                        <a onclick="activer(event);" data-modal-target="activer"
                                        data-modal-toggle="activer" href="{{route('chauffeurs-status',$chauffeur->id)}}" class="text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Activer</a>
                                    @endif
                               </td>
                               
                            </tr>
                            
                        @endforeach
                    </tbody>                      
                </table>
                </div>
            
        </div>
    </div>
</div>
<x-savechauffeur :users="$users" :message="__('Voulez-vous enregistrer un chauffeur ?')" />
<x-deleteVehicule :message="__('Voulez-vous vraiment supprimer ce chauffeur ?')" />
<x-desactiverchauffeur :message="__('Voulez-vous vraiment activer ce chauffeur ?')" />
<x-activerChauffeur :message="__('Voulez-vous vraiment desactiver ce chauffeur ?')" />

    <x-slot name="scripts">      
    </x-slot>
</x-app-layout>
