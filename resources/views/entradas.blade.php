<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cartelera') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-row">
                    <div class="basis-1/4">
                        <livewire:check-ticket />
                        <livewire:show-tickets />
                    </div>
                    <div class="basis-3/4">
                        <livewire:create-ticket />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
