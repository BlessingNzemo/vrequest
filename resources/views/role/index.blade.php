<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between py-5">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Liste des Roles') }}
            </h2>
        </div>
    </x-slot>
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
    <div class="flex flex-col">
        <div class=" overflow-x-auto pb-4">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden  border rounded-lg border-gray-300">
                    <table class="table-auto min-w-full rounded-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th scope="col"
                                    class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize">
                                    N°</th>
                                <th scope="col"
                                    class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize">
                                    Nom </th>
                                <th scope="col"
                                    class="p-5 text-left whitespace-nowrap text-sm leading-6 font-semibold text-gray-900 capitalize min-w-[150px]">
                                    Action </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 ">
                            @foreach ($roles as $i => $item)
                                <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">
                                        {{ $i + 1 }}</td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                        {{ $item->name }}</td>
                                    <td class=" px-5 py-3">
                                        <a href="{{ route('roles.show', $item->id) }}" type="button"
                                            class="text-white bg-orange-400 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-orange-600 dark:hover:bg-orange-700 focus:outline-none dark:focus:ring-orange-800">Voir_Permission</a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <x-deleteRole />
    <x-editRole />
</x-app-layout>
