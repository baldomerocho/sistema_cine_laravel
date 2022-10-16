<div class="bg-slate-100 w-full m-6 p-6 rounded-md">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <h3 class="text-2xl font-bold mb-4">Crear Ticket</h3>


        <div class="mb-4">
            <x-jet-label for="country" value="País"/>
            <select wire:model="country"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-slate-500 focus:border-slate-500 sm:text-sm"
                    required>
                <option>-- Selecciona una opción --</option>
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="country"/>
        </div>


        <div class="mb-4">
            <x-jet-label for="city" value="Ciudad"/>
            <select wire:model="city"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-slate-500 focus:border-slate-500 sm:text-sm"
                    required>
                <option>-- Selecciona una opción --</option>
                @foreach($cities->cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="city"/>
        </div>

        <div class="mb-4">
            <x-jet-label for="name" value="Salas"/>
            <select wire:model="room"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-slate-500 focus:border-slate-500 sm:text-sm"
                    required>
                <option>-- Selecciona una opción --</option>
                @foreach($rooms->rooms as $room)
                    <option value="{{$room->id}}">{{$room->name}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="room"/>
        </div>

        <div class="mb-4 w-full">
            @foreach($shows->shows as $is_show)
                <button class="w-full" wire:click="selectShow({{$is_show}})">
                    <div class=" border space-x-2 p-4 flex">
                        <img src=" {{$is_show->movie->poster_path_url()}}" alt="" class="w-20 h-20">
                        <div class="text-left">
                            <h3 class="text-xl font-bold">{{$is_show->movie->title}}</h3>
                            <p class="text-sm">Precio: {{$is_show->price}}</p>
                            <p class="text-sm">Lugar: {{$is_show->room->name}}, {{$is_show->room->city->name}}</p>
                            <p class="text-sm">Estreno: {{$is_show->movie->show_release_date()}}</p>
                            <p class="text-sm">Presentación: {{$is_show->day()}} | {{$is_show->start_and_end_time()}} | Duración: {{$is_show->duration_in_minutos_and_seconds()}}</p>


                        </div>
                    </div>
                </button>
            @endforeach
        </div>


        ASIENTOS ELEGIDOS @json($seats_for_sale)
    <div class="text-2xl">
        TOTAL: {{$total}}
    </div>
    <hr class="my-4"/>
        @foreach($show_seats as $index => $seat)
            <button wire:click="selectSeat({{$seat->id}})" class="bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 space-y-2" >{{$seat->name}}</button>
        @endforeach
    <hr class="my-4" />

    <x-jet-button wire:click="createSale" class="mt-4">Crear</x-jet-button>
    {{$movie}}
</div>
