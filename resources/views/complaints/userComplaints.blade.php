<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Миний илгээсэн санал хүсэлт') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div aria-label="group of cards" tabindex="0" class="focus:outline-none w-full">
                @foreach ($complaints as $complaint)
                <div class="lg:flex items-center justify-center w-full mt-7">
                    <div tabindex="0" aria-label="card 1"
                        class="focus:outline-none lg:w-full lg:mr-7 lg:mb-0 mb-7 bg-white p-6 shadow rounded">
                        <div class="flex items-center border-b border-gray-200 pb-6">

                            <livewire:channel-icon :category="$complaint->category->name"
                                :channel="$complaint->channel->name" />

                            <div class="flex items-start justify-between w-full">
                                <div class="pl-3 w-full">
                                    <p tabindex="0"
                                        class="focus:outline-none text-xl font-medium leading-5 text-gray-800 ">
                                        {{$complaint->category->name}} - №{{$complaint->serial_number}}</p>
                                    <p tabindex="0"
                                        class="focus:outline-none text-sm leading-normal pt-2 text-gray-500">
                                        {{$complaint->complaint_date}}</p>
                                </div>
                                <div role="img" aria-label="bookmark">
                                    <svg class="focus:outline-none text-gray-800" width="28" height="28"
                                        viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.5001 4.66667H17.5001C18.1189 4.66667 18.7124 4.9125 19.15 5.35009C19.5876 5.78767 19.8334 6.38117 19.8334 7V23.3333L14.0001 19.8333L8.16675 23.3333V7C8.16675 6.38117 8.41258 5.78767 8.85017 5.35009C9.28775 4.9125 9.88124 4.66667 10.5001 4.66667Z"
                                            stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 mb-8">
                            <div>
                                <a href="{{route('showComplaint', $complaint->id)}}" class="text-gray-600 hover:text-blue-600">
                                    <p tabindex="0"
                                        class="focus:outline-none text-sm leading-5 py-4 text-justify">
                                        {{$complaint->complaint}}</p>
                                </a>
                            </div>
                            
                            <div>
                                <h2 class="sr-only">Steps</h2>
                              
                                <div class="after:mt-4 after:block after:h-1 after:w-full after:rounded-lg after:bg-gray-200">
                                  <ol class="grid grid-cols-3 text-sm font-medium text-gray-500">
                                    <li class="relative flex justify-start text-{{$complaint->status_id == 2 || $complaint->status_id==3 ? 'blue' : 'gray'}}-600">
                                      <span class="absolute -bottom-[1.75rem] start-0 rounded-full bg-{{$complaint->status_id == 2 || $complaint->status_id==3 ? 'blue' : 'gray'}}-600">
                                        <svg
                                          class="h-5 w-5"
                                          xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 20 20"
                                          fill="currentColor"
                                        >
                                          <path
                                            fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"
                                          />
                                        </svg>
                                      </span>
                              
                                      <span class="hidden sm:block"> Хүлээн авсан </span>
                              
                                      <svg
                                        class="h-6 w-6 sm:hidden"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                      >
                                        <path
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"
                                        />
                                      </svg>
                                    </li>
                              
                                    <li class="relative flex justify-center text-{{$complaint->status_id == 3 ? 'blue' : 'gray'}}-600">
                                      <span
                                        class="absolute -bottom-[1.75rem] left-1/2 -translate-x-1/2 rounded-full bg-{{$complaint->status_id == 3 ? 'blue' : 'gray'}}-600"
                                      >
                                        <svg
                                          class="h-5 w-5"
                                          xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 20 20"
                                          fill="currentColor"
                                        >
                                          <path
                                            fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"
                                          />
                                        </svg>
                                      </span>
                              
                                      <span class="hidden sm:block"> Хянаж байгаа </span>
                              
                                      <svg
                                        class="mx-auto h-6 w-6 sm:hidden"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                      >
                                        <path
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        />
                                        <path
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                      </svg>
                                    </li>
                              
                                    <li class="relative flex justify-end text-{{$complaint->status_id == 6 ? 'blue' : 'gray'}}-600">
                                      <span class="absolute -bottom-[1.75rem] end-0 rounded-full bg-{{$complaint->status_id == 6 ? 'blue' : 'gray'}}-600">
                                        <svg
                                          class="h-5 w-5"
                                          xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 20 20"
                                          fill="currentColor"
                                        >
                                          <path
                                            fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"
                                          />
                                        </svg>
                                      </span>
                              
                                      <span class="hidden sm:block"> Шийдвэрлэсэн </span>
                              
                                      <svg
                                        class="h-6 w-6 sm:hidden"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                      >
                                        <path
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                                        />
                                      </svg>
                                    </li>
                                  </ol>
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