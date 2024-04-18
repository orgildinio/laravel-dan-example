<div x-data="{ modelOpen: false }">
    <div @click="modelOpen =!modelOpen"
        class="w-70 flex items-center py-2.5 px-2 border-2 border-gray-300 rounded-lg hover:bg-gray-200">
        <div class="flex items-center">
            <div class="w-10 flex items-center justify-center">
                @switch($fileExt)
                    @case('pdf')
                        <img src="{{ asset('/image/pdf-icon.svg') }}" class="w-6 h-6"
                            alt="png">
                    @break

                    @case('png')
                        <img src="{{ asset('/image/png.svg') }}" class="w-6 h-6"
                            alt="png">
                    @break

                    @case('jpg')
                        <img src="{{ asset('/image/jpg.svg') }}" class="w-6 h-6"
                            alt="png">
                    @break

                    @case('zip')
                        <img src="{{ asset('/image/zip-icon.svg') }}" class="w-6 h-6"
                            alt="png">
                    @break

                    @default
                        <img src="{{ asset('/image/jpg.svg') }}" class="w-6 h-6"
                            alt="png">
                @endswitch
            </div>
            <div class="w-48 ml-2 flex flex-col">
                <a href="#"
                    class="text-sm text-gray-700 font-bold truncate">{{ substr($fileName, 0, 10) }}.{{$fileExt}}</a>
                <span class="text-gray-500 text-xs">{{$fileSizeInKilobytes}} KB</span>
            </div>
        </div>
        <a href="/files/{{ $fileName }}" download
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

                @if ($fileExt == 'pdf')
                    <iframe class="pdf" class="w-full min-h-full"
                            src="{{ asset($fileUrl) }}"
                        width="100%" height="600">
                    </iframe>
                @else
                    <img class="w-full h-full lg:max-w-3xl" src="{{ asset($fileUrl) }}" alt="file">
                @endif

            </div>
        </div>
    </div>
</div>