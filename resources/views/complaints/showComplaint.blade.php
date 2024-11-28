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
                                        <x-file-list-component :$fileName :$fileExt :$fileUrl :$fileSizeInKilobytes />
                                        @endif
                                        <p>file name {{ $fileName }}</p>
                                        <p>file ext {{ $fileExt }}</p>
                                        <p>file fileUrl {{ $fileUrl }}</p>
                                        <p>file fileSizeInKilobytes {{ $fileSizeInKilobytes }}</p>
                                        @if ($complaint->files->isNotEmpty())
                                            <div class="flex flex-row flex-wrap">
                                                @foreach ($complaint->files as $file)
                                                <div class="m-2">
                                                        <x-file-list-component :fileName="$file->filename" :fileExt="pathinfo($file->filename, PATHINFO_EXTENSION)" :fileUrl="url('files/' . $file->filename)"
                                                            :fileSizeInKilobytes="10" />
                                                        </div>
                                                    @endforeach
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
                                                                        <svg class="fill-emerald-600"
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
                                                                        $fileName = $step->file?->filename; // Example dynamic image URL
                                                                        $fileUrl = 'files/' . $step->file?->filename; // Example dynamic image URL
                                                                        $fileExt = pathinfo($step->file?->filename, PATHINFO_EXTENSION);
                                                                        $fileSizeInBytes = filesize(public_path($fileUrl));
                                                                        $fileSizeInKilobytes = round($fileSizeInBytes / 1024);
                                                                    }
                                                                @endphp
                                                                <div class="flex space-x-4 py-4">
                                                                    <x-file-list-component :$fileName :$fileExt :$fileUrl :$fileSizeInKilobytes />
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
