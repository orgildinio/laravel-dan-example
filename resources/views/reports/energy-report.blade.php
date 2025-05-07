<style>
    table {
        border-collapse: collapse;
        background-color: white;
        width: 100%;
        font-size: 10px;
    }

    thead th,
    thead td {
        border: 1px solid #999;
        text-align: center;
        vertical-align: middle;
        padding: 5px;
    }

    thead th div {
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        white-space: nowrap;
    }

    thead tr:nth-child(1) th {
        background-color: #f2f2f2;
        border-top: 2px solid #000;
    }

    thead tr:nth-child(2) th {
        background-color: #fff;
    }

    th[colspan="11"][style*="background-color: #e6f7ff;"] {
        border: 2px solid #007acc;
    }

    th[colspan="11"][style*="background-color: #ffe6e6;"] {
        border: 2px solid #cc0000;
    }

    th[colspan="{{ count($complaint_type_summaries) + 1 }}"] {
        border: 2px solid #666;
    }

    tbody th {
        padding: 4px 15px 4px 0px;
        text-align: right;
    }

    tbody td {
        border: 1px solid #cccccc;
        padding: 8px 15px 8px 15px;
        text-align: center;
    }

    th,
    td {
        padding: 5px;
    }

    /* Hover effect */
    tbody tr:hover {
        background-color: #f0f0f0;
    }
</style>
<x-admin-layout>
    <h3 class="text-xl font-bold mb-4">Эрчим хүчний гомдлын тайлан</h3>

    <!-- Search Form -->
    <form method="GET" autocomplete="off" class="">
        <div class="flex flex-row gap-2">
            <div>
                <input type="date" id="startdate" name="startdate"
                    value="{{ request('startdate', now()->subMonth()->toDateString()) }}"
                    class="w-36 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
            </div>
            <div>
                <input type="date" id="enddate" name="enddate"
                    value="{{ request('enddate', now()->toDateString()) }}"
                    class="w-36 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
            </div>
            <div>
                <select name="category_id" id="category_id"
                    class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                    <option value="">-- Сонгох --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="energy_type_id" id="energy_type_id"
                    class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                    <option value="">-- Сонгох --</option>
                    @foreach ($energy_types as $type)
                        <option value="{{ $type->id }}"
                            {{ request('energy_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="complaint_type_id" id="complaint_type_id"
                    class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                    <option value="">-- Сонгох --</option>
                    @foreach ($complaint_types as $type)
                        <option value="{{ $type->id }}"
                            {{ request('complaint_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="mr-1">
                <select name="transferred" id="transferred"
                    class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                    <option value="1" {{ request('transferred') == '1' ? 'selected' : '' }}>Шилжүүлсэн</option>
                    <option value="0" {{ request('transferred') == '0' ? 'selected' : '' }}>Шилжүүлээгүй
                    </option>
                </select>
            </div> --}}
            <div class="flex items-end">
                <button type="submit"
                    class="bg-primary hover:bg-primaryHover text-white font-medium rounded-lg px-4 py-2 mr-2">
                    Хайх
                </button>
                <button type="button" onclick="exportToExcel(event, 'tailan2', 'Tailan-2')"
                    class="bg-blue-400 hover:bg-primaryHover text-white font-medium rounded-lg px-4 py-2">Export</button>
            </div>

        </div>
    </form>

    {{-- <div class="table-container">
        <table id="tailan2">
            <thead>
                <tr>
                    <th rowspan="2">№</th>
                    <th rowspan="2">ТЗЭ</th>
                    <th colspan="11" style="background-color: #e6f7ff;">ЭХЗХ-оос шилжүүлсэн</th>
                    <th colspan="11" style="background-color: #ffe6e6;">ТЗЭ-чид ирсэн</th>
                    <th colspan="{{ count($complaint_type_summaries) + 1 }}">Гомдлын ангилал</th>
                </tr>
                <tr>
                    <!-- Шилжүүлсэн -->
                    <th>
                        <div><span>Веб</span></div>
                    </th>
                    <th>
                        <div><span>Утсаар</span></div>
                    </th>
                    <th>
                        <div><span>И-мэйл</span></div>
                    </th>
                    <th>
                        <div><span>Биечлэн</span></div>
                    </th>
                    <th>
                        <div><span>Гар утас</span></div>
                    </th>
                    <th>
                        <div><span>Бичгээр</span></div>
                    </th>
                    <th>
                        <div><span>1111</span></div>
                    </th>
                    <th>
                        <div><span>ЭХЯ-аас</span></div>
                    </th>
                    <th>
                        <div><span>НЗДТГ-аас</span></div>
                    </th>
                    <th>
                        <div><span>АЗДТГ-аас</span></div>
                    </th>
                    <th>
                        <div><span>Нийт</span></div>
                    </th>

                    <!-- Шилжүүлээгүй -->
                    <th>
                        <div><span style="border-bottom: 1px solid red;">Веб</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">Утсаар</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">И-мэйл</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">Биечлэн</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">Гар утас</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">Бичгээр</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">1111</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">ЭХЯ</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">НЗДТГ</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">АЗДТГ</span></div>
                    </th>
                    <th>
                        <div><span style="border-bottom: 1px solid red;">Нийт</span></div>
                    </th>

                    <!-- complaint_type_summaries -->
                    @foreach ($complaint_type_summaries as $summary)
                        <th>
                            <div><span>{{ $summary->name }}</span></div>
                        </th>
                    @endforeach
                    <th>
                        <div><span>Нийт</span></div>
                    </th>
                </tr>
            </thead>

            <tbody>
                @php
                    $totals = [
                        'c_1' => 0,
                        'c_2' => 0,
                        'c_3' => 0,
                        'c_4' => 0,
                        'c_5' => 0,
                        'c_6' => 0,
                        'c_7' => 0,
                        'c_8' => 0,
                        'c_9' => 0,
                        'c_10' => 0,
                        'total_channel' => 0,
                    ];
                    $summary_totals = [];
                @endphp
                @foreach ($complaintsTransferred as $index => $complaint)
                    @php
                        $totals['c_1'] += $complaint->c_1;
                        $totals['c_2'] += $complaint->c_2;
                        $totals['c_3'] += $complaint->c_3;
                        $totals['c_4'] += $complaint->c_4;
                        $totals['c_5'] += $complaint->c_5;
                        $totals['c_6'] += $complaint->c_6;
                        $totals['c_7'] += $complaint->c_7;
                        $totals['c_8'] += $complaint->c_8;
                        $totals['c_9'] += $complaint->c_9;
                        $totals['c_10'] += $complaint->c_10;
                        $totals['total_channel'] += $complaint->total_channel;

                        foreach ($complaint_type_summaries as $summary) {
                            $columnName = 'c' . $summary->id . '_cnt';
                            $summary_totals[$columnName] =
                                ($summary_totals[$columnName] ?? 0) + ($complaint->$columnName ?? 0);
                        }
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="@if ($complaint->organization_name == 'Эрчим хүчний зохицуулах хороо') text-blue-600 font-bold @endif">
                            {{ $complaint->organization_name }}</td>
                        <td>{{ $complaint->c_1 }}</td>
                        <td>{{ $complaint->c_2 }}</td>
                        <td>{{ $complaint->c_3 }}</td>
                        <td>{{ $complaint->c_4 }}</td>
                        <td>{{ $complaint->c_5 }}</td>
                        <td>{{ $complaint->c_6 }}</td>
                        <td>{{ $complaint->c_7 }}</td>
                        <td>{{ $complaint->c_8 }}</td>
                        <td>{{ $complaint->c_9 }}</td>
                        <td>{{ $complaint->c_10 }}</td>
                        <td style="font-weight: bold; background-color: lightgray;">{{ $complaint->total_channel }}
                        </td>
                        <td>{{ $complaintsNotTransferred[$index]->c_1 ?? 0 }}</td>
                        <td>{{ $complaintsNotTransferred[$index]->c_2 ?? 0 }}</td>
                        <td>{{ $complaintsNotTransferred[$index]->c_3 ?? 0 }}</td>
                        <td>{{ $complaintsNotTransferred[$index]->c_4 ?? 0 }}</td>
                        <td>{{ $complaintsNotTransferred[$index]->c_5 ?? 0 }}</td>
                        <td>{{ $complaintsNotTransferred[$index]->c_6 ?? 0 }}</td>
                        <td>{{ $complaintsNotTransferred[$index]->c_7 ?? 0 }}</td>
                        <td>{{ $complaintsNotTransferred[$index]->c_8 ?? 0 }}</td>
                        <td>{{ $complaintsNotTransferred[$index]->c_9 ?? 0 }}</td>
                        <td>{{ $complaintsNotTransferred[$index]->c_10 ?? 0 }}</td>
                        <td style="font-weight: bold; background-color: lightgray;">
                            {{ $complaintsNotTransferred[$index]->total_channel ?? 0 }}</td>

                        @foreach ($complaint_type_summaries as $summary)
                            @php
                                $transferredColumn = 'c' . $summary->id . '_transferred';
                                $notTransferredColumn = 'c' . $summary->id . '_not_transferred';
                                $totalPerType =
                                    ($complaint->$transferredColumn ?? 0) + ($complaint->$notTransferredColumn ?? 0);
                            @endphp
                            <td>{{ $totalPerType }}</td>
                        @endforeach

                        <td style="font-weight: bold; background-color: lightgray;">
                            @php
                                $totalSummary = 0;
                                foreach ($complaint_type_summaries as $summary) {
                                    $transferredColumn = 'c' . $summary->id . '_transferred';
                                    $notTransferredColumn = 'c' . $summary->id . '_not_transferred';
                                    $totalSummary +=
                                        ($complaint->$transferredColumn ?? 0) +
                                        ($complaint->$notTransferredColumn ?? 0);
                                }
                            @endphp
                            {{ $totalSummary }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

    {{-- <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-10">
            <h2 class="text-xl font-bold mb-4 text-blue-600">Шилжүүлсэн гомдлууд</h2>
            <div class="overflow-auto">
                <table class="min-w-full bg-white border border-gray-200 text-sm">
                    <thead class="bg-blue-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Байгууллага</th>
                            <th class="px-4 py-2 border">Нийт гомдол</th>
                            @foreach ($complaint_type_summaries as $summary)
                                <th class="px-4 py-2 border">{{ $summary->name }}</th>
                            @endforeach
                            @for ($i = 1; $i <= 10; $i++)
                                <th class="px-4 py-2 border">Сувгийн {{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($complaintsTransferred as $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $row->organization_name }}</td>
                                <td class="px-4 py-2 border">{{ $row->total_channel }}</td>
                                @foreach ($complaint_type_summaries as $summary)
                                    <td class="px-4 py-2 border">{{ $row->{'c' . $summary->id . '_cnt'} ?? 0 }}</td>
                                @endforeach
                                @for ($i = 1; $i <= 10; $i++)
                                    <td class="px-4 py-2 border">{{ $row->{'c_' . $i} ?? 0 }}</td>
                                @endfor
                            </tr>
                        @empty
                            <tr>
                                <td colspan="20" class="px-4 py-2 text-center text-gray-500">Мэдээлэл олдсонгүй</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-10">
            <h2 class="text-xl font-bold mb-4 text-red-600">Шилжүүлээгүй гомдлууд</h2>
            <div class="overflow-auto">
                <table class="min-w-full bg-white border border-gray-200 text-sm">
                    <thead class="bg-red-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Байгууллага</th>
                            <th class="px-4 py-2 border">Нийт гомдол</th>
                            @foreach ($complaint_type_summaries as $summary)
                                <th class="px-4 py-2 border">{{ $summary->name }}</th>
                            @endforeach
                            @for ($i = 1; $i <= 10; $i++)
                                <th class="px-4 py-2 border">Сувгийн {{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($complaintsNotTransferred as $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $row->organization_name }}</td>
                                <td class="px-4 py-2 border">{{ $row->total_channel }}</td>
                                @foreach ($complaint_type_summaries as $summary)
                                    <td class="px-4 py-2 border">{{ $row->{'c' . $summary->id . '_cnt'} ?? 0 }}</td>
                                @endforeach
                                @for ($i = 1; $i <= 10; $i++)
                                    <td class="px-4 py-2 border">{{ $row->{'c_' . $i} ?? 0 }}</td>
                                @endfor
                            </tr>
                        @empty
                            <tr>
                                <td colspan="20" class="px-4 py-2 text-center text-gray-500">Мэдээлэл олдсонгүй</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-10">
            <h2 class="text-xl font-bold mb-4">Нийт гомдлууд (Шилжүүлсэн ба шилжүүлээгүй)</h2>
            <div class="overflow-auto">
                <table class="min-w-full bg-white border border-gray-200 text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Байгууллага</th>
                            <th class="px-4 py-2 border">Нийт гомдол</th>
                            @foreach ($complaint_type_summaries as $summary)
                                <th class="px-4 py-2 border">{{ $summary->name }}</th>
                            @endforeach
                            @for ($i = 1; $i <= 10; $i++)
                                <th class="px-4 py-2 border" colspan="2">
                                    Сувгийн {{ $i }}
                                    <div class="flex justify-between">
                                        <span class="text-blue-600">Шилж.</span>
                                        <span class="text-red-600">Шилжүүлээгүй</span>
                                    </div>
                                </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mergedComplaints as $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $row->organization_name }}</td>
                                <td class="px-4 py-2 border">{{ $row->total_channel }}</td>
                                @foreach ($complaint_type_summaries as $summary)
                                    <td class="px-4 py-2 border">{{ $row->{'c' . $summary->id . '_cnt'} ?? 0 }}</td>
                                @endforeach
                                @for ($i = 1; $i <= 10; $i++)
                                    <td class="px-4 py-2 border text-blue-600">{{ $row->{'transferred_c_' . $i} ?? 0 }}
                                    </td>
                                    <td class="px-4 py-2 border text-red-600">
                                        {{ $row->{'not_transferred_c_' . $i} ?? 0 }}</td>
                                @endfor
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ 2 + count($complaint_type_summaries) + 20 }}"
                                    class="px-4 py-2 text-center text-gray-500">Мэдээлэл олдсонгүй</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-admin-layout>

@push('scripts')

    <script type="module">
        $(document).ready(function() {

            // export to excel
            window.exportToExcel = function(event, tableID, filename = '') {
                event.preventDefault(); // Prevent form submission
                var table = document.getElementById(tableID);
                var wb = XLSX.utils.table_to_book(table, {
                    sheet: "Sheet1"
                });
                XLSX.writeFile(wb, filename + ".xlsx");
            }

        });
    </script>
