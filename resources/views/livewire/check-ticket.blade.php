<div class="p-4">
    <form wire:submit.prevent="checkTicket">
        <x-jet-input type="text" class="mt-1 block w-full" wire:model.defer="ticket" placeholder="Verificar Ticket"/>
        <x-jet-input-error for="ticket"/>
        <x-jet-button wire:click="checkTicket" class="mt-4">Verificar</x-jet-button>
    </form>
</div>
