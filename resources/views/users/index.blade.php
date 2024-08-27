<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between py-5">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __("Liste d'utilisateurs") }}
            </h2>
        </div>
    </x-slot>
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
                            @foreach ($users as $i => $item)
                                <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">
                                        {{ $i + 1 }}</td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                        {{ $item->username }}</td>
                                    <td class=" px-5 py-3">
                                        <a href="{{ route('user_role.show', $item->id) }}"><button type="button"
                                                class="text-white bg-orange-400 hover:bg-orange-00 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-orange-600 dark:hover:bg-orange-700 focus:outline-none dark:focus:ring-orange-800">roles</button></a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        new DataTable('#user', {
            info: false,
            ordering: false,
            paging: false
        });
    </script>
</x-app-layout>
