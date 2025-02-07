<x-admin-layout>
    <div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Үйлчлэх хүрээ</h2>

        <div class="mb-4">
            <a href="{{ route('organizationServiceArea.create') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded">Нэмэх</a>
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-gray-600">
                    <th class="border p-3">#</th>
                    <th class="border p-3">ТЗЭ нэр</th>
                    <th class="border p-3">Аймаг</th>
                    <th class="border p-3">Сум/Дүүрэг</th>
                    <th class="border p-3">Баг/Хороо</th>
                    <th class="border p-3">Үйлдэл</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serviceAreas as $index => $serviceArea)
                    <tr class="border">
                        <td class="border p-3 text-center">{{ $index + 1 }}</td>
                        <td class="border p-3">{{ $serviceArea->organization->name ?? '-' }}</td>
                        <td class="border p-3">{{ $serviceArea->country->name ?? '-' }}</td>
                        <td class="border p-3">{{ $serviceArea->soumDistrict->name ?? '-' }}</td>
                        <td class="border p-3">{{ $serviceArea->bagKhoroo->name ?? '-' }}</td>
                        <td class="border p-3 text-center">
                            <form action="{{ route('organizationServiceArea.destroy', $serviceArea->id) }}"
                                method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $serviceAreas->links() }}
        </div>


    </div>
</x-admin-layout>
