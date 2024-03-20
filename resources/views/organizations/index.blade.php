<!-- resources/views/cdr/index.blade.php -->
<x-admin-layout>
    <div class="container mx-auto px-2 py-4">
        <h1 class="text-2xl font-bold mb-4">Байгууллага</h1>
        <div class="flex justify-end">
            <a href="{{ route('organization.create') }}"
                class="px-4 py-2 rounded-md bg-black text-sky-100 hover:bg-gray-600">Нэмэх</a>
        </div>

        @if ($message = Session::get('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-2 mb-4" role="alert">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="bg-white shadow-md rounded my-2">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="p-3 text-left">id</th>
                        <th class="p-3 text-left">Байгууллагын</th>
                        <th class="p-3 text-left">Төрөл</th>
                        <th class="p-3 text-left">Дугаар</th>
                        <th class="py-3 px-6 text-center">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($orgs as $org)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="p-3 text-left">{{ $org->id }}</td>
                            <td class="p-3 text-left">{{ $org->name }}</td>
                            <td class="p-3 text-left">{{ $org->plant_id }}</td>
                            <td class="p-3 text-left">{{ $org->org_number_id }}</td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('organization.edit', $org->id) }}" class="text-blue-500 hover:text-blue-800">Засах</a>
                                <form action="{{ route('organization.destroy', $org->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-800">Устгах</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-2">
                {!! $orgs->links() !!}
            </div>
        </div>
    </div>
</x-admin-layout>
