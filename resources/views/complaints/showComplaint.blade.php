<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="shadow rounded-lg  2xl:col-span-1">
            <div class="flex items-center justify-between mb-4">
                <div class="lg:flex items-center justify-center w-full my-7">
                    <div tabindex="0" aria-label="card 1"
                        class="focus:outline-none lg:w-full lg:mb-0 mb-8 bg-white  p-6 shadow rounded">
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
                                <div class="pl-3 w-full">
                                    <p tabindex="0" class="focus:outline-none text-xl font-medium leading-5 text-gray-800 ">
                                        {{$complaint->category->name}} - №{{$complaint->id}}</p>
                                    <p tabindex="0" class="focus:outline-none text-sm leading-normal pt-2 text-gray-500">
                                        {{$complaint->created_at}}</p>
                                    <p class="text-sm my-1"><span
                                            class="bg-gray-300 p-1 rounded">{{$complaint->organization->name}} {{$complaint->status->name}}.</span></p>
                                </div>
                                <div role="img" aria-label="bookmark">
                                    <svg class="focus:outline-none text-gray-800" width="28" height="28" viewBox="0 0 28 28"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.5001 4.66667H17.5001C18.1189 4.66667 18.7124 4.9125 19.15 5.35009C19.5876 5.78767 19.8334 6.38117 19.8334 7V23.3333L14.0001 19.8333L8.16675 23.3333V7C8.16675 6.38117 8.41258 5.78767 8.85017 5.35009C9.28775 4.9125 9.88124 4.66667 10.5001 4.66667Z"
                                            stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="px-2">
                            <h6 class="text-sm font-bold text-gray pt-4">Гомдол мэдүүлсэн: {{mb_substr($complaint->lastname,
                                0, 1)}}.{{$complaint->firstname}}</h6>
                            <p tabindex="0"
                                class="focus:outline-none text-sm leading-5 py-4 text-gray-600 text-justify border-b-2 border-gray-100 mb-5">
                                {{$complaint->complaint}}</p>
    
    
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
                            {{-- <div tabindex="0" class="focus:outline-none flex">
                                <div>
                                    <livewire:complaint-step :complaint="$complaint" />
                                </div>
                            </div> --}}
    
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
                                            <p class="text-sm text-black bg-gray-300 p-1 rounded">{{$step->org?->name}} руу
                                                шилжүүлсэн</p>
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
        </div>
    </div>

</x-app-layout>