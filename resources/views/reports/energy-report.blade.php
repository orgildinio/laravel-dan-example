<style>
    table {
        border-collapse: collapse;
        background-color: white;
        width: 100%;
        font-size: 10px;
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

    th.rotate {
        /* Something you can count on */
        height: 140px;
        white-space: nowrap;
    }

    th.rotate>div {
        transform:
            /* Magic Numbers */
            translate(25px, 51px)
            /* 45 is really 360 - 45 */
            rotate(315deg);
        width: 30px;
    }

    th.rotate>div>span {
        border-bottom: 1px solid purple;
        padding: 5px 10px;
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
            <div>
                {{-- <select name="transfer_status" id="transfer_status"
                    class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                    <option value="second_org_id" {{ request('transfer_status') == 'second_org_id' ? 'selected' : '' }}>
                        Шилжүүлсэн
                    </option>
                    <option value="organization_id"
                        {{ request('transfer_status') == 'organization_id' ? 'selected' : '' }}>
                        Шилжүүлээгүй
                    </option>
                </select> --}}
                <select name="transferred" id="transferred"
                    class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2"
                    onchange="this.form.submit()">
                    <option value="1" {{ request('transferred') == '1' ? 'selected' : '' }}>Шилжүүлсэн</option>
                    <option value="0" {{ request('transferred') == '0' ? 'selected' : '' }}>Шилжүүлээгүй
                    </option>
                </select>
            </div>
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

    <div class="table-container">
        <table id="tailan2">
            <thead>
                <tr>
                    <th><span>№</span></th>
                    <th>
                        <div><span>Байгууллага</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">Веб</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">Утсаар</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">И-мэйл</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">Биечлэн</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">Гар утас</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">Бичгээр</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">1111</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">ЭХЯ-аас</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">Нийслэлийн ЗДТГ-аас</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">Аймгийн ЗДТГ-аас</span></div>
                    </th>
                    <th class="rotate">
                        <div><span style="border-bottom: 1px solid blue;">Нийт</span></div>
                    </th>
                    @foreach ($complaint_type_summaries as $summary)
                        <th class="rotate">
                            <div><span>{{ $summary->name }}</span></div>
                        </th>
                    @endforeach
                    <th class="rotate">
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
                @foreach ($complaints as $index => $complaint)
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
                        @foreach ($complaint_type_summaries as $summary)
                            @php
                                $columnName = 'c' . $summary->id . '_cnt';
                            @endphp
                            <td>{{ $complaint->$columnName ?? 0 }}</td>
                        @endforeach
                        <td style="font-weight: bold; background-color: lightgray;">
                            @php
                                $totalSummary = 0;
                                foreach ($complaint_type_summaries as $summary) {
                                    $columnName = 'c' . $summary->id . '_cnt';
                                    $totalSummary += $complaint->$columnName ?? 0;
                                }
                            @endphp
                            {{ $totalSummary }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- Footer for totals -->
            <tfoot>
                <tr style="font-weight: bold; background-color: lightgray; text-align: center;">
                    <td colspan="2">Нийт</td>
                    <td>{{ $totals['c_1'] }}</td>
                    <td>{{ $totals['c_2'] }}</td>
                    <td>{{ $totals['c_3'] }}</td>
                    <td>{{ $totals['c_4'] }}</td>
                    <td>{{ $totals['c_5'] }}</td>
                    <td>{{ $totals['c_6'] }}</td>
                    <td>{{ $totals['c_7'] }}</td>
                    <td>{{ $totals['c_8'] }}</td>
                    <td>{{ $totals['c_9'] }}</td>
                    <td>{{ $totals['c_10'] }}</td>
                    <td>{{ $totals['total_channel'] }}</td>

                    @foreach ($complaint_type_summaries as $summary)
                        @php $columnName = 'c' . $summary->id . '_cnt'; @endphp
                        <td>{{ $summary_totals[$columnName] ?? 0 }}</td>
                    @endforeach

                    <td>{{ array_sum($summary_totals) }}</td>
                </tr>
            </tfoot>
        </table>
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
