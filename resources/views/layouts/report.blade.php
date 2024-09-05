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

</head>

<body>

 
  <div class="font-roboto text-gray-900 antialiased">
   <x-admin-header></x-admin-header>
   <div class="flex overflow-hidden bg-white pt-16">
       <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto transition-all duration-300 ease-in-out">
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
</body>

</html>