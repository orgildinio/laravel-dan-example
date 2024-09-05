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
                <th rowspan="3">№</th>
                <th rowspan="3">Тусгай зөвшөөрөл эзэмшигч</th>
                <th colspan="42" style="background-color: black; color: white;">Өргөдөл, гомдлын төрөл</th>
                {{-- <th rowspan="3">ТЗЭ хооронд</th>
            <th rowspan="3">Нийт</th> --}}
            </tr>
            <tr>
                <th colspan="7" class="tulbur">Төлбөр тооцоо</th>
                <th colspan="7" class="chanar">Чанар, хангамж</th>
                <th colspan="7" class="hemjih">Хэмжих хэрэгсэл</th>
                <th colspan="7" class="hariltsaa">Харилцаа, ёс зүй</th>
                <th colspan="7" class="busad">Бусад</th>
                <th colspan="7">Нийт</th>
            </tr>
            <tr>
                <th class="v-header tulbur">
                    <div class="vertical-text">Веб</div>
                </th>
                <th class="v-header tulbur">
                    <div class="vertical-text">Имэйл</div>
                </th>
                <th class="v-header tulbur">
                    <div class="vertical-text">Биечлэн</div>
                </th>
                <th class="v-header tulbur">
                    <div class="vertical-text">Гар утас</div>
                </th>
                <th class="v-header tulbur">
                    <div class="vertical-text">Бичгээр</div>
                </th>
                <th class="v-header tulbur">
                    <div class="vertical-text">Утсаар</div>
                </th>
                <th class="v-header tulbur">
                    <div class="vertical-text">1111</div>
                </th>

                <th class="v-header chanar">
                    <div class="vertical-text">Веб</div>
                </th>
                <th class="v-header chanar">
                    <div class="vertical-text">Имэйл</div>
                </th>
                <th class="v-header chanar">
                    <div class="vertical-text">Биечлэн</div>
                </th>
                <th class="v-header chanar">
                    <div class="vertical-text">Гар утас</div>
                </th>
                <th class="v-header chanar">
                    <div class="vertical-text">Бичгээр</div>
                </th>
                <th class="v-header chanar">
                    <div class="vertical-text">Утсаар</div>
                </th>
                <th class="v-header chanar">
                    <div class="vertical-text">1111</div>
                </th>

                <th class="v-header hemjih">
                    <div class="vertical-text">Веб</div>
                </th>
                <th class="v-header hemjih">
                    <div class="vertical-text">Имэйл</div>
                </th>
                <th class="v-header hemjih">
                    <div class="vertical-text">Биечлэн</div>
                </th>
                <th class="v-header hemjih">
                    <div class="vertical-text">Гар утас</div>
                </th>
                <th class="v-header hemjih">
                    <div class="vertical-text">Бичгээр</div>
                </th>
                <th class="v-header hemjih">
                    <div class="vertical-text">Утсаар</div>
                </th>
                <th class="v-header hemjih">
                    <div class="vertical-text">1111</div>
                </th>

                <th class="v-header hariltsaa">
                    <div class="vertical-text">Веб</div>
                </th>
                <th class="v-header hariltsaa">
                    <div class="vertical-text">Имэйл</div>
                </th>
                <th class="v-header hariltsaa">
                    <div class="vertical-text">Биечлэн</div>
                </th>
                <th class="v-header hariltsaa">
                    <div class="vertical-text">Гар утас</div>
                </th>
                <th class="v-header hariltsaa">
                    <div class="vertical-text">Бичгээр</div>
                </th>
                <th class="v-header hariltsaa">
                    <div class="vertical-text">Утсаар</div>
                </th>
                <th class="v-header hariltsaa">
                    <div class="vertical-text">1111</div>
                </th>

                <th class="v-header busad">
                    <div class="vertical-text">Веб</div>
                </th>
                <th class="v-header busad">
                    <div class="vertical-text">Имэйл</div>
                </th>
                <th class="v-header busad">
                    <div class="vertical-text">Биечлэн</div>
                </th>
                <th class="v-header busad">
                    <div class="vertical-text">Гар утас</div>
                </th>
                <th class="v-header busad">
                    <div class="vertical-text">Бичгээр</div>
                </th>
                <th class="v-header busad">
                    <div class="vertical-text">Утсаар</div>
                </th>
                <th class="v-header busad">
                    <div class="vertical-text">1111</div>
                </th>

                <th class="v-header">
                    <div class="vertical-text">Веб</div>
                </th>
                <th class="v-header">
                    <div class="vertical-text">Имэйл</div>
                </th>
                <th class="v-header">
                    <div class="vertical-text">Биечлэн</div>
                </th>
                <th class="v-header">
                    <div class="vertical-text">Гар утас</div>
                </th>
                <th class="v-header">
                    <div class="vertical-text">Бичгээр</div>
                </th>
                <th class="v-header">
                    <div class="vertical-text">Утсаар</div>
                </th>
                <th class="v-header">
                    <div class="vertical-text">1111</div>
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>

                    <td>{{ $data->type1_channel1_count }}</td>
                    <td>{{ $data->type1_channel2_count }}</td>
                    <td>{{ $data->type1_channel3_count }}</td>
                    <td>{{ $data->type1_channel4_count }}</td>
                    <td>{{ $data->type1_channel5_count }}</td>
                    <td>{{ $data->type1_channel6_count }}</td>
                    <td>{{ $data->type1_channel7_count }}</td>

                    <td>{{ $data->type2_channel1_count }}</td>
                    <td>{{ $data->type2_channel2_count }}</td>
                    <td>{{ $data->type2_channel3_count }}</td>
                    <td>{{ $data->type2_channel4_count }}</td>
                    <td>{{ $data->type2_channel5_count }}</td>
                    <td>{{ $data->type2_channel6_count }}</td>
                    <td>{{ $data->type2_channel7_count }}</td>

                    <td>{{ $data->type3_channel1_count }}</td>
                    <td>{{ $data->type3_channel2_count }}</td>
                    <td>{{ $data->type3_channel3_count }}</td>
                    <td>{{ $data->type3_channel4_count }}</td>
                    <td>{{ $data->type3_channel5_count }}</td>
                    <td>{{ $data->type3_channel6_count }}</td>
                    <td>{{ $data->type3_channel7_count }}</td>

                    <td>{{ $data->type4_channel1_count }}</td>
                    <td>{{ $data->type4_channel2_count }}</td>
                    <td>{{ $data->type4_channel3_count }}</td>
                    <td>{{ $data->type4_channel4_count }}</td>
                    <td>{{ $data->type4_channel5_count }}</td>
                    <td>{{ $data->type4_channel6_count }}</td>
                    <td>{{ $data->type4_channel7_count }}</td>

                    <td>{{ $data->type5_channel1_count }}</td>
                    <td>{{ $data->type5_channel2_count }}</td>
                    <td>{{ $data->type5_channel3_count }}</td>
                    <td>{{ $data->type5_channel4_count }}</td>
                    <td>{{ $data->type5_channel5_count }}</td>
                    <td>{{ $data->type5_channel6_count }}</td>
                    <td>{{ $data->type5_channel7_count }}</td>

                    <td>{{ $data->channel1_all }}</td>
                    <td>{{ $data->channel2_all }}</td>
                    <td>{{ $data->channel3_all }}</td>
                    <td>{{ $data->channel4_all }}</td>
                    <td>{{ $data->channel5_all }}</td>
                    <td>{{ $data->channel6_all }}</td>
                    <td>{{ $data->channel7_all }}</td>
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