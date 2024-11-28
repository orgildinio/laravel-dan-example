<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/modules/treemap.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>


    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div class="font-roboto text-gray-900 antialiased" x-data="{ sidebarOpen: window.innerWidth >= 1024 }" x-init="window.addEventListener('resize', () => {
        sidebarOpen = window.innerWidth >= 1024;
    });">
        <x-admin-header></x-admin-header>
        <div class="flex overflow-hidden bg-white pt-16">
            <x-sidebar-menu :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
                class="fixed lg:relative z-20 bg-white w-64 transition-all duration-300 ease-in-out lg:block">
            </x-sidebar-menu>
            <div class="bg-gray-900 opacity-50 fixed inset-0 z-10 lg:hidden" x-show="sidebarOpen"
                @click="sidebarOpen = false"></div>
            <div id="main-content"
                class="h-full w-full bg-gray-50 relative overflow-y-auto transition-all duration-300 ease-in-out"
                :class="{ 'lg:ml-64': sidebarOpen, 'ml-0': !sidebarOpen }">
                <main>
                    <div class="pt-6 px-4 mb-10">
                        <div class="w-full grid grid-cols-1 xl:grid-cols-1 2xl:grid-cols-1 gap-4">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>


    @stack('modals')

    @livewireScripts
</body>

</html>
