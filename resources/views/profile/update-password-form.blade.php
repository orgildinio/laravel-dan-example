<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Нууц үг солих') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Таны бүртгэл аюулгүй байхын тулд урт, хүчтэй нууц үг ашиглаж байгаа эсэхийг шалгаарай.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Одоо ашиглаж байгаа нууц үг') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Шинэ нууц үг') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Шинэ нууц үг /давтаж оруулах/') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Хадгалагдсан.') }}
        </x-action-message>

        <x-button>
            {{ __('Хадгалах') }}
        </x-button>
    </x-slot>
</x-form-section>
