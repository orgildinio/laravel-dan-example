<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-1">
        <div class="flex items-center justify-between mb-4">
            <div class="w-full mt-7 grid grid-cols-4 gap-4">
                
                <div class="col-span-1 self-start sticky top-0 mr-4 p-6 bg-gray-50 shadow text-sm">
                    <h1 class="text-black font-bold mb-4 text-lg">Гомдол гаргасан:</h1>
                    <dl class="max-w-md text-gray-900 divide-y divide-gray-200">
                        <div class="flex flex-col pb-3">
                            <dt class="mb-1 text-gray-500">Овог нэр</dt>
                            <dd class="font-semibold">{{mb_substr($complaint->lastname,
                                0, 1)}}.{{$complaint->firstname}}</dd>
                        </div>
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-gray-500">Регистр</dt>
                            <dd class="font-semibold">{{$complaint->registerNumber}}</dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500">Утас</dt>
                            <dd class="font-semibold">{{$complaint->phone}}</dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500">И-мэйл</dt>
                            <dd class="font-semibold">{{$complaint->email}}</dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500">Хаяг</dt>
                            <dd class="font-semibold">{{$complaint->addressDetail}}</dd>
                        </div>
                    </dl>
                </div>
                
                <div class="col-span-3 mb-7 bg-white p-6 shadow rounded">
                    @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                        role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="flex items-center border-b border-gray-200  pb-6">

                        <div class="flex items-center justify-center h-16 w-16 bg-red-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 rounded-full text-red-700" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                            </svg>
                        </div>

                        <div class="flex items-start justify-between w-full">
                            <div class="pl-3">
                                <p tabindex="0" class="focus:outline-none text-xl font-medium leading-5 text-gray-800 ">
                                    {{$complaint->category->name}} - №{{$complaint->id}}</p>
                                <p tabindex="0" class="focus:outline-none text-sm leading-normal pt-2 text-gray-500">
                                    {{$complaint->created_at}}</p>
                                <p class="text-sm my-1"><span
                                        class="bg-gray-300 p-1 rounded">{{$complaint->organization?->name}}</span> {{$complaint->status?->name}}</p>
                            </div>
                            <div role="img" aria-label="bookmark">
                                <div>
                                    <livewire:complaint-step :complaint="$complaint" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        {{-- <h6 class="text-sm font-bold text-gray pt-4">Гомдол мэдүүлсэн: {{mb_substr($complaint->lastname,
                            0, 1)}}.{{$complaint->firstname}}</h6> --}}
                        <p tabindex="0" class="focus:outline-none text-sm leading-5 py-4 text-gray-600 text-justify">
                            {{$complaint->complaint}}</p>
                        
                    </div>

                    <div>
                        @if ($complaint->audio_file_id != null)
                        <div class="text-sm px-2">
                            <p>Бичлэг</p>
                            <audio controls class="w-full">
                                <source src="/files/{{$complaint->audioFile?->filename}}" type="audio/mpeg">
                                Your browser does not support the audio tag.
                            </audio>
                        </div>
                        @endif

                        <br>

                        @if ($complaint->file_id != null)
                        <div class="py-5 px-2">
                            <p>Файл</p>
                            <a href="/files/{{$complaint->file?->filename}}" target="_blank">
                                <div
                                    class="group text-sm border-transparent border-2 bg-green-50 hover:bg-white hover:border-indigo-600 w-40">
                                    <div class="mx-16 my-10">
                                        <i class="fa-solid fa-file-lines fa-3x group-hover:hidden"></i>
                                        <i class="fa-solid fa-download fa-3x hidden group-hover:block"></i>
                                    </div>
                                </div>
                            </a>
                            <div>
                                <p>{{mb_substr($complaint->file?->filename, 0, 10)}}...
                                    .{{pathinfo($complaint->file?->filename, PATHINFO_EXTENSION)}}</p>
                            </div>
                        </div>
                        @endif

                        
                    </div>

                    <div class="flex items-center border-t border-gray-200  p-6 m-6">

                        <ol class="relative text-gray-500 border-l border-gray-200">
                            @foreach($complaint_steps as $step)
                            <li class="mb-10 ml-6">
                                <div class="flex justify-start items-start">
                                    <div class="flex items-center justify-center w-10 h-10 bg-blue-200 rounded-full">
                                        <i class="fa-regular fa-user"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm"><span class="text-black bg-gray-300 p-1 rounded">{{$step->org?->name}}</span> {{$step->status?->name}}</p>
                                        <p class="text-sm">{{$step->sent_date}}</p>
                                        <p class="text-sm mt-5">{{$step->desc}}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ol>

                    </div>
                </div>
            </div>
        </div>

</x-admin-layout>