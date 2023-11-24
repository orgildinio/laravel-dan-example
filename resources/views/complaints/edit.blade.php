<x-admin-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 m-5">
                <div>
                    <h1 class="py-4 mb-2 mt-0 text-2xl font-medium leading-tight text-gray">Санал, хүсэлт
                        шинээр бүртгэх</h1>
                </div>
                <form method="POST" action="{{ route('complaint.update', $complaint->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($message = Session::get('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-2 mb-4" role="alert">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Таны овог
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none  rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('lastname')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="lastname" value="{{$complaint->lastname}}">
                            @error('lastname')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Таны нэр
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('firstname')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="firstname" value="{{$complaint->firstname}}">
                            @error('firstname')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Регистрийн дугаар
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('registerNumber')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="registerNumber" value="{{$complaint->registerNumber}}">
                            @error('registerNumber')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Холбогдох утас
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('phone')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="phone" value="{{$complaint->phone}}">
                            @error('phone')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                И-мэйл хаяг
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('email')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="email" name="email" value="{{$complaint->email}}">
                            @error('email')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                УБ/орон нутаг
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('country')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="country" value="{{$complaint->country}}">
                            @error('country')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Сум/дүүрэг
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('district')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="district" value="{{$complaint->district}}">
                            @error('district')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Баг/хороо
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('khoroo')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="khoroo" value="{{$complaint->khoroo}}">
                            @error('khoroo')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Дэлгэрэнгүй хаяг
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('addressDetail')) border border-red-500 @else border-1 border-gray-200 @endif"
                                name="addressDetail" rows="3">{{$complaint->addressDetail}}</textarea>
                            @error('addressDetail')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr />
                    <br>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                        </div>
                        <div class="md:w-2/3 flex">
                            <div class="flex items-center px-8 border border-gray-200 rounded grow mr-5">
                                <input id="bordered-radio-1" type="radio" value="1" {{ $complaint->energy_type_id == "1"
                                ? 'checked' : '' }} name="energy_type_id" class="w-4 h-4 text-blue-600 bg-gray-100
                                border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                <label for="bordered-radio-1"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Цахилгаан</label>
                            </div>
                            <div class="flex items-center px-8 border border-gray-200 rounded grow">
                                <input id="bordered-radio-2" type="radio" value="2" {{ $complaint->energy_type_id == "2"
                                ? 'checked' : '' }} name="energy_type_id" class="w-4 h-4 text-blue-600 bg-gray-100
                                border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="bordered-radio-2"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Дулаан</label>
                            </div>
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Төрөл
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="category_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($category->id==$complaint->category_id)>{{
                                    $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Гомдлын төрөл
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="complaint_type_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($complaint_types as $type)
                                <option value="{{ $type->id }}" @selected($type->id==$complaint->complaint_type_id)>{{
                                    $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Суваг
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="channel_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($channels as $channel)
                                <option value="{{ $channel->id }}" @selected($channel->id==$complaint->channel_id)>{{
                                    $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Байгууллага
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="organization_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($orgs as $org)
                                <option value="{{ $org->id }}" @selected($org->id==$complaint->organization_id)>{{
                                    $org->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Санал, хүсэлт
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('complaint')) border border-red-500 @else border-1 border-gray-200 @endif"
                                name="complaint" rows="3">{{$complaint->complaint}}</textarea>
                            @error('complaint')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Файл хавсаргах
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="block w-full text-gray-900 text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                id="inline-full-name" type="file" name="file">
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        </div>
                        <div class="md:w-2/3">
                            <x-button>Илгээх</x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>