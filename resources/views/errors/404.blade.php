<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="text-center text-3xl font-extrabold text-gray-900">{{ __('404 Not found') }}</h2>
                <p class="mt-2 text-center text-sm text-gray-600">{{ __('Таны хайсан хуудас олдсонгүй.') }}</p>
            </div>
            <div class="text-center">
                <a href="{{ url('/') }}" class="inline-block bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Нүүр хуудас') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>