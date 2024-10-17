<style>
    #report-detail {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
      font-size: 12px;
    }
    
    #report-detail td, #report-detail th {
      border: 1px solid #ddd;
      padding: 8px;
    }
    
    #report-detail tr:nth-child(even){background-color: #f2f2f2;}
    
    #report-detail tr:hover {background-color: #ddd;}
    
    #report-detail th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: blueviolet;
      color: white;
    }
</style>
<x-admin-layout>
    <h3 class="text-xl font-bold">ХЭРЭГЛЭГЧИЙН ӨРГӨДӨЛ, ГОМДЛЫН ШИЙДВЭРЛЭЛТИЙН МЭДЭЭ </h3>
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
                        <option>Сонгох</option>
                        @foreach ($energy_types as $type)
                            <option value="{{ $type->id }}"
                                {{ old('energy_type_id', $energy_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}</option>
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
    <table id="report-detail">
        <thead>
            <tr>
                <th>№</th>
                <th>Байгууллага</th>
                <th style="background-color: blue;">Шинээр ирсэн</th>
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
                    <td>{{ $data->s_2_cnt }}</td>
                    <td>{{ $data->s_3_cnt }}</td>
                    <td>{{ $data->s_4_cnt }}</td>
                    <td>{{ $data->s_6_cnt }}</td>
                    <td>{{ $data->total_count }}</td>
                    <td>{{ $data->expired_count }}</td>
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

    });
</script>