<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                        {{ __('Нүүр') }}
                    </x-nav-link>
                </div>
                @guest
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link href="{{ route('addComplaint') }}" :active="request()->routeIs('addComplaint')">
                            {{ __('Өргөдөл, гомдол илгээх') }}
                        </x-nav-link>
                    </div>
                @endguest
                @auth
                    @if (Auth::user()->role?->name === 'dan' || Auth::user()->role?->name === 'admin')
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link href="{{ route('addComplaint') }}" :active="request()->routeIs('addComplaint')">
                                {{ __('Өргөдөл, гомдол илгээх') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link href="{{ route('userComplaints') }}" :active="request()->routeIs('userComplaints')">
                                {{ __('Миний илгээсэн санал') }}
                            </x-nav-link>
                        </div>
                    @endif
                    @if (Auth::user()->role?->name !== 'dan')
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                {{ __('Хянах самбар') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Auth::user()->profile_photo_path != null)
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <span class="mr-3">{{ Auth::user()->name }}</span>
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @elseif(Auth::user()->danImage != null)
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <span class="mr-3">{{ Auth::user()->name }}</span>
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="data:image/png;base64,{{ Auth::user()->danImage }}" alt="profile">
                                    </button>
                                </span>
                                @else
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <span class="mr-3">{{ Auth::user()->name }}</span>
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                @if (Auth::user()->role?->name === 'dan')
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Тохиргоо') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile') }}">
                                        {{ __('Профайл') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('userComplaints') }}">
                                        {{ __('Миний илгээсэн санал') }}
                                    </x-dropdown-link>
                                @endif


                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Гарах') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm text-white font-bold bg-primary hover:bg-primaryHover py-2 px-3 rounded-md">Нэвтрэх</a>

                        {{-- @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Бүртгүүлэх</a>
                    @endif --}}
                    @endauth

                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                {{ __('Нүүр') }}
            </x-responsive-nav-link>
        </div>
        {{-- <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('complaints') }}" :active="request()->routeIs('complaints')">
                {{ __('Санал хүсэлт') }}
            </x-responsive-nav-link>
        </div> --}}
        @guest
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('addComplaint') }}" :active="request()->routeIs('addComplaint')">
                    {{ __('Өргөдөл, гомдол илгээх') }}
                </x-responsive-nav-link>
            </div>
        @endguest
        @auth
            @if (Auth::user()->role?->name === 'dan' || Auth::user()->role?->name === 'admin')
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('addComplaint') }}" :active="request()->routeIs('addComplaint')">
                        {{ __('Өргөдөл, гомдол илгээх') }}
                    </x-responsive-nav-link>
                </div>
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('userComplaints') }}" :active="request()->routeIs('userComplaints')">
                        {{ __('Миний илгээсэн санал хүсэлт') }}
                    </x-responsive-nav-link>
                </div>
            @endif
            @if (Auth::user()->role?->name !== 'dan')
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Хянах самбар') }}
                    </x-responsive-nav-link>
                </div>
            @endif
        @endauth


        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile') }}" :active="request()->routeIs('profile')">
                        {{ __('Профайл') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Гарах') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('login') }}">
                    {{ __('Нэвтрэх') }}
                </x-responsive-nav-link>
            </div>
            {{-- @if (Route::has('register'))
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('register') }}"
                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Бүртгүүлэх</a>
        </div>
        @endif --}}
        @endauth

    </div>
</nav>
