<style>
    .table-container {
        display: flex;
    }

    .energyReport {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        border-collapse: collapse;
        /* width: 100%; */
    }

    .energyReport th, .energyReport td {
        border: 1px solid black;
        padding: 4px;
        height: 50px;
    }

    .energyReport tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .energyReport tr:hover {
        background-color: #ddd;
    }

    /* .energyReport th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        color: #030712;
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        white-space: nowrap;
        height: 550px;
        width: 40px;
        text-align: center;
    } */

    .energyReport tfoot {
        font-weight: bold;
    }

    .energyReport td:last-child {
        font-weight: bold;
    }

    #table-energy th {
        background-color: lightgreen;
        /* color: deepskyblue */
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
                <div class="flex flex-row items-center space-x-2">
                    <button type="submit"
                        class="flex items-center justify-center text-white bg-primary hover:bg-primaryHover focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        Хайх
                    </button>
                    <button type="button" onclick="exportToExcel(event, 'table-energy', 'Tailan-energy')" class="flex items-center justify-center text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 ml-4">Export</button>
                </div>
            </div>
        </form>
        <div class="table-container">
        <table class="energyReport" id="table-energy">
            <thead>
                <tr style="height: 20px;">
                    <th style="background-color: white;" rowspan="2">№</th>
                    <th style="background-color: white;" rowspan="2">Байгууллага</th>
                    <th colspan="25">Чанар хангамж</th>
                    <th style="background-color: yellow;" colspan="6">Өргөдөл, гомдлын төрөл</th>
                    <th style="background-color: deepskyblue;" colspan="8">Хүлээн авсан суваг</th>
                </tr>
                <tr>
                    {{-- <th style="background-color: white;" rowspan="2">Д/д</th>
                    <th style="background-color: white;">Байгууллага</th> --}}
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
                    {{-- complaint type --}}
                    <th style="background-color: yellow;">Төлбөр тооцоо</th>
                    <th style="background-color: yellow;">Чанар хангамж</th>
                    <th style="background-color: yellow;">Хэмжих хэрэгсэл</th>
                    <th style="background-color: yellow;">Харилцаа ёс зүй</th>
                    <th style="background-color: yellow;">Бусад</th>
                    <th style="background-color: yellow;">Нийт</th>
                    {{-- complaint channel --}}
                    <th style="background-color: deepskyblue;">Веб хуудас</th>
                    <th style="background-color: deepskyblue;">Утас</th>
                    <th style="background-color: deepskyblue;">Имэйл</th>
                    <th style="background-color: deepskyblue;">Биечлэн</th>
                    <th style="background-color: deepskyblue;">Гар утас апп</th>
                    <th style="background-color: deepskyblue;">Бичгээр</th>
                    <th style="background-color: deepskyblue;">ЗГ-ын 11-11 төв</th>
                    <th style="background-color: deepskyblue;">Нийт</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaints as $item)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td style="white-space: nowrap;">
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
                        <td style="font-weight: bold;">
                            {{ $item->total_complaints }}
                        </td>
                        <td>
                            {{ $item->c_1 }}
                        </td>
                        <td>
                            {{ $item->c_2 }}
                        </td>
                        <td>
                            {{ $item->c_3 }}
                        </td>
                        <td>
                            {{ $item->c_5 }}
                        </td>
                        <td>
                            {{ $item->c_6 }}
                        </td>
                        <td style="font-weight: bold;">
                            {{ $item->total_type }}
                        </td>
                        <td>
                            {{ $item->c_1 }}
                        </td>
                        <td>
                            {{ $item->c_2 }}
                        </td>
                        <td>
                            {{ $item->c_3 }}
                        </td>
                        <td>
                            {{ $item->c_4 }}
                        </td>
                        <td>
                            {{ $item->c_5 }}
                        </td>
                        <td>
                            {{ $item->c_6 }}
                        </td>
                        <td>
                            {{ $item->c_7 }}
                        </td>
                        <td style="font-weight: bold;">
                            {{ $item->total_channel }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td>Нийт</td>
                    <td id="sum1"></td>
                    <td id="sum2"></td>
                    <td id="sum3"></td>
                    <td id="sum4"></td>
                    <td id="sum5"></td>
                    <td id="sum6"></td>
                    <td id="sum7"></td>
                    <td id="sum8"></td>
                    <td id="sum9"></td>
                    <td id="sum10"></td>
                    <td id="sum11"></td>
                    <td id="sum12"></td>
                    <td id="sum13"></td>
                    <td id="sum14"></td>
                    <td id="sum15"></td>
                    <td id="sum16"></td>
                    <td id="sum17"></td>
                    <td id="sum18"></td>
                    <td id="sum19"></td>
                    <td id="sum20"></td>
                    <td id="sum21"></td>
                    <td id="sum22"></td>
                    <td id="sum23"></td>
                    <td id="sum24"></td>
                    <td id="sum25"></td>
                    <td id="sum26"></td>
                    <td id="sum27"></td>
                    <td id="sum28"></td>
                    <td id="sum29"></td>
                    <td id="sum30"></td>
                    <td id="sum31"></td>
                    <td id="sum32"></td>
                    <td id="sum33"></td>
                    <td id="sum34"></td>
                    <td id="sum35"></td>
                    <td id="sum36"></td>
                    <td id="sum37"></td>
                    <td id="sum38"></td>
                    <td id="sum39"></td>
                </tr>
            </tfoot>
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

            // Function to calculate the sum for each column in a table
            function calculateColumnSum(tableId, columnIndex, resultCellId) {
                let sum = 0;

                // Loop through each row (excluding the header and footer)
                $(`#${tableId} tbody tr`).each(function() {
                    let cellValue = $(this).find(`td:eq(${columnIndex})`).text().trim();
                    cellValue = parseFloat(cellValue) || 0; // Convert to float, or 0 if invalid
                    sum += cellValue;
                });

                // Display the sum in the corresponding footer cell
                $(`#${resultCellId}`).text(sum.toFixed(0)); // Rounded to 2 decimal places
            }

            // Calculate sums for each table and column
            calculateColumnSum('table-energy', 2, 'sum1'); // For column 2 in table1, store result in #sum1
            calculateColumnSum('table-energy', 3, 'sum2'); // For column 3 in table1, store result in #sum2
            calculateColumnSum('table-energy', 4, 'sum3');
            calculateColumnSum('table-energy', 5, 'sum4');
            calculateColumnSum('table-energy', 6, 'sum5');
            calculateColumnSum('table-energy', 7, 'sum6');
            calculateColumnSum('table-energy', 8, 'sum7');
            calculateColumnSum('table-energy', 9, 'sum8');
            calculateColumnSum('table-energy', 10, 'sum9');
            calculateColumnSum('table-energy', 11, 'sum10');
            calculateColumnSum('table-energy', 12, 'sum11');
            calculateColumnSum('table-energy', 13, 'sum12');
            calculateColumnSum('table-energy', 14, 'sum13');
            calculateColumnSum('table-energy', 15, 'sum14');
            calculateColumnSum('table-energy', 16, 'sum15');
            calculateColumnSum('table-energy', 17, 'sum16');
            calculateColumnSum('table-energy', 18, 'sum17');
            calculateColumnSum('table-energy', 19, 'sum18');
            calculateColumnSum('table-energy', 20, 'sum19');
            calculateColumnSum('table-energy', 21, 'sum20');
            calculateColumnSum('table-energy', 22, 'sum21');
            calculateColumnSum('table-energy', 23, 'sum22');
            calculateColumnSum('table-energy', 24, 'sum23');
            calculateColumnSum('table-energy', 25, 'sum24');
            calculateColumnSum('table-energy', 26, 'sum25');
            calculateColumnSum('table-energy', 27, 'sum26');
            calculateColumnSum('table-energy', 28, 'sum27');
            calculateColumnSum('table-energy', 29, 'sum28');
            calculateColumnSum('table-energy', 30, 'sum29');
            calculateColumnSum('table-energy', 31, 'sum30');
            calculateColumnSum('table-energy', 32, 'sum31');
            calculateColumnSum('table-energy', 33, 'sum32');
            calculateColumnSum('table-energy', 34, 'sum33');
            calculateColumnSum('table-energy', 35, 'sum34');
            calculateColumnSum('table-energy', 36, 'sum35');
            calculateColumnSum('table-energy', 37, 'sum36');
            calculateColumnSum('table-energy', 38, 'sum37');
            calculateColumnSum('table-energy', 39, 'sum38');
            calculateColumnSum('table-energy', 40, 'sum39');

            // export to excel
            window.exportToExcel = function(event, tableID, filename = '') {
                event.preventDefault();  // Prevent form submission
                var table = document.getElementById(tableID);
                var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet1"});
                XLSX.writeFile(wb, filename + ".xlsx");
            }

        });
    </script>
