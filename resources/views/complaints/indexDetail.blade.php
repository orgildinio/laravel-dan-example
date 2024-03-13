@php
    function getBorderColor($category)
    {
        switch ($category) {
            case 1:
                return 'border-green-500';
            case 2:
                return 'border-red-500';
            case 3:
                return 'border-yellow-500';
            case 4:
                return 'border-blue-500';
            case 5:
                return 'border-cyan-500';
            default:
                return 'border-blue-500';
        }
    }

    function getBgColor($category)
    {
        switch ($category) {
            case 1:
                return 'bg-green-500';
            case 2:
                return 'bg-red-500';
            case 3:
                return 'bg-yellow-500';
            case 4:
                return 'bg-blue-500';
            case 5:
                return 'bg-cyan-500';
            default:
                return 'bg-blue-500';
        }
    }
@endphp

<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">

        {{-- Filter --}}
        <form method="GET" autocomplete="off">
            <div class="w-full flex flex-col md:flex-row items-center justify-start pb-2">
                    @csrf
                    <div class="mr-2 w-32">
                        <select name="year" id="year" class="text-sm rounded-lg block w-full appearance-none bg-gray-50 border border-gray-300">
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative md:w-1/2 flex items-center mr-2">
                        <div class="absolute inset-y-0 left-2 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                              </svg>
                        </div>
                            <input type="text" id="daterange"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                                placeholder="Огноо" name="daterange" value="{{ $daterange }}">
                    </div>
                    <div class="w-1/2 flex items-center mr-2">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2" placeholder="Хайх утгаа оруулна уу" name="search_text" value="{{ $search_text }}">
                        </div>
                    </div>
                    <button id="resetFilters" class="mr-2 text-gray-500">
                        <svg id="resetIcon" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12C21 16.9706 16.9706 21 12 21C9.69494 21 7.59227 20.1334 6 18.7083L3 16M3 12C3 7.02944 7.02944 3 12 3C14.3051 3 16.4077 3.86656 18 5.29168L21 8M3 21V16M3 16H8M21 3V8M21 8H16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </button>
                    
                    <button type="submit"
                        class="flex items-center justify-center text-white bg-primary hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        Хайх
                    </button>
                
            </div>
            {{-- <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                <button type="button" id="export-btn"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    Export
                </button>
            </div> --}}

        </form>

        {{-- List of complaints --}}
        @if (count($complaints) > 0)
            @foreach ($complaints as $complaint)
                <div class="mx-auto border border-gray-200 rounded-lg text-gray-700 mb-0.5 h-30 complaint-show cursor-pointer hover:bg-gray-100"
                    data-id="{{ $complaint->id }}">
                    <div class="flex p-3 border-l-4 {{ getBorderColor($complaint->category_id) }} rounded-lg">
                        <div class="space-y-1 border-r-2 pr-3">
                            <div class="text-xs leading-5 font-semibold"><span
                                    class="text-xs leading-4 font-normal text-gray-500"> №</span>
                                {{ $complaint->serial_number }}</div>
                            <div class="text-xs leading-5"><span class="text-xs leading-4 font-normal text-gray-500 pr">
                                    Төрөл: </span> {{ $complaint->energyType?->name }}</div>
                            <div class="text-xs leading-5"><span class="text-xs leading-4 font-normal text-gray-500">
                                    {{ $complaint->status?->name }}: </span>{{ $complaint->updated_at }}</div>
                            @if ($status_id != 6)
                                <div class="text-sm leading-5"><span
                                        class="text-xs leading-4 font-normal text-gray-500"> Үлдсэн хугацаа: </span>
                                    @if ($complaint->hasExpired())
                                        <span class="text-red-500 text-xs">Хугацаа хэтэрсэн</span>
                                    @else
                                        <span>{{ now()->diffInHours($complaint->expire_date) > 24 ? now()->diffInDays($complaint->expire_date) . ' өдөр' : now()->diffInHours($complaint->expire_date) . ' цаг' }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="ml-3 space-y-1 border-r-2 pr-3">
                                <div class="text-sm leading-4 font-semibold">
                                    {{ $complaint->complaint_maker_type_id == 1 ? $complaint->lastname . ' ' . $complaint->firstname : $complaint->complaint_maker_org_name }}
                                    <span
                                        class="text-xs leading-4 font-normal text-gray-500">({{ $complaint->complaintMakerType?->name }})</span>
                                </div>
                                <div class="text-sm leading-4 font-normal">{{ Str::limit($complaint->complaint, 200) }}
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->org_id == 99)
                            <div class="border-r-2 w-60">
                                <div>
                                    <div class="p-1">
                                        <div class="text-xs leading-4 font-medium text-gray-500">Холбогдох ТЗЭ</div>
                                        <div class="text-sm leading-4 font-semibold text-gray-800">
                                            {{ $complaint->secondOrg?->name }}
                                        </div>
                                        @if ($status_id == 1)
                                            <div>
                                                @if ($complaint->second_status_id !== null)
                                                    @switch($complaint->second_status_id)
                                                        @case('0')
                                                            <div class="text-sm">Шинээр ирсэн</div>
                                                        @break

                                                        @case('2')
                                                            <div class="text-orange-900 text-sm">Хүлээн авсан</div>
                                                        @break

                                                        @case('3')
                                                            <div class="text-blue-900 text-sm">Хянаж байгаа</div>
                                                        @break

                                                        @case('4')
                                                            <div class="text-gray-900 text-sm">Цуцалсан</div>
                                                        @break

                                                        @case('6')
                                                            <div class="text-green-900 text-sm">Шийдвэрлэсэн</div>
                                                        @break

                                                        @default
                                                            <div class="text-sm">Шинээр ирсэн</div>
                                                    @endswitch
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div>
                            <div class="ml-3 my-5 {{ getBgColor($complaint->category_id) }} p-1 w-20">
                                <div class="uppercase text-xs leading-4 font-semibold text-center text-white">
                                    {{ $complaint->category?->name }}</div>
                            </div>
                        </div>
                        <div>
                            <div x-data="{ open: false }" class="inline-flex relative">
                                <button @click="open = ! open"
                                    class="text-gray-100 rounded-sm my-5 ml-2 focus:outline-none bg-gray-500 hover:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-cloak x-show="open" @click.away="open = false"
                                    class="w-32 absolute top-10 right-0 p-2 bg-white border border-gray-200 rounded-lg shadow">
                                    <div class="px-2 py-1 cursor-pointer hover:bg-sky-100 rounded-lg">Edit</div>
                                    <div class="px-2 py-1 cursor-pointer hover:bg-sky-100 rounded-lg">Delete</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $complaints->links() !!}
        @else
            <div class="text-gray-500">
                <img class="w-32 h-32 mx-auto" src="{{ asset('/image/empty.svg') }}" alt="image empty states">
                <p class="text-gray-500 font-medium text-lg text-center">Мэдээлэл байхгүй байна.</p>
            </div>
        @endif
        <br>
    </div>
</x-admin-layout>

@push('scripts')

<script>
    $(document).ready(function() {
        flatpickr("#daterange", {
            mode: "range",
            dateFormat: "Y-m-d",
            locale: {
                firstDayOfWeek: 1
            }
        });
        $('#resetFilters').on('click', function() {

            $('#resetIcon').addClass('animate-spin');
            setTimeout(() => {
                $('#resetIcon').removeClass('animate-spin');
            }, 1000);

            // Reset filter values to their default or empty state
            $('#daterange').val('');
            $('#simple-search').val(''); 

            $('#daterange').change();
            $('#simple-search').change(); 
        });

        // Add click event handler to table rows with class 'table-row'
        $('.complaint-show').click(function() {
            // Get the value of the 'data-id' attribute of the clicked row
            var id = $(this).data('id');

            $.ajax({
                url: '/updateComplaintStatus/' + id,
                method: 'PUT',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {},
                success: function(response) {
                    console.log(response.message);
                },
                error: function(error) {
                    console.error(error.responseText);
                }
            });

            window.location.href = '/complaint/' + id;

        });
    });

</script>
