<x-app-layout>

    {{-- <x-slot name="header">
        <div class="flex items-center justify-between py-5">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Detail Permissions') }}
            </h2>
        </div>
    </x-slot> --}}
    <div class=" flex items-center border p-4 mb-10">
        <a href="{{ route('roles.index') }}" class="border p-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="#6b7280" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>

        </a>

        <div class="ml-5">
            <span class="block text-sm text-gray-500">Retour à la liste des roles</span>
            <span class="text-xl font-semibold whitespace-nowrap dark:text-white">Detail des Permissions {{$role->name}}
               </span>

        </div>
    </div>

    <div class="relative overflow-x-auto">
        @if (session('status'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-orange-800 rounded-lg bg-orange-50 dark:bg-gray-800 dark:text-orange-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('status') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-orange-50 text-orange-500 rounded-lg focus:ring-2 focus:ring-orange-400 p-1.5 hover:bg-orange-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-orange-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Models
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lire
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Enregistrer
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modifier
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Supprimer
                    </th>
                </tr>
            </thead>
            <tbody>

                @for ($j = 0; $j < count($modelname); $j++)

                    @if ($modelname[$j] === 'UserInfo')
                        @continue
                    @endif
                    @if ($modelname[$j] === 'Message')
                        @continue
                    @endif
                    @if ($modelname[$j] === 'MessageGroupe')
                        @continue
                    @endif
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                            {{ $modelname[$j] }}
                        </th>
                        {{-- les permissions de l'utilisateur --}}
                        @foreach ($permissions as $permission)
                            <input type="hidden" name="" {{ $tab[] = $permission->name }}>
                        @endforeach
                        @include('role.user')
                        @include('role.vehicule')
                        @include('role.demande')
                        @include('role.site')
                        @include('role.chauffeur')
                        @include('role.course')
                        @include('role.delegation')



                @endfor



            </tbody>
        </table>
    </div>
</x-app-layout>
