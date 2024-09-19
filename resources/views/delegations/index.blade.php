
<x-app-layout>
   
       <x-slot name="header">
           <div class="flex justify-between item-center">
               <h2 class="font-semibold text-xl text-white-800 dark:text-gray-200 leading-tight">
                   {{ __('Liste des delegations') }}
           </h2>
           

       <!-- Modal toggle -->
            <div class="flex items-center justify-between my-4">
                <a href="{{ route('delegations.create') }}" data-tooltip-target="tooltip-new" type="button"
                    class="inline-flex items-center justify-center w-14 h-14 font-medium bg-orange-400 rounded-full hover:bg-gray-700 group focus:ring-4 focus:ring-blue-200 focus:outline-none dark:focus:ring-gray-700">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="sr-only">New item</span>
                </a>
            </div>
       
           </div>

           {{--
                    <div class="relative h-[400px] bg-gradient-to-tr from-indigo-600 via-indigo-700 to-violet-800">
                        <div class="flex flex-col gap-4 justify-center items-center w-full h-full px-3 md:px-0">

                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white">
                                {{ __('Liste des delegations') }}
                            </h1>
                            
                            <div class="relative p-3 border border-gray-200 rounded-lg w-full max-w-lg">
                                <input type="text" class="rounded-md w-full p-3 " placeholder="Rechercher une délégation">


                                <button type="submit" class="absolute right-6 top-6">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                        </svg>
                                </button>

                            </div>
                        </div>

                    </div>
           
           --}}
               
           
       
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


    <div class="flex flex-col">
        <div class=" overflow-x-auto pb-4">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden  border rounded-lg border-gray-300">
                    <table id="example" class="table-auto min-w-full rounded-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize">N°</th>
                                <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize">Date de soumission </th>
                                <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize min-w-[150px]"> Remplaçant </th>
                                <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Date de début </th>
                                <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Date de Fin</th>
                                <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Status </th>
                                <th scope="col" class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize"> Actions </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 ">
                            @foreach ($delegations as $i => $item)
                                <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 "> {{$i+1}}</td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{$item->created_at}}</td>
                                    <td class=" px-5 py-3">
                                        <div class="w-48 flex items-center gap-3">
                                            {{-- <img src="https://pagedone.io/asset/uploads/1697536419.png" alt="Floyd image"> --}}
                                            <div class="data">
                                                <p class="font-normal text-sm text-gray-900">{{$item->user->username}}</p>
                                                <p class="font-normal text-xs leading-5 text-gray-400"> {{$item->user->email}} </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{$item->date_debut}}</td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{$item->date_fin}}</td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                        @if ($item->status==1)
                                            <div class="py-1.5 px-2.5 bg-emerald-50 rounded-full flex justify-center w-20 items-center gap-1">
                                                <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="2.5" cy="3" r="2.5" fill="#059669"></circle>
                                                </svg>
                                                <span class="font-medium text-xs text-emerald-600 ">Activé</span>
                                            </div>
                                        @endif
                                        @if ($item->status==0)
                                            <div class="py-1.5 px-2.5 bg-red-50 rounded-full flex w-20 justify-center items-center gap-1">
                                                <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="2.5" cy="3" r="2.5" fill="#DC2626"></circle>
                                                </svg>
                                                <span class="font-medium text-xs text-red-600 ">Désactivé</span>
                                            </div>    
                                        @endif
                                    
                                    </td>
                                    <td class="flex p-5 items-center gap-0.5">    
                                        <button class="p-2 rounded-full bg-white group transition-all duration-500  hover:bg-red-300 hover:text-red-600  flex item-center">
                                            <a onclick="supprimerDelegation(event);" data-modal-target="suppDelegation-modal" data-modal-toggle="suppDelegation-modal" href="{{ route('delegations.destroy', $item->id) }}" class="p-2 rounded-full bg-white group transition-all duration-500 hover:bg-red-300 flex item-center" title="Supprimer cette délégation">                                               
                                                Supprimer
                                            </a>
                                        </button>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="py-1 px-3">
                        {{ $delegations->links() }}
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


        });
    </script>

    <x-deleteDelegation :message="__('Voulez-vous vraiment supprimer cette delegation ?')" />
       
   </x-app-layout> 









   