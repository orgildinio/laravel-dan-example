<x-admin-layout>
    <div class="py-4">
        <div class="w-full mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div>
                    <h1 class="py-4 mb-2 mt-0 text-2xl font-medium leading-tight text-gray text-center">Өргөдөл, гомдол
                        засварлах</h1>
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
                                <option value="{{ $type->id }}" @selected($type->id==$complaint->complaint_maker_type_id)>{{
                                    $type->name }}</option>
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
                                <svg class="w-4 h-4 text-gray-500" viewBox="-0.5 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" fill-rule="evenodd" d="M61,154.006845 C61,153.45078 61.4499488,153 62.0068455,153 L73.9931545,153 C74.5492199,153 75,153.449949 75,154.006845 L75,165.993155 C75,166.54922 74.5500512,167 73.9931545,167 L62.0068455,167 C61.4507801,167 61,166.550051 61,165.993155 L61,154.006845 Z M62,157 L74,157 L74,166 L62,166 L62,157 Z M64,152.5 C64,152.223858 64.214035,152 64.5046844,152 L65.4953156,152 C65.7740451,152 66,152.231934 66,152.5 L66,153 L64,153 L64,152.5 Z M70,152.5 C70,152.223858 70.214035,152 70.5046844,152 L71.4953156,152 C71.7740451,152 72,152.231934 72,152.5 L72,153 L70,153 L70,152.5 Z" transform="translate(-61 -152)"/>
                                  </svg>
                            </div>
                            <input type="text" id="datetime" name="complaint_date"
                                value="{{ $complaint->complaint_date }}"
                                class="bg-gray-100 appearance-none  rounded w-full py-2 px-10 text-gray-700 text-sm leading-tight border-1 border-gray-200" />
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
                                <svg class="w-4 h-4 text-gray-500" viewBox="-0.5 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" fill-rule="evenodd" d="M61,154.006845 C61,153.45078 61.4499488,153 62.0068455,153 L73.9931545,153 C74.5492199,153 75,153.449949 75,154.006845 L75,165.993155 C75,166.54922 74.5500512,167 73.9931545,167 L62.0068455,167 C61.4507801,167 61,166.550051 61,165.993155 L61,154.006845 Z M62,157 L74,157 L74,166 L62,166 L62,157 Z M64,152.5 C64,152.223858 64.214035,152 64.5046844,152 L65.4953156,152 C65.7740451,152 66,152.231934 66,152.5 L66,153 L64,153 L64,152.5 Z M70,152.5 C70,152.223858 70.214035,152 70.5046844,152 L71.4953156,152 C71.7740451,152 72,152.231934 72,152.5 L72,153 L70,153 L70,152.5 Z" transform="translate(-61 -152)"/>
                                  </svg>
                            </div>
                            <input type="text" id="expire_date" name="expire_date"
                                value="{{ $complaint->expire_date }}"
                                class="bg-gray-100 appearance-none  rounded w-full py-2 px-10 text-gray-700 text-sm leading-tight border-1 border-gray-200" />
                            @error('expire_date')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div id="conditionalInput1">
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/4">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Овог
                                </label>
                            </div>
                            <div class="md:w-3/4">
                                <input
                                    class="bg-gray-100 appearance-none  rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('lastname')) border border-red-500 @else border-1 border-gray-200 @endif"
                                    type="text" name="lastname" value="{{$complaint->lastname}}">
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
                                <input
                                    class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('firstname')) border border-red-500 @else border-1 border-gray-200 @endif"
                                    type="text" name="firstname" value="{{$complaint->firstname}}">
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
                                    class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('complaint_maker_org_name')) border border-red-500 @else border-1 border-gray-200 @endif"
                                    type="text" name="complaint_maker_org_name"
                                    value="{{$complaint->complaint_maker_org_name}}">
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
                            <input
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('phone')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="phone" value="{{$complaint->phone}}">
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
                            <input
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('email')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="email" name="email" value="{{$complaint->email}}">
                            @error('email')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                УБ/орон нутаг
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('country')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="country" value="{{$complaint->country}}">
                            @error('country')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Сум/дүүрэг
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('district')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="district" value="{{$complaint->district}}">
                            @error('district')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Баг/хороо
                            </label>
                        </div>
                        <div class="md:w-3/4">
                            <input
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('khoroo')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="khoroo" value="{{$complaint->khoroo}}">
                            @error('khoroo')
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
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('addressDetail')) border border-red-500 @else border-1 border-gray-200 @endif"
                                name="addressDetail" rows="3">{{$complaint->addressDetail}}</textarea>
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
                                <option value="{{ $category->id }}" @selected($category->id==$complaint->category_id)>{{
                                    $category->name }}</option>
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
                                <option value="{{ $channel->id }}" @selected($channel->id==$complaint->channel_id)>{{
                                    $channel->name }}</option>
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
                                @foreach ($audio_calls as $audio_call)
                                <option value="{{ $audio_call->id }}" @selected($audio_call->id==$complaint->cdr_id)>{{ $audio_call->calldate . ' - ' . $audio_call->src . ' - ' . $audio_call->billsec . 'sec' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                        </div>
                        <div class="md:w-3/4 flex">
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
                                <option value="{{ $type->id }}" @selected($type->id==$complaint->complaint_type_id)>{{
                                    $type->name }}</option>
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
                                <option value='{{ $complaint->complaint_type_summary_id }}'>{{$complaint->complaintTypeSummary?->name}}</option>
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
                            <select name="second_org_id"
                                class="bg-gray-100 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                <option value="">-- ТЗЭ сонгох --</option>
                                @foreach ($orgs as $org)
                                <option value="{{ $org->id }}" @selected($org->id==$complaint->second_org_id)>{{
                                    $org->name }}</option>
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
                                class="bg-gray-100 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('complaint')) border border-red-500 @else border-1 border-gray-200 @endif"
                                name="complaint" rows="3">{{$complaint->complaint}}</textarea>
                            @error('complaint')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/4">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Файл хавсаргах
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
                                <p id="errorMessage" class="text-sm text-red-500 mt-1 hidden">Дээд тал нь 5 файл хавсаргах боломжтой.</p>
                                @error('files.*')
                                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
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
        });
        flatpickr("#expire_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
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
            console.log("energy: ", energy_type_id);
            var complaint_type_id=$("#complaint_type_id").val();
            console.log("type: ", complaint_type_id);

            // Perform Ajax request based on the selected values
            $.ajax({
                url: '/getTypeSummary',
                method: 'GET',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    energy_type_id: energy_type_id,
                    complaint_type_id: complaint_type_id,
                },
                success: function (result) {
                    $('#complaint_type_summary_id').html('<option value="">-- Сонгох --</option>');
                    $.each(result.summaries, function (key, value) {
                        $("#complaint_type_summary_id").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                },
                error: function(error) {
                    console.error('Error getting summary data...');
                }
            });
        });

        // Хэрэглэгчийн кодоор мэдээлэл татах
        $("#consumer_code").change(function(){
            var consumer_code = $(this).val();

            $.ajax({
                    url: '/getUserDataByCode',
                    method: 'GET',
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        consumer_code: consumer_code,
                    },
                    success: function (result) {
                        // console.log(result);
                        if(JSON.stringify(result) !== '{}'){
                            $("#empty").addClass('hidden');
                            $("#lastname").val(result.lastname);
                            $("#firstname").val(result.firstname);
                            $("#phoneNumber").val(result.phoneNumber);
                            $("#capitalProvince").val(result.capitalProvince);
                            $("#districtsum").val(result.districtsum);
                            $("#khorooBag").val(result.khorooBag);
                            $("#mail").val(result.mail);
                            $("#complaint_maker_org_name").val(result.firstname);
                        }else{
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
        })

        // Утсаар ярьсан бол дуудлага сонгох dropdown харуулах
        $('#channel_id').change(function () {
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