<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4">
        <div class="flex items-center justify-between mb-4">
            <div class="w-full grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 md:gap-4">

                <div class="col-span-1 flow-root rounded-lg border border-gray-100 py-3 shadow-sm mb-4">
                    <dl class="-my-3 divide-y divide-gray-100 text-sm">
                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">#</dt>
                        <dd class="text-gray-700 text-right font-bold sm:col-span-2">{{$complaint->id}}</dd>
                      </div>

                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Хүсэлт гаргагч</dt>
                        <dd class="text-gray-700 text-right sm:col-span-2">
                        @if ($complaint->complaint_maker_type_id == 1)
                                {{ mb_substr($complaint->lastname, 0, 1) }}.{{ $complaint->firstname }}
                        @else
                            {{ $complaint->complaint_maker_org_name }}
                        @endif    
                        </dd>
                      </div>
                  
                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Бүртгэсэн огноо</dt>
                        <dd class="text-gray-700 text-right sm:col-span-2">{{ date('Y-m-d H:i', strtotime($complaint->complaint_date)) }}</dd>
                      </div>

                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Үлдсэн хугацаа</dt>
                        <dd class="text-gray-700 text-right sm:col-span-2">
                            @if (($complaint->expire_date) > now() )
                                <span>{{ now()->diffInHours($complaint->expire_date) }} цаг</span>
                            @else
                                {{-- <img src="{{ asset('/image/circle-exclamation.svg')}}" class="fa-beat w-[16px] h-[16px] text-red-700 shrink-0 inline-block" alt="dashboard"> --}}
                                <i class="fa-solid fa-circle fa-beat-fade text-red-500"></i>
                                <span class="">Хугацаа хэтэрсэн</span>
                            @endif
                        </dd>
                      </div>
                  
                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Төрөл</dt>
                        <dd class="text-gray-700 text-right sm:col-span-2"><span class="bg-red-200 p-1 rounded">{{$complaint->category?->name}}</span></dd>
                      </div>
                  
                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Ирсэн хэлбэр</dt>
                        <dd class="text-gray-700 text-right sm:col-span-2">{{$complaint->channel?->name}}</dd>
                      </div>
                  
                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Хариуцсан байгууллага</dt>
                        <dd class="text-gray-700 text-right sm:col-span-2"><span class="bg-black text-white p-1 rounded">{{$complaint->organization?->name}}</span></dd>
                      </div>

                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Төлөв</dt>
                        <dd class="text-gray-700 text-right sm:col-span-2"><span class="p-1 rounded @if ($complaint->status_id == 0) 
                            bg-gray-100
                            @elseif($complaint->status_id == 1)
                            bg-gray-200
                            @elseif($complaint->status_id == 2)
                            bg-yellow-200
                            @elseif($complaint->status_id == 3)
                            bg-blue-200
                            @elseif($complaint->status_id == 4)
                            bg-orange-200
                            @elseif($complaint->status_id == 5)
                            bg-red-200
                            @elseif($complaint->status_id == 6)
                            bg-green-200
                            @else
                            bg-gray-200 
                            @endif">{{$complaint->status?->name}}</span></dd>
                      </div>

                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Ангилал</dt>
                        <dd class="text-gray-700 text-right sm:col-span-2">
                            <div class="mb-2">
                                @if ($complaint->complaintMakerType)
                                    <span
                                        class="text-blue-900 bg-blue-100 text-sm py-1 px-2 rounded-md">{{ $complaint->complaintMakerType?->name }}</span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <span
                                    class="text-blue-900 bg-blue-100 text-sm py-1 px-2 rounded-md">{{ $complaint->energyType?->name }}</span>
                            </div>
                            
                            <div class="mb-2">
                                @if ($complaint->complaintTypeSummary)
                                    <span
                                        class="text-blue-900 bg-blue-100 text-sm py-1 px-2 rounded-md">{{ $complaint->complaintTypeSummary?->name }}</span>
                                @endif
                            </div>
                        </dd>
                      </div>

                      <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Үнэлгээ</dt>
                        <dd class="text-gray-700 text-right sm:col-span-2">
                        </dd>
                    </div>
                    @livewire('complaint-ratings', ['complaint' => $complaint], key($complaint->id))

                    </dl>
                  </div>
                {{-- <div class="col-span-1 self-start sticky top-0 mr-4 p-6 bg-gray-50 shadow text-sm">
                    <h1 class="text-black font-bold mb-4 text-lg">Гомдол гаргасан:</h1>
                    <dl class="max-w-md text-gray-900 divide-y divide-gray-200">
                        @if ($complaint->complaint_maker_type_id == 1)
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-500">Овог нэр</dt>
                                <dd class="font-semibold">
                                    {{ mb_substr($complaint->lastname, 0, 1) }}.{{ $complaint->firstname }}
                                </dd>
                            </div>
                        @endif
                        @if ($complaint->complaint_maker_type_id == 2)
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-500">ААН</dt>
                                <dd class="font-semibold">{{ $complaint->complaint_maker_org_name }}</dd>
                            </div>
                        @endif
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500">Утас</dt>
                            <dd class="font-semibold">{{ $complaint->phone }}</dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500">И-мэйл</dt>
                            <dd class="font-semibold">{{ $complaint->email }}</dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500">Хаяг</dt>
                            <dd class="font-semibold">{{ $complaint->addressDetail }}</dd>
                        </div>
                    </dl>
                    @livewire('complaint-ratings', ['complaint' => $complaint], key($complaint->id))
                </div> --}}

                <div class="col-span-3 mb-7 bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
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
                    <div class="flex items-center border-b border-gray-200 pb-3 mb-2">

                        <div class="flex items-start justify-between w-full">
                            <div class="pl-3">
                                <p class="focus:outline-none text-xl font-medium leading-5 text-gray-800 ">Өргөдөл гомдлын агуулга</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-2">
                        <p tabindex="0" class="focus:outline-none text-sm leading-5 py-4 text-gray-700 text-justify">
                            {{ $complaint->complaint }}</p>
                    </div>

                    <div>
                        @if ($complaint->audio_file_id != null)
                            <div class="text-sm px-2 mb-2">
                                <p>Бичлэг</p>
                                <audio controls class="w-full">
                                    <source src="/files/{{ $complaint->audioFile?->filename }}" type="audio/mpeg">
                                    Your browser does not support the audio tag.
                                </audio>
                            </div>
                        @endif

                        @if ($complaint->file_id != null)
                            <div class="p-2">
                                <div class="w-1/3">
                                    <div class="text-xs font-semibold">Хавсралт файл</div>
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

                    <div role="img" aria-label="bookmark">
                        <div>
                            <livewire:complaint-step :complaint="$complaint" />
                        </div>
                    </div>

                </div>
            </div>
        </div>

</x-admin-layout>
