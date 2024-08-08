
<x-app-layout>
   
    <x-slot name="header">
        <div class="flex justify-between item-center">

                <h2 class="font-semibold text-xl text-white-800 dark:text-gray-200 leading-tight">
                            {{ __('Liste des managers vous ayant délégué') }}
                </h2>
        </div>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-100 dark:text-blue-100 ">
                    <thead class="text-xs text-white uppercase bg-gray-600 dark:text-white">
                            <tr>
                                    <th scope="col" class="px-6 py-3">
                                        N°
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Manager
                                    </th>
                                    
                                    <th scope="col" class="px-6 py-3">
                                        Date Debut
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date Fin
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                
                            </tr>

                    </thead>
                    <tbody>

                            @foreach ($delegations as $i => $item)

                                <tr class="bg-gray-800 border-b border-gray-400">

                                    <td class="px-6 py-4">
                                        {{$i+1}}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{-- {{$i+1}} --}}
                                        {{$item->user->findOrFail($item->manager_id)->username }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->date_debut}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->date_fin}}
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
                                                <div id="dropdownDots{{$i}}"  class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                                            <li>
                                                                <a href="{{route('delegations.show', $item->id)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Voir</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{route('delegations.edit', $item->id)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editer</a>
                                                            </li>
                                                            <li>
                                                                <a onclick="supprimer(event);" data-modal-target="delete-modal"
                                                                data-modal-toggle="delete-modal" href="{{ route('delegations.destroy', $item->id) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Supprimer</a>
                                                            </li>
                                                        

                                                    
                                                    </ul>

                                                </div>
                                        </button>

                                </td>
                                    
                                </tr>
                @endforeach
            </tbody>
        </table>
          {{-- {{$delegations->links()}} --}}
    </div>


    {{--  --}}
    
</x-app-layout> 

