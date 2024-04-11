<nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                    class="md:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <button @click="sidebarOpen = !sidebarOpen"
                    class="hidden md:block text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 7L7 7M20 7L11 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M20 17H17M4 17L13 17" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M4 12H7L20 12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
                <a href="{{ route('welcome') }}" class="text-xl font-bold flex items-center lg:ml-2.5">
                    <x-application-mark class="block h-9 w-auto" />
                    <span class="self-center whitespace-nowrap"></span>
                </a>
            </div>
            <div class="flex items-center">
                <button id="toggleSidebarMobileSearch" type="button"
                    class="hidden text-gray-500 hover:text-gray-900 hover:bg-gray-100 p-2 rounded-lg">
                    <span class="sr-only">Search</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <a href="{{ route('complaint.create') }}"
                    class="hidden sm:inline-flex ml-5 text-white bg-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-3">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Санал хүсэлт бүртгэх
                </a>
                {{-- <a href="{{ route('welcome') }}"
               class="hidden sm:inline-flex ml-5 text-white bg-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-3">
               Нүүр хуудас
            </a> --}}

                {{-- fullscreen button --}}
                <button id="fullscreen-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24"
                        style="fill: gray;transform: ;msFilter:;">
                        <path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"></path>
                    </svg>
                </button>
                {{-- Profile photo --}}
                <button type="button" class="flex mx-3 text-sm rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                    <span class="sr-only">Open user menu</span>
                    {{-- <img class="w-8 h-8 rounded-full" src="{{ asset('/image/account-avatar.svg') }}"
                        alt="user photo"> --}}
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </button>
                <!-- Dropdown menu -->
                <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow"
                    id="dropdown">
                    <div class="py-3 px-4">
                        <span class="block text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</span>
                        <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-1 text-gray-500" aria-labelledby="dropdown">
                        <li>
                            <a href="{{ route('adminProfile') }}"
                                class="block py-2 px-4 text-sm hover:bg-gray-100">Профайл</a>
                        </li>
                    </ul>
                    <ul class="py-1 text-gray-500" aria-labelledby="dropdown">
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                        <li>
                            <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                class="block py-2 px-4 text-sm hover:bg-gray-100">{{ __('Гарах') }}</a>
                        </li>
                        </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    const fullscreenButton = document.getElementById('fullscreen-button');

    fullscreenButton.addEventListener('click', toggleFullscreen);

    function toggleFullscreen() {
        if (document.fullscreenElement) {
            // If already in fullscreen, exit fullscreen
            document.exitFullscreen();
        } else {
            // If not in fullscreen, request fullscreen
            document.documentElement.requestFullscreen();
        }
    }
</script>
