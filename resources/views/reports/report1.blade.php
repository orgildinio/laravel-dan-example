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
                        @foreach ($complaint_types as $type)
                            <option value="{{ $type->id }}"
                                {{ old('complaint_type_id', $complaint_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-row items-center space-x-2">
                    <button type="submit"
                        class="flex items-center justify-center text-white bg-primary hover:bg-primaryHover focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        Хайх
                    </button>
                    <button type="button" onclick="exportToExcel(event, 'report1', 'Tailan-1')" class="flex items-center justify-center text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 ml-4">Export</button>
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
                <th class="border border-gray-300 px-4 py-2">Имэйл</th>
                <th class="border border-gray-300 px-4 py-2">Биечлэн</th>
                <th class="border border-gray-300 px-4 py-2">Гар утас</th>
                <th class="border border-gray-300 px-4 py-2">Бичгээр</th>
                <th class="border border-gray-300 px-4 py-2">Утсаар</th>
                <th class="border border-gray-300 px-4 py-2">1111</th>
                <th class="border border-gray-300 px-4 py-2">Нийт</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $data)
                <tr class="hover:bg-blue-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel1_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel2_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel3_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel4_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel5_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel6_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $data->channel7_all }}</td>
                    <td class="border border-gray-300 px-4 py-2 font-bold text-center">{{ $data->total_channels }}</td>
                </tr>
            @endforeach
        </tbody>
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
            defaultDate: "{{ $start_date ?? '' }}" || formattedStartDate,  // Use Laravel variable or fallback
            dateFormat: "Y-m-d"
        });

        // Initialize Flatpickr for end date
        flatpickr("#enddate", {
            defaultDate: "{{ $end_date ?? '' }}" || formattedEndDate,  // Use Laravel variable or fallback
            dateFormat: "Y-m-d"
        });

        window.exportToExcel = function(event, tableID, filename = '') {
            event.preventDefault();  // Prevent form submission
            var table = document.getElementById(tableID);
            var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet1"});
            XLSX.writeFile(wb, filename + ".xlsx");
        }

        
    });
</script>