<x-admin-layout>
    {{-- <div class="bg-white border border-4 rounded-lg shadow relative m-10">

        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold">
                Өргөдөл, гомдол шинээр бүртгэх
            </h3>
            <div
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"">
                <input type="text" name="product-name" id="product-name"
                    class="shadow-sm bg-yellow-50 border border-yellow-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"
                    placeholder="Хэрэглэгчийн код">
            </div>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="product-name" class="text-sm font-medium text-gray-900 block mb-2">Овог</label>
                    <input type="text" name="product-name" id="product-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple Imac 27”" required="">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="category" class="text-sm font-medium text-gray-900 block mb-2">Нэр</label>
                    <input type="text" name="category" id="category"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Electronics" required="">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Холбогдох утас
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="price" class="text-sm font-medium text-gray-900 block mb-2">И-мэйл хаяг</label>
                    <input type="number" name="price" id="price"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="$2300" required="">
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">УБ/орон нутаг
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Сум/дүүрэг
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Баг/хороо
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>
                <div class="col-span-full">
                    <label for="product-details" class="text-sm font-medium text-gray-900 block mb-2">Дэлгэрэнгүй
                        хаяг</label>
                    <textarea id="product-details" rows="2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-4"
                        placeholder="Details"></textarea>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200">
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="product-name" class="text-sm font-medium text-gray-900 block mb-2">Өргөдөл гаргасан
                        огноо</label>
                    <input type="date" name="product-name" id="product-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple Imac 27”" required="">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="category" class="text-sm font-medium text-gray-900 block mb-2">Шийдвэрлэх огноо</label>
                    <input type="date" name="category" id="category"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Electronics" required="">
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Гомдол гаргагчийн төрөл
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Төрөл
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Суваг
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>



                <div class="col-span-6 sm:col-span-2">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Гомдлын төрөл
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Өргөдлийн товч утга
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Холбогдох ТЗЭ
                    </label>
                    <input type="text" name="brand" id="brand"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        placeholder="Apple" required="">
                </div>
                <div class="col-span-full">
                    <label for="product-details" class="text-sm font-medium text-gray-900 block mb-2">Санал,
                        хүсэлт</label>
                    <textarea id="product-details" rows="2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-4"
                        placeholder="Details"></textarea>
                </div>
                <div class="col-span-full">
                    <label for="product-details" class="text-sm font-medium text-gray-900 block mb-2">Файл хавсаргах
                        (Max 5)</label>
                    <input type="file" name="files[]" id="files" multiple
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                                        file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                    <!-- Display Selected Files -->
                    <div id="fileList" class="mt-2 space-y-1"></div>

                    <!-- Error Message for Max File Limit -->
                    <p id="errorMessage" class="text-sm text-red-500 mt-1 hidden">Дээд тал нь 5 файл
                        хавсаргах боломжтой.</p>
                    @error('files.*')
                        <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="p-6 border-t border-gray-200 rounded-b">
            <button
                class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="submit">Save all</button>
        </div>

    </div> --}}
    <div class="py-4">
        <div class="w-full mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div>
                    <h1 class="py-4 mb-2 mt-0 text-2xl font-medium leading-tight text-gray text-center">Өргөдөл, гомдол
                        шинээр бүртгэх</h1>
                </div>
                <form method="POST" action="{{ route('complaint.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if ($message = Session::get('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-2 mb-4"
                            role="alert">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Гомдол гаргагчийн төрөл
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="complaint_maker_type_id" id="complaint_maker_type_id"
                                class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($complaint_maker_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Өргөдөл гаргасан огноо
                            </label>
                        </div>
                        <div class="relative md:w-3/4">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" viewBox="-0.5 0 15 15"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M61,154.006845 C61,153.45078 61.4499488,153 62.0068455,153 L73.9931545,153 C74.5492199,153 75,153.449949 75,154.006845 L75,165.993155 C75,166.54922 74.5500512,167 73.9931545,167 L62.0068455,167 C61.4507801,167 61,166.550051 61,165.993155 L61,154.006845 Z M62,157 L74,157 L74,166 L62,166 L62,157 Z M64,152.5 C64,152.223858 64.214035,152 64.5046844,152 L65.4953156,152 C65.7740451,152 66,152.231934 66,152.5 L66,153 L64,153 L64,152.5 Z M70,152.5 C70,152.223858 70.214035,152 70.5046844,152 L71.4953156,152 C71.7740451,152 72,152.231934 72,152.5 L72,153 L70,153 L70,152.5 Z"
                                        transform="translate(-61 -152)" />
                                </svg>
                            </div>
                            <input type="text" id="datetime" name="complaint_date"
                                class="bg-gray-100 appearance-none  rounded w-full py-2 px-10 text-gray-700 text-sm leading-tight border-1 border-gray-200"
                                value="{{ request('created') }}" />
                            @error('complaint_date')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if (Auth::user()->role?->name == 'ehzh')
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/4">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Шийдвэрлэх огноо
                                </label>
                            </div>
                            <div class="relative md:w-3/4">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" viewBox="-0.5 0 15 15"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M61,154.006845 C61,153.45078 61.4499488,153 62.0068455,153 L73.9931545,153 C74.5492199,153 75,153.449949 75,154.006845 L75,165.993155 C75,166.54922 74.5500512,167 73.9931545,167 L62.0068455,167 C61.4507801,167 61,166.550051 61,165.993155 L61,154.006845 Z M62,157 L74,157 L74,166 L62,166 L62,157 Z M64,152.5 C64,152.223858 64.214035,152 64.5046844,152 L65.4953156,152 C65.7740451,152 66,152.231934 66,152.5 L66,153 L64,153 L64,152.5 Z M70,152.5 C70,152.223858 70.214035,152 70.5046844,152 L71.4953156,152 C71.7740451,152 72,152.231934 72,152.5 L72,153 L70,153 L70,152.5 Z"
                                            transform="translate(-61 -152)" />
                                    </svg>
                                </div>
                                <input type="text" id="expire_date" name="expire_date"
                                    class="bg-gray-100 appearance-none  rounded w-full py-2 px-10 text-gray-700 text-sm leading-tight border-1 border-gray-200"
                                    value="{{ old('expire_date') }}" />
                                @error('expire_date')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div>
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/4">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Хэрэглэгчийн код
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <input id="consumer_code"
                                    class="bg-orange-50 appearance-none  rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight border-gray-200"
                                    type="text" name="user_code" value="{{ old('user_code') }}">
                                <span id="empty" class="hidden text-xs text-red-500">Мэдээлэл олдсонгүй</span>
                            </div>
                        </div>
                    </div>
                    <div id="conditionalInput1">
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/4">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Овог
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <input id="lastname"
                                    class="bg-gray-100 appearance-none  rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if ($errors->has('lastname')) border border-red-500 @else border-1 border-gray-200 @endif"
                                    type="text" name="lastname" value="{{ request('lastname') }}">
                                @error('lastname')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="conditionalInput2">
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/4">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Нэр
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <input id="firstname"
                                    class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if ($errors->has('firstname')) border border-red-500 @else border-1 border-gray-200 @endif"
                                    type="text" name="firstname" value="{{ request('firstname') }}">
                                @error('firstname')
                                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="conditionalInput3">
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/4">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    ААН-ийн нэр
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <input id="complaint_maker_org_name"
                                    class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if ($errors->has('complaint_maker_org_name')) border border-red-500 @else border-1 border-gray-200 @endif"
                                    type="text" name="complaint_maker_org_name"
                                    value="{{ old('complaint_maker_org_name') }}">
                                @error('complaint_maker_org_name')
                                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Холбогдох утас
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input id="phoneNumber"
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if ($errors->has('phone')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="phone" value="{{ request('phone') }}">
                            @error('phone')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                И-мэйл хаяг
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input id="mail"
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if ($errors->has('email')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="email" name="email" value="{{ request('email') }}">
                            @error('email')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4">
                                УБ/орон нутаг
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            @if (!empty(request('city')))
                                <input id="capitalProvince"
                                    class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight 
                                              @error('country') border border-red-500 @else border-1 border-gray-200 @enderror"
                                    type="text" name="country" value="{{ request('city') }}">
                                @error('country')
                                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            @else
                                <select name="country_id" id="country_id"
                                    class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight 
                                               focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="">-- Сонгох --</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ old('country_id') == $country->id || request('city') == $country->name ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                    </div>

                    <!-- Sum/District -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4">
                                Сум/дүүрэг
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            @if (!empty(request('district')))
                                <input id="districtsum"
                                    class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight 
                                              @error('district') border border-red-500 @else border-1 border-gray-200 @enderror"
                                    type="text" name="district" value="{{ request('district') }}">
                            @else
                                <select name="soum_district_id" id="soum_district_id"
                                    class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight 
                                               focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="">-- Сонгох --</option>
                                </select>
                            @endif
                            @error('soum_district_id')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Khoroo/Bag -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4">
                                Баг/хороо
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            @if (!empty(request('quarter')))
                                <input id="khorooBag"
                                    class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight 
                                              @error('khoroo') border border-red-500 @else border-1 border-gray-200 @enderror"
                                    type="text" name="khoroo" value="{{ request('quarter') }}">
                            @else
                                <select name="bag_khoroo_id" id="bag_khoroo_id"
                                    class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight 
                                               focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="">-- Сонгох --</option>
                                </select>
                            @endif
                            @error('bag_khoroo_id')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Дэлгэрэнгүй хаяг
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <textarea
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if ($errors->has('addressDetail')) border border-red-500 @else border-1 border-gray-200 @endif"
                                name="addressDetail" rows="3">{{ request('address') }}</textarea>
                            @error('addressDetail')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <hr />
                    <br>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Төрөл
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="category_id"
                                class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == request('category_id'))>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Суваг
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="channel_id" id="channel_id"
                                class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}" @selected($channel->id == request('channel_id'))>
                                        {{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2" id="audio_call">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Яриа бичлэг сонгох
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="cdr_id"
                                class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                <option value="">-- Яриа бичлэг сонгох --</option>
                                @foreach ($audio_calls as $audio_call)
                                    <option value="{{ $audio_call->id }}">
                                        {{ $audio_call->calldate . ' - ' . $audio_call->src . ' - ' . $audio_call->billsec . 'sec' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                        </div>
                        <div class="md:w-3/4 flex">
                            <div class="flex items-center px-8 border border-gray-200 rounded grow mr-5">
                                <input id="bordered-radio-1" type="radio" value="1" name="energy_type_id"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                <label for="bordered-radio-1"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Цахилгаан</label>
                            </div>
                            <div class="flex items-center px-8 border border-gray-200 rounded grow">
                                <input id="bordered-radio-2" type="radio" value="2" name="energy_type_id"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2">
                                <label for="bordered-radio-2"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Дулаан</label>
                            </div>
                        </div>
                    </div>


                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Гомдлын төрөл
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="complaint_type_id" id="complaint_type_id"
                                class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($complaint_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Өргөдлийн товч утга
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <select name="complaint_type_summary_id" id="complaint_type_summary_id"
                                class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                {{-- @foreach ($complaint_type_summaries as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    @if (Auth::user()->org_id == 99)
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/4">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Холбогдох ТЗЭ
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <select id="organization_id" name="second_org_id"
                                    class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="">-- ТЗЭ сонгох --</option>
                                    @foreach ($orgs as $org)
                                        <option value="{{ $org->id }}">{{ $org->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Санал, хүсэлт
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <textarea
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if ($errors->has('complaint')) border border-red-500 @else border-1 border-gray-200 @endif"
                                name="complaint" rows="3">{{ request('content') }}</textarea>
                            @error('complaint')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Файл хавсаргах (Max 5)
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <!-- Multi-File Upload Input -->
                            <div class="space-y-1">
                                <input type="file" name="files[]" id="files" multiple
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                                            file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                                <!-- Display Selected Files -->
                                <div id="fileList" class="mt-2 space-y-1"></div>

                                <!-- Error Message for Max File Limit -->
                                <p id="errorMessage" class="text-sm text-red-500 mt-1 hidden">Дээд тал нь 5 файл
                                    хавсаргах боломжтой.</p>
                                @error('files.*')
                                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- 1111-н гомдлын дугаар давхар request-р илгээх --}}
                    <input type="hidden" name="source_number" value="{{ request('number') }}">
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/4">
                        </div>
                        <div class="md:w-3/4">
                            <x-button>Хадгалах</x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

@push('scripts')

    <script type="module">
        $(document).ready(function() {

            // Datepicker select input
            flatpickr("#datetime", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                // defaultDate: new Date(),
                // defaultHour: "9",
                // defaultMinute: "00",
                locale: {
                    firstDayOfWeek: 1
                }
            });

            flatpickr("#expire_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                // defaultDate: new Date(),
                // defaultHour: "9",
                // defaultMinute: "00",
                locale: {
                    firstDayOfWeek: 1
                }
            });

            // Өргөдөл гаргагчийг сонгох
            $('#complaint_maker_type_id').change(function() {
                // Check the selected option and add/remove the class accordingly
                checkSelectedOption();
            });

            // Сонгогдсон өргөдөл гаргагчийг шалгах
            checkSelectedOption();

            // Өргөдлийн товч утга ajax аар татах
            $("input[type=radio][name=energy_type_id], #complaint_type_id").change(function() {
                // Get the selected values
                var energy_type_id = $('input[type=radio][name=energy_type_id]:checked').val();
                // console.log("energy type: ", energy_type_id);
                var complaint_type_id = $("#complaint_type_id").val();
                // console.log("complainttype: ", complaint_type_id);

                // Perform Ajax request based on the selected values
                $.ajax({
                    url: '/getTypeSummary',
                    method: 'GET',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        energy_type_id: energy_type_id,
                        complaint_type_id: complaint_type_id,
                    },
                    success: function(result) {
                        $('#complaint_type_summary_id').html(
                            '<option value="">-- Сонгох --</option>');
                        $.each(result.summaries, function(key, value) {
                            $("#complaint_type_summary_id").append('<option value="' +
                                value
                                .id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.error('Error getting summary data...');
                    }
                });
            });

            // Хэрэглэгчийн кодоор мэдээлэл татах
            $("#consumer_code").change(function() {
                var consumer_code = $(this).val();

                $.ajax({
                    url: '/getUserDataByCode',
                    method: 'GET',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        consumer_code: consumer_code,
                    },
                    success: function(result) {
                        // console.log(result);
                        if (JSON.stringify(result) !== '{}') {
                            $("#empty").addClass('hidden');
                            $("#lastname").val(result.lastname);
                            $("#firstname").val(result.firstname);
                            $("#phoneNumber").val(result.phoneNumber);
                            $("#capitalProvince").val(result.capitalProvince);
                            $("#districtsum").val(result.districtsum);
                            $("#khorooBag").val(result.khorooBag);
                            $("#mail").val(result.mail);
                            $("#complaint_maker_org_name").val(result.firstname);
                        } else {
                            $("#empty").removeClass('hidden');
                            $("#lastname").val('');
                            $("#firstname").val('');
                            $("#phoneNumber").val('');
                            $("#capitalProvince").val('');
                            $("#districtsum").val('');
                            $("#khorooBag").val('');
                            $("#mail").val('');
                            $("#complaint_maker_org_name").val('');
                        }
                    },
                    error: function(error) {
                        console.error('Error getting user data by code...');
                    }
                });
            });

            // Утсаар ярьсан бол дуудлага сонгох dropdown харуулах
            $('#channel_id').change(function() {
                var selectedStatusId = $(this).val();

                if (selectedStatusId && selectedStatusId == 2) {
                    $('#audio_call').show();
                } else {
                    $('#audio_call').hide();
                }
            });

            // Trigger change event on page load in case a channel is pre-selected
            $('#channel_id').trigger('change');

            $('#files').on('change', function() {
                const maxFiles = 5;
                const fileList = $('#fileList');
                const errorMessage = $('#errorMessage');
                const files = this.files;

                // Clear previous file list and error message
                fileList.empty();
                errorMessage.addClass('hidden');

                // Check if file count exceeds max limit
                if (files.length > maxFiles) {
                    errorMessage.text('Дээд тал нь 5 файл хавсаргах боломжтой.').removeClass('hidden');
                    this.value = ''; // Reset file input
                } else {
                    // Display selected file names
                    $.each(files, function(index, file) {
                        fileList.append('<p class="text-sm text-gray-700">' + file.name + '</p>');
                    });
                }
            });

            $('#country_id').change(function() {
                var country_id = $(this).val();
                var soumDropdown = $('#soum_district_id');

                soumDropdown.empty().append('<option value="">-- Сонгох --</option>');

                if (country_id) {
                    $.ajax({
                        url: '/soum-districts',
                        type: 'GET',
                        data: {
                            country_id: country_id
                        },
                        success: function(response) {
                            $.each(response, function(key, soum) {
                                soumDropdown.append('<option value="' + soum.id + '">' +
                                    soum.name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Алдаа гарлаа, дахин оролдоно уу!');
                        }
                    });
                }
            });

            // When a soum/district is selected
            $('#soum_district_id').change(function() {
                let soum_district_id = $(this).val();

                if (soum_district_id) {
                    $.ajax({
                        url: "/bag-khoroos", // Route for fetching bag_khoroos
                        type: "GET",
                        data: {
                            soum_district_id: soum_district_id
                        },
                        success: function(data) {
                            $('#bag_khoroo_id').empty();
                            $('#bag_khoroo_id').append(
                                '<option value="">-- Сонгох --</option>');
                            $.each(data, function(key, value) {
                                $('#bag_khoroo_id').append(
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#bag_khoroo_id').empty().append(
                        '<option value="">-- Сонгох --</option>');
                }
            });

            // function loadOrganizations() {
            //     let bagKhorooId = $('#bag_khoroo_id').val();
            //     let soumDistrictId = $('#soum_district_id').val();
            //     let countryId = $('#country_id').val();
            //     console.log("countryId=", countryId);

            //     // Show loading indicator
            //     $('#loading').show();

            //     $.ajax({
            //         url: '/organizations',
            //         type: 'GET',
            //         data: {
            //             bag_khoroo_id: bagKhorooId,
            //             soum_district_id: soumDistrictId,
            //             country_id: countryId
            //         },
            //         success: function(data) {
            //             console.log("data ", data);
            //             let organizationDropdown = $('#organization_id');
            //             organizationDropdown.empty();
            //             // organizationDropdown.append('<option value="">Байгууллага сонгох</option>');

            //             $.each(data, function(key, organization) {
            //                 organizationDropdown.append(
            //                     '<option class="bg-gray-100 p-2" value="' +
            //                     organization
            //                     .id +
            //                     '">' + organization.name + '</option>');
            //             });
            //         },
            //         complete: function() {
            //             // Hide loading indicator once request is complete
            //             $('#loading').hide();
            //         }
            //     });
            // }

            // $('#bag_khoroo_id, #soum_district_id, #country_id').change(function() {
            //     console.log("changed...");
            //     loadOrganizations();
            // });


        });

        // Сонгогдсон өргөдөл гаргагчийг шалгах функц
        function checkSelectedOption() {

            var selectedValue = $('#complaint_maker_type_id').val();

            if (selectedValue === '1') {
                $('#conditionalInput1').removeClass('hidden');
                $('#conditionalInput2').removeClass('hidden');
                $('#conditionalInput3').addClass('hidden');

            } else {
                $('#conditionalInput1').addClass('hidden');
                $('#conditionalInput2').addClass('hidden');
                $('#conditionalInput3').removeClass('hidden');
            }
        }
    </script>
