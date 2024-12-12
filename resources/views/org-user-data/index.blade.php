<x-admin-layout>
    <div class="flex flex-col bg-white p-8">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="container mx-auto">
                    <h1 class="text-xl font-semibold mb-4">Хэрэглэгчдийн мэдээлэл</h1>

                    <div class="container mx-auto">
                        @if ($message = Session::get('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4" role="alert">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>
                
                    <!-- Import File Form -->
                    <form action="{{ route('orguserdata.import') }}" method="POST" enctype="multipart/form-data" class="mb-6">
                        @csrf
                        <div class="mb-4">
                            <label for="org_id" class="block text-sm font-medium text-gray-700 mb-2">Байгууллага</label>
                            <select name="org_id" id="org_id" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
                                <option value="" disabled selected>Сонгох</option>
                                @foreach($organizations as $organization)
                                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Import Excel File</label>
                            <input type="file" name="file" id="file" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Import
                        </button>
                    </form>
                
                    <!-- List of Org User Data -->
                    <div class="overflow-hidden border border-gray-200 shadow rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Code</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reg. Num</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aimag/City</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sum/District</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bag/Khoroo</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Building/Street</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Door</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($orgUserData as $data)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->usercode }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->lastname }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->firstname }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->regnum }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->phone }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->aimagCityName }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->sumDistrictName }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->bagKhorooName }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->buildingStreet }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->door }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $data->mail }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="px-4 py-3 text-center text-sm text-gray-500">No data available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $orgUserData->links(); }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
