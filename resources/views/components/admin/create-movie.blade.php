<div>
    <select wire:model="country_selected">
        @foreach($countries as $country)
            <option value="{{ $country->id}}">{{ $country->name }}</option>
        @endforeach
    </select>
    @json($country_selected)
    @json($cities)
</div>
