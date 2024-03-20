<x-admin-layout>
    <div>
        <div class="w-full mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 m-5">
                <div>
                    <h1 class="py-4 mb-2 mt-0 text-2xl font-medium leading-tight text-gray">Шинэ хэрэглэгч бүртгэх</h1>
                </div>
                @if ($errors->any())
                    <div class="bg-red-200 p-2 mb-2 text-red-700 rounded-md">
                        <strong>Whoops!</strong> Алдаа гарлаа.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="max-w-sm bg-gray-100 p-5" method="POST" action="{{ route('organization.update', $organization->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Байгууллагын нэр</label>
                        <input type="text" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            autocomplete="off" value="{{$organization->name}}">
                    </div>

                    <div class="md-5">
                        <label for="organization" class="block mb-2 text-sm font-medium text-gray-900">
                            Төрөл
                        </label>
                        <select name="plant_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="1" {{ $organization->plant_id == 1 ? 'selected' : '' }}>Цахилгаан</option>
                            <option value="2" {{ $organization->plant_id == 2 ? 'selected' : '' }}>Дулаан</option>
                        </select>
                    </div>
                    <br>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Хадгалах</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>