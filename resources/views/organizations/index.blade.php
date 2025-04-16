<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Байгууллагын мэдээлэл</h1>

        @if ($message = Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-4 mb-6 rounded" role="alert">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('organization.create') }}"
                class="px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600 transition duration-200">
                Нэмэх
            </a>
        </div>

        <form id="filterForm" method="GET" action="{{ route('organization.index') }}" class="mb-6">
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Нэрээр хайх</label>
                        <input type="text" name="name" value="{{ request('name') }}"
                            class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400"
                            placeholder="Байгууллагын нэр">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Төрөл</label>
                        <select name="plant_id"
                            class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                            <option value="">Бүгд</option>
                            <option value="1" {{ request('plant_id') == '1' ? 'selected' : '' }}>Цахилгаан</option>
                            <option value="2" {{ request('plant_id') == '2' ? 'selected' : '' }}>Дулаан</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Утасны дугаар</label>
                        <input type="text" name="phone" value="{{ request('phone') }}"
                            class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400"
                            placeholder="Дугаар">
                    </div>

                    <div class="flex space-x-2">
                        <button type="submit" name="filter" value="1"
                            class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition duration-200">
                            Хайх
                        </button>
                        <a href="{{ route('organization.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300 transition duration-200">
                            Цэвэрлэх
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <table class="w-full border-collapse">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm font-semibold text-gray-700">
                        <th class="p-3 border-b border-gray-200">№</th>
                        <th class="p-3 border-b border-gray-200">Байгууллагын нэр</th>
                        <th class="p-3 border-b border-gray-200">Төрөл</th>
                        <th class="p-3 border-b border-gray-200">Дугаар</th>
                        <th class="p-3 border-b border-gray-200 text-center">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($orgs as $org)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border-b border-gray-200 text-sm">
                                {{ ($orgs->currentPage() - 1) * $orgs->perPage() + $loop->iteration }}
                            </td>
                            <td class="p-3 border-b border-gray-200 text-sm">{{ $org->name }}</td>
                            <td class="p-3 border-b border-gray-200 text-sm">
                                {{ $org->plant_id == 1 ? 'Цахилгаан' : 'Дулаан' }}
                            </td>
                            <td class="p-3 border-b border-gray-200 text-sm">
                                @if ($org->orgNumbers->isNotEmpty())
                                    @foreach ($org->orgNumbers as $item)
                                        <div>{{ $item->phone_number }}</div>
                                    @endforeach
                                @else
                                    <span class="text-gray-400 italic">N/A</span>
                                @endif
                            </td>
                            <td class="p-3 border-b border-gray-200 text-center">
                                <a href="{{ route('organization.show', $org->id) }}"
                                    class="px-3 py-1 bg-cyan-500 text-white text-sm font-medium rounded hover:bg-cyan-600 transition duration-200">
                                    Дэлгэрэнгүй
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4 border-t border-gray-200">
                {!! $orgs->appends(request()->query())->links() !!}
            </div>
        </div>
    </div>
</x-admin-layout>
