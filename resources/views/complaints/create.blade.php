<x-admin-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 m-5">
                <div>
                    <h1 class="py-4 mb-2 mt-0 text-2xl font-medium leading-tight text-gray text-center">Өргөдөл, гомдол
                        шинээр бүртгэх</h1>
                </div>
                <form method="POST" action="{{ route('complaint.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if ($message = Session::get('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-2 mb-4" role="alert">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                        </div>
                        <div class="md:w-2/3 flex">
                            <div class="flex items-center px-8 border border-gray-200 rounded grow mr-5">
                                <input checked id="bordered-radio-1" type="radio" value="1" name="complaint_maker_type_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                <label for="bordered-radio-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Иргэн</label>
                            </div>
                            <div class="flex items-center px-8 border border-gray-200 rounded grow">
                                <input id="bordered-radio-2" type="radio" value="2" name="complaint_maker_type_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2">
                                <label for="bordered-radio-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">ААН</label>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Өргөдөл гаргасан огноо
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input type="text" id="datetime" name="complaint_date" class="bg-gray-200 appearance-none  rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight border-1 border-gray-200" />
                            @error('complaint_date')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Хэрэглэгчийн код
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="consumer_code"
                                    class="bg-orange-50 appearance-none  rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight border-gray-200"
                                    type="text" name="consumer_code" value="{{old('consumer_code')}}">
                                    <span id="empty" class="hidden text-xs text-red-500">Мэдээлэл олдсонгүй</span>
                            </div>
                        </div>
                    </div>
                    <div id="conditionalInput1">
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Овог
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="lastname"
                                    class="bg-gray-200 appearance-none  rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('lastname')) border border-red-500 @else border-1 border-gray-200 @endif"
                                    type="text" name="lastname" value="{{old('lastname')}}">
                                @error('lastname')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="conditionalInput2">
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Нэр
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="firstname"
                                    class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('firstname')) border border-red-500 @else border-1 border-gray-200 @endif"
                                    type="text" name="firstname" value="{{old('firstname')}}">
                                @error('firstname')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="conditionalInput3" class="hidden">
                        <div class="hidden md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    ААН-ийн нэр
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="complaint_maker_org_name"
                                    class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('complaint_maker_org_name')) border border-red-500 @else border-1 border-gray-200 @endif"
                                    type="text" name="complaint_maker_org_name" value="{{old('complaint_maker_org_name')}}">
                                @error('complaint_maker_org_name')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Регистрийн дугаар
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('registerNumber')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="registerNumber" value="{{old('registerNumber')}}">
                            @error('registerNumber')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Холбогдох утас
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input id="phoneNumber"
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('phone')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="phone" value="{{old('phone')}}">
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
                            <input id="mail"
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('email')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="email" name="email" value="{{old('email')}}">
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
                            <input id="capitalProvince"
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('country')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="country" value="{{old('country')}}">
                            {{-- <select name="aimag_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($aimags as $aimag)
                                <option value="{{ $aimag->id }}">{{ $aimag->name }}</option>
                                @endforeach
                            </select> --}}
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
                            <input id="districtsum"
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('district')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="district" value="{{old('district')}}">
                            {{-- <select name="soum_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($soums as $soum)
                                <option value="{{ $soum->id }}">{{ $soum->name }}</option>
                                @endforeach
                            </select> --}}
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
                            <input id="khorooBag"
                                class="bg-gray-200 appearance-none rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight @if($errors->has('khoroo')) border border-red-500 @else border-1 border-gray-200 @endif"
                                type="text" name="khoroo" value="{{old('khoroo')}}">
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
                                name="addressDetail" rows="3">{{old('addressDetail')}}</textarea>
                            @error('addressDetail')
                            <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <hr />
                    <br>
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                        </div>
                        <div class="md:w-2/3 flex">
                            <div class="flex items-center px-8 border border-gray-200 rounded grow mr-5">
                                <input id="bordered-radio-1" type="radio" value="1" name="energy_type_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                <label for="bordered-radio-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Цахилгаан</label>
                            </div>
                            <div class="flex items-center px-8 border border-gray-200 rounded grow">
                                <input id="bordered-radio-2" type="radio" value="2" name="energy_type_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2">
                                <label for="bordered-radio-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Дулаан</label>
                            </div>
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
                            <select name="complaint_type_id" id="complaint_type_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($complaint_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Өргөдлийн товч утга
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="complaint_type_summary_id" id="complaint_type_summary_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                {{-- @foreach ($complaint_type_summaries as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    
                    {{-- <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Холбогдох ТЗЭ
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="organization_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($orgs as $org)
                                <option value="{{ $org->id }}">{{ $org->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
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
                                name="complaint" rows="3">{{old('complaint')}}</textarea>
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
                            <x-button>Хадгалах</x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#datetime", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            // defaultDate: new Date(),
            defaultHour: "9",
            defaultMinute: "00",
        });
    });

    var radioButtons = document.querySelectorAll('input[name="complaint_maker_type_id"]');
    // var conditionalInput = document.getElementById('conditionalInput');

    radioButtons.forEach(function(radioButton) {
        radioButton.addEventListener('change', function() {

            var selectedValue = radioButton.value;

            // Show or hide input fields based on the selected value
            document.getElementById('conditionalInput1').classList.toggle('hidden', selectedValue !== '1');
            document.getElementById('conditionalInput2').classList.toggle('hidden', selectedValue !== '1');
            document.getElementById('conditionalInput3').classList.toggle('hidden', selectedValue == '1');

        });
    });
    //Өргөдлийн товч утга татах

    // // Attach the change event handler to the select element
    // $("input[name='energy_type_id']").on('change', function() {
    //     // Get the selected value
    //     updateFetchData();

    // });
    // $('#complaint_type_id').on('change', function() {
    //     // Get the selected value
    //     updateFetchData();

    // });
    // // Function to update the selected values
    // function updateFetchData() {
    //     // Get the selected values from both select boxes
    //     var selectedEnergyTypeId = $('#selectBox1').val();
    //     var selectedValue2 = $('#selectBox2').val();

    //     // Display the selected values (you can replace this with your own logic)
    //     $('#selectedValues').text('Selected Value 1: ' + selectedValue1 + '\nSelected Value 2: ' + selectedValue2);
    // }

    $("input[name='energy_type_id']").change(function(){
        if( $(this).is(":checked") ){
            var energy_type_id = $(this).val();
        }
        if($("#complaint_type_id").val() ==null){
            var complaint_type_id = null;
        }else{
            var complaint_type_id=$("#complaint_type_id").val();
        }
        console.log(complaint_type_id);

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
    })

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

</script>