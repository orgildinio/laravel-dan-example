<div>
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Шилжүүлэх</button>
        @if($isOpen)
            @include('livewire.create')
        @endif
</div>