<!-- resources/views/cdr/index.blade.php -->
<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">
        <h1 class="text-2xl font-bold mb-4">Байгууллагын мэдээлэл</h1>
        

        @if ($message = Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-2 mb-4" role="alert">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="flex justify-end">
            <a href="{{ route('organization.create') }}"
                class="px-4 py-2 rounded-md bg-black text-sky-100 hover:bg-gray-600">Нэмэх</a>
        </div>

        <form method="GET" action="{{ route('organization.index') }}">
            <div class="flex flex-wrap mb-6">
                <div class="w-full md:w-1/5 px-2 mb-4 md:mb-0">
                    <select name="org_id"
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 text-gray-500">
                        <option value="">Байгууллага</option>
                        @foreach ($orgs as $org)
                        <option value="{{ $org->id }}" {{ request('org_id') == $org->id ? 'selected' : '' }}>{{ $org->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/5 px-2 mb-4 md:mb-0">
                    <select name="plant_id"
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 text-gray-500">
                        <option value="">Төрөл</option>
                        <option value="1" {{ request('plant_id') == '1' ? 'selected' : '' }}>Цахилгаан</option>
                        <option value="2" {{ request('plant_id') == '2' ? 'selected' : '' }}>Дулаан</option>
                    </select>
                </div>
                <div class="w-full md:w-1/5 px-2 mb-4 md:mb-0">
                    <button type="submit" class="w-full px-3 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200">Хайх</button>
                </div>
            </div>
        </form>

        <div class="bg-white shadow-md rounded my-2">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="p-3 text-left">№</th>
                        <th class="p-3 text-left">Байгууллагын нэр</th>
                        <th class="p-3 text-left">Төрөл</th>
                        <th class="p-3 text-left">Дугаар</th>
                        <th class="py-3 px-6 text-center">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($orgs as $org)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="p-3 text-left">
                                {{-- {{ $loop->iteration }} --}}

                                {{ ($orgs->currentPage() - 1) * $orgs->perPage() + $loop->iteration }}
                            </td>
                            <td class="p-3 text-left">{{ $org->name }}</td>
                            <td class="p-3 text-left">{{ $org->plant_id == 1 ? "Цахилгаан" : "Дулаан" }}</td>
                            <td class="p-3 text-left">
                                @if ($org->orgNumber->isNotEmpty())
                                    @foreach ($org->orgNumber as $item)
                                        <p>{{$item->phone_number}}</p>    
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div x-data="{ open: false }">
                                    <button @click="open = true"
                                        class="text-blue-500 hover:text-blue-800"><i class="fa-solid fa-square-phone-flip fa-lg"></i></button>

                                    <div x-show="open" @click.away="open = false"
                                        class="fixed z-10 inset-0 overflow-y-auto">
                                        <div class="flex items-center justify-center min-h-screen">
                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                            </div>
                                            <div
                                                class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all">
                                                <!-- Modal Content -->
                                                <div class="px-4 py-5 sm:p-6">
                                                    <form method="POST" action="{{ route('orgNumber.save', $org->id) }}">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label for="phone_number"
                                                                class="block text-gray-700 font-bold mb-2">Дугаар</label>
                                                            <input type="number" name="phone_number"
                                                                class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit"
                                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Хадгалах</button>
                                                            <button @click="open = false"
                                                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Хаах</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->role->name == 'admin')
                                <a href="{{ route('organization.edit', $org->id) }}"
                                    class="text-gray-500 hover:text-gray-800"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                <form action="{{ route('organization.destroy', $org->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-800"><i class="fa-regular fa-trash-can fa-lg"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-2">
                {{-- {!! $orgs->links() !!} --}}
                {!! $orgs->appends(request()->query())->links() !!}
            </div>
        </div>
    </div>
</x-admin-layout>
