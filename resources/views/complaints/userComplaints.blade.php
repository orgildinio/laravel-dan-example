@php
  function getBgColor($category)
    {
        switch ($category) {
            case 1:
                return 'bg-green-600';
            case 2:
                return 'bg-red-600';
            case 3:
                return 'bg-yellow-600';
            case 4:
                return 'bg-blue-600';
            case 5:
                return 'bg-cyan-600';
            default:
                return 'bg-blue-600';
        }
    }
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Миний илгээсэн санал хүсэлт') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div aria-label="group of cards" tabindex="0" class="focus:outline-none w-full">
                @foreach ($complaints as $complaint)
                <div class="lg:flex items-center justify-center w-full mt-7">
                    <div tabindex="0" aria-label="card 1"
                        class="focus:outline-none lg:w-full lg:mr-7 lg:mb-0 mb-7 bg-white p-6 border border-gray-300 shadow rounded">
                        <div class="flex items-center border-b border-gray-300 pb-6">
                            <div class="flex items-start justify-between w-full">
                                <div class="">
                                    <p class="bg-primary px-4 py-1 text-white text-md rounded">№{{$complaint->serial_number}}</p>
                                    {{-- <p tabindex="0"
                                        class="focus:outline-none text-sm leading-normal pt-2 text-gray-500">
                                        {{$complaint->complaint_date}}</p> --}}
                                </div>
                                <div class="text-blue-900 font-bold text-lg">
                                  {{$complaint->organization?->name}} - {{$complaint->status?->name}}
                                </div>
                            </div>
                        </div>
                        <div class="px-2 mb-8">
                            <div>
                                <a href="{{route('showComplaint', $complaint->id)}}" class="text-gray-600 hover:text-blue-600">
                                    <p tabindex="0"
                                        class="focus:outline-none leading-5 py-4 text-justify">
                                        {{$complaint->complaint}}</p>
                                </a>
                            </div>
                            <div class="flex justify-between items-center">
                              <div>
                                <span class="text-gray-600 text-sm italic">
                                  {{ $complaint->complaint_date }}
                                  {{-- {{ \Carbon\Carbon::parse($complaint->complaint_date)->diffForHumans() }} --}}
                                </span>
                              </div>
                              <div>
                                <span class="text-white text-lg px-8 py-2 font-bold {{getBgColor($complaint->category_id)}}">
                                  {{$complaint->category?->name}}
                                </span>
                              </div>
                            </div>
                            <div class="w-full px-6 py-4">
                              <div class="relative flex items-center justify-between w-full">
                                <div class="absolute left-0 top-2/4 h-0.5 w-full -translate-y-2/4 bg-gray-300"></div>
                                @if ($complaint->status_id == 3)
                                <div class="absolute left-0 top-2/4 h-0.5 w-1/2 -translate-y-2/4 bg-green-600 transition-all duration-500">
                                </div>
                                @endif
                                @if ($complaint->status_id == 6)
                                <div class="absolute left-0 top-2/4 h-0.5 w-full -translate-y-2/4 bg-green-600 transition-all duration-500">
                                </div>
                                @endif
                                <div
                                  class="relative z-10 grid w-10 h-10 font-bold transition-all duration-300 {{ in_array($complaint->status_id, [2, 3, 6]) ? 'bg-green-600 text-white' : 'bg-gray-200' }}  rounded-full place-items-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                  </svg>
                                  
                                  
                                  <div class="absolute -bottom-[2rem] w-max text-center">
                                    <h6
                                      class="block font-sans text-sm antialiased text-gray-700 font-semibold leading-relaxed tracking-normal">
                                      Хүлээн авсан
                                    </h6>
                                  </div>
                                </div>
                                <div
                                  class="relative z-10 grid w-10 h-10 font-bold transition-all duration-300 {{ in_array($complaint->status_id, [3, 6]) ? 'bg-green-600 text-white' : 'bg-gray-200' }} rounded-full place-items-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                  </svg>
                                  
                                  <div class="absolute -bottom-[2rem] w-max text-center">
                                    <h6
                                      class="block font-sans text-sm antialiased font-semibold text-gray-700 leading-relaxed tracking-normal">
                                      Хянаж байгаа
                                    </h6>
                                  </div>
                                </div>
                                <div
                                  class="relative z-10 grid w-10 h-10 font-bold transition-all duration-300 {{ $complaint->status_id == 6 ? 'bg-green-600 text-white' : 'bg-gray-200' }} rounded-full place-items-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                  </svg>
                                  
                                  <div class="absolute -bottom-[2rem] w-max text-center">
                                    <h6
                                      class="block font-sans text-sm text-gray-700 antialiased font-semibold leading-relaxed tracking-normal">
                                      Шийдвэрлэсэн
                                    </h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <br>
                <div class="mr-7">
                    {!! $complaints->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>