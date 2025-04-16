<x-admin-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Утасны дугаар засах</h2>

        <form action="{{ route('orgNumbers.update', $orgNumber->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700 font-medium mb-2">Утасны дугаар:</label>
                <input type="text" name="phone_number" id="phone_number"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring focus:border-blue-500"
                    value="{{ old('phone_number', $orgNumber->phone_number) }}" required>
                @error('phone_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('organization.show', $orgNumber->organization_id) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                    Буцах
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                    Хадгалах
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
