<div class="relative">
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded my-3"><i class="fa-solid fa-gear"></i> Удирдах<p></button>
    @if($showPermissionWarning)
        <div class="absolute top-5 right-0 mt-8 w-64 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-2" role="alert">
            <p>Таны хариуцсан гомдол биш байна..</p>
          </div>
    @endif
    @if($isOpen)
        @include('livewire.create')
    @endif
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- JavaScript to reload the page after the modal closes -->
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('reloadPage', function () {
                console.log("reload")
                location.reload();
            });
        });
    </script>
@endpush