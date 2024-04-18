<x-app-layout>
    <div class="w-full bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <button onclick="window.history.back()" type="button"
                class="w-full flex items-center justify-center px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto hover:bg-gray-300">
                <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>Буцах</span>
            </button>
            <div class="rounded-lg  2xl:col-span-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="lg:flex items-center justify-center w-full my-7">
                        <div tabindex="0" aria-label="card 1"
                            class="focus:outline-none lg:w-full lg:mb-0 mb-8 bg-white p-6 shadow-lg rounded">
                            <div class="flex items-center">
                                <div class="flex items-start justify-between w-full">
                                    <div class="pl-3">
                                        <p class="focus:outline-none text-xl font-medium leading-5 text-gray-800 ">
                                            {{ $complaint->category->name }} - №{{ $complaint->serial_number }}</p>
                                        <p class="focus:outline-none text-sm leading-normal pt-2 text-gray-500">
                                            {{ $complaint->created_at }}</p>
                                        {{-- <p class="text-sm my-1 bg-gray-200 text-primary font-bold p-1 rounded">
                                            {{ $complaint->organization?->name }} - {{ $complaint->status?->name }}</p> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 pb-2 border-b-2">
                                <span
                                    class="text-blue-900 bg-blue-100 text-sm py-1 px-2 m-2 mr-2 rounded-md">{{ $complaint->channel?->name }}</span>
                                <span
                                    class="text-blue-900 bg-blue-100 text-sm py-1 px-2 m-2 mr-2 rounded-md">{{ $complaint->energyType?->name }}</span>
                                @if ($complaint->complaintMakerType)
                                    <span
                                        class="text-blue-900 bg-blue-100 text-sm py-1 px-2 m-2 mr-2 rounded-md">{{ $complaint->complaintMakerType?->name }}</span>
                                @endif
                                @if ($complaint->complaintTypeSummary)
                                    <span
                                        class="text-blue-900 bg-blue-100 text-sm py-1 px-2 m-2 mr-2 rounded-md">{{ $complaint->complaintTypeSummary?->name }}</span>
                                @endif
                            </div>

                            <div class="px-2">
                                <p tabindex="0"
                                    class="focus:outline-none p-4 bg-slate-100 shadow-inner rounded text-slate-700 text-justify mt-4">
                                    {{ $complaint->complaint }}</p>
                                <div class="flex space-x-4 py-4">

                                    <div>
                                        @if ($complaint->file_id != null)
                                        <div x-data="{ modelOpen: false }">
                                                <div @click="modelOpen =!modelOpen"
                                                    class="w-70 flex items-center py-2.5 px-2 border-2 border-gray-300 rounded-lg hover:bg-gray-200">
                                                    <div class="flex items-center">
                                                        <div class="w-10 flex items-center justify-center">
                                                            @switch(pathinfo($complaint->file?->filename,
                                                                PATHINFO_EXTENSION))
                                                                @case('pdf')
                                                                    <img src="{{ asset('/image/pdf-icon.svg') }}" class="w-6 h-6"
                                                                        alt="png">
                                                                @break
    
                                                                @case('png')
                                                                    <img src="{{ asset('/image/png-icon.svg') }}" class="w-6 h-6"
                                                                        alt="png">
                                                                @break
    
                                                                @case('jpg')
                                                                    <img src="{{ asset('/image/jpg-icon.svg') }}" class="w-6 h-6"
                                                                        alt="png">
                                                                @break
    
                                                                @case('zip')
                                                                    <img src="{{ asset('/image/zip-icon.svg') }}" class="w-6 h-6"
                                                                        alt="png">
                                                                @break
    
                                                                @default
                                                                    <img src="{{ asset('/image/zip-icon.svg') }}" class="w-6 h-6"
                                                                        alt="png">
                                                            @endswitch
                                                        </div>
                                                        <div class="w-48 ml-2 flex flex-col">
                                                            <a href="#"
                                                                class="text-sm text-gray-700 font-bold truncate">{{ substr($complaint->file?->filename, 0, 10) }}.{{ pathinfo($complaint->file?->filename, PATHINFO_EXTENSION) }}</a>
                                                            <span class="text-gray-500 text-xs">{{$fileSizeInKilobytes}} KB</span>
                                                        </div>
                                                    </div>
                                                    <a href="/files/{{ $complaint->file?->filename }}" download
                                                        class="w-6 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="text-gray-500 hover:text-gray-600 h-6 w-6" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            
                                                <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                                        <div x-cloak @click="modelOpen = false" x-show="modelOpen" 
                                                            x-transition:enter="transition ease-out duration-300 transform"
                                                            x-transition:enter-start="opacity-0" 
                                                            x-transition:enter-end="opacity-100"
                                                            x-transition:leave="transition ease-in duration-200 transform"
                                                            x-transition:leave-start="opacity-100" 
                                                            x-transition:leave-end="opacity-0"
                                                            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                                                        ></div>
                                            
                                                        <div x-cloak x-show="modelOpen" 
                                                            x-transition:enter="transition ease-out duration-300 transform"
                                                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave="transition ease-in duration-200 transform"
                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                            class="inline-block w-full max-w-xl p-6 mt-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                                                        >
                                                            <div class="flex items-center justify-between space-x-2 mb-4">
                                                                <h1 class="text-xl font-medium text-gray-800 ">Хавсралт файл</h1>
                                            
                                                                <button @click="modelOpen = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                            <hr>

                                                            @if ($file_ext == 'pdf')
                                                                <iframe class="pdf" class="w-full min-h-full"
                                                                        src="{{ asset($file_url) }}"
                                                                    width="100%" height="600">
                                                                </iframe>
                                                            @else
                                                                <img class="w-full h-full lg:max-w-3xl" src="{{ asset($file_url) }}" alt="file">
                                                            @endif
                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($complaint->audio_file_id != null)
                                            <div class="text-sm px-2">
                                                <p>Бичлэг</p>
                                                <audio controls class="w-full">
                                                    <source src="/files/{{ $complaint->audioFile?->filename }}"
                                                        type="audio/mpeg">
                                                    Your browser does not support the audio tag.
                                                </audio>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            {{-- Шийдвэрлэлтийн явц --}}

                            <!-- component -->
                            <section class="relative flex flex-col justify-center bg-white overflow-hidden border-t-2">
                                <div class="w-full">
                                    <div class="flex flex-col justify-center divide-y divide-slate-200 [&>*]:py-16">
                                        <div class="w-full max-w-4xl mx-auto">
                                            <div
                                                class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-[8.75rem] md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">

                                                @foreach ($complaint_steps as $step)
                                                    <div class="relative">
                                                        <div class="md:flex items-center md:space-x-4 mb-3">
                                                            <div
                                                                class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                                                <!-- Icon -->
                                                                <div
                                                                    class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-100 shadow border md:order-1">
                                                                    @if ($step->status_id == 2)
                                                                        <svg class="fill-emerald-600"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16">
                                                                            <path
                                                                                d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                                        </svg>
                                                                    @elseif ($step->status_id == 6)
                                                                        <svg class="fill-red-500"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16">
                                                                            <path
                                                                                d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                                        </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16">
                                                                            <path class="fill-slate-300"
                                                                                d="M14.853 6.861C14.124 10.348 10.66 13 6.5 13c-.102 0-.201-.016-.302-.019C7.233 13.618 8.557 14 10 14c.51 0 1.003-.053 1.476-.143L14.2 15.9a.499.499 0 0 0 .8-.4v-3.515c.631-.712 1-1.566 1-2.485 0-.987-.429-1.897-1.147-2.639Z" />
                                                                            <path class="fill-slate-500"
                                                                                d="M6.5 0C2.91 0 0 2.462 0 5.5c0 1.075.37 2.074 1 2.922V11.5a.5.5 0 0 0 .8.4l1.915-1.436c.845.34 1.787.536 2.785.536 3.59 0 6.5-2.462 6.5-5.5S10.09 0 6.5 0Z" />
                                                                        </svg>
                                                                    @endif
                                                                </div>
                                                                <!-- Date -->
                                                                <time
                                                                    class="text-sm text-right font-medium text-indigo-500 md:w-28">{{ $step->sent_date }}</time>
                                                            </div>
                                                            <!-- Title -->
                                                            <div class="text-slate-500 ml-14"><span
                                                                    class="text-slate-900 font-bold">{{ $step->org?->name }}
                                                                </span><span
                                                                    class="text-blue-900 bg-blue-100 px-2 py-1 rounded-lg text-sm">{{ $step->status?->name }}</span>
                                                            </div>
                                                        </div>
                                                        <!-- Card -->
                                                        <div class="ml-14 md:ml-44">
                                                            <div
                                                                class="p-4 bg-slate-100 shadow-inner rounded border border-slate-200 text-slate-700">
                                                                {{ $step->desc }}
                                                            </div>

                                                            @if ($step->file_id != null)
                                                                @php
                                                                    if ($step->file_id != null) {
                                                                        $file_url = 'files/' . $step->file?->filename; // Example dynamic image URL
                                                                        $file_ext = pathinfo($step->file?->filename, PATHINFO_EXTENSION);
                                                                        $fileSizeInBytes = filesize(public_path($file_url));
                                                                        $fileSizeInKilobytes = round($fileSizeInBytes / 1024); // Convert Kbytes to megabytes
                                                                    }
                                                                @endphp
                                                                <div x-data="{ modelStepOpen: false }">
                                                                    <div class="flex space-x-4 py-4" @click="modelStepOpen =!modelStepOpen">
                                                                        <div
                                                                            class="w-70 flex items-center py-2.5 px-2 border-2 border-gray-300 rounded-lg hover:bg-gray-200">
                                                                            <div class="flex items-center">
                                                                                <div
                                                                                    class="w-10 flex items-center justify-center">
                                                                                    @switch(pathinfo($step->file?->filename,
                                                                                        PATHINFO_EXTENSION))
                                                                                        @case('pdf')
                                                                                            <img src="{{ asset('/image/pdf-icon.svg') }}"
                                                                                                class="w-6 h-6" alt="png">
                                                                                        @break

                                                                                        @case('png')
                                                                                            <img src="{{ asset('/image/png-icon.svg') }}"
                                                                                                class="w-6 h-6" alt="png">
                                                                                        @break

                                                                                        @case('jpg')
                                                                                            <img src="{{ asset('/image/jpg-icon.svg') }}"
                                                                                                class="w-6 h-6" alt="png">
                                                                                        @break

                                                                                        @case('zip')
                                                                                            <img src="{{ asset('/image/zip-icon.svg') }}"
                                                                                                class="w-6 h-6" alt="png">
                                                                                        @break

                                                                                        @default
                                                                                            <img src="{{ asset('/image/zip-icon.svg') }}"
                                                                                                class="w-6 h-6" alt="png">
                                                                                    @endswitch
                                                                                </div>
                                                                                <div class="w-48 ml-2 flex flex-col">
                                                                                    <a href="#"
                                                                                        class="text-sm text-gray-700 font-bold truncate">{{ substr($step->file?->filename, 0, 10) }}.{{ pathinfo($step->file?->filename, PATHINFO_EXTENSION) }}</a>
                                                                                    <span class="text-gray-500 text-xs">   {{$fileSizeInKilobytes}}
                                                                                        KB</span>
                                                                                </div>
                                                                            </div>
                                                                            <a href="/files/{{ $step->file?->filename }}"
                                                                                download
                                                                                class="w-6 flex items-center justify-center">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="text-gray-500 hover:text-gray-600 h-6 w-6"
                                                                                    fill="none" viewBox="0 0 24 24"
                                                                                    stroke="currentColor">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                                                    </path>
                                                                                </svg>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div x-show="modelStepOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                                                            <div x-cloak @click="modelStepOpen = false" x-show="modelStepOpen" 
                                                                                x-transition:enter="transition ease-out duration-300 transform"
                                                                                x-transition:enter-start="opacity-0" 
                                                                                x-transition:enter-end="opacity-100"
                                                                                x-transition:leave="transition ease-in duration-200 transform"
                                                                                x-transition:leave-start="opacity-100" 
                                                                                x-transition:leave-end="opacity-0"
                                                                                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                                                                            ></div>
                                                                
                                                                            <div x-cloak x-show="modelStepOpen" 
                                                                                x-transition:enter="transition ease-out duration-300 transform"
                                                                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                                                                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                                                x-transition:leave="transition ease-in duration-200 transform"
                                                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                                class="inline-block w-full max-w-xl p-6 mt-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                                                                            >
                                                                                <div class="flex items-center justify-between space-x-2 mb-4">
                                                                                    <h1 class="text-xl font-medium text-gray-800 ">Хавсралт файл</h1>
                                                                
                                                                                    <button @click="modelStepOpen = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                                        </svg>
                                                                                        <span class="sr-only">Close modal</span>
                                                                                    </button>
                                                                                </div>
                    
                                                                                <hr>
                    
                                                                                @if ($file_ext == 'pdf')
                                                                                    <iframe class="pdf" class="w-full min-h-full"
                                                                                            src="{{ asset($file_url) }}"
                                                                                        width="100%" height="600">
                                                                                    </iframe>
                                                                                @else
                                                                                    <img class="w-full h-full lg:max-w-3xl" src="{{ asset($file_url) }}" alt="file">
                                                                                @endif
                                    
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>


                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>

                            

                            {{-- Шийдвэрлэлтэд үнэлгээ өгөх --}}
                            <div class="border-t-2 pt-4">

                                @if ($complaint->status_id == 6)
                                    @livewire('complaint-ratings', ['complaint' => $complaint], key($complaint->id))
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
