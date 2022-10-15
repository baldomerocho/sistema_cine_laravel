<div class="p-6">
    <div class="mb-4">
        <x-jet-label for="search_movie" value="Buscar película"/>
        <x-jet-input type="text" id="search_movie" class="mt-1 block w-full" wire:model.defer="search_movie"
                     placeholder="Buscar película"/>
        <x-jet-input-error for="search_movie"/>
    </div>

    <x-jet-danger-button wire:click="find_movie" wire:loading.attr="disabled" wire:target="save">
        Buscar
    </x-jet-danger-button>

    <div class="grid grid-cols-4 gap-4 mt-12 flex items-center">
        @foreach($search_results as $movie)
            <div class="hover:bg-gray-100">
                <div class="p-4">
                    <img src="https://image.tmdb.org/t/p/w500/{{$movie['poster_path']}}" alt="" width="200"
                         class="rounded-xl overflow-hidden">
                    <h3 class="font-bold my-2">{{$movie['title']}}</h3>
                    <x-jet-button wire:click="add_movie({{$movie['id']}})" wire:loading.attr="disabled" title="Agregar a la cartelera">
                        Agregar
                    </x-jet-button>
                    <x-jet-button wire:click="update_movie({{$movie['id']}})" wire:loading.attr="disabled">
                        Actualizar
                    </x-jet-button>

                </div>
            </div>
        @endforeach
    </div>

</div>
