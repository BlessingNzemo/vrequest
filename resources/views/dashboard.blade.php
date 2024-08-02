<x-app-layout>
    
    
        <div
            class="bg-white  border-gray-200 flex flex-wrap items-center justify-between h-28 mt-6 shadow-[0_2px_1px_0_rgba(0,255,0,0.5)]">
            <div class=" mx-10">
                {{-- <h3>Dashboard/<b> Statistiques</b></h3> --}}

                <form class="max-w-md mx-auto">
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search Mockups, Logos..." required />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>

            </div>

            <div>
                <?php
                $dates = date('l jS \of F Y');
                ?>
                <p>{{ $dates }}</p>
            </div>

            <div class="flex items-center justify-between my-4 mx-10">
                <div>
                    <a href="{{ route('demandes.create') }}" data-tooltip-target="tooltip-new" type="button"
                        class="inline-flex items-center justify-center w-8 h-8 font-medium bg-orange-400 rounded-full hover:bg-gray-700 group focus:ring-4 focus:ring-blue-200 focus:outline-none dark:focus:ring-gray-700">
                        <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 1v16M1 9h16" />
                        </svg>
                        <span class="sr-only">New item</span>
                    </a>
                </div>
                <div id="tooltip-new" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-1 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Demander une course
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>



                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Janvier</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fevrier</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mars</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Avril</a>
                        </li>
                    </ul>
                </div>

                {{-- Noctification --}}
                <button type="button"
                    class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 21">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C17 15.4 17 16 16.462 16H3.538C3 16 3 15.4 3 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 10 3.464ZM1.866 8.832a8.458 8.458 0 0 1 2.252-5.714m14.016 5.714a8.458 8.458 0 0 0-2.252-5.714M6.54 16a3.48 3.48 0 0 0 6.92 0H6.54Z" />
                    </svg>
                    <span class="sr-only">Notifications</span>
                    <div
                        class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                        2</div>
                </button>

               
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-white rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="{{ asset('img/profil.jpeg') }}" alt="user photo">

                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{-- {{ Auth::user()->name }} --}}
                                {{ Session::get('authUser')->username }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{-- {{ Auth::user()->email }} --}}
                                {{ Session::get('authUser')->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Profil</a>
                            </li>

                            <li>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                        {{ __('Deconnexion') }}
                                    </x-dropdown-link>
                                </form>


                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    

    <div class="flex flex-row h-36 mt-6">
        {{-- <div class=" bg-white border-gray-200  rounded-lg px-14 py-8 mt-5 shadow-[0_2px_1px_0_rgba(0,255,0,0.5)]">
            Demandes Acceptées
            <svg class="w-6 h-6  text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill=" #4CAF50"
                    d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z" />
                <path fill=" #fff"
                    d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z" />
            </svg>
            <p>10</p>
        </div> --}}
        <div class="bg-white border-gray-200 rounded-lg px-6 py-8 w-4/12 shadow-[0_2px_1px_0_rgba(0,255,0,0.5)]">
            <div class="flex flex-col items-center">
                <span>Demandes Acceptées</span>
                <div class="mt-2 flex items-center">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill="#4CAF50"
                            d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z" />
                        <path fill="#fff"
                            d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z" />
                    </svg>
                    <p class="ml-2">10</p>
                </div>
            </div>
        </div>
        <div
            class="bg-white border-gray-200 rounded-lg mx-6 px-6 py-8 w-4/12 shadow-[0_2px_1px_0_rgba(245,140,39,0.5)]">
            <div class="flex flex-col items-center">
                <span>Demandes En Attente</span>
                <div class="mt-2 flex items-center">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="#f58c27" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1v3m5-3v3m5-3v3M1 7h18M5 11h10M2 3h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" />
                    </svg>
                    <p class="ml-2">12</p>
                </div>
            </div>
        </div>
        <div class="bg-white border-gray-200 rounded-lg px-6 py-8 w-4/12 shadow-[0_2px_1px_0_rgba(255,0,0,0.5)]">
            <div class="flex flex-col items-center">
                <span>Demandes Rejetées</span>
                <div class="mt-2 flex items-center">
                    <svg class="w-6 h-6 bg-red-500 rounded-full text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6.72 5.66l10.59 10.59a.75.75 0 11-1.06 1.06L5.66 6.72a.75.75 0 011.06-1.06z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M5.66 17.34L16.25 6.75a.75.75 0 111.06 1.06L6.72 18.4a.75.75 0 01-1.06-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="ml-2">5</p>
                </div>
            </div>
        </div>
        <div
            class="bg-white border-gray-200 rounded-lg ml-6 px-6 py-8 w-4/12 shadow-[0_2px_1px_0_rgba(23,70,162,0.5)]">
            <div class="flex flex-col items-center">
                <span>Nombre des courses</span>
                <div class="mt-2 flex items-center">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 7h16M4 7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v.5a1.5 1.5 0 0 1-1.5 1.5H4ZM4 7v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7M9 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm10 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"
                            stroke="#1746A2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="ml-2">4</p>
                </div>
            </div>
        </div>
    </div>
    
    


    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-12 ">
        <div class="w-3/4 h-1/4 bg-white border-gray-200 shadow-lg rounded-lg px-10 py-10">
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                class="text-white bg-orange-400 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">Billan 2024 <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <canvas id="myChart"></canvas>

        </div>
        {{-- <div>
            <canvas id="myChart2"></canvas>

        </div> --}}

    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        const ctx1 = document.getElementById('myChart2');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept',
                    'Oct', 'Nov', 'Dec'
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3, 5, 4, 19, 3, 5, 2],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(245, 140, 39, 0.8)',
                        'rgba(167, 172, 116, 0.8)'
                    ]

                }]
            },
            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },
                    scales: {
                        y: {
                            min: 0,
                            max: 100
                        }
                    }
                }
            }
        });
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Accepté', 'En attente', 'Refusé'],
                datasets: [{
                    label: '# of Votes',
                    data: [50, 19, 28],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(245, 140, 39, 0.8)',
                        'rgba(167, 102, 116, 0.8)',
                        'rgba(250, 102, 116, 0.8)'

                    ]

                }]
            },
            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },
                    scales: {
                        y: {
                            min: 0,
                            max: 100
                        }
                    }
                }
            }
        });
    </script>



</x-app-layout>
