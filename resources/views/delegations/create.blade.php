<x-app-layout>
    <div class="py-8  px-4 mx-auto max-w-4xl lg:py-16 shadow-md sm:rounded-lg">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Remplissez ce formulaire pour faire une délégation </h2>
        @if ($errors->any())

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:red">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('delegations.store') }}" method="post">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" @required(true)>Motif</label>
                    <input type="text" name="motif" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Motif de la délégation" required="required">
                </div>
                <div class="w-full sm:col-span-2">
                    <label for="user_id"
                        class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white" @required(true) > Votre remplaçant</label>
                    <input type="text" name="user_id" id="user_id"
                        class="block mb-2 typeahead form-control "
                        placeholder="Choisissez votre remplaçant" required="required">

                    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
                    {{-- <x-styleAutocomplete />
                    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
                    <script type="text/javascript">
                        var path = "{{ url('autocomplete') }}";
                        $('input.typeahead').typeahead({
                            source:  function (query, process) {
                            return $.get(path, { query: query }, function (data) {
                                    return process(data);
                                });
                            }
                        });
                    </script> --}}

                    
                    
                </div>

                <div class="w-full">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de début</label>
                    <input type="datetime-local" name="date_debut" id="datetime"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="">
                </div>
                <div>
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de Fin</label>
                    <input type="datetime-local" name="date_fin" id="datetime"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required="">
                </div>
                

            <button
                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800" >
                        Soumettre votre délégation
            </button>
        </form>
        

        <script src="https://unpkg.com/jquery/dist/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </div>
    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
        <script type="text/javascript">
            var path = "{{ url('autocomplete') }}";
            $('input.typeahead').typeahead({
                source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                        return process(data);
                    });
                }
            });
        </script>

</x-app-layout>




