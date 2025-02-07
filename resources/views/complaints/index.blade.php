<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">
        @if (Auth::user()->role?->name == 'ehzh' ||
                Auth::user()->role?->name == 'admin' ||
                Auth::user()->role?->name == 'udirdlaga')
            <div class="flex justify-end space-x-2">
                <a href="{{ route('report1.show') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Тайлан 1</a>
                <a href="{{ route('energyReport') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Тайлан
                    2</a>
                <a href="{{ route('reportDetail') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Тайлан
                    3</a>
                <a href="{{ route('reportStatus') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Тайлан
                    4</a>
            </div>
        @endif
        <div class="">
            <h1 class="text-xl font-bold"> Нийт ирсэн санал, хүсэлт</h1>
        </div>
        <form method="GET" action={{ route('complaint.index') }}>
            @csrf
            <div
                class="flex
            flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 py-4">
                <div class="w-full">
                    <div class="flex flex-wrap items-center gap-2">
                        <div class="mr-1">
                            <input type="text" id="daterange"
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2"
                                name="daterange" placeholder="Огноо" value="{{ $daterange }}">
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
                            </select>
                        </div>
                        <div class="mr-1">
                            <a href="{{ url()->current() }}"
                                class="flex items-center justify-center bg-gray-300 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
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
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <a class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                        href="{{ route('exportReportExcel', request()->all()) }}">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        Export
                    </a>
                </div>

            </div>
            <div class="overflow-x-auto border border-t-2 border-l-2 border-r-2 border-gray-300 rounded-lg">
                <table class="min-w-full table-fixed text-small" id="complaint-report">
                    <thead>
                        <tr>
                            <th
                                class="p-2 w-[5px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                №</th>
                            <th
                                class="p-2 w-[5px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Дугаар</th>
                            <th
                                class="p-2 w-[100px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Ангилал</th>
                            <th
                                class="p-2 w-[100px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Суваг</th>
                            <th
                                class="p-2 w-[500px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Төлөв</th>
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Мэргэжилтэн</th>
                            @if (Auth::user()->org_id == 99)
                                <th
                                    class="p-2 w-[200px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                    Байгууллага</th>
                                <th
                                    class="p-2 w-[150px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                    Холбогдох ТЗЭ</th>
                                <th
                                    class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                    Төрөл</th>
                            @endif
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Овог, нэр / ААН</th>

                            <th
                                class="p-2 w-[500px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Санал, хүсэлт</th>
                            <th
                                class="p-2 w-[150px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Өргөдөл гомдол гаргасан огноо</th>
                            <th
                                class="p-2 w-[150px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Бүртгэсэн огноо</th>
                            <th
                                class="p-2 w-[150px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Шийдвэрлэсэн огноо</th>
                            <th
                                class="p-2 w-[150px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Шийдвэрлэсэн хоног</th>
                            <th
                                class="p-2 w-[100px] font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                Үлдсэн хугацаа</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>
                            </th>
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <input type="text" id="serial_number"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                    name="serial_number" value="{{ $serial_number }}">
                            </th>
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <select name="category_id" id="category_id"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                    <option value=""></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <select name="channel_id" id="channel_id"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                    <option value=""></option>
                                    @foreach ($channels as $channel)
                                        <option value="{{ $channel->id }}"
                                            {{ old('channel_id', $channel_id) == $channel->id ? 'selected' : '' }}>
                                            {{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <select name="status_id" id="status_id"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                    <option value=""></option>
                                    @foreach ($statuses as $status)
                                        {{-- <option value="{{ $status->id }}"
                                            {{ old('status_id', $status_id) == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}</option> --}}
                                        <option value="{{ $status->id }}"
                                            {{ isset($status_id) && old('status_id', $status_id) == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <select name="controlled_user_id" id="controlled_user_id"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                    <option value=""></option>
                                    @foreach ($controlled_users as $controlled_user)
                                        <option value="{{ $controlled_user->id }}"
                                            {{ old('controlled_user_id', $controlled_user_id) == $controlled_user->id ? 'selected' : '' }}>
                                            {{ $controlled_user->name }}</option>
                                    @endforeach
                                </select>
                            </th>
                            @if (Auth::user()->org_id == 99)
                                <th
                                    class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                    <select name="org_id" id="org_id"
                                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                        <option value=""></option>
                                        @foreach ($orgs as $org)
                                            <option value="{{ $org->id }}"
                                                {{ old('org_id', $org_id) == $org->id ? 'selected' : '' }}>
                                                {{ $org->name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th
                                    class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                    <select name="second_org_id" id="seond_org_id"
                                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                                        <option value=""></option>
                                        @foreach ($orgs as $org)
                                            <option value="{{ $org->id }}"
                                                {{ old('second_org_id', $second_org_id) == $org->id ? 'selected' : '' }}>
                                                {{ $org->name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                </th>
                            @endif
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <input type="text" id="simple-search"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                    name="search_text" value="{{ $search_text }}">
                            </th>

                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <input type="text" id="simple-search"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                    name="search_text" value="{{ $search_text }}">
                            </th>
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <input type="date" id=""
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                    name="complaint_date" value="{{ $complaintDate }}">
                            </th>
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <input type="date" id=""
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                    name="created_at" value="{{ $createdAt }}">
                            </th>
                            <th
                                class="p-2 font-medium leading-4 tracking-wider text-center text-gray-800 uppercase border bg-gray-50">
                                <input type="date" id=""
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2"
                                    name="updated_at" value="{{ $updatedAt }}">
                            </th>
                            <th>
                            </th>
                            <th>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($complaints as $key => $complaint)
                            <tr class="table-row hover:bg-gray-100 cursor-pointer" data-id="{{ $complaint->id }}">
                                <td class="p-2 whitespace-no-wrap border">
                                    <div class="flex items-center">
                                        {{ $key + $complaints->firstItem() }}
                                    </div>
                                </td>

                                <td class="p-2 whitespace-no-wrap border">
                                    <div class="leading-5 text-gray-900">{{ $complaint->serial_number }}
                                    </div>
                                </td>

                                <td class="p-2 whitespace-no-wrap border">
                                    <div class="leading-5 text-gray-900">{{ $complaint->category?->name }}
                                    </div>
                                </td>

                                <td class="p-2 whitespace-no-wrap border">
                                    <div class="leading-5 text-gray-900">{{ $complaint->channel?->name }}
                                    </div>
                                </td>

                                <td class="p-2 whitespace-no-wrap border">
                                    <div class="leading-5 text-gray-900">
                                        @if ($complaint->status_id !== null)
                                            @switch($complaint->status_id)
                                                @case('0')
                                                    <div class="bg-gray-100 p-1 text-center rounded ">Шинээр ирсэн</div>
                                                @break

                                                @case('1')
                                                    <div
                                                        class="bg-cyan-100 text-cyan-900 p-1 text-center rounded whitespace-nowrap">
                                                        Шилжүүлсэн</div>
                                                @break

                                                @case('2')
                                                    <div class="bg-orange-100 text-orange-900 p-1 text-center rounded">
                                                        Хүлээн авсан</div>
                                                @break

                                                @case('3')
                                                    <div class="bg-blue-100 text-blue-900 p-1 text-center rounded">Хянаж
                                                        байгаа</div>
                                                @break

                                                @case('4')
                                                    <div class="bg-red-100 text-red-900 p-1 text-center rounded">Цуцалсан
                                                    </div>
                                                @break

                                                @case('6')
                                                    <div class="bg-green-100 text-green-900 p-1 text-center rounded">
                                                        Шийдвэрлэсэн</div>
                                                @break

                                                @default
                                                    <div class="bg-gray-100 p-1 text-center rounded">Шинээр ирсэн</div>
                                            @endswitch
                                        @endif
                                        {{-- {{$complaint->status_id}} --}}
                                    </div>
                                </td>

                                <td class="p-2 whitespace-no-wrap border">
                                    <div class="leading-5 text-gray-900">{{ $complaint->controlledUser?->name }}
                                    </div>
                                </td>

                                @if (Auth::user()->org_id == 99)
                                    <td class="p-2 whitespace-no-wrap border">
                                        <div class="leading-5 text-gray-900">
                                            {{ Str::limit($complaint->organization?->name, 20) }}
                                        </div>
                                    </td>

                                    <td class="p-2 whitespace-no-wrap border">
                                        <div class="leading-5 text-gray-900">
                                            {{ Str::limit($complaint->secondOrg?->name, 20) }}
                                        </div>
                                    </td>

                                    <td class="p-2 whitespace-no-wrap border">
                                        <div class="leading-5 text-gray-900">{{ $complaint->energyType?->name }}
                                        </div>
                                    </td>
                                @endif

                                <td class="p-2 whitespace-no-wrap border lowercase">
                                    <div class="leading-5 text-gray-900">
                                        {{ $complaint->complaint_maker_type_id == 1 ? Str::limit($complaint->lastname . ' ' . $complaint->firstname, 15) : Str::limit($complaint->complaint_maker_org_name, 20) }}
                                    </div>
                                </td>

                                <td class="p-2 whitespace-no-wrap border">
                                    <p>{{ Str::limit($complaint->complaint, 50) }}
                                    </p>
                                </td>

                                <td class="p-2 text-center  leading-5 text-gray-500 whitespace-no-wrap border">
                                    <span>{{ date('Y-m-d', strtotime($complaint->complaint_date)) }}</span>
                                </td>
                                <td class="p-2 text-center  leading-5 text-gray-500 whitespace-no-wrap border">
                                    <span>{{ date('Y-m-d', strtotime($complaint->created_at)) }}</span>
                                </td>
                                <td class="p-2 text-center  leading-5 text-gray-500 whitespace-no-wrap border">
                                    <span>{{ $complaint->status_id == 6 ? date('Y-m-d', strtotime($complaint->updated_at)) : '' }}</span>
                                </td>
                                <td class="p-2 text-center  leading-5 text-gray-500 whitespace-no-wrap border">
                                    @if ($complaint->status_id == 6)
                                        <span>
                                            {{ \Carbon\Carbon::parse($complaint->created_at)->diffInDays($complaint->updated_at) }}
                                            хоног
                                        </span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                @if ($complaint->status_id == 6)
                                    <td class="p-2 whitespace-no-wrap border"></td>
                                @else
                                    <td class="p-2 text-center leading-5 whitespace-no-wrap border">
                                        @if ($complaint->hasExpired())
                                            <span class="text-red-500 text-xs">Хугацаа хэтэрсэн</span>
                                        @else
                                            <span>{{ now()->diffInHours($complaint->expire_date) > 24 ? now()->diffInDays($complaint->expire_date) . ' өдөр' : now()->diffInHours($complaint->expire_date) . ' цаг' }}</span>
                                        @endif
                                    </td>
                                @endif
                                @if (Auth::user()->role?->name == 'admin')
                                    <td class="font-medium leading-5 whitespace-no-wrap border">
                                        <form action="{{ route('complaint.destroy', $complaint->id) }}"
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
        </form>
        <br>
        {{-- {!! $complaints->links() !!} --}}
        {{ $complaints->appends(request()->query())->links() }}
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

            // Add click event handler to table rows with class 'table-row'
            $('.table-row').click(function() {
                // Get the value of the 'data-id' attribute of the clicked row
                var id = $(this).data('id');

                window.location.href = '/complaint/' + id;

            });

            // find complaint_type_summaries depending on complaint_type
            $('#energy_type_id, #complaint_type_id').on('change', function() {
                // var complaintTypeId = $(this).val();
                var energy_type_id = $("#energy_type_id").val();
                var complaint_type_id = $("#complaint_type_id").val();

                if (energy_type_id && complaint_type_id) {
                    $.ajax({
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
                                $("#complaint_type_summary_id").append(
                                    '<option value="' +
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

            $('#complaint-report thead input, #complaint-report thead select').on('change', function() {
                $(this).closest('form').submit();
            });

        });
    </script>
