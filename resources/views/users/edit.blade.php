<x-admin-layout>
    <div>
        <div class="w-full mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 m-5">
                <div>
                    <h1 class="py-4 mb-2 mt-0 text-2xl font-medium leading-tight text-gray">Шинэ хэрэглэгч бүртгэх</h1>
                </div>
                <form class="max-w-sm bg-gray-100 p-5" method="POST" action="{{ route('user.update', $user->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Хэрэглэгчийн
                            нэр</label>
                        <input type="text" name="name" value="{{$user->name}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Имэйл
                            хаяг</label>
                        <input type="email" name="email" value="{{$user->email}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Нууц
                            үг</label>
                        <input type="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            >
                    </div>

                    <div class="md-5">
                        <label for="organization" class="block mb-2 text-sm font-medium text-gray-900">
                            Байгууллага
                        </label>
                        <select name="org_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($orgs as $org)
                            <option value="{{ $org->id }}" {{ $org->id == $user->org_id ? 'selected' : ''}}>{{ $org->name }}</option>
                            @endforeach
                        </select>
                        @error('org_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="md-5">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900">
                            Хандах эрх
                        </label>
                        <select name="role_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : ''}}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="mb-5">
                        <label for="division" class="block mb-2 text-sm font-medium text-gray-900">Албан тушаал</label>
                        <input type="text" name="division" value="{{$user->division}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('division') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-5">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Утас</label>
                        <input type="text" name="phone" value="{{$user->phone}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            >
                        @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Хадгалах</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>