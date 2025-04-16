<x-admin-layout>
    <div class="w-full mx-auto mt-10 bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Шинэ дугаар нэмэх</h2>

        <form action="{{ route('orgNumber.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700 font-medium mb-2">Утасны дугаар:</label>
                <input type="text" name="phone_number" id="phone_number"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring focus:border-blue-500"
                    value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <input type="hidden" name="organization_id" value="{{ $organizationId }}">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Хадгалах</button>
        </form>
    </div>
</x-admin-layout>
