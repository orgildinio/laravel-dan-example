<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-1">
        <div class="flex items-center justify-between mb-4">
            <div class="lg:flex items-center justify-center w-full mt-7">
                <div tabindex="0" aria-label="card 1"
                    class="focus:outline-none lg:w-full lg:mr-7 lg:mb-0 mb-7 bg-white  p-6 shadow rounded">
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
                    <div class="flex items-center border-b border-gray-200  pb-6">

                        <div class="flex items-center justify-center h-16 w-16 bg-red-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 rounded-full text-red-700" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                            </svg>
                        </div>

                        <div class="flex items-start justify-between w-full">
                            <div class="pl-3 w-full">
                                <p tabindex="0" class="focus:outline-none text-xl font-medium leading-5 text-gray-800 ">
                                    {{$complaint->category->name}} - №{{$complaint->id}}</p>
                                <p tabindex="0" class="focus:outline-none text-sm leading-normal pt-2 text-gray-500">
                                    {{$complaint->created_at}}</p>
                                <p class="text-sm my-1"><span
                                        class="bg-gray-300 p-1 rounded">{{$complaint->organization->name}} хүлээн
                                        авсан.</span></p>
                            </div>
                            <div role="img" aria-label="bookmark">
                                <svg class="focus:outline-none text-gray-800" width="28" height="28" viewBox="0 0 28 28"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.5001 4.66667H17.5001C18.1189 4.66667 18.7124 4.9125 19.15 5.35009C19.5876 5.78767 19.8334 6.38117 19.8334 7V23.3333L14.0001 19.8333L8.16675 23.3333V7C8.16675 6.38117 8.41258 5.78767 8.85017 5.35009C9.28775 4.9125 9.88124 4.66667 10.5001 4.66667Z"
                                        stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <h6 class="text-sm font-bold text-gray pt-4">Гомдол мэдүүлсэн: {{mb_substr($complaint->lastname,
                            0, 1)}}.{{$complaint->firstname}}</h6>
                        <p tabindex="0" class="focus:outline-none text-sm leading-5 py-4 text-gray-600 text-justify">
                            {{$complaint->complaint}}</p>
                        <div tabindex="0" class="focus:outline-none flex">
                            <div>
                                <livewire:complaint-step :complaint="$complaint" />
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center border-t border-gray-200  p-6 m-6">

                        <ol
                            class="relative text-gray-500 border-l border-gray-200">
                            @foreach($complaint_steps as $step)
                            <li class="mb-10 ml-6">
                                <span
                                    class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full -left-4 ring-4 ring-white">
                                    <svg class="w-3.5 h-3.5 text-green-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                </span>
                                <h3 class="font-medium leading-tight">{{$step->org?->name}} руу шилжүүлсэн</h3>
                                <p class="text-sm">{{$step->desc}}</p>
                                <p class="text-sm">{{$step->sent_date}}</p>
                            </li>
                            @endforeach
                        </ol>

                    </div>
                </div>
            </div>
        </div>

</x-admin-layout>