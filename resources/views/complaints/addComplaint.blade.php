<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Өргөдөл, гомдол илгээх') }}
        </h2>
    </x-slot>



    <div class="py-8 bg-slate-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 m-5">
                <h1 class="text-center text-2xl font-bold text-gray-900 mb-10">Өргөдөл, гомдол илгээх</h1>

                <div class="container mx-auto">
                    @if ($message = Session::get('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>

                <form id="submitForm" method="POST" action="{{ route('complaint.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if (Auth::user()->companyName != null)
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Байгууллагын нэр
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                    id="inline-full-name" type="text" name="companyName"
                                    value="{{ isset($danUser->companyName) ? $danUser->companyName : '' }}" disabled>
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Регистрийн дугаар
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                    id="inline-register-name" type="text" name="companyRegnum"
                                    value="{{ isset($danUser->companyRegnum) ? $danUser->companyRegnum : '' }}"
                                    disabled>
                            </div>
                        </div>
                    @else
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Таны овог
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                    id="inline-full-name" type="text" name="lastname"
                                    value="{{ isset($danUser->danLastname) ? $danUser->danLastname : '' }}" disabled>
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Таны нэр
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                    id="inline-first-name" type="text" name="firstname"
                                    value="{{ isset($danUser->danFirstname) ? $danUser->danFirstname : '' }}" disabled>
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Регистрийн дугаар
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                    id="inline-register-name" type="text" name="registerNumber"
                                    value="{{ isset($danUser->danRegnum) ? $danUser->danRegnum : '' }}" disabled>
                            </div>
                        </div>
                    @endif
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Холбогдох утас
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-50 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-phone" type="text" name="phone"
                                value="{{ isset($danUser->phone) ? $danUser->phone : '' }}">
                            @error('phone')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                И-мэйл хаяг
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-50 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-email" type="email" name="email"
                                value="{{ isset($danUser->email) ? $danUser->email : '' }}">
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                УБ/орон нутаг
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-country" type="text" name="country"
                                value="{{ isset($danUser->danAimagCityName) ? $danUser->danAimagCityName : '' }}"
                                disabled>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Сум/дүүрэг
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-discrict-name" type="text" name="district"
                                value="{{ isset($danUser->danSoumDistrictName) ? $danUser->danSoumDistrictName : '' }}"
                                disabled>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Баг/хороо
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-khoroo-name" type="text" name="khoroo"
                                value="{{ isset($danUser->danBagKhorooName) ? $danUser->danBagKhorooName : '' }}"
                                disabled>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Дэлгэрэнгүй хаяг
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea
                                class="bg-gray-50 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                name="addressDetail" rows="3">{{ isset($danUser->danPassportAddress) ? $danUser->danPassportAddress : '' }}</textarea>
                        </div>
                    </div>
                    <hr />
                    <br>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Төрөл
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="category_id"
                                class="bg-gray-50 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                        </div>
                        <div class="md:w-2/3 flex">
                            <div class="flex items-center px-8 border border-gray-200 rounded grow mr-5">
                                <input id="bordered-radio-1" type="radio" value="1" name="energy_type_id"
                                    class="w-4 h-4 text-blue-600 bg-gray-50 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                <label for="bordered-radio-1"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Цахилгаан</label>
                            </div>
                            <div class="flex items-center px-8 border border-gray-200 rounded grow">
                                <input id="bordered-radio-2" type="radio" value="2" name="energy_type_id"
                                    class="w-4 h-4 text-blue-600 bg-gray-50 border-gray-300 focus:ring-blue-500  focus:ring-2">
                                <label for="bordered-radio-2"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Дулаан</label>
                            </div>
                        </div>
                    </div>
                    @error('energy_type_id')
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                            </div>
                            <div class="md:w-2/3 flex">
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            </div>
                        </div>
                    @enderror

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Гомдлын төрөл
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="complaint_type_id" id="complaint_type_id"
                                class="bg-gray-50 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                @foreach ($complaint_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('complaint_type_id')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Өргөдлийн товч утга
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="complaint_type_summary_id" id="complaint_type_summary_id"
                                class="bg-gray-50 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                            </select>
                            @error('complaint_type_summary_id')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Create a div to hold the map -->
                    {{-- <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-570 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Байршил сонгох
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <div id="map" style="height: 400px;"></div>
                        </div>
                    </div> --}}


                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Холбогдох ТЗЭ
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select name="organization_id" id="sel_org"
                                class="bg-gray-50 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                {{-- <option value='0'>-- онгох --</option> --}}
                                {{-- @foreach ($orgs as $org)
                                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                                @endforeach --}}
                            </select>
                            @error('organization_id')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Санал, хүсэлт
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea
                                class="bg-gray-50 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                name="complaint" rows="3"></textarea>
                            @error('complaint')
                                <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Файл хавсаргах
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="block w-full text-gray-900 text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                id="inline-file-name" type="file" name="file">
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Дуут мессеж илгээх
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <div class="flex justify-start items-center">
                                <div class="m-5">
                                    <button id="micBtn" class="font-bold bg-gray-50 p-4 rounded-full shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="m-5">
                                    <ul id="playlist">
                                        <li>
                                            <audio id="audio" name="audio" controls></audio>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="audio_record">
                                <input type="file" id="audio_file_upload" name="audio_file" />
                            </div>
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        </div>
                        <div class="md:w-2/3">
                            <x-button id="sbmBtn">Илгээх</x-button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @push('scripts')
        <script type="module">
            const button = document.getElementById("micBtn");
            const submitButton = document.getElementById("sbmBtn");
            const audioFile = document.getElementById('audio');
            // const audioInputFile = document.getElementById('audio_input');
            const audio_file_upload = document.getElementById('audio_file_upload');

            // const form = document.getElementById("submitForm");
            // const data = new FormData(form);

            const recorder = new MicRecorder({
                bitRate: 128
            });

            button.addEventListener("click", startRecording);
            // submitButton.addEventListener("click", submitFormData);

            function startRecording(event) {
                event.preventDefault();

                console.log("Record started...")
                recorder
                    .start()
                    .then(() => {
                        console.log("record start...");
                        button.classList.add("bg-red-600", "animation-pulse", "text-white");
                        button.removeEventListener("click", startRecording);
                        button.addEventListener("click", stopRecording);
                    })
                    .catch((e) => {
                        console.error(e);
                    });
            }

            function stopRecording(event) {
                event.preventDefault();

                recorder.stop().getMp3().then(([buffer, blob]) => {
                    // console.log(buffer);
                    const file = new File(buffer, 'record.mp3', {
                        type: blob.type,
                        lastModified: Date.now()
                    });
                    console.log(URL.createObjectURL(blob));
                    // audioInputFile.type = "file";
                    // audioInputFile.value = file;

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    audio_file_upload.files = dataTransfer.files;

                    let playlist = document.getElementById('playlist');
                    const li = document.createElement('li');
                    const player = new Audio(URL.createObjectURL(file));
                    player.controls = true;
                    li.appendChild(player);
                    playlist.replaceChild(li, playlist.firstElementChild);

                    button.classList.remove("bg-red-600", "animation-pulse", "text-white");
                    button.removeEventListener('click', stopRecording);
                    button.addEventListener('click', startRecording);

                }).catch((e) => {
                    console.error(e);
                });
            }

            // Initialize the map
            // var map = L.map('map').setView([47.93077880351261, 106.91095779606707], 12);
            // var popup = L.popup();
            // var marker;

            // // Set up the OSM layer
            // L.tileLayer(
            // 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
            // ).addTo(map);


            // // Add a click event listener to the map
            // map.on('click', function(e) {
            //     // Retrieve the clicked coordinates
            //     var lat = e.latlng.lat;
            //     var lng = e.latlng.lng;

            //     // Now, you can send these coordinates to your Laravel backend
            //     // using AJAX or any other method.
            //     sendCoordinates(lat, lng);
            //     if (marker) { // check
            //         map.removeLayer(marker); // remove old layers
            //     }
            //     marker = new L.Marker([e.latlng.lat, e.latlng.lng]).addTo(map);
            //     // popup.setLatLng(e.latlng)
            //     //     .setContent(e.latlng.toString())
            //     //     .openOn(map);
            //     // console.log(lat, lng);
            // });

            // function sendCoordinates(lat, lng) {
            //     // Use AJAX to send the coordinates to your Laravel backend
            //     $.ajax({
            //         url: '/getOrg',
            //         method: 'POST',
            //         headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            //         data: {
            //             lat: lat,
            //             lng: lng
            //         },
            //         success: function(response) {
            //             resetInput();
            //             console.log('Coordinates saved successfully', response);
            //             // var len = 0;
            //             //  if(response != null){
            //             //       var id = response.id;
            //             //       var name = response.name;
            //             //       var option = "<option value='"+id+"'>"+name+"</option>";
            //             //       $("#sel_org").append(option); 
            //             //  }
            //         },
            //         error: function(error) {
            //             console.error('Error getting org data...');
            //         }
            //     });
            // }
            // function resetInput(){
            //     var x = document.getElementById("sel_org");
            //     x.remove(x.selectedIndex);
            // }

            $(document).ready(function() {

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

                    $.ajax({
                        url: '/getOrgByEnergyTypeId',
                        method: 'GET',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            energy_type_id: energy_type_id,
                        },
                        success: function(result) {
                            // console.log("orgs: ", result);
                            $('#sel_org').html('<option value="">-- Сонгох --</option>');
                            $.each(result.orgs, function(key, value) {
                                $("#sel_org").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        },
                        error: function(error) {
                            console.error('Error getting org data...');
                        }
                    });
                });

            });
        </script>
    @endpush
</x-app-layout>
