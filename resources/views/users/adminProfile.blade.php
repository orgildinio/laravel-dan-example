<x-admin-layout>
    <div class="bg-gray-100">
        <div class="container mx-auto py-8">
            <form class="" action="{{ route('updateAdminProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                    <div class="col-span-4 sm:col-span-3">
                        <div class="bg-white shadow rounded-lg p-6">
                            <div class="flex flex-col items-center mt-4">
                                @if (Auth::user()->profile_photo_path != null)
                                    <img id='preview_img'
                                        class="w-32 h-32 bg-white shadow-lg rounded-full object-cover object-center p-1 mb-4 shrink-0"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                @elseif(Auth::user()->danImage != null)
                                    <img id='preview_img'
                                        class="w-32 h-32 bg-white shadow-lg rounded-full object-cover object-center p-1 mb-4 shrink-0"
                                        src="data:image/png;base64,{{ Auth::user()->danImage }}" alt="profile">
                                @else
                                    <img id='preview_img'
                                        class="w-32 h-32 bg-white shadow-lg rounded-full object-cover object-center p-1 mb-4 shrink-0"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                @endif
                                <h1 class="text-xl font-bold mb-4">
                                    {{ Auth::user()->danFirstname ? Auth::user()->danFirstname : Auth::user()->name }}
                                </h1>
                                <p class="text-gray-700">{{ Auth::user()->division }}</p>
                                <p class="text-gray-700">{{ Auth::user()->org?->name }}</p>
                                <br>
                                <label for="uploadFile"
                                    class="bg-gray-800 hover:bg-gray-700 text-white text-sm px-4 py-2 outline-none rounded w-max cursor-pointer mx-auto block font-[sans-serif]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 mr-2 fill-white inline"
                                        viewBox="0 0 32 32">
                                        <path
                                            d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z"
                                            data-original="#000000" />
                                        <path
                                            d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z"
                                            data-original="#000000" />
                                    </svg>
                                    Зураг солих
                                    <input type="file" id='uploadFile' name="photo" class="hidden" onchange="loadFile(event)" />
                                </label>
                                {{-- <label class="block">
                                    <input type="file" name="photo" onchange="loadFile(event)"
                                        class="block w-full text-sm text-slate-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-violet-50 file:text-blue-700
                                      hover:file:bg-violet-100
                                    " />
                                </label> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-9">
                        <div class="bg-white shadow rounded-lg p-6">
                            @if (session('success'))
                                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-2 mb-4"
                                    role="alert">
                                    <p>{{ session('success') }}</p>
                                </div>
                            @elseif (session('error'))
                                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 text-sm p-2 mb-4"
                                    role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <h2 class="text-xl font-bold mb-4">Үндсэн мэдээлэл</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="lastname" class="block text-sm font-medium text-gray-700">Байгууллага</label>
                                    <input type="text" id="lastname" name="lastname"
                                        class="mt-1 block w-full border-gray-300 bg-gray-200 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-600 sm:text-sm cursor-not-allowed"
                                        value="{{ Auth::user()->org?->name }}" disabled>
                                </div>

                                <div>
                                    <label for="firstname" class="block text-sm font-medium text-gray-700">Нэр</label>
                                    <input type="text" id="firstname" name="firstname"
                                        class="mt-1 block w-full border-gray-300 bg-gray-200 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-600 sm:text-sm cursor-not-allowed"
                                        value="{{ Auth::user()->name }}" disabled>
                                </div>

                                <div>
                                    <label for="regnum" class="block text-sm font-medium text-gray-700">Албан тушаал</label>
                                    <input type="text" id="regnum" name="regnum"
                                        class="mt-1 block w-full border-gray-300 bg-gray-200 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-600 sm:text-sm cursor-not-allowed"
                                        value="{{ Auth::user()->division }}" disabled>
                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">Хандах эрх</label>
                                    <input type="text" id="city" name="city"
                                        class="mt-1 block w-full border-gray-300 bg-gray-200 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-600 sm:text-sm cursor-not-allowed"
                                        value="{{ Auth::user()->role?->name }}" disabled>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Холбогдох
                                        утас</label>
                                    <input type="text" id="phone" name="phone"
                                        class="mt-1 block w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        value="{{ Auth::user()->phone }}">
                                    @error('phone')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Имэйл</label>
                                    <input type="email" id="email" name="email"
                                        class="mt-1 block w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div x-data="{ show: true }">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Шинэ нууц
                                        үг</label>
                                    {{-- <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"> --}}
                                    <div class="relative text-gray-500">
                                        <input placeholder="" name="password" :type="show ? 'password' : 'text'"
                                            class="mt-1 block w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <div
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                @click="show = !show" :class="{ 'hidden': !show, 'block': show }"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                @click="show = !show" :class="{ 'block': !show, 'hidden': show }"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>


                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="passwordRepeat" class="block text-sm font-medium text-gray-700">Шинэ
                                        нууц үг давтаж оруулах</label>
                                    <input type="password" id="passwordRepeat" name="passwordRepeat"
                                        class="mt-1 block w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>

                            </div>
                            <br>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Хадгалах</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>

<script>
    var loadFile = function(event) {

        var input = event.target;
        var file = input.files[0];
        var type = file.type;

        var output = document.getElementById('preview_img');


        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
