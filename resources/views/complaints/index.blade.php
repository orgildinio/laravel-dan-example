<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">
        @if (Auth::user()->role?->name == 'ehzh' || Auth::user()->role?->name == 'admin' || Auth::user()->role?->name == 'udirdlaga')
            <div class="flex justify-end space-x-2">
                <a href="{{ route('report1.show') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Тайлан 1</a>
                <a href="{{ route('energyReport') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Тайлан
                    2</a>
                <a href="{{ route('reportDetail') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Тайлан
                    3</a>
                <a href="{{ route('reportStatus') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Тайлан
                    4</a>
            </div>
        @endif
        <div class="">
            <h1 class="text-xl font-bold"> Нийт ирсэн санал, хүсэлт</h1>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 py-4">
            <div class="w-full">
                <form method="GET" autocomplete="off">
                    @csrf
                    <div class="flex flex-wrap items-center gap-2">
                        <div class="mr-1">
                            <input type="text" id="serial_number"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                placeholder="Дугаар" name="serial_number" value="{{ $serial_number }}">
                        </div>
                        <div class="mr-1">
                            <input type="text" id="simple-search"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                placeholder="Хайх" name="search_text" value="{{ $search_text }}">
                        </div>
                        <div class="mr-1">
                            <input type="text" id="daterange"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2"
                                name="daterange" placeholder="Огноо" value="{{ $daterange }}">
                        </div>
                        <div class="mr-1">
                            <select name="status_id" id="status_id"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
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
                                    class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                    <option value="">Байгууллага</option>
                                    @foreach ($orgs as $org)
                                        <option value="{{ $org->id }}"
                                            {{ old('org_id', $org_id) == $org->id ? 'selected' : '' }}>
                                            {{ $org->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-1">
                                <select name="second_org_id" id="seond_org_id"
                                    class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                    <option value="">Хариуцсан ТЗЭ</option>
                                    @foreach ($orgs as $org)
                                        <option value="{{ $org->id }}"
                                            {{ old('second_org_id', $second_org_id) == $org->id ? 'selected' : '' }}>
                                            {{ $org->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-1">
                                <select name="energy_type_id" id="energy_type_id"
                                    class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                    <option value="">Энергийн төрөл</option>
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
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
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
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                <option value="">Суваг</option>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}"
                                        {{ old('channel_id', $channel_id) == $channel->id ? 'selected' : '' }}>
                                        {{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mr-1">
                            <input type="text" id="user_code"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                placeholder="Код" name="user_code" value="{{ $user_code }}">
                        </div>
                        <div class="mr-1">
                            <input type="text" id="phone"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                placeholder="Утас" name="phone" value="{{ $phone }}">
                        </div>
                        <div class="mr-1">
                            <select name="expire_status" id="expire_status"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                <option value="" {{ $expire_status == '' ? 'selected' : '' }}>Бүгд</option>
                                <option value="expired" {{ $expire_status == 'expired' ? 'selected' : '' }}>Хугацаа
                                    хэтэрсэн</option>
                                <option value="not_expired" {{ $expire_status == 'not_expired' ? 'selected' : '' }}>
                                    Хугацаа хэтрээгүй</option>
                            </select>
                        </div>
                        <div class="mr-1">
                            <select name="complaint_type_id" id="complaint_type_id"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                <option value="">Гомдлын төрөл</option>
                                @foreach ($complaint_types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('complaint_type_id', $complaint_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mr-1">
                            <select name="complaint_type_summary_id" id="complaint_type_summary_id"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                <option value="">Товч утга</option>
                                {{-- @foreach ($complaint_type_summaries as $summary)
                                    <option value="{{ $summary->id }}"
                                        {{ old('complaint_type_summary_id', $complaint_type_summary_id) == $summary->id ? 'selected' : '' }}>
                                        {{ $summary->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="mr-1">
                            <a href="{{ url()->current() }}" class="flex items-center justify-center bg-gray-300 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                                Цэвэрлэх
                            </a>
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
                <a class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                    href="{{ route('exportReportExcel', ['daterange' => Request::get('daterange'), 'energy_type_id' => Request::get('energy_type_id'), 'search_text' => Request::get('search_text'), 'status_id' => Request::get('status_id'), 'org_id' => Request::get('org_id'), 'second_org_id' => Request::get('second_org_id'), 'energy_type_id' => Request('energy_type_id'), 'controlled_user_id' => Request('controlled_user_id'), 'channel_id' => Request('channel_id'), 'user_code' => Request('user_code'), 'phone' => Request('phone'), 'expire_status' => Request('expire_status'), 'complaint_type_id' => Request('complaint_type_id'), 'complaint_type_summary_id' => Request('complaint_type_summary_id')]) }}">
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
        <div class="overflow-x-auto border border-t-2 border-l-2 border-r-2 border-gray-300 rounded-lg">
            <table class="min-w-full table-fixed" id="complaint-report">
                <thead>
                    <tr>
                        <th
                            class="p-2 w-[5px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            №</th>
                        <th
                            class="p-2 w-[5px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Дугаар</th>
                        <th
                            class="p-2 w-[100px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Төрөл</th>
                        <th
                            class="p-2 w-[100px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Суваг</th>
                        <th
                            class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Төлөв</th>
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Мэргэжилтэн</th>
                        @if (Auth::user()->org_id == 99)
                            <th
                                class="p-2 w-[200px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                                Байгууллага</th>
                            <th
                                class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                                Холбогдох ТЗЭ</th>
                            <th
                                class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                                Төрөл</th>
                        @endif
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Овог, нэр / ААН</th>

                        <th
                            class="p-2 w-[500px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Санал, хүсэлт</th>
                        <th
                            class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Бүртгэсэн огноо</th>
                        <th
                            class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Шийдвэрлэсэн огноо</th>
                        <th
                            class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Шийдвэрлэсэн хоног</th>
                        <th
                            class="p-2 w-[100px] text-xs font-medium leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-300 bg-gray-50">
                            Үлдсэн хугацаа</th>
                            <th></th>
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
                                <div class="text-sm leading-5 text-gray-900">{{ $complaint->serial_number }}
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">{{ $complaint->category?->name }}
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap border-b border-gray-300">
                                <div class="text-sm leading-5 text-gray-900">{{ $complaint->channel?->name }}
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
                                                <div
                                                    class="bg-cyan-100 text-cyan-900 p-1 text-center rounded text-xs whitespace-nowrap">
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
                            <td
                                class="p-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-300">
                                <span>{{ $complaint->status_id == 6 ? date('Y-m-d H:i', strtotime($complaint->updated_at)) : '' }}</span>
                            </td>
                            <td
                                class="p-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-300">
                                @if($complaint->status_id == 6)
                                    <span>
                                        {{ \Carbon\Carbon::parse($complaint->complaint_date)->diffInDays($complaint->updated_at) }} хоног
                                    </span>
                                @else
                                    <span>-</span>
                                @endif
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
                            @if (Auth::user()->role?->name == 'admin')
                            <td
                                class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                <form action="{{ route('complaint.destroy',$complaint->id) }}"
                                    method="Post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-6 h-6 text-red-600 hover:text-red-800" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg></button>
                                </form>
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
                'second_org_id' => $second_org_id,
                'energy_type_id' => $energy_type_id,
                'controlled_user_id' => $controlled_user_id,
                'channel_id' => $channel_id,
                'phone' => $phone,
                'user_code' => $user_code,
                'expire_status' => $expire_status,
                'complaint_type_id' => $complaint_type_id,
                'complaint_type_summary_id' => $complaint_type_summary_id,
                'relatedComplaintIds' => $relatedComplaintIds
            ])->links() !!}
    </div>
</x-admin-layout>

@push('scripts')

    <script type="module">
        $(document).ready(function() {

            flatpickr("#daterange", {
                mode: "range",
                dateFormat: "Y-m-d",
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

            // find complaint_type_summaries depending on complaint_type
            $('#energy_type_id, #complaint_type_id').on('change', function () {
            // var complaintTypeId = $(this).val();
            var energy_type_id = $("#energy_type_id").val();
            var complaint_type_id = $("#complaint_type_id").val();

            if (energy_type_id && complaint_type_id) {
                $.ajax({
                    // url: '/getComplaintSummaries/' + complaintTypeId,
                    // type: 'GET',
                    // dataType: 'json',
                    // success: function (data) {
                    //     $('#complaint_type_summary_id').empty();
                    //     $('#complaint_type_summary_id').append('<option value="">Товч утга</option>');
                    //     $.each(data, function (key, value) {
                    //         $('#complaint_type_summary_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    //     });
                    // }
                    url: '/getTypeSummary',
                        method: 'GET',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            energy_type_id: energy_type_id,
                            complaint_type_id: complaint_type_id,
                        },
                        success: function(result) {
                            $('#complaint_type_summary_id').html(
                                '<option value="">-- Сонгох --</option>');
                            $.each(result.summaries, function(key, value) {
                                $("#complaint_type_summary_id").append('<option value="' +
                                    value
                                    .id + '">' + value.name + '</option>');
                            });
                        },
                        error: function(error) {
                            console.error('Error getting summary data...');
                        }
                });
            } else {
                $('#complaint_type_summary_id').empty();
                $('#complaint_type_summary_id').append('<option value="">Товч утга</option>');
            }
        });
        });
    </script>
