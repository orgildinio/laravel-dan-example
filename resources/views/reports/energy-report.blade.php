<style>
    .table-container {
            display: flex;
            justify-content: space-around;
        }
    #energy {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #energy thead {
        height: 200px;
    }

    #energy td,
    #energy th {
        border: 1px solid #ddd;
        padding: 8px;
        height: 150px;
    }

    #energy tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #energy tr:hover {
        background-color: #ddd;
    }

    #energy th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: purple;
        color: white;
    }
    td:last-child {
            font-weight: bold;
        }
</style>
<x-admin-layout>
    <h3 class="text-xl font-bold">Тайлан Цахилгаан</h3>
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
                <div>
                    <button type="submit"
                        class="flex items-center justify-center text-white bg-primary hover:bg-primaryHover focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        Хайх
                    </button>
                </div>
            </div>
        </form>
        <div class="table-container">
        <table id="energy">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Байгууллага</th>
                    <th>Хүчдэлгүй</th>
                    <th>Хүчдэлийн түвшин муу
                    </th>
                    <th>Тулгууртай холбоотой
                    </th>
                    <th>ЦЭХ-ээр хязгаарласан
                    </th>
                    <th>Тасралт, гэмтэл
                    </th>
                    <th>Цахилгаан хэрэгсэл шатсан
                    </th>
                    <th>Дуудлагын төвийн утастай холбоотой
                    </th>
                    <th>Орон сууц хүлээж аваагүй
                    </th>
                    <th>Шугам, тоноглолтой холбоотой
                    </th>
                    <th>Щиттэй холбоотой
                    </th>
                    <th>Компанийн ажиллагсадтай холбоотой
                    </th>
                    <th>Хувийн эзэмшлийн шугамтай холбоотой
                    </th>
                    <th>Таслалт
                    </th>
                    <th>Бусад
                    </th>
                    <th>Төлбөр ороогүйтэй холбоотой
                    </th>
                    <th>Дотор монтажтай холбоотой
                    </th>
                    <th>Байгууллагын үйл ажиллагаа, үйлчилгээний хүнд суртал чирэгдэлтэй холбоотой
                    </th>
                    <th>Цахилгаан хангамжийг таслахад хэрэглэгчийн цахилгаан хэрэгсэл гэмтсэн тухай
                    </th>
                    <th>Тасласан хэрэглэгчийг дахин залгахтай холбоотой
                    </th>
                    <th>Төлбөр төлөх хугацаа болоогүй байхад тасласан тухай
                    </th>
                    <th>Хүн, мал амьтан хүчдэлд нэрвэгдсэн тухай
                    </th>
                    <th>Техникийн нөхцөлтэй холбоотой
                    </th>
                    <th>Газар шорооны ажилтай холбоотой
                    </th>
                    <th>Шинэ холболттой холбоотой</th>
                    <th>Нийт</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaints as $item)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $item->organization_name }}
                        </td>
                        <td>
                            {{ $item->c1_cnt }}
                        </td>
                        <td>
                            {{ $item->c9_cnt }}
                        </td>
                        <td>
                            {{ $item->c10_cnt }}
                        </td>
                        <td>
                            {{ $item->c11_cnt }}
                        </td>
                        <td>
                            {{ $item->c12_cnt }}
                        </td>
                        <td>
                            {{ $item->c13_cnt }}
                        </td>
                        <td>
                            {{ $item->c14_cnt }}
                        </td>
                        <td>
                            {{ $item->c15_cnt }}
                        </td>
                        <td>
                            {{ $item->c29_cnt }}
                        </td>
                        <td>
                            {{ $item->c30_cnt }}
                        </td>
                        <td>
                            {{ $item->c31_cnt }}
                        </td>
                        <td>
                            {{ $item->c32_cnt }}
                        </td>
                        <td>
                            {{ $item->c33_cnt }}
                        </td>
                        <td>
                            {{ $item->c34_cnt }}
                        </td>
                        <td>
                            {{ $item->c39_cnt }}
                        </td>
                        <td>
                            {{ $item->c40_cnt }}
                        </td>
                        <td>
                            {{ $item->c42_cnt }}
                        </td>
                        <td>
                            {{ $item->c78_cnt }}
                        </td>
                        <td>
                            {{ $item->c79_cnt }}
                        </td>
                        <td>
                            {{ $item->c80_cnt }}
                        </td>
                        <td>
                            {{ $item->c81_cnt }}
                        </td>
                        <td>
                            {{ $item->c82_cnt }}
                        </td>
                        <td>
                            {{ $item->c83_cnt }}
                        </td>
                        <td>
                            {{ $item->c84_cnt }}
                        </td>
                        <td class="">
                            {{ $item->total_complaints }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table id="energy">
            <thead>
                <tr>
                    {{-- <th>ТЗЭ</th> --}}
                    <th>Төлбөр тооцоо</th>
                    <th>Чанар хангамж</th>
                    <th>Хэмжих хэрэгсэл</th>
                    <th>Харилцаа ёс зүй</th>
                    <th>Бусад</th>
                    <th>Нийт</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaintsByType as $comp)
                <tr>
                    {{-- <td>
                        {{ $comp->organization_name }}
                    </td> --}}
                    <td>
                        {{ $comp->c_1 }}
                    </td>
                    <td>
                        {{ $comp->c_2 }}
                    </td>
                    <td>
                        {{ $comp->c_3 }}
                    </td>
                    <td>
                        {{ $comp->c_5 }}
                    </td>
                    <td>
                        {{ $comp->c_6 }}
                    </td>
                    <td>
                        {{ $comp->total }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
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

        });
    </script>
