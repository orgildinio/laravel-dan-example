<style>
    #report-detail {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }

    #report-detail td,
    #report-detail th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #report-detail tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #report-detail tr:hover {
        background-color: #ddd;
    }

    #report-detail th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: blueviolet;
        color: white;
    }
</style>
<x-admin-layout>
    <h3 class="text-xl font-bold">ЭХЗХ-оос ТЗЭ нарт шилжүүлсэн өргөдөл, гомдлын шийдвэрлэлтийн мэдээ</h3>
    <div class="w-full">
        <form method="GET" autocomplete="off">
            @csrf
            <div class="flex flex-row justify-start items-center">
                <div class="mr-1">
                    <input type="text" id="startdate"
                        class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2"
                        name="startdate" placeholder="Эхлэх" value="{{ $start_date }}">
                </div>
                <div class="mr-1">
                    <input type="text" id="enddate"
                        class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2"
                        name="enddate" placeholder="Дуусах" value="{{ $end_date }}">
                </div>
                <div class="mr-1">
                    <select name="energy_type_id" id="energy_type_id"
                        class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                        @foreach ($energy_types as $type)
                            <option value="{{ $type->id }}"
                                {{ old('energy_type_id', $energy_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mr-1">
                    <select name="transferred" id="transferred"
                        class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                        <option value="1" {{ request('transferred') == '1' ? 'selected' : '' }}>Шилжүүлсэн</option>
                        <option value="0" {{ request('transferred') == '0' ? 'selected' : '' }}>Шилжүүлээгүй
                        </option>
                    </select>
                </div>
                <div class="flex flex-row items-center space-x-2">
                    <button type="submit"
                        class="flex items-center justify-center text-white bg-primary hover:bg-primaryHover focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        Хайх
                    </button>
                    <button type="button" onclick="exportToExcel(event, 'report-detail', 'Tailan-status')"
                        class="flex items-center justify-center text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 ml-4">Export</button>
                </div>
            </div>
        </form>
    </div>
    <table id="report-detail">
        <thead>
            <tr>
                <th>№</th>
                <th>Байгууллага</th>
                <th style="background-color: blue;">Шинээр ирсэн</th>
                <th style="background-color: blue;">Шилжүүлсэн</th>
                <th style="background-color: blue;">Хүлээн авсан</th>
                <th style="background-color: blue;">Хянаж байгаа</th>
                <th style="background-color: blue;">Цуцалсан</th>
                <th style="background-color: blue;">Шийдвэрлэсэн</th>
                <th style="background-color: blue;">Нийт</th>
                <th style="background-color: red;">Хугацаа хэтэрсэн</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($complaints as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->organization_name }}</td>
                    <td>{{ $data->s_0_cnt }}</td>
                    <td>{{ $data->s_1_cnt }}</td>
                    <td>{{ $data->s_2_cnt }}</td>
                    <td>{{ $data->s_3_cnt }}</td>
                    <td>{{ $data->s_4_cnt }}</td>
                    <td>{{ $data->s_6_cnt }}</td>
                    <td class="font-bold">{{ $data->total_count }}</td>
                    <td class="text-red-500">{{ $data->expired_count }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-right font-bold">Нийт:</th>
                <th style="background-color: blue;">{{ $complaints->sum('s_0_cnt') }}</th>
                <th style="background-color: blue;">{{ $complaints->sum('s_1_cnt') }}</th>
                <th style="background-color: blue;">{{ $complaints->sum('s_2_cnt') }}</th>
                <th style="background-color: blue;">{{ $complaints->sum('s_3_cnt') }}</th>
                <th style="background-color: blue;">{{ $complaints->sum('s_4_cnt') }}</th>
                <th style="background-color: blue;">{{ $complaints->sum('s_6_cnt') }}</th>
                <th style="background-color: blue;" class="font-bold">{{ $complaints->sum('total_count') }}</th>
                <th style="background-color: red;" class="text-red-500">{{ $complaints->sum('expired_count') }}</th>
            </tr>
        </tfoot>
    </table>
</x-admin-layout>

@push('scripts')

    <script type="module">
        $(document).ready(function() {

            // Set default start date to 1 month earlier than today
            var defaultStartDate = new Date();
            defaultStartDate.setMonth(defaultStartDate.getMonth() - 1);
            var formattedStartDate = defaultStartDate.toISOString().split('T')[0]; // Format to 'YYYY-MM-DD'

            // Set default end date to today's date
            var defaultEndDate = new Date();
            var formattedEndDate = defaultEndDate.toISOString().split('T')[0]; // Format to 'YYYY-MM-DD'

            // Initialize Flatpickr for start date
            flatpickr("#startdate", {
                defaultDate: "{{ $start_date ?? '' }}" ||
                    formattedStartDate, // Use Laravel variable or fallback
                dateFormat: "Y-m-d"
            });

            // Initialize Flatpickr for end date
            flatpickr("#enddate", {
                defaultDate: "{{ $end_date ?? '' }}" ||
                    formattedEndDate, // Use Laravel variable or fallback
                dateFormat: "Y-m-d"
            });

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
