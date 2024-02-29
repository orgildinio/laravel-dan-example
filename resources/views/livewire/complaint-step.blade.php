<div>
    <div class="relative">
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
        <div class="text-right">
            <button wire:click="create()" class="bg-black hover:bg-gray-700 text-white text-right text-sm py-2 px-4 rounded my-3"><i
                class="fa-solid fa-gear"></i> Удирдах<p></button>
        </div>
        @if ($showPermissionWarning)
            <div class="absolute top-5 right-0 mt-8 w-64 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-2"
                role="alert">
                <p>Таны хариуцсан гомдол биш байна..</p>
            </div>
        @endif
        @if ($isOpen)
            @include('livewire.create')
        @endif
    </div>
    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->

    @foreach ($complaint_steps as $step)
        <div
            class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
            <div class="border-b-2 border-neutral-100 px-6 py-3 font-semibold">
                <span
                    class="py-1 px-2 rounded-lg text-sm 
                    @if ($step->status_id == 0) 
                    bg-gray-100
                    @elseif($step->status_id == 1)
                    bg-gray-200
                    @elseif($step->status_id == 2)
                    bg-yellow-200
                    @elseif($step->status_id == 3)
                    bg-blue-200
                    @elseif($step->status_id == 4)
                    bg-orange-200
                    @elseif($step->status_id == 5)
                    bg-red-200
                    @elseif($step->status_id == 6)
                    bg-green-200
                    @else
                    bg-gray-200 
                    @endif">Өргөдөл
                    гомдол {{ $step->status?->name }}</span>
            </div>
            <div class="p-4">
                <div class="w-full mx-auto bg-white rounded-xl overflow-hidden">
                    <div class="md:flex">
                        <!-- First Column - User Info -->
                        <div class="md:w-1/3 p-4">
                            <!-- User Avatar -->
                            {{-- <img src="user-avatar.jpg" alt="User Avatar" class="w-20 h-20 rounded-full mx-auto mb-4"> --}}
                            <div class="flex items-start">
                                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                <div class="text-sm ">
                                    <div class="flex items-center justify-between">
                                        <h2 class="font-semibold text-gray-900">
                                            {{ $step->sentUser?->name }}</h2>
                                    </div>
                                    <p class="text-gray-700">{{ $step->sentUser?->division }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Second Column - Additional Content -->
                        <div class="md:w-1/3 p-4 text-sm">
                            <!-- Other content goes here -->
                            <h2 class="font-semibold text-gray-900">Байгууллага</h2>
                            <div>{{ $step->org?->name }}</div>
                        </div>
                        <div class="md:w-1/3 p-4 text-sm ">
                            <!-- Other content goes here -->
                            <h2 class="font-semibold text-gray-900">Огноо</h2>
                            <div>{{ $step->sent_date }}</div>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-2">
                        {{ $step->desc }}
                        @if ($step->file_id != null)
                            <div class="my-5 w-2/3">
                                <div class="text-xs">Хавсралт файл</div>
                                <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <ul role="list"
                                        class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                            <div class="flex w-0 flex-1 items-center">
                                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                    <span
                                                        class="truncate font-medium">{{ $step->file?->filename }}.{{ pathinfo($step->file?->filename, PATHINFO_EXTENSION) }}</span>
                                                    {{-- <span class="flex-shrink-0 text-gray-400">4.5mb</span> --}}
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
                </div>
            </div>
        </div>
        <br>
    @endforeach

    {{-- <div class="flex items-center border-t border-gray-200 m-6 p-6">
        <ol class="relative text-gray-500 border-l border-gray-200 w-full">
            @forelse ($complaint_steps as $step)
                <li class="mb-10 ml-6 w-full border-b border-gray-200">
                    <div class="flex justify-start items-start">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-200 rounded-full">
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
                                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                            <div class="flex w-0 flex-1 items-center">
                                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
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
            @empty
                <div class="flex col-span-1">
                    <div class="relative px-4 mb-16 leading-6 text-left">
                        <div class="box-border text-sm font-medium text-gray-500">
                            Хоосон
                        </div>
                    </div>
                </div>
            @endforelse
        </ol>
    </div> --}}
</div>
