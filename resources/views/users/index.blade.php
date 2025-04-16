<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Хэрэглэгчийн мэдээлэл</h1>
            <a href="{{ route('user.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                Нэмэх
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <p>{{ $message }}</p>
            </div>
        @endif

        <form method="GET" action="{{ route('users.index') }}" class="mb-6">
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div class="">
                        <input type="text" name="name" placeholder="Нэр" value="{{ request('name') }}"
                            class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                    </div>
                    <div class="">
                        <input type="text" name="email" placeholder="Имэйл" value="{{ request('email') }}"
                            class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                    </div>
                    <div class="">
                        <select name="org_id"
                            class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                            <option value="">Байгууллага</option>
                            @foreach ($orgs as $org)
                                <option value="{{ $org->id }}"
                                    {{ request('org_id') == $org->id ? 'selected' : '' }}>
                                    {{ $org->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Хайх
                        </button>
                        <a href="{{ route('users.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300 transition duration-200">
                            Цэвэрлэх
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-200">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2 border">№</th>
                        <th class="px-4 py-2 border">Нэр</th>
                        <th class="px-4 py-2 border">Имэйл</th>
                        <th class="px-4 py-2 border">Байгууллага</th>
                        <th class="px-4 py-2 border">Албан тушаал</th>
                        <th class="px-4 py-2 border">Утас</th>
                        <th class="px-4 py-2 border">Огноо</th>
                        <th class="px-4 py-2 border" colspan="2">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-2 border text-center">{{ ++$i }}</td>
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>
                            <td class="px-4 py-2 border">{{ $user->org?->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->division }}</td>
                            <td class="px-4 py-2 border">{{ $user->phone }}</td>
                            <td class="px-4 py-2 border">{{ $user->created_at }}</td>
                            @if (Auth::user()->role?->name == 'admin')
                                <td class="px-4 py-2 border text-center">
                                    <a href="{{ route('user.edit', $user->id) }}"
                                        class="text-blue-600 hover:text-blue-900">
                                        Засах
                                    </a>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Устгах уу?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Устгах</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
