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
                <th>Мэргэжилтэнд цохогдсон огноо</th>
                <th>Өргөдөл гаргагчийн нэр</th>
                <th style="background-color: blue;">Төлбөр тооцоо</th>
                <th style="background-color: blue;">Чанар хангамж</th>
                <th style="background-color: blue;">Хэмжих хэрэгсэл</th>
                <th style="background-color: blue;">Харилцаа, ёс зүй</th>
                <th style="background-color: blue;">Бусад</th>
                @if ($energy_type_id == 2)    
                <th style="background-color: blue;">Халаалт</th>
                <th style="background-color: blue;">Халуун ус</th>
                @endif
                <th style="background-color: green;">Веб хуудас</th>
                <th style="background-color: green;">Утас</th>
                <th style="background-color: green;">И-мэйл</th>
                <th style="background-color: green;">Биечлэн</th>
                <th style="background-color: green;">Гар утасны апп</th>
                <th style="background-color: green;">Бичгээр</th>
                <th style="background-color: green;">11-11 төвөөс</th>
                <th>Холбогдох байгууллага</th>
                <th style="width: 300px;">Товч утга</th>
                <th style="width: 300px;">Шийдвэрлэсэн байдал</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($complaints as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->complaint_date }}</td>
                    <td>{{ $data->lastname . " " . $data->firstname . " " . $data->phone }}</td>
                    <td>{{ $data->t1 }}</td>
                    <td>{{ $data->t2 }}</td>
                    <td>{{ $data->t3 }}</td>
                    <td>{{ $data->t5 }}</td>
                    <td>{{ $data->t6 }}</td>
                    @if ($energy_type_id == 2)    
                    <td>{{ $data->t7 }}</td>
                    <td>{{ $data->t8 }}</td>
                    @endif
                    <td>{{ $data->ch1 }}</td>
                    <td>{{ $data->ch2 }}</td>
                    <td>{{ $data->ch3 }}</td>
                    <td>{{ $data->ch4 }}</td>
                    <td>{{ $data->ch5 }}</td>
                    <td>{{ $data->ch6 }}</td>
                    <td>{{ $data->ch7 }}</td>
                    <td>{{ $data->organization?->name }}</td>
                    <td>{{ $data->complaint }}</td>
                    <td style="text-align: left;">
                        @foreach ($data->complaintSteps as $step)
                            {{ '(' . $step->created_at->format('Y-m-d') . ') ' . $step->desc }}<br>
                        @endforeach
                    </td>
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