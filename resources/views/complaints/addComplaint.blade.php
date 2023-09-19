<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Санал хүсэлт илгээх') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 m-5">
                {{-- <div class="container mx-auto mt-5 text-center">
                    <h1>Record Audio</h1>
                    <div>
                        <button id="startRecording" class="bg-blue-500 p-5 rounded text-white ml-5">Start Recording</button>
                        <button id="stopRecording" class="bg-red-500 p-5 rounded text-white" disabled>Stop Recording</button>
                    </div>
                    <div>
                        <audio controls id="recordedAudio" style="display: none;"></audio>
                    </div>
                    <form action="{{ route('complaint.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="audio_data" id="audioData">
                        <button type="submit" class="bg-black p-5 rounded m-5 text-white">Save Audio</button>
                    </form>
                </div> --}}
                <form id="submitForm" method="POST" action="{{ route('complaint.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if ($message = Session::get('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4" role="alert">
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-full-name" type="text" name="lastname" value="">
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-first-name" type="text" name="firstname" value="">
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-register-name" type="text" name="registerNumber" value="">
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-phone" type="text" name="phone" value="">
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-email" type="email" name="email" value="">
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-country" type="text" name="country" value="">
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-discrict-name" type="text" name="district" value="">
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="inline-khoroo-name" type="text" name="khoroo" value="">
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                name="addressDetail" rows="3"></textarea>
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
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                name="complaint" rows="3"></textarea>
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <option value="{{ $org->id }}">{{ $org->name }}</option>
                                @endforeach
                            </select>
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
                                id="inline-file-name" type="file" name="file">
                        </div>
                    </div>

                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Дуут мессеж илгээх
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <button id="micBtn" class="font-bold bg-gray-50 p-4 rounded-full mb-5 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                                </svg>
                            </button>
                            <ul id="playlist">
                                <li>
                                    <audio id="audio" name="audio" controls></audio>
                                </li>
                            </ul>
                            <input type="hidden" id="audio_input" />
                            <input type="file" id="audio_file_upload" name="audio_file" />
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
    <script>
        const button = document.getElementById("micBtn");
        const submitButton = document.getElementById("sbmBtn");
        const audioFile = document.getElementById('audio');
        const audioInputFile = document.getElementById('audio_input');
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
                button.classList.add("bg-red-600", "animate-pulse", "text-white");
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
                const file = new File(buffer, 'music.mp3', {
                    type: blob.type,
                    lastModified: Date.now()
                });
                console.log(URL.createObjectURL(blob));
                // audioInputFile.type = "file";
                audioInputFile.value = file;

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                audio_file_upload.files = dataTransfer.files;

                let playlist = document.getElementById('playlist');
                const li = document.createElement('li');
                const player = new Audio(URL.createObjectURL(file));
                player.controls = true;
                li.appendChild(player);
                playlist.replaceChild(li, playlist.firstElementChild);

                button.classList.remove("bg-red-600", "animate-pulse", "text-white");
                button.removeEventListener('click', stopRecording);
                button.addEventListener('click', startRecording);

            }).catch((e) => {
                console.error(e);
            });
        }

    </script>

{{-- <script>
    const startRecordingButton = document.getElementById('startRecording');
    const stopRecordingButton = document.getElementById('stopRecording');
    const recordedAudioElement = document.getElementById('recordedAudio');
    const audioDataInput = document.getElementById('audioData');
    
    let mediaRecorder;
    let audioChunks = [];

    startRecordingButton.addEventListener('click', () => {
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then((stream) => {
                mediaRecorder = new MediaRecorder(stream);
                mediaRecorder.ondataavailable = (event) => {
                    if (event.data.size > 0) {
                        audioChunks.push(event.data);
                    }
                };

                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                    const audioUrl = URL.createObjectURL(audioBlob);

                    recordedAudioElement.src = audioUrl;
                    recordedAudioElement.style.display = 'block';
                    audioDataInput.value = audioBlob;

                    startRecordingButton.disabled = true;
                    stopRecordingButton.disabled = true;
                };

                startRecordingButton.disabled = true;
                stopRecordingButton.disabled = false;

                mediaRecorder.start();
            })
            .catch((error) => {
                console.error('Error accessing microphone:', error);
            });
    });

    stopRecordingButton.addEventListener('click', () => {
        if (mediaRecorder.state === 'recording') {
            mediaRecorder.stop();
        }
    });

    

    // fetch('/complaint', {
    //     method: 'POST',
    //     body: formData,
    // })
    // .then(response => response.json())
    // .then(data => {
    //     console.log('Audio uploaded:', data);
    // })
    // .catch(error => {
    //     console.error('Error uploading audio:', error);
    // });


</script> --}}


    @endpush
</x-app-layout>