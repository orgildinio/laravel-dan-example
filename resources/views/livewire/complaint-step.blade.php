<div>
    <div class="relative">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('success') }}
              </div>
        @endif
        @if (session('info'))
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                {{ session('info') }}
              </div>
        @endif
        @if (session('warning'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                {{ session('warning') }}
              </div>
        @endif
        <div class="text-right">
            <button wire:click="create()" class="bg-black hover:bg-gray-700 text-white text-right text-sm py-2 px-4 rounded my-3"><i
                class="fa-solid fa-gear"></i> Удирдах<p></button>
        </div>
        @if ($isOpen)
            @include('livewire.create')
        @endif
    </div>

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
                                src="{{ $step->sentUser?->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
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
                        <div class="text-sm text-gray-700">
                            {{ $step->desc }}
                        </div> 
                    </div>
                    @if ($step->file_id != null)
                        <div class="mt-2 w-1/3">
                            <div class="text-xs font-semibold">Хавсралт файл</div>
                            <dd class="mt-2 text-sm bg-white text-gray-900 sm:col-span-2 sm:mt-0">
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
        <br>
    @endforeach

</div>
