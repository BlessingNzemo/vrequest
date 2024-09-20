@props(['vehicule', 'chauffeurs', 'demandes'])
<x-app-layout>

    {{-- <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('details de la Demande') }}
            </h2>
        </div>
    </x-slot> --}}
    @if (session('success'))
    <div class="flex p-4 mb-4 text-sm rounded-lg bg-green-300" id="success-message">
        {{ session('success') }}
    </div>

    <script>
        // Faire disparaître le message de succès après 5 secondes
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>
@endif
    <section class="bg-gray-100">
        <div class="max-w-full mx-auto py-16 px-2 sm:px-6 lg:py-20 lg:px-8">
            <nav class="border-b py-2.5 dark:bg-gray-900">
                <div class="flex flex-wrap items-center justify-between max-w-full px-4 mx-auto">
                    <div class=" flex items-center">
                        <a href="{{ route('demandes.index') }}" class="border p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="#6b7280" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>

                        </a>

                        <div class="ml-5">
                            <span class="block text-sm text-gray-500">Retour à la liste des demandes</span>
                            <span class="text-xl font-semibold whitespace-nowrap dark:text-white">Detail de la
                                Demande</span>

                        </div>
                    </div>

                    {{-- <div class="flex items-center lg:order-2">
                        <div class="hidden mt-2 mr-4 sm:inline-block">
                            <span></span>
                        </div>

                        <a href="#"
                            class="text-white bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-orange-600 dark:hover:bg-orange-700 focus:outline-none dark:focus:ring-orange-800"><?php
                            $dates = date('l jS \of F Y');
                            ?>
                            <p>{{ $dates }}</p>
                        </a>
                    </div> --}}
                </div>
            </nav>
            <section class="text-gray-700 body-font">
                <div class="container px-2 py-16 mx-auto">

                    <div class="flex flex-wrap -m-4 text-center">
                        <div class="p-2 md:w-1/3 sm:w-1/2 w-full">
                            <div
                                class="border-2 border-gray-600  py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="text-blue-500 w-12 h-12 mb-3 inline-block"
                                    viewBox="0 0 24 24">
                                    <path d="M8 17l4 4 4-4m-4-5v9"></path>
                                    <path d="M20.88 18.09A5 5 0 0018 9h-1.26A8 8 0 103 16.29"></path>
                                </svg>
                                <p class="leading-relaxed">Validation du Manager</p>
                                @if ($demandes->is_validated == 1)
                                    <input type="checkbox" @checked(true) name="" id=""
                                        disabled>
                                @else
                                    <input type="checkbox" name="" id="" disabled>
                                @endif

                            </div>
                        </div>
                        <div class="p-2 md:w-1/3 sm:w-1/2 w-full">
                            <div
                                class="border-2 border-gray-600  py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="text-blue-500 w-12 h-12 mb-3 inline-block"
                                    viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"></path>
                                </svg>
                                <p class="leading-relaxed">Validation Chef Charroi</p>
                                @if ($demandes->status == 1)
                                    <input type="checkbox" @checked(true) name="" id=""
                                        disabled>
                                @else
                                    <input type="checkbox" name="" id="" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="p-2 md:w-1/3 sm:w-1/2 w-full">
                            <div
                                class="border-2 border-gray-600  py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="text-blue-500 w-12 h-12 mb-3 inline-block"
                                    viewBox="0 0 24 24">
                                    <path d="M3 18v-6a9 9 0 0118 0v6"></path>
                                    <path
                                        d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z">
                                    </path>
                                </svg>
                                <p class="leading-relaxed">Statut de la Course</p>
                                @if ($courses)
                                    <p style="color:rgba(59, 130, 246, 1)"><b>{{ $courses->status }}</b></p>
                                @else
                                    <p><b>en attente de validation</b></p>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="mt-2 lg:mt-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if (isset($error))
                        <p>{{ $error }}</p>
                    @else
                        <div>
                            <input type="hidden" id="latitude_depart_{{ $demandes->id }}"
                                value="{{ $demandes->latitude_depart }}">
                            <input type="hidden" id="longitude_depart_{{ $demandes->id }}"
                                value="{{ $demandes->longitude_depart }}">
                            <input type="hidden" id="latitude_destination_{{ $demandes->id }}"
                                value="{{ $demandes->latitude_destination }}">
                            <input type="hidden" id="longitude_destination_{{ $demandes->id }}"
                                value="{{ $demandes->longitude_destination }}">

                            <div id="map_{{ $demandes->id }}" class="map"
                                style=" height: 480px; width:100%; border:1px;"></div>
                        </div>
                    @endif
                    <div>
                        <div class="flex flex-wrap">
                            <div
                                class="mb-12 w-full shrink-0 grow-0 border-b-2 basis-auto md:w-6/12 md:px-3 lg:w-full lg:px-6 xl:w-6/12">
                                <div class="flex items-start">
                                    <div class="shrink-0">
                                        <div class="inline-block rounded-md bg-orange-200 p-4 text-primary">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path fill="currentColor"
                                                    d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z" />
                                            </svg>

                                        </div>
                                    </div>
                                    <div class="ml-6 grow">
                                        <p class="mb-2 font-bold ">
                                            Date de soumission de la demande
                                        </p>
                                        <p class="text-sm text-neutral-500">
                                            {{ $demandes->date }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div
                                class="mb-12 w-full shrink-0 grow-0 border-b-2 basis-auto md:w-6/12 md:px-3 lg:w-full lg:px-6 xl:w-6/12">
                                <div class="flex items-start">
                                    <div class="shrink-0">
                                        <div class="inline-block rounded-md bg-blue-200 p-4 text-primary">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 1v3m5-3v3m5-3v3M1 7h7m1.506 3.429 2.065 2.065M19 7h-2M2 3h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm6 13H6v-2l5.227-5.292a1.46 1.46 0 0 1 2.065 2.065L8 16Z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-6 grow">
                                        <p class="mb-2 font-bold ">
                                            Date Deplacement
                                        </p>

                                        <p class="text-sm text-neutral-500">
                                            {{ $demandes->date_deplacement }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mb-12 w-full shrink-0 grow-0 border-b-2 basis-auto md:w-6/12 md:px-3 lg:w-full lg:px-6 xl:w-6/12">
                                <div class="flex items-start">
                                    <div class="srink-0">
                                        <div class="inline-block rounded-md bg-green-200 p-4 text-primary">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 22 21">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                    d="M7.24 7.194a24.16 24.16 0 0 1 3.72-3.062m0 0c3.443-2.277 6.732-2.969 8.24-1.46 2.054 2.053.03 7.407-4.522 11.959-4.552 4.551-9.906 6.576-11.96 4.522C1.223 17.658 1.89 14.412 4.121 11m6.838-6.868c-3.443-2.277-6.732-2.969-8.24-1.46-2.054 2.053-.03 7.407 4.522 11.959m3.718-10.499a24.16 24.16 0 0 1 3.719 3.062M17.798 11c2.23 3.412 2.898 6.658 1.402 8.153-1.502 1.503-4.771.822-8.2-1.433m1-6.808a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" />
                                            </svg>

                                        </div>

                                    </div>
                                    <div class="ml-6 grow">
                                        <p class="mb-2 font-bold ">
                                            Motif
                                        </p>
                                        <p class="text-sm text-neutral-500">
                                            {{ $demandes->motif }}

                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div
                                class="mb-12 w-full shrink-0 grow-0 border-b-2 basis-auto md:mb-0 md:w-6/12 md:px-3 lg:mb-12 lg:w-full lg:px-6 xl:w-6/12">
                                <div class="align-start flex">
                                    <div class="shrink-0">
                                        <div class="inline-block rounded-md bg-orange-200 p-4 text-primary">
                                            {{-- <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                class="w-7 h-7" viewBox="0 0 111.756 122.879"
                                                enable-background="new 0 0 111.756 122.879" xml:space="preserve">
                                                <g>
                                                    <path
                                                        d="M27.953,5.569v96.769h19.792V5.569H37.456H27.953L27.953,5.569z M21.898,105.123V2.785C21.898,1.247,23.254,0,24.926,0 h12.53h13.316C52.443,0,53.8,1.247,53.8,2.785v102.338c0,1.537-1.356,2.783-3.028,2.783H24.926 C23.254,107.906,21.898,106.66,21.898,105.123L21.898,105.123z M13.32,17.704c1.671,0,3.027,1.247,3.027,2.785 s-1.355,2.784-3.027,2.784H7.352c-0.161,0-0.292,0.022-0.39,0.064c-0.129,0.056-0.276,0.166-0.429,0.325 c-0.161,0.167-0.281,0.346-0.353,0.528c-0.083,0.208-0.125,0.465-0.125,0.759v90.803c0,0.287,0.043,0.537,0.125,0.74l0.034,0.092 c0.068,0.135,0.165,0.264,0.284,0.383c0.126,0.125,0.258,0.217,0.39,0.27c0.123,0.051,0.279,0.074,0.466,0.074h97.052 c0.188,0,0.346-0.025,0.467-0.074c0.133-0.053,0.264-0.145,0.389-0.27c3.035-3.035,0.441,1.799,0.441-1.215V24.949 c0-3.667,3.039,2.357-0.477-1.288c-0.143-0.146-0.287-0.254-0.43-0.314c-0.113-0.048-0.246-0.075-0.391-0.075H62.563 c-1.672,0-3.027-1.247-3.027-2.784s1.355-2.785,3.027-2.785h41.842c1.041,0,2.029,0.204,2.943,0.597 c0.895,0.385,1.699,0.945,2.393,1.663c0.664,0.686,1.17,1.468,1.514,2.334c0.332,0.839,0.502,1.726,0.502,2.652v90.803 c0,0.938-0.168,1.826-0.502,2.654c-0.344,0.859-0.865,1.639-1.549,2.324c-0.701,0.703-1.506,1.234-2.398,1.598 c-0.906,0.367-1.879,0.551-2.902,0.551H7.352c-1.022,0-1.995-0.184-2.901-0.551c-0.894-0.363-1.698-0.896-2.399-1.598 c-0.621-0.623-1.107-1.33-1.45-2.107c-0.036-0.07-0.069-0.143-0.099-0.217C0.168,117.574,0,116.684,0,115.752V24.949 c0-0.921,0.17-1.811,0.504-2.652c0.342-0.863,0.849-1.648,1.512-2.334c0.683-0.707,1.488-1.263,2.393-1.652 c0.929-0.401,1.917-0.607,2.943-0.607H13.32L13.32,17.704z M65.902,29.03h27.049c0.803,0,1.566,0.145,2.291,0.431 c0.076,0.03,0.15,0.063,0.223,0.099c0.607,0.269,1.166,0.635,1.666,1.096c0.584,0.533,1.027,1.128,1.326,1.782 c0.047,0.104,0.088,0.21,0.119,0.317c0.225,0.584,0.34,1.189,0.34,1.812v12.611c0,0.744-0.156,1.45-0.459,2.118l-0.004,0.009 l0.004,0.002c-0.291,0.64-0.725,1.224-1.291,1.75c-0.58,0.546-1.227,0.956-1.932,1.231c-0.736,0.287-1.5,0.426-2.283,0.426H65.902 c-0.777,0-1.535-0.14-2.27-0.426c-0.693-0.269-1.33-0.668-1.912-1.198c-0.588-0.539-1.031-1.144-1.326-1.81 c-0.033-0.078-0.063-0.157-0.09-0.235c-0.234-0.605-0.35-1.228-0.35-1.867V34.567c0-0.723,0.146-1.424,0.445-2.099l-0.006-0.002 c0.295-0.666,0.738-1.271,1.326-1.81l0.037-0.032l-0.002-0.001c0.877-0.78,2.039-1.219,2.119-1.244 C64.537,29.147,65.215,29.03,65.902,29.03L65.902,29.03z M93.475,34.599h-28.08v12.547h28.08V34.599L93.475,34.599z M78.877,63.42 c1.072,0,2.01,0.41,2.807,1.207s1.188,1.734,1.188,2.785c0,1.148-0.389,2.104-1.188,2.865c-0.799,0.758-1.734,1.129-2.807,1.129 c-1.129,0-2.084-0.371-2.844-1.129c-0.76-0.762-1.148-1.717-1.148-2.865c0-1.051,0.391-1.988,1.148-2.785 S77.748,63.42,78.877,63.42L78.877,63.42z M90.977,63.42c1.072,0,2.008,0.41,2.805,1.207s1.189,1.734,1.189,2.785 c0,1.148-0.391,2.104-1.189,2.865c-0.799,0.758-1.732,1.129-2.805,1.129c-1.131,0-2.086-0.371-2.846-1.129 c-0.76-0.762-1.148-1.717-1.148-2.865c0-1.051,0.391-1.988,1.148-2.785S89.846,63.42,90.977,63.42L90.977,63.42z M66.662,75.518 c1.15,0,2.105,0.389,2.865,1.148s1.129,1.715,1.129,2.865c0,1.051-0.371,1.988-1.129,2.785s-1.715,1.209-2.865,1.209 c-1.053,0-1.988-0.412-2.785-1.209s-1.209-1.734-1.209-2.785c0-1.15,0.41-2.105,1.209-2.865S65.609,75.518,66.662,75.518 L66.662,75.518z M78.877,75.518c1.072,0,2.008,0.389,2.807,1.148s1.188,1.715,1.188,2.865c0,1.051-0.391,1.988-1.188,2.785 s-1.734,1.209-2.807,1.209c-1.129,0-2.086-0.412-2.844-1.209s-1.148-1.734-1.148-2.785c0-1.15,0.389-2.105,1.148-2.865 S77.748,75.518,78.877,75.518L78.877,75.518z M90.977,75.518c1.072,0,2.006,0.389,2.805,1.148s1.189,1.715,1.189,2.865 c0,1.051-0.393,1.988-1.189,2.785s-1.732,1.209-2.805,1.209c-1.131,0-2.088-0.412-2.846-1.209s-1.148-1.734-1.148-2.785 c0-1.15,0.389-2.105,1.148-2.865S89.846,75.518,90.977,75.518L90.977,75.518z M66.662,87.518c1.15,0,2.107,0.393,2.865,1.189 s1.129,1.773,1.129,2.922c0,1.053-0.369,1.988-1.129,2.787s-1.715,1.207-2.865,1.207c-1.053,0-1.986-0.408-2.785-1.207 s-1.209-1.734-1.209-2.787c0-1.148,0.412-2.125,1.209-2.922S65.609,87.518,66.662,87.518L66.662,87.518z M78.877,87.518 c1.072,0,2.01,0.393,2.807,1.189s1.188,1.773,1.188,2.922c0,1.053-0.389,1.988-1.188,2.787s-1.734,1.207-2.807,1.207 c-1.129,0-2.084-0.408-2.844-1.207s-1.148-1.734-1.148-2.787c0-1.148,0.391-2.125,1.148-2.922S77.748,87.518,78.877,87.518 L78.877,87.518z M90.977,87.518c1.072,0,2.008,0.393,2.805,1.189s1.189,1.773,1.189,2.922c0,1.053-0.391,1.988-1.189,2.787 s-1.732,1.207-2.805,1.207c-1.131,0-2.086-0.408-2.846-1.207s-1.148-1.734-1.148-2.787c0-1.148,0.391-2.125,1.148-2.922 S89.846,87.518,90.977,87.518L90.977,87.518z M78.877,99.617c1.072,0,2.008,0.389,2.807,1.188s1.188,1.734,1.188,2.807 c0,1.129-0.389,2.084-1.188,2.844s-1.734,1.148-2.807,1.148c-1.129,0-2.084-0.389-2.844-1.148s-1.148-1.715-1.148-2.844 c0-1.072,0.389-2.008,1.148-2.807S77.748,99.617,78.877,99.617L78.877,99.617z M66.662,63.42c1.15,0,2.107,0.41,2.865,1.207 s1.129,1.734,1.129,2.785c0,1.148-0.369,2.104-1.129,2.865c-0.76,0.758-1.715,1.129-2.865,1.129c-1.053,0-1.986-0.371-2.785-1.129 c-0.799-0.762-1.209-1.717-1.209-2.865c0-1.051,0.412-1.988,1.209-2.785S65.609,63.42,66.662,63.42L66.662,63.42z" />
                                                </g>
                                            </svg> --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 11.25V7.5A2.25 2.25 0 015.25 5.25h13.5A2.25 2.25 0 0121 7.5v3.75m-1.5 0h-15M5.25 17.25a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm14.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                            </svg>

                                        </div>
                                    </div>
                                    <div class="ml-6 grow">
                                        <p class="mb-2 font-bold ">Lieu de depart</p>
                                        <p class="text-neutral-500">{{ $demandes->lieu_depart }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full shrink-0 grow-0 border-b-2 basis-auto md:w-6/12 md:px-3 lg:w-full lg:px-6 xl:mb-12 xl:w-6/12">
                                <div class="align-start flex">
                                    <div class="shrink-0">
                                        <div class="inline-block rounded-md bg-blue-200 p-4 text-primary">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 18 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                                            </svg>

                                        </div>
                                    </div>
                                    <div class="ml-6 grow">
                                        <p class="mb-2 font-bold ">Destination</p>
                                        <p class="text-neutral-500"> {{ $demandes->destination }}
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>
                            <div
                            class="mb-12 w-full shrink-0 grow-0 border-b-2 basis-auto md:w-6/12 md:px-3 lg:w-full lg:px-6 xl:w-6/12">
                            <div class="flex items-start">
                                <div class="shrink-0">
                                    <div class="inline-block rounded-md bg-red-200 p-4 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-6 grow">
                                    <p class="mb-2 font-bold ">
                                        Nombre de Passagers : {{ $demandes->nbre_passagers }}
                                    </p>
                                    
                                       @foreach ($passager_name as $passager)
                                       <p class="text-sm text-neutral-500">
                                           {{$passager}}
                                        </p>
                                       @endforeach
                                    
                                </div>
                            </div>
                        </div>
                            
                            @if ($demandes->status == '1')
                                
                            
                            <div
                                class="mb-12 w-full shrink-0 grow-0 border-b-2 basis-auto md:w-6/12 md:px-3 lg:w-full lg:px-6 xl:w-6/12">
                                <div class="flex items-start">
                                    <div class="shrink-0">
                                        <div class="inline-block rounded-md bg-green-200 p-4 text-primary">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="h-6 w-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0l6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 014.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 00-.38 1.21 12.035 12.035 0 007.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 011.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 01-2.25 2.25h-2.25z" />
                                            </svg> --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 11.25V7.5A2.25 2.25 0 015.25 5.25h13.5A2.25 2.25 0 0121 7.5v3.75m-1.5 0h-15M5.25 17.25a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm14.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                            </svg>

                                        </div>
                                    </div>
                                    <div class="ml-6 grow">
                                        <p class="mb-2 font-bold ">
                                            Vehicule
                                        </p>
                                        <p class="text-sm text-neutral-500">
                                            @if ($vehicule)
                                                {{ $vehicule->plaque}} = {{ $vehicule->capacite }}
                                            @else
                                            @endif
                                            @if (Session::get('authUser')->hasRole('charroi') && $demandes->status=='1')
                                                <button
                                                    class="text-green-700 bg-green border px-2 py-1 border-green-200 focus:outline-none hover:bg-green-400 focus:ring-4 focus:ring-green-100 font-medium rounded-full text-sm px-0.3 py-0.3 me-0 mb-1 dark:bg-green-200 bg-green-200 dark:text-green-700 dark:border-green-200 dark:hover:bg-green-400 dark:hover:border-green-400 dark:focus:ring-green-400 ml-8"
                                                    data-modal-target="crud-modal3" data-modal-toggle="crud-modal3">
                                                        modifier
                                                </button>   
                                            @endif


                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div
                                class="mb-12 w-full shrink-0 grow-0 border-b-2 basis-auto md:w-6/12 md:px-3 lg:w-full lg:px-6 xl:w-6/12">
                                <div class="flex items-start">
                                    <div class="shrink-0">
                                        <div class="inline-block rounded-md bg-red-200 p-4 text-primary">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4H1m3 4H1m3 4H1m3 4H1m6.071.286a3.429 3.429 0 1 1 6.858 0M4 1h12a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Zm9 6.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-6 grow">
                                        <p class="mb-2 font-bold ">
                                            chauffeur
                                        </p>
                                        <p class="text-sm text-neutral-500">
                                            @if ($chauffeur_name)
                                                {{ $chauffeur_name->username }}
                                            @else
                                            @endif
                                            @if (Session::get('authUser')->hasRole('charroi') && $demandes->status=='1')

                                                <button
                                                    class="text-pink-700 bg-pink border px-2 py-1 border-pink-100 focus:outline-none hover:bg-pink-300 focus:ring-4 focus:ring-pink-100 font-medium rounded-full text-sm px-0.3 py-0.3 me-0 mb-1 bg-pink-100 dark:bg-pink-100 dark:text-pink-700 dark:border-pink-100 dark:hover:bg-pink-300 dark:hover:border-pink-300 dark:focus:ring-pink-400 ml-8"
                                                    data-modal-target="crud-modal2" data-modal-toggle="crud-modal2">
                                                        modifier    
                                                </button>
                                            @endif



                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modifChauffeur :demandes="$demandes" :chauffeurs="$chauffeurs" :message="__('Voulez-vous modifier ce chauffeur?')" />
    <x-modifShowVehicule :demandes="$demandes" :vehicules="$vehicules" :message="__('Voulez-vous modifier ce vehicule?')" />

    <script>
        var greenIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Parcourir chaque demande pour créer une carte
            @foreach ($demandes as $demande)
                // Récupérer les coordonnées depuis les champs cachés
                var latitude_depart = document.getElementById('latitude_depart_{{ $demandes->id }}').value;
                var longitude_depart = document.getElementById('longitude_depart_{{ $demandes->id }}').value;
                var latitude_destination = document.getElementById('latitude_destination_{{ $demandes->id }}')
                    .value;
                var longitude_destination = document.getElementById('longitude_destination_{{ $demandes->id }}')
                    .value;

                // Initialiser la carte pour chaque demande
                var map = L.map('map_{{ $demandes->id }}').setView([latitude_depart, longitude_depart], 13);

                // Ajouter les tuiles OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                var marker = L.marker([latitude_depart, longitude_depart], {
                    icon: greenIcon
                }).addTo(map);

                // Ajouter les marqueurs
                L.marker([latitude_depart, longitude_depart], {
                        icon: greenIcon
                    }).addTo(map)
                    .bindPopup('<b>Lieu de départ</b> : {{ $demandes->lieu_depart }}');
                L.marker([latitude_destination, longitude_destination]).addTo(map)
                    .bindPopup('<b>Destination</b> : {{ $demandes->destination }}');
            @endforeach
        });
    </script>


</x-app-layout>
