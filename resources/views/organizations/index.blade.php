<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">
        <h1 class="text-2xl font-bold mb-4">Байгууллагын мэдээлэл</h1>

        @if ($message = Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-2 mb-4" role="alert">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('organization.create') }}"
                class="px-4 py-2 rounded-md bg-black text-sky-100 hover:bg-gray-600">
                Нэмэх
            </a>
        </div>

        <form id="filterForm" method="GET" action="{{ route('organization.index') }}" x-ref="filterForm" x-data="{ phone: '{{ request('phone') }}' }">
            <input type="hidden" name="name" :value="name">
            <input type="hidden" name="plant_id" :value="plant_id">
            <input type="hidden" name="phone" :value="phone">


            <div class="bg-white shadow-md rounded my-2">
                <table class="w-full border border-gray-300 rounded-lg shadow-md overflow-hidden">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr class="text-left text-sm uppercase font-semibold">
                            <th class="p-3">№</th>
                            <th class="p-3">Байгууллагын нэр</th>
                            <th class="p-3">Төрөл</th>
                            <th class="p-3">Дугаар</th>
                            <th class="p-3 text-center">Үйлдэл</th>
                        </tr>
                        <tr>
                            <th class="p-2"></th>
                            <th class="p-2">
                                <input type="text" name="name"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="Нэрээр хайх..." x-model="name" />
                            </th>
                            <th class="p-2">
                                <select name="plant_id"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    x-model="plant_id" @change="$refs.filterForm.submit()">
                                    <option value="">Төрөл сонгох</option>
                                    <option value="1" :selected="plant_id == 1">Цахилгаан</option>
                                    <option value="2" :selected="plant_id == 2">Дулаан</option>
                                </select>
                            </th>
                            <th class="p-2">
                                <input type="text" name="phone"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="Дугаар..." x-model="phone" />
                            </th>
                            <th class="p-2 text-center">
                                <button type="button"
                                    @click="name = ''; plant_id = ''; phone=''; window.location.href = '{{ route('organization.index') }}';"
                                    class="px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition duration-200">
                                    Цэвэрлэх
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white text-sm">
                        @foreach ($orgs as $org)
                            <tr class="hover:bg-gray-100 transition duration-200">
                                <td class="p-3">{{ ($orgs->currentPage() - 1) * $orgs->perPage() + $loop->iteration }}</td>
                                <td class="p-3">{{ $org->name }}</td>
                                <td class="p-3">{{ $org->plant_id == 1 ? 'Цахилгаан' : 'Дулаан' }}</td>
                                <td class="p-3">
                                    @if ($org->orgNumber->isNotEmpty())
                                        @foreach ($org->orgNumber as $item)
                                            <p>{{ $item->phone_number }}</p>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 italic">N/A</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <div x-data="{ open: false }">
                                            <button @click="open = true" class="text-blue-500 hover:text-blue-700 transition">
                                                <i class="fa-solid fa-square-phone-flip fa-lg"></i>
                                            </button>
                
                                            <div x-show="open" @click.away="open = false"
                                                class="fixed z-10 inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                                                    <form method="POST" action="{{ route('orgNumber.save', $org->id) }}">
                                                        @csrf
                                                        <label for="phone_number" class="block text-gray-700 font-medium mb-2">
                                                            Дугаар
                                                        </label>
                                                        <input type="number" name="phone_number"
                                                            class="w-full border border-gray-300 rounded-lg p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                                        <div class="flex justify-end space-x-2">
                                                            <button type="submit"
                                                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                                                Хадгалах
                                                            </button>
                                                            <button type="button" @click="open = false"
                                                                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                                                                Хаах
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @if (Auth::user()->role->name == 'admin')
                                            <a href="{{ route('organization.edit', $org->id) }}"
                                                class="text-gray-500 hover:text-gray-800 transition">
                                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                            </a>
                                            <form action="{{ route('organization.destroy', $org->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                                    <i class="fa-regular fa-trash-can fa-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="p-2">
                    {!! $orgs->appends(request()->query())->links() !!}
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
