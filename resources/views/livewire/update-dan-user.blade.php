<div>
    <div>
        @if ($isOpen)
            <div  class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div wire:click="closeModal" class="fixed inset-0 bg-gray-400 bg-opacity-75 transition-opacity"></div>
        
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div
                            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-6">
                            <form wire:submit.prevent="updateUser">
                                @csrf
                    
                                <div>
                                    <x-label for="username" value="{{ __('Хэрэглэгчийн нэр') }}" />
                                    <x-input class="block mt-1 w-full" type="text" wire:model="username" :value="old('username')" />
                                    @error('username') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                    
                                <div class="mt-4">
                                    <x-label for="email" value="{{ __('И-мэйл') }}" />
                                    <x-input class="block mt-1 w-full" type="text" wire:model="email" :value="old('email')" />
                                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                    
                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Нууц үг') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" wire:model="password" />
                                    @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                    
                                <div class="mt-4">
                                    <x-label for="password_confirmation" value="{{ __('Нууц үг давтах') }}" />
                                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" wire:model="password_confirmation" />
                                    @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                    
                                <div class="flex items-center justify-end mt-4">
                    
                                    <x-button type="submit" class="ml-4">
                                        {{ __('Бүртгүүлэх') }}
                                    </x-button>
                                    <x-button class="ml-4 bg-gray-600" wire:click="closeModal">
                                        {{ __('Хаах') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('click', function(event) {
        const modal = document.querySelector('.modal');
        if (!modal.contains(event.target)) {
            Livewire.emit('closeModal');
        }
    });
</script>