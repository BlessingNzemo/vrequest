<x-app-layout>
  
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Liste des vehicules') }}
            </h2>
            <form class="flex items-center max-w-sm  mr-4 my-4 " method="GET" action="{{route('vehicules.search')}}">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 "
                        placeholder="Ecris la capacité..." name="search" required />
                </div>
                <button type="submit"
                    class="p-2.5 ms-2 text-sm font-medium text-white bg-orange-400 rounded-lg border  hover:bg-orange-400 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-450 dark:hover:bg-orange-700 dark:focus:ring-orange-400">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                   
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>
    </x-slot>
    <div class="flex items-center justify-end my-4">
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"  data-tooltip-target="tooltip-new" type="button" class="inline-flex items-center justify-center w-14 h-14 font-medium bg-orange-400 rounded-full hover:bg-gray-700 group focus:ring-4 focus:ring-blue-200 focus:outline-none dark:focus:ring-gray-700">
            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            <span class="sr-only">New item</span>
        </button>
    </div>
    <div id="tooltip-new" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Ajouter un vehicule
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>  
    @if (session('success'))
    <div class="flex p-4 mb-4 text-sm rounded-lg bg-orange-200" id="success-message">
        {{ session('success') }}
    </div>

    <script>
        // Faire disparaître le message de succès après 5 secondes
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>
@endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            @endforeach
        @endif
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">N°</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">plaque</th>
                    <th scope="col" class="px-6 py-3">Marque</th>
                    <th scope="col" class="px-6 py-3">capacité</th>
                    <th scope="col" class="px-6 py-3">disponibilité</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicules as $i => $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $i + 1 }}</td>
                        <td class="px-6 py-4">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td class="px-6 py-4">{{ $item->plaque }}</td>
                        <td class="px-6 py-4">{{ $item->marque }}</td>
                        <td class="px-6 py-4">{{ $item->capacite }}</td>
                        <td class="px-6 py-4">
                            
                            @if ($item->disponibilite==1)
                                
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">occupé</span>
                            
                           @else
                           <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">disponible</span>
                           
                           @endif
                       </td>
                        <td class="px-6 py-4">

                                                        
                            <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots{{ $i + 1 }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                </svg>
                                </button>
                                
                                <!-- Dropdown menu -->
                                <div id="dropdownDots{{ $i + 1 }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                        @if ($item->disponibilite==1)
                                    <li>
                                        <a onclick="changerDisponibilite(event);" data-modal-target="disponibilite"
                                        data-modal-toggle="disponibilite" href="{{ route('vehicules-disponibilite', $item->id) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">disponibilité</a>
                                    </li>
                                    @else

                                    <li>
                                        <a onclick="changerIndisponibilite(event);" data-modal-target="indisponibilite"
                                        data-modal-toggle="indisponibilite" href="{{route('vehicules-disponibilite',$item->id)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">disponibilité</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a onclick="edit(event)" href="{{ route('vehicules.update',$item->id) }}" data-modal-target="crud-modal1" data-modal-toggle="crud-modal1" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editer</a>
                                    </li>
                                    </ul>
                                    <div class="py-2">
                                    <a onclick="supprimer(event);" data-modal-target="delete-modal"
                                    data-modal-toggle="delete-modal" href="{{ route('vehicules.destroy', $item->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Supprimer</a>
                                    </div>
                                </div>
    

    
                        </td>
                    </tr>
                @endforeach
            </tbody>  
        </table>
    </div>
    <x-deleteVehicule :message="__('Voulez-vous vraiment supprimer ce vehicule ?')" />
    <x-enregistrer :marques="$marques" :message="__('Voulez-vous enregistrer un vehicule ?')" />
    <x-editVehicule :message="__('Voulez-vous modifier un vehicule ?')" />
    <x-modifDisponibilite :message="__('Ce vehicule est-il maintenant disponible ?')" />
    <x-modifIndisponibilite :message="__('Ce vehicule est-il occupé ?')" />


    <x-slot name="scripts">      
    </x-slot>   
</x-app-layout>

