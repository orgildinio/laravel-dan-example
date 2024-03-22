<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="rounded-lg  2xl:col-span-1">
            <div class="flex items-center justify-between mb-4">
                <div class="lg:flex items-center justify-center w-full my-7">
                    <div tabindex="0" aria-label="card 1"
                        class="focus:outline-none lg:w-full lg:mb-0 mb-8 bg-white  p-6 shadow rounded">
                        <div class="flex items-center border-b border-gray-200  pb-2">
                            <div class="flex items-start justify-between w-full">
                                <div class="pl-3">
                                    <p class="focus:outline-none text-xl font-medium leading-5 text-gray-800 ">
                                        {{ $complaint->category->name }} - №{{ $complaint->id }}</p>
                                    <p class="focus:outline-none text-sm leading-normal pt-2 text-gray-500">
                                        {{ $complaint->created_at }}</p>
                                    <p class="text-sm my-1 bg-gray-200 text-primary font-bold p-1 rounded">
                                        {{ $complaint->organization?->name }} - {{ $complaint->status?->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="my-2">
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
                        <hr>
                        <div class="px-2">
                            <h6 class="text-sm font-bold text-gray pt-4">Гомдол мэдүүлсэн: {{mb_substr($complaint->lastname,
                                0, 1)}}.{{$complaint->firstname}}</h6>
                            <p tabindex="0"
                                class="focus:outline-none text-sm leading-5 py-4 text-gray-600 text-justify mb-5">
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
                                    <div class="my-5 w-2/3">
                                        <div class="text-xs">Хавсралт файл</div>
                                        <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            <ul role="list"
                                                class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                                <li
                                                    class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                    <div class="flex w-0 flex-1 items-center">
                                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                            <span
                                                                class="truncate font-medium">{{ $complaint->file?->filename }}.{{ pathinfo($complaint->file?->filename, PATHINFO_EXTENSION) }}</span>
                                                            {{-- <span class="flex-shrink-0 text-gray-400">4.5mb</span> --}}
                                                        </div>
                                                    </div>
                                                    <div class="ml-4 flex-shrink-0">
                                                        <a href="/files/{{ $complaint->file?->filename }}"
                                                            class="font-medium text-primary hover:text-primaryHover">Татах</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </dd>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        {{-- Шийдвэрлэлтийн явц --}}
                        <div class="flex items-center border-t border-gray-200 m-6 p-6">
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
                        </div>

                        {{-- Шийдвэрлэлтэд үнэлгээ өгөх --}}
                        @if ($complaint->status_id == 6)
                        @livewire('complaint-ratings', ['complaint' => $complaint], key($complaint->id))
                        @endif

                    </div>
                </div>
            </div>
            
        </div>
    </div>

</x-app-layout>