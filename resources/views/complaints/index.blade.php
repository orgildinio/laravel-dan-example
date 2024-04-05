<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">
        <div class="">
            <h1 class="text-xl font-bold"> Нийт ирсэн санал, хүсэлт</h1>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 py-4">
            <div class="w-full md:w-2/3">
                <form method="GET" autocomplete="off">
                    @csrf
                    <div class="flex flex-row justify-start items-center">
                        <div class="mr-1">
                            <input type="text" id="simple-search"
                                class="w-32 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                placeholder="Хайх" name="search_text" value="{{ $search_text }}">
                        </div>
                        <div class="mr-1">
                            <input type="text" id="daterange"
                                class="w-32 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg p-2"
                                name="daterange" placeholder="Огноо" value="{{ $daterange }}">
                        </div>
                        <div class="mr-1">
                            <select name="status_id" id="status_id"
                                class="w-32 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg p-2">
                                <option value="">Төлөв</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ old('status_id', $status_id) === $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if (Auth::user()->org_id == 99)
                        <div class="mr-1">
                            <select name="org_id" id="org_id"
                                class="w-32 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg p-2">
                                <option value="">Байгууллага</option>
                                @foreach ($orgs as $org)
                                    <option value="{{ $org->id }}"
                                        {{ old('org_id', $org_id) == $org->id ? 'selected' : '' }}>
                                        {{ $org->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mr-1">
                            <select name="energy_type_id" id="energy_type_id"
                                class="w-32 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg p-2">
                                <option value="">Төрөл</option>
                                @foreach ($energy_types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('energy_type_id', $energy_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="mr-1">
                            <select name="controlled_user_id" id="controlled_user_id"
                                class="w-32 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg p-2">
                                <option value="">Мэргэжилтэн</option>
                                @foreach ($controlled_users as $controlled_user)
                                    <option value="{{ $controlled_user->id }}"
                                        {{ old('controlled_user_id', $controlled_user_id) == $controlled_user->id ? 'selected' : '' }}>
                                        {{ $controlled_user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mr-1">
                            <select name="channel_id" id="channel_id"
                                class="w-32 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg p-2">
                                <option value="">Суваг</option>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}"
                                        {{ old('channel_id', $channel_id) == $channel->id ? 'selected' : '' }}>
                                        {{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit"
                                class="flex items-center justify-center text-white bg-primary hover:bg-primaryHover focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                                Хайх
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <a class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-400 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                    href="{{ route('exportReportExcel', ['daterange' => Request::get('daterange'), 'energy_type_id' => Request::get('energy_type_id'), 'search_text' => Request::get('search_text'), 'status_id' => Request::get('status_id'), 'org_id' => Request::get('org_id'), 'energy_type_id' => Request('energy_type_id'), 'controlled_user_id' => Request('controlled_user_id'), 'channel_id' => Request('channel_id')]) }}">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    Export
                    {{-- <img src="{{ asset('/image/excel-document.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="dashboard"> --}}
                </a>
            </div>
        </div>
        <div class="overflow-x-auto border border-gray-300 rounded-lg">
            <table class="min-w-full table-fixed" id="complaint-report">
                <thead>
                    <tr>
                        <th
                            class="p-2 w-[5px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            ID</th>
                        <th
                            class="p-2 w-[100px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Төрөл</th>
                        <th
                            class="p-2 w-[100px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Суваг</th>
                        <th
                            class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Төлөв</th>
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Мэргэжилтэн</th>
                        @if (Auth::user()->org_id == 99)
                        <th
                            class="p-2 w-[200px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Байгууллага</th>
                        <th
                            class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Холбогдох ТЗЭ</th>
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Төрөл</th>
                        @endif
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Овог, нэр / ААН</th>

                        <th
                            class="p-2 w-[500px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Санал, хүсэлт</th>
                        <th
                            class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Огноо</th>
                        <th
                            class="p-2 w-[100px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-400 bg-gray-50">
                            Үлдсэн хугацаа</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($complaints as $key => $complaint)
                        <tr class="table-row hover:bg-gray-100 cursor-pointer" data-id="{{ $complaint->id }}">
                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="flex items-center">
                                    {{ $key + $complaints->firstItem() }}
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">{{ $complaint->category->name }}
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">{{ $complaint->channel->name }}
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">
                                    @if ($complaint->status_id !== null)
                                        @switch($complaint->status_id)
                                            @case('0')
                                                <div class="bg-gray-100 p-1 text-center rounded text-xs">Шинээр ирсэн</div>
                                            @break

                                            @case('1')
                                                <div class="bg-cyan-100 text-cyan-900 p-1 text-center rounded text-xs whitespace-nowrap">
                                                    Шилжүүлсэн</div>
                                            @break

                                            @case('2')
                                                <div class="bg-orange-100 text-orange-900 p-1 text-center rounded text-xs">
                                                    Хүлээн
                                                    авсан</div>
                                            @break

                                            @case('3')
                                                <div class="bg-blue-100 text-blue-900 p-1 text-center rounded text-xs">Хянаж
                                                    байгаа</div>
                                            @break

                                            @case('4')
                                                <div class="bg-red-100 text-red-900 p-1 text-center rounded text-xs">Цуцалсан
                                                </div>
                                            @break

                                            @case('6')
                                                <div class="bg-green-100 text-green-900 p-1 text-center rounded text-xs">
                                                    Шийдвэрлэсэн</div>
                                            @break

                                            @default
                                                <div class="bg-gray-100 p-1 text-center rounded text-xs">Шинээр ирсэн</div>
                                        @endswitch
                                    @endif
                                    {{-- {{$complaint->status_id}} --}}
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">{{ $complaint->controlledUser?->name }}
                                </div>
                            </td>

                            @if (Auth::user()->org_id == 99)
                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">{{ $complaint->organization?->name }}
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">{{ $complaint->secondOrg?->name }}
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">{{ $complaint->energyType?->name }}
                                </div>
                            </td>
                            @endif

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ $complaint->complaint_maker_type_id == 1 ? $complaint->lastname . ' ' . $complaint->firstname : $complaint->complaint_maker_org_name }}
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300 text-sm">
                                <p>{{ Str::limit($complaint->complaint, 150) }}
                                </p>
                            </td>

                            <td
                                class="p-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-300">
                                <span>{{ date('Y-m-d H:i', strtotime($complaint->complaint_date)) }}</span>
                            </td>
                            @if ($complaint->status_id == 6)
                                <td class="p-2 whitespace-no-wrap border-b border-gray-300"></td>
                            @else
                                <td
                                    class="p-2 text-xs text-center leading-5 whitespace-no-wrap border-b border-gray-300">
                                    @if ($complaint->hasExpired())
                                    <span class="text-red-500 text-xs">Хугацаа хэтэрсэн</span>
                                    @else
                                    <span>{{ now()->diffInHours($complaint->expire_date) > 24 ? now()->diffInDays($complaint->expire_date) . ' өдөр' : now()->diffInHours($complaint->expire_date) . ' цаг' }}</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        {!! $complaints->appends([
                'search_text' => $search_text,
                'daterange' => $daterange,
                'status_id' => $status_id,
                'org_id' => $org_id,
                'energy_type_id' => $energy_type_id,
                'controlled_user_id' => $controlled_user_id,
                'channel_id' => $channel_id,
            ])->links() !!}
    </div>
</x-admin-layout>

@push('scripts')

    <script>
        $(document).ready(function() {

            $('#daterange').flatpickr({
                mode: 'range',
                // showMonths: 2,
                // dateFormat: 'Y-m-d',
                locale: {
                    firstDayOfWeek: 1
                }
            });

            // Add click event handler to table rows with class 'table-row'
            $('.table-row').click(function() {
                // Get the value of the 'data-id' attribute of the clicked row
                var id = $(this).data('id');

                window.location.href = '/complaint/' + id;

            });
        });
    </script>
