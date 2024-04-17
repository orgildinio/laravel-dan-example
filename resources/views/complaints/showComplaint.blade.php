<x-app-layout>
    <div class="w-full bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <button onclick="window.history.back()" type="button" class="w-full flex items-center justify-center px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto hover:bg-gray-300">
                <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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
                            {{-- <hr> --}}
                            <div class="px-2">
                                <p tabindex="0"
                                    class="focus:outline-none p-4 bg-slate-100 shadow-inner rounded text-slate-700 text-justify mt-4">
                                    {{ $complaint->complaint }}</p>
                                    <div class="flex space-x-4 py-4">
    
                                        <div>
                                            @if ($complaint->file_id != null)
                                                <div class="w-70 flex items-center py-2.5 px-2 border-2 border-gray-300 rounded-lg hover:bg-gray-200">
                                                    <div class="flex items-center">
                                                        <div class="w-10 flex items-center justify-center">
                                                            @switch(pathinfo($complaint->file?->filename, PATHINFO_EXTENSION))
                                                                @case('pdf')
                                                                    <img src="{{ asset('/image/pdf-icon.svg')}}" class="w-6 h-6" alt="png">
                                                                    @break
                                                                @case('png')
                                                                    <img src="{{ asset('/image/png-icon.svg')}}" class="w-6 h-6" alt="png">
                                                                    @break
                                                                @case('jpg')
                                                                    <img src="{{ asset('/image/jpg-icon.svg')}}" class="w-6 h-6" alt="png">
                                                                    @break
                                                                @case('zip')
                                                                    <img src="{{ asset('/image/zip-icon.svg')}}" class="w-6 h-6" alt="png">
                                                                    @break
                                                            
                                                                @default
                                                                    <img src="{{ asset('/image/zip-icon.svg')}}" class="w-6 h-6" alt="png">
                                                            @endswitch
                                                        </div>
                                                        <div class="w-48 ml-2 flex flex-col">
                                                            <a href="#" class="text-sm text-gray-700 font-bold truncate">{{ substr($complaint->file?->filename, 0, 10) }}.{{ pathinfo($complaint->file?->filename, PATHINFO_EXTENSION) }}</a>
                                                            <span class="text-gray-500 text-xs">1.5 MB</span>
                                                        </div>
                                                    </div>
                                                    <a href="/files/{{ $complaint->file?->filename }}" download
                                                        class="w-6 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-600 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                        </svg>
                                                    </a>
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
                            {{-- <div class="flex items-center border-t border-gray-200 m-6 p-6">
                                <ol class="relative text-gray-500 border-l border-gray-200 w-full">
                                    @foreach ($complaint_steps as $step)
                                        <li class="mb-10 ml-6 w-full border-b border-gray-200">
                                            <div class="flex justify-start items-start">
                                                <div
                                                    class="flex items-center justify-center w-10 h-10 bg-blue-200 rounded-full">
                                                    <i class="fa-regular fa-user"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm my-1 bg-gray-200 text-primary font-bold p-1 rounded">
                                                        {{ $step->org?->name }} - {{ $step->status?->name }}</p>
                                                    <p class="text-sm">{{ $step->sent_date }}</p>
                                                </div>
                                            </div>
                                            <div class="text-sm mt-5 p-2 ">
                                                <div>{{ $step->desc }}</div>
                                                @if ($step->file_id != null)
                                                    <div class="my-5 w-2/3">
                                                        <div class="text-xs">Хавсралт файл</div>
                                                        <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                            <ul role="list"
                                                                class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                                                <li
                                                                    class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                                    <div class="flex w-0 flex-1 items-center">
                                                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                                            viewBox="0 0 20 20" fill="currentColor"
                                                                            aria-hidden="true">
                                                                            <path fill-rule="evenodd"
                                                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                                            <span
                                                                                class="truncate font-medium">{{ $step->file?->filename }}.{{ pathinfo($step->file?->filename, PATHINFO_EXTENSION) }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ml-4 flex-shrink-0">
                                                                        <a href="/files/{{ $step->file?->filename }}"
                                                                            class="font-medium text-primary hover:text-primaryHover">Татах</a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </dd>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            </div> --}}
    
                            <!-- component -->
                            <section
                                class="relative flex flex-col justify-center bg-white overflow-hidden border-t-2">
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
                                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16">
                                                                    <path
                                                                        d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                                </svg>
                                                                @elseif ($step->status_id == 6)
                                                                <svg class="fill-red-500"
                                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16">
                                                                    <path
                                                                        d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                                </svg>
                                                                @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16">
                                                                    <path class="fill-slate-300"
                                                                        d="M14.853 6.861C14.124 10.348 10.66 13 6.5 13c-.102 0-.201-.016-.302-.019C7.233 13.618 8.557 14 10 14c.51 0 1.003-.053 1.476-.143L14.2 15.9a.499.499 0 0 0 .8-.4v-3.515c.631-.712 1-1.566 1-2.485 0-.987-.429-1.897-1.147-2.639Z" />
                                                                    <path class="fill-slate-500"
                                                                        d="M6.5 0C2.91 0 0 2.462 0 5.5c0 1.075.37 2.074 1 2.922V11.5a.5.5 0 0 0 .8.4l1.915-1.436c.845.34 1.787.536 2.785.536 3.59 0 6.5-2.462 6.5-5.5S10.09 0 6.5 0Z" />
                                                                </svg>
                                                                @endif
                                                            </div>
                                                            <!-- Date -->
                                                            <time class="text-sm text-right font-medium text-indigo-500 md:w-28">{{ $step->sent_date }}</time>
                                                        </div>
                                                        <!-- Title -->
                                                        <div class="text-slate-500 ml-14"><span
                                                                class="text-slate-900 font-bold">{{ $step->org?->name }} </span><span class="text-blue-900 bg-blue-100 px-2 py-1 rounded-lg text-sm">{{ $step->status?->name }}</span></div>
                                                    </div>
                                                    <!-- Card -->
                                                    <div
                                                        class="ml-14 md:ml-44">
                                                        <div class="p-4 bg-slate-100 shadow-inner rounded border border-slate-200 text-slate-700">
                                                            {{ $step->desc }}
                                                        </div>
    
                                                        @if ($step->file_id != null)
                                                        <div class="flex space-x-4 py-4">
                                                            <div class="w-70 flex items-center py-2.5 px-2 border-2 border-gray-300 rounded-lg hover:bg-gray-200">
                                                                <div class="flex items-center">
                                                                    <div class="w-10 flex items-center justify-center">
                                                                        @switch(pathinfo($step->file?->filename, PATHINFO_EXTENSION))
                                                                            @case('pdf')
                                                                                <img src="{{ asset('/image/pdf-icon.svg')}}" class="w-6 h-6" alt="png">
                                                                                @break
                                                                            @case('png')
                                                                                <img src="{{ asset('/image/png-icon.svg')}}" class="w-6 h-6" alt="png">
                                                                                @break
                                                                            @case('jpg')
                                                                                <img src="{{ asset('/image/jpg-icon.svg')}}" class="w-6 h-6" alt="png">
                                                                                @break
                                                                            @case('zip')
                                                                                <img src="{{ asset('/image/zip-icon.svg')}}" class="w-6 h-6" alt="png">
                                                                                @break
                                                                        
                                                                            @default
                                                                                <img src="{{ asset('/image/zip-icon.svg')}}" class="w-6 h-6" alt="png">
                                                                        @endswitch
                                                                    </div>
                                                                    <div class="w-48 ml-2 flex flex-col">
                                                                        <a href="#" class="text-sm text-gray-700 font-bold truncate">{{ substr($step->file?->filename, 0, 10) }}.{{ pathinfo($step->file?->filename, PATHINFO_EXTENSION) }}</a>
                                                                        <span class="text-gray-500 text-xs">1.5 MB</span>
                                                                    </div>
                                                                </div>
                                                                <a href="/files/{{ $step->file?->filename }}" download
                                                                    class="w-6 flex items-center justify-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-600 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                                    </svg>
                                                                </a>
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
