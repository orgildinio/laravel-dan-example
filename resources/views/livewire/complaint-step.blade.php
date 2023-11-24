<div>
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded my-3"><i class="fa-solid fa-gear"></i> Удирдах<p></button>
    @if($isOpen)
        @include('livewire.create')
    @endif
</div>