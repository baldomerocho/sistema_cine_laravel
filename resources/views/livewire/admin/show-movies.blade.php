<div>
    <div class="p-4 flex flex-row space-x-4">
        <select wire:model="country"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required>
            <option>-- Selecciona una opción --</option>
            @foreach($countries as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </select>
        @if($cities->isNotEmpty())
            <select wire:model="city"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="null">-- Selecciona una opción --</option>
                @foreach($cities as $cd)
                    <option value="{{$cd->id}}">{{$cd->name}}</option>
                @endforeach
            </select>
        @endif

    </div>

    <div class="bg-white overflow-hidden sm:rounded-lg">
        @foreach($movies as $i => $movie)
            <div class="hover:bg-blue-50 flex flex-row justify-between">
                <div class="basis-1/4 flex justify-center">
                    <img src="https://image.tmdb.org/t/p/w500/{{$movie['poster_path']}}" alt="" width="200"
                         class="rounded-xl overflow-hidden m-4">
                </div>
                <div class="basis-1/2">
                    <div class="p-4">
                        <h3 class="font-bold text-4xl my-2">{{$movie->title}}</h3>
                        <p class="text-gray-500">{{$movie->tagline}}</p>
                        <p class="text-gray-500">Estreno: {{$movie->show_release_date()}}</p>
                        @if($movie->shows_today->isNotEmpty())
                            <div class="bg-green-50 p-4 rounded-md">
                                @foreach($movie->shows_today as $show)
                                    <span class="text-gray-500 font-bold">{{$show->day()}}: {{$show->start_and_end_time()}} </span>
                                    <span class="text-gray-500">Duración: {{$show->duration_in_minutos_and_seconds()}}</span><br/>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
                <div class="basis-1/4 ">
                    <div class="p-4">
                        <x-jet-label from="sala" value="Elige una Sala"/>
                        <select id="sala" wire:model="create_show.{{$i}}.room_id"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required @if($rooms->isEmpty()) disabled @endif>
                            <option>-- Selecciona una opción --</option>
                            @foreach($rooms as $sala)
                                <option value="{{$sala->id}}">{{$sala->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="create_show.{{$i}}.room_id" class="mb-4"/>
                        <x-jet-label from="fecha" value="Fecha y hora de la presentación" class="mt-4" />
                        <x-jet-input id="fecha" type="datetime-local" class="mt-1 block w-full" wire:model="create_show.{{$i}}.start" />
                        <x-jet-input-error for="create_show.{{$i}}.start" class="mb-4"/>
                        <x-jet-label from="precio" value="Ingresa el precio" class="mt-4"/>
                        <x-jet-input id="precio" type="number" class="mt-1 block w-full mb-4" wire:model="create_show.{{$i}}.price" />
                        <x-jet-input-error for="create_show.{{$i}}.price" class="mb-4"/>
                        <x-jet-button wire:click="createShow({{$i}},{{$movie}})" wire:loading.attr="disabled">
                            Crear horario
                        </x-jet-button>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    <div class="p-4">
        {{$movies->links()}}
    </div>
</div>
