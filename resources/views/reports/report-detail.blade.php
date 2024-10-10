<style>
    html {
        font-family: sans-serif;
    }

    table {
        border-collapse: collapse;
        border: 2px solid rgb(200, 200, 200);
        letter-spacing: 1px;
        font-size: 0.8rem;
    }

    td,
    th {
        border: 1px solid rgb(190, 190, 190);
        /* padding: 10px 20px; */
    }

    th {
        background-color: rgb(235, 235, 235);
    }

    td {
        text-align: center;
    }

    tr:nth-child(even) td {
        background-color: rgb(250, 250, 250);
    }

    tr:nth-child(odd) td {
        background-color: rgb(245, 245, 245);
    }

    caption {
        padding: 10px;
    }

    .vertical-text {
        transform: rotate(-90deg);
        /* margin: 30px 0px;
    padding: 0px; */
        /* padding: 10px; */
        width: 30px;
    }

    .v-header {
        height: 120px;
        /* width: 20px; */
    }

    .tulbur {
        background-color: lightgreen;
    }

    .chanar {
        background-color: lightpink
    }

    .hemjih {
        background-color: lightyellow
    }

    .hariltsaa {
        background-color: lightblue
    }

    .busad {
        background-color: lightsteelblue
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
    <table>
        <thead>
            <tr>
                <th>№</th>
                <th>Мэргэжилтэнд цохогдсон огноо</th>
                <th>Өргөдөл гаргагчийн нэр</th>
                <th>Төлбөр</th>
                <th>Чанар хангамж</th>
                <th>Хэмжих хэрэгсэл</th>
                <th>Харилцаа, ёс зүй</th>
                <th>Бусад</th>
                <th>Нийт</th>
                <th>Веб хуудас</th>
                <th>Утас</th>
                <th>И-мэйл</th>
                <th>Биечлэн</th>
                <th>Гар утасны апп</th>
                <th>Бичгээр</th>
                <th>11-11 төвөөс</th>
                <th>Холбогдох байгууллага</th>
                <th>Товч утга</th>
                <th>Шийдвэрлэсэн байдал</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($complaints as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->complaint_date }}</td>
                    <td>{{ $data->firstname . " " . $data->phone }}</td>
                    <td>{{ $data->t1 }}</td>
                    <td>{{ $data->t2 }}</td>
                    <td>{{ $data->t3 }}</td>
                    <td>{{ $data->t5 }}</td>
                    <td>{{ $data->t6 }}</td>
                    <td></td>
                    <td>{{ $data->ch1 }}</td>
                    <td>{{ $data->ch2 }}</td>
                    <td>{{ $data->ch3 }}</td>
                    <td>{{ $data->ch4 }}</td>
                    <td>{{ $data->ch5 }}</td>
                    <td>{{ $data->ch6 }}</td>
                    <td>{{ $data->ch7 }}</td>
                    <td>{{ $data->organization }}</td>
                    <td>{{ $data->complaint }}</td>
                    <td>
                        @foreach ($data->complaintSteps as $step)
                            {{ $step->desc }}
                            {{-- {{ '(' . $step->created_at->format('Y-m-d') . ') ' . $lastStep->desc }} --}}
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