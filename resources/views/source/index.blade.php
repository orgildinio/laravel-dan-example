@php
    function getBorderColor($category)
    {
        switch ($category) {
            case 'Талархал':
                return 'border-green-500';
            case 'Гомдол':
                return 'border-red-500';
            case 'Санал':
                return 'border-yellow-500';
            case 'Хүсэлт':
                return 'border-blue-500';
            case 'Лавлагаа':
                return 'border-cyan-500';
            default:
                return 'border-blue-500';
        }
    }

    function getBgColor($category)
    {
        switch ($category) {
            case 'Талархал':
                return 'bg-green-500';
            case 'Гомдол':
                return 'bg-red-500';
            case 'Санал':
                return 'bg-yellow-500';
            case 'Хүсэлт':
                return 'bg-blue-500';
            case 'Лавлагаа':
                return 'bg-cyan-500';
            default:
                return 'bg-blue-500';
        }
    }
@endphp
<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">

        {{-- Filter --}}
        <form id="searchForm" method="GET" autocomplete="off">
            <div class="w-full flex flex-col md:flex-row items-center justify-start pb-2">
                @csrf
                <div class="md:w-32 w-full md:mr-2 mr-0 mb-2">
                    <select name="year" id="year"
                        class="text-sm text-gray-600 rounded-lg block w-full appearance-none bg-gray-50 border border-gray-400">
                        @foreach ($years as $year)
                            <option value="{{ $year }}"
                                {{ old('year', $selected_year) == $year ? 'selected' : '' }}>{{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="md:w-1/4 w-full md:mr-2 flex items-center mr-0 mb-2">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                fill="currentColor">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="🔍-System-Icons" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd">
                                        <g id="ic_fluent_number_symbol_24_regular" fill="currentColor"
                                            fill-rule="nonzero">
                                            <path
                                                d="M17.2881302,2.00089344 L17.3894,2.01308 C17.7964,2.09007 18.064,2.48242 17.987,2.88941 L17.987,2.88941 L17.0214,7.99404 L21.2496,7.99207 C21.6639,7.99187 21.9998,8.3275 21.9999999,8.74172 C21.9999999,9.15593 21.6646,9.49187 21.2503,9.49207 L21.2503,9.49207 L16.7376,9.49417 L15.7919,14.4939 L20.2496,14.4918 C20.6639,14.4916 20.9998,14.8273 20.9999999,15.2415 C21.0002,15.6557 20.6646,15.9916 20.2503,15.9918 L20.2503,15.9918 L15.5081,15.994 L14.4869,21.3924 C14.41,21.7994 14.0176,22.0669 13.6106,21.9899 C13.2036,21.9129 12.9361,21.5206 13.0131,21.1136 L13.0131,21.1136 L13.9814,15.9948 L8.50742,15.9973 L7.48688,21.3924 C7.4099,21.7994 7.01755,22.0669 6.61055,21.9899 C6.20356,21.9129 5.93603,21.5206 6.01302,21.1136 L6.01302,21.1136 L6.98068,15.998 L2.75035,16 C2.33614,16.0002 1.99999992,15.6646 1.99999992,15.2503 C1.99999992,14.8361 2.33544,14.5002 2.74965,14.5 L2.74965,14.5 L7.26445,14.4979 L8.2102,9.49816 L3.75035,9.50024 C3.33614,9.50044 3.00019,9.16481 2.99999992,8.75059 C2.99981,8.33638 3.33544,8.00044 3.74965,8.00024 L3.74965,8.00024 L8.49396,7.99803 L9.51305,2.61062 C9.59003,2.20362 9.98238,1.9361 10.3894,2.01308 C10.7964,2.09007 11.0639,2.48242 10.9869,2.88941 L10.9869,2.88941 L10.0207,7.99731 L15.4946,7.99476 L16.5131,2.61062 C16.5901,2.20362 16.9824,1.9361 17.3894,2.01308 Z M15.2109,9.49489 L9.73693,9.49745 L8.79118,14.4972 L14.2651,14.4946 L15.2109,9.49489 Z"
                                                id="🎨-Color"> </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <input type="text" id="serial_number"
                            class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                            placeholder="Дугаар" name="serial_number" value="{{ $serial_number }}">
                    </div>
                </div>
                <div class="relative flex items-center md:w-1/4 w-full md:mr-2 mr-0 mb-2">
                    <div class="absolute inset-y-0 left-2 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                    </div>
                    <input type="text" id="daterange"
                        class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                        placeholder="Огноо" name="daterange" value="{{ $daterange }}">
                </div>
                <div class="md:w-2/4 w-full md:mr-2 flex items-center mr-0 mb-2">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor"
                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                            </svg>
                        </div>
                        <input type="text" id="simple-search"
                            class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                            placeholder="Хайх утгаа оруулна уу" name="search_text" value="{{ $search_text }}">
                    </div>
                </div>

                <div class="flex flex-row mt-2 md:mt-0">
                    <button id="resetFilters" class="mr-2 mb-2 text-gray-500">
                        <svg id="resetIcon" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M21 12C21 16.9706 16.9706 21 12 21C9.69494 21 7.59227 20.1334 6 18.7083L3 16M3 12C3 7.02944 7.02944 3 12 3C14.3051 3 16.4077 3.86656 18 5.29168L21 8M3 21V16M3 16H8M21 3V8M21 8H16"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </button>

                    <button type="submit"
                        class="text-white bg-primary hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 mb-2">
                        Хайх
                    </button>
                </div>
            </div>
        </form>


        @if (count($complaints) > 0)
            @foreach ($complaints as $complaint)
                <div class="mx-auto border border-gray-400 rounded-lg text-gray-700 mb-0.5 h-30 clickable-row cursor-pointer hover:bg-gray-100"
                    data-url="{{ route('complaint.create') }}" data-created="{{ $complaint->created_date }}"
                    data-fullname="{{ $complaint->fullname }}" data-phone="{{ $complaint->phone }}"
                    data-email="{{ $complaint->email }}" data-city="{{ $complaint->city }}"
                    data-district="{{ $complaint->district }}" data-address="{{ $complaint->address }}"
                    data-content="{{ $complaint->content }}" data-number="{{ $complaint->number }}"
                    data-quarter="{{ $complaint->quarter }}" data-type="{{ $complaint->type }}">
                    <div class="flex p-3 border-l-4 {{ getBorderColor($complaint->type) }} rounded-lg">
                        <div class="space-y-1 border-r-2 pr-3">
                            <div class="text-xs leading-5 font-semibold"><span
                                    class="text-xs leading-4 font-normal text-gray-500"> №</span>
                                {{ $complaint->number }}</div>
                            <div class="text-xs leading-5"><span
                                    class="text-xs leading-4 font-normal text-gray-500 pr">
                                    Төрөл: </span> {{ $complaint->type }}</div>
                            <div class="text-xs leading-5"><span class="text-xs leading-4 font-normal text-gray-500">
                                    Шинээр ирсэн: </span>{{ $complaint->created_date }}</div>
                        </div>
                        <div class="flex-1">
                            <div class="ml-3 space-y-1 border-r-2 pr-3">
                                <div class="text-sm leading-4 font-semibold">
                                    {{ $complaint->fullname }}
                                    <span class="text-xs leading-4 font-normal text-gray-500">Иргэн</span>
                                </div>
                                <div class="text-sm leading-4 font-normal">
                                    {{-- {{ Str::limit($complaint['content'], 200) }} --}}
                                    {{-- {{ html_entity_decode($complaint['content'], ENT_QUOTES, 'UTF-8') }} --}}
                                    {{ $complaint->content }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ml-3 my-5 {{ getBgColor($complaint->type) }} p-1 w-20">
                                <div class="uppercase text-xs leading-4 font-semibold text-center text-white">
                                    {{ $complaint->type }}</div>
                            </div>
                            @if (isset($complaint->complaint_id))
                                <div class="ml-3 p-1 bg-gray-100 rounded text-xs">
                                    Бүртгэгдсэн
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <br>
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
        function createCategoryId(str) {
            let category_id = null;
            switch (str) {
                case 'Талархал':
                    category_id = 1;
                    break;
                case 'Гомдол':
                    category_id = 2;
                    break;
                case 'Санал':
                    category_id = 3;
                    break;
                case 'Хүсэлт':
                    category_id = 4;
                    break;
                case 'Лавлагаа':
                    category_id = 5;
                    break;
                case 'Тодорхойгүй':
                    category_id = 7;
                    break;
                case 'Дуудлага':
                    category_id = 8;
                    break;
                default:
                    category_id = 0;
                    break;
            }
            return category_id;
        }
        $(document).ready(function() {
            $('.clickable-row').click(function() {
                const url = $(this).data('url');
                const created = $(this).data('created');
                const fullname = $(this).data('fullname');
                const phone = $(this).data('phone');
                const email = $(this).data('email');
                const city = $(this).data('city');
                const district = $(this).data('district');
                const address = $(this).data('address');
                const content = $(this).data('content');
                const number = $(this).data('number');
                const quarter = $(this).data('quarter');

                const nameParts = fullname.split(' ');
                const firstname = nameParts[0];
                const lastname = nameParts.slice(1).join(' ');

                const type = $(this).data('type');
                const category_id = createCategoryId(type);
                console.log('category_id: ', category_id);

                // Create a temporary DOM element to decode the HTML entities
                var tempElement = document.createElement('div');
                tempElement.innerHTML = content;

                // Retrieve the decoded text from the temporary element
                var decodedText = tempElement.textContent || tempElement.innerText;

                // Redirect to create page with data
                window.location.href = url + '?firstname=' + firstname + '&lastname=' + lastname +
                    '&email=' + email + '&created=' + created + '&phone=' + phone + '&city=' + city +
                    '&district=' + district + '&address=' + address + '&content=' + decodedText +
                    '&number=' + number + '&quarter=' + quarter + '&channel_id=7' + '&category_id=' + category_id;
            });

            $('#resetFilters').on('click', function() {

                $('#resetIcon').addClass('animate-spin');
                setTimeout(() => {
                    $('#resetIcon').removeClass('animate-spin');
                }, 1000);

                // Reset filter values to their default or empty state
                $('#daterange').val('');
                $('#simple-search').val('');
                $('#year').val('');

                $('#daterange').change();
                $('#simple-search').change();
                $('#year').change();
            });

            $('#searchForm input, #searchForm select').keypress(function(event) {
                if (event.keyCode === 13) { // Check if Enter key is pressed
                    event.preventDefault(); // Prevent form submission
                    $('#searchForm').submit(); // Submit the form
                }
            });

        });
    </script>
