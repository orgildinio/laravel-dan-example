<x-admin-layout>
    <h3 class="text-xl font-bold">Тайлан гомдлын төрөл болон хүлээн авсан суваг</h3>
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
                        <option value="">-- Сонгох --</option>
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
                        <option value="">-- Сонгох --</option>
                        @foreach ($complaint_types as $type)
                            <option value="{{ $type->id }}"
                                {{ old('complaint_type_id', $complaint_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mr-1">
                    <select name="transferred" id="transferred"
                        class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2"
                        onchange="this.form.submit()">
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
                    <button type="button" onclick="exportToExcel(event, 'report1', 'Tailan-1')"
                        class="flex items-center justify-center text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 ml-4">Export</button>
                </div>
            </div>
        </form>
    </div>
    <table id="report1" class="table-auto w-full bg-white border border-gray-300">
        <thead class="bg-primary text-white">
            <tr>
                <th class="border border-gray-300 px-4 py-2">№</th>
                <th class="border border-gray-300 px-4 py-2">Тусгай зөвшөөрөл эзэмшигч</th>
                <th class="border border-gray-300 px-4 py-2">Веб</th>
                <th class="border border-gray-300 px-4 py-2">Утсаар</th>
                <th class="border border-gray-300 px-4 py-2">Имэйл</th>
                <th class="border border-gray-300 px-4 py-2">Биечлэн</th>
                <th class="border border-gray-300 px-4 py-2">Гар утас</th>
                <th class="border border-gray-300 px-4 py-2">Бичгээр</th>
                <th class="border border-gray-300 px-4 py-2">1111</th>
                <th class="border border-gray-300 px-4 py-2">ЭХЯ-аас</th>
                <th class="border border-gray-300 px-4 py-2">Нийслэлийн ЗДТГ-аас</th>
                <th class="border border-gray-300 px-4 py-2">Аймгийн ЗДТГ-аас</th>
                <th class="border border-gray-300 px-4 py-2">Нийт</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $data)
                <tr class="hover:bg-blue-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                    <td
                        class="border border-gray-300 px-4 py-2 @if ($data->name == 'Эрчим хүчний зохицуулах хороо') text-blue-600 font-bold @endif">
                        {{ $data->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel1_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel2_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel3_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel4_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel5_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel6_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel7_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel8_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel9_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel10_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 font-bold text-center">{{ $data->total_channels }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-gray-200 font-bold">
            <tr>
                <td class="border border-gray-300 px-4 py-2 text-center" colspan="2">Нийт</td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel1"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel2"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel3"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel4"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel5"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel6"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel7"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel8"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel9"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_channel10"></td>
                <td class="border border-gray-300 px-4 py-2 text-center" id="sum_total"></td>
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

            window.exportToExcel = function(event, tableID, filename = '') {
                event.preventDefault(); // Prevent form submission
                var table = document.getElementById(tableID);
                var wb = XLSX.utils.table_to_book(table, {
                    sheet: "Sheet1"
                });
                XLSX.writeFile(wb, filename + ".xlsx");
            }

            function calculateSum(columnIndex, outputId) {
                let sum = 0;
                $("#report1 tbody tr").each(function() {
                    let value = parseInt($(this).find("td").eq(columnIndex).text()) || 0;
                    sum += value;
                });
                $("#" + outputId).text(sum);
            }

            // Calculate sum for each column
            calculateSum(2, "sum_channel1"); // Веб
            calculateSum(3, "sum_channel2"); // Утсаар
            calculateSum(4, "sum_channel3"); // Имэйл
            calculateSum(5, "sum_channel4"); // Биечлэн
            calculateSum(6, "sum_channel5"); // Гар утас
            calculateSum(7, "sum_channel6"); // Бичгээр
            calculateSum(8, "sum_channel7"); // 1111
            calculateSum(9, "sum_channel8"); // Нийт
            calculateSum(10, "sum_channel9"); // Нийт
            calculateSum(11, "sum_channel10"); // Нийт
            calculateSum(12, "sum_total"); // Нийт

        });
    </script>
