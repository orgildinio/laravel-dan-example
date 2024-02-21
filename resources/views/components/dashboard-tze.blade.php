<div class="mt-4">
    <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-4 my-4">
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
                class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-8 h-8 rounded-full text-purple-700"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
            </div>
            <div>
                <span class="block text-2xl font-bold">{{ $tze_tog + $tze_dulaan }}</span>
                <span class="block text-gray-500">Нийт</span>
            </div>
        </div>
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
                class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8 rounded-full text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>

            </div>
            <div>
                <span class="block text-2xl font-bold">{{ $tze_tog }}</span>
                <span class="block text-gray-500">Цахилгаан</span>
            </div>
        </div>
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
                class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-orange-600 bg-orange-100 rounded-full mr-6">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8 rounded-full text-orange-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                </svg>

            </div>
            <div>
                <span class="inline-block text-2xl font-bold">{{ $tze_dulaan }}</span>
                <span class="block text-gray-500">Дулаан</span>
            </div>
        </div>
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
                class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8 rounded-full text-red-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <span class="block text-2xl font-bold">{{ $exp_comp }}</span>
                <span class="block text-gray-500">Хугацаа хэтэрсэн</span>
            </div>
        </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-4">
        <div id="chartEnergyTypeTze" class="bg-white shadow rounded-lg"></div>
        <div id="pieChartStatusTze" class="bg-white shadow rounded-lg"></div>
        <div id="lineChartTze" class="bg-white shadow rounded-lg"></div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 mt-4 mb-4">
      <div class="flex items-center border-r border-black">
         <div class="flex-1 border-t border-b border-black mx-4"></div>
         <div class="text-lg font-bold">Цахилгаан</div>
         <div class="flex-1 border-t border-b border-black mx-4"></div>
      </div>
      <div class="flex items-center">
         <div class="flex-1 border-t border-b border-black mx-4"></div>
         <div class="text-lg font-bold">Дулаан</div>
         <div class="flex-1 border-t border-b border-black mx-4"></div>
      </div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-4 mt-4">
         <div class="bg-white shadow rounded-lg">
            <div id="stackedChartContainerTze1"></div>
         </div>
         <div class="bg-white shadow rounded-lg">
            <div id="stackedChartContainerTze2"></div>
         </div>
    </section>
    <section class="grid md:grid-cols-4 xl:grid-cols-4 gap-4 mt-4">
        {{-- <div class="flex flex-col bg-white shadow rounded-lg p-2">
            <table class="min-w-full text-left text-sm font-light border border-gray-300">
                <thead class="font-medium">
                    <tr class="border-b bg-blue-700 text-white">
                        <th scope="col" class="p-1 border-r">Тусгай зөвшөөрөл эзэмшигч</th>
                        <th scope="col" class="p-1 text-center">100</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b bg-gray-50">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шинээр ирсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-orange-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хүлээн авсан</td>
                        <td class="whitespace-nowrap p-1 text-center">10</td>
                    </tr>
                    <tr class="border-b bg-blue-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хянаж байгаа</td>
                        <td class="whitespace-nowrap p-1 text-center">15</td>
                    </tr>
                    <tr class="border-b bg-yellow-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шилжүүлсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-green-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шийдвэрлэсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">50</td>
                    </tr>
                    <tr class="border-b bg-gray-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Буцаасан</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-red-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хугацаа хэтэрсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">10</td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
        <div id="barChartStatusTog" class="bg-white shadow rounded-lg"></div>
        <div id="pieChartMakerElectric" class="bg-white shadow rounded-lg"></div>
        {{-- <div class="flex flex-col bg-white shadow rounded-lg p-2">
            <table class="min-w-full text-left text-sm font-light border border-gray-300">
                <thead class="font-medium">
                    <tr class="border-b bg-blue-700 text-white">
                        <th scope="col" class="p-1 border-r">Тусгай зөвшөөрөл эзэмшигч</th>
                        <th scope="col" class="p-1 text-center">100</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b bg-gray-50">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шинээр ирсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-orange-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хүлээн авсан</td>
                        <td class="whitespace-nowrap p-1 text-center">10</td>
                    </tr>
                    <tr class="border-b bg-blue-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хянаж байгаа</td>
                        <td class="whitespace-nowrap p-1 text-center">15</td>
                    </tr>
                    <tr class="border-b bg-yellow-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шилжүүлсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-green-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шийдвэрлэсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">50</td>
                    </tr>
                    <tr class="border-b bg-gray-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Буцаасан</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-red-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хугацаа хэтэрсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">10</td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
        <div id="barChartStatusDulaan" class="bg-white shadow rounded-lg"></div>
        <div id="pieChartMakerDulaan" class="bg-white shadow rounded-lg"></div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-4 mt-4">
        <div id="barChartElectric" class="bg-white shadow rounded-lg"></div>
        <div id="barChartDulaan" class="bg-white shadow rounded-lg"></div>
    </section>
</div>

<script type="text/javascript">
    // ЭХЗХ Chart энергийн төрлөөр 
    Highcharts.chart('chartEnergyTypeTze', {
        chart: {
            type: 'pie',
            marginTop: 10
            // width: 300
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 250,
                depth: 45,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.percentage:.1f}%</b>',
                    distance: -35,
                    connectorPadding: 0,
                    style: {
                        fontSize: '14px',
                        color: '#fff',
                        fontWeight: 'bold',
                        textOutline: 'none'
                    },
                },
                showInLegend: true,
            }
        },
        // legend: {
        //    floating: true,
        //    // layout: 'vertical',
        //    x: -100,
        //    y: 10
        // },
        colors: ['#00BFFF', '#FF6347'],
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: [{
                    name: 'Цахилгаан',
                    y: {{ $tze_tog }}
                },
                {
                    name: 'Дулаан',
                    y: {{ $tze_dulaan }}
                },
            ]
        }],
        // subtitle: {
        //    text: 'Нийт:  {{ $tze_tog + $tze_dulaan }}', // Display the total value in the center
        //    verticalAlign: 'middle',
        //    floating: true,
        //    style: {
        //       fontSize: '18px',
        //       color: '#000',
        //       fontWeight: 'bold'
        //    }
        // }
    });
    const customColorsStacked = ['#fca5a5', '#d1d5db', '#86efac', '#fde047', '#93c5fd', '#fdba74', '#f9fafb'];
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartStatusTze', {
        chart: {
            type: 'pie',
            marginTop: 70
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 250,
                depth: 45,
                dataLabels: {
                    enabled: true,
                    // format: '<b>{point.percentage:.1f}%</b>',
                    formatter: function() {
                        // Show data labels for non-zero points only
                        if (this.y !== 0) {
                            return '<b>' + this.percentage.toFixed(1) + '</b>% ';
                        } else {
                            return null; // Return null to hide the data label
                        }
                    },
                    distance: -35,
                    connectorPadding: 0,
                    style: {
                        fontSize: '14px',
                        color: '#fff',
                        fontWeight: 'bold',
                        textOutline: 'none'
                    },
                },
                showInLegend: true,
            }
        },
        legend: {
            // maxHeight: 50,
            // floating: true,
            // layout: 'vertical',
            // x: 10,
            // y: 10
        },
        colors: ['#f9fafb', '#3b82f6', '#f59e0b', '#fde047', '#22c55e', '#64748b',
            '#ef4444'
        ], // Set custom colors
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: [{
                    name: 'Шинээр ирсэн',
                    y: {{ $new_comp }}
                },
                {
                    name: 'Хүлээн авсан',
                    y: {{ $rec_comp }}
                },
                {
                    name: 'Хянаж байгаа',
                    y: {{ $ctl_comp }}
                },
                {
                    name: 'Шилжүүлсэн',
                    y: {{ $snt_comp }}
                },
                {
                    name: 'Шийдвэрлэсэн',
                    y: {{ $slv_comp }}
                },
                {
                    name: 'Буцаасан',
                    y: {{ $rtn_comp }}
                },
                {
                    name: 'Хугацаа хэтэрсэн',
                    y: {{ $exp_comp }}
                },
            ]
        }]
    });
    // Line chart санал гомдлын тоо
    var compCountsCurrentYear = <?php echo $lineChartData; ?>;

    var monthLabels = compCountsCurrentYear.map(function(obj) {
        return obj[Object.keys(obj)[0]] + ' сар';
    });
    var monthDatas = compCountsCurrentYear.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });
    Highcharts.chart('lineChartTze', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Санал гомдол'
        },
        xAxis: {
            categories: monthLabels
        },
        yAxis: {
            title: {
                text: 'Values'
            }
        },
        plotOptions: {
            area: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'Санал гомдол',
            data: monthDatas
        }]
    });

    var allTzeTogTab2 = <?php echo $stackedChartDataTog; ?>;

    const filteredDataTogTab2 = allTzeTogTab2.filter(item => {
        return item.total_count !== 0 || allTzeTogTab2.some(otherItem => otherItem.name === item.name &&
            otherItem
            .total_count !== 0);
    });

    const orgNametogTab2 = [...new Set(filteredDataTogTab2.map(item => item.name))];

    // Group the total_count by status_id
    const groupedDataTab2 = filteredDataTogTab2.reduce((acc, curr) => {
        const {
            status,
            total_count
        } = curr;
        if (!acc[status]) {
            acc[status] = {
                status,
                values: [total_count]
            };
        } else {
            acc[status].values.push(total_count);
        }
        return acc;
    }, {});

    // Create a new array with the grouped data and category names
    const dataTogTab2 = Object.values(groupedDataTab2).map(item => ({
        category: statusCategoryMapping[item.status],
        status_id: item.status,
        values: item.values
    }));

    // Extract series data from the sample data
    const seriesTogTab2 = dataTogTab2.map((item, index) => ({
        name: item.category,
        data: item.values,
        color: customColors[index]
    }));

    // Create the stacked bar chart
    Highcharts.chart('stackedChartContainerTze1', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Цахилгаан түгээх, хангах ТЗЭ-чид'
        },
        xAxis: {
            categories: orgNametogTab2
        },
        yAxis: {
            title: {
                text: 'Санал, гомдлын тоо'
            },
            stackLabels: {
                enabled: true
            }
        },
        plotOptions: {
            bar: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    style: {
                        textOutline: 'none'
                    }
                }
            }
        },
        series: seriesTogTab2
    });

    // Stacked Chart 2

    var allTzeDulaanTab2 = <?php echo $stackedChartDataDulaan; ?>;

    const filteredDataDulaanTab2 = allTzeDulaanTab2.filter(item => {
        return item.total_count !== 0 || allTzeDulaanTab2.some(otherItem => otherItem.name === item.name &&
            otherItem
            .total_count !== 0);
    });

    const orgNameDulaanTab2 = [...new Set(filteredDataDulaanTab2.map(item => item.name))];

    // Group the total_count by status_id
    const groupedDataDulaanTab2 = filteredDataDulaanTab2.reduce((acc, curr) => {
        const {
            status,
            total_count
        } = curr;
        if (!acc[status]) {
            acc[status] = {
                status,
                values: [total_count]
            };
        } else {
            acc[status].values.push(total_count);
        }
        return acc;
    }, {});

    // Create a new array with the grouped data and category names
    const dataDulaanTab2 = Object.values(groupedDataDulaanTab2).map(item => ({
        category: statusCategoryMapping[item.status],
        status_id: item.status,
        values: item.values
    }));

    // Extract series data from the sample data
    const seriesDulaanTab2 = dataDulaanTab2.map((item, index) => ({
        name: item.category,
        data: item.values,
        color: customColors[index]
    }));

    // Stacked Chart 2
    Highcharts.chart('stackedChartContainerTze2', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Дулаан түгээх, хангах ТЗЭ-чид'
        },
        xAxis: {
            categories: orgNameDulaanTab2
        },
        yAxis: {
            title: {
                text: 'Values'
            },
            stackLabels: {
                enabled: true
            }
        },
        plotOptions: {
            bar: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    style: {
                        textOutline: 'none'
                    }
                }
            }
        },
        series: seriesDulaanTab2
    });

    // Bar chart status tog
    let statusCountTog = @json($statusTog);
    let dataStatusTog = statusCountTog.map((obj, index) => ({
        y: obj['status_count'],
        color: statusBarColors[index]
    }));
    let statusExpireTog = {
        y: {{ $statusExpireTog }},
        color: '#fca5a5'
    };
    let statusTogDataset = [...dataStatusTog, statusExpireTog];

   //  let datalableTog = statusTogDataset.map(function(obj) {
   //      return obj[Object.keys(obj)[1]];
   //  });

    Highcharts.chart('barChartStatusTog', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Гомдлын төлөв',
            // align: 'left'
        },
        subtitle: {
            text: '',
            align: ''
        },
        xAxis: {
            categories: ['Шинээр ирсэн', 'Шилжүүлсэн', 'Хүлээн авсан', 'Хянаж байгаа', 'Цуцалсан', 'Буцаасан',
                'Шийдвэрлэсэн', 'Хугацаа хэтэрсэн'
            ],
            title: {
                text: null
            },
            gridLineWidth: 1,
            lineWidth: 0
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Санал, гомдлын тоо',
                // align: 'high'
            },
            labels: {
                overflow: 'justify'
            },
            gridLineWidth: 0
        },
        tooltip: {
            valueSuffix: ' ширхэг'
        },
        plotOptions: {
            bar: {
                borderRadius: '50%',
                dataLabels: {
                    enabled: true,
                    align: 'left', // Justify the data labels to the left
                    x: 800
                },
                // groupPadding: 0.1
            },
            series: {
                pointWidth: 10 // Set the width of the bars to 20 pixels
            }
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Санал, гомдлын тоо',
            data: statusTogDataset
        }, ]
    });


    // Bar chart status dulaan
    let statusCountDulaan = @json($statusDulaan);
    let dataStatusDulaan = statusCountDulaan.map((obj, index) => ({
        y: obj['status_count'],
        color: statusBarColors[index]
    }));
    let statusExpireDulaan = {
        y: {{ $statusExpireDulaan }},
        color: '#fca5a5'
    };
    let statusDulaanDataset = [...dataStatusDulaan, statusExpireDulaan];

    Highcharts.chart('barChartStatusDulaan', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Гомдлын төлөв',
            // align: 'left'
        },
        subtitle: {
            text: '',
            align: ''
        },
        xAxis: {
            categories: ['Шинээр ирсэн', 'Шилжүүлсэн', 'Хүлээн авсан', 'Хянаж байгаа', 'Цуцалсан', 'Буцаасан',
                'Шийдвэрлэсэн', 'Хугацаа хэтэрсэн'
            ],
            title: {
                text: null
            },
            gridLineWidth: 1,
            lineWidth: 0
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Санал, гомдлын тоо',
                // align: 'high'
            },
            labels: {
                overflow: 'justify'
            },
            gridLineWidth: 0
        },
        tooltip: {
            valueSuffix: ' ширхэг'
        },
        plotOptions: {
            bar: {
                borderRadius: '50%',
                dataLabels: {
                    enabled: true,
                    align: 'left', // Justify the data labels to the left
                    x: 800
                },
                // groupPadding: 0.1
            },
            series: {
                pointWidth: 10 // Set the width of the bars to 20 pixels
            }
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Санал, гомдлын тоо',
            data: statusDulaanDataset
        }, ]
    });

    var compMakerTogCount = <?php echo $compMakerTogCount; ?>;
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMakerElectric', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын гаргагчийн төрөл',
            style: {
                fontSize: '14px' // Set the desired font size here
            }
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 200,
                depth: 45,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.percentage:.1f}%</b>',
                    distance: -35,
                    connectorPadding: 0,
                    style: {
                        fontSize: '14px',
                        color: '#fff',
                        fontWeight: 'bold',
                        textOutline: 'none'
                    },
                },
                showInLegend: true,
            }
        },
        series: [{
            name: 'Өргөдөл, гомдол',
            data: compMakerTogCount
        }]
    });
    var compMakerDulaanCount = <?php echo $compMakerDulaanCount; ?>;
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMakerDulaan', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын гаргагчийн төрөл',
            style: {
                fontSize: '14px' // Set the desired font size here
            }
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 200,
                depth: 45,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.percentage:.1f}%</b>',
                    distance: -35,
                    connectorPadding: 0,
                    style: {
                        fontSize: '14px',
                        color: '#fff',
                        fontWeight: 'bold',
                        textOutline: 'none'
                    },
                },
                showInLegend: true,
            }
        },
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: compMakerDulaanCount
        }]
    });



    // Хүлээн авсан суваг
    var compTogChannelsCount = <?php echo $compTogChannelsCount; ?>;
    var channelTogLabels = compTogChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[0]];
    });
    var channelTogDatas = compTogChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });

    Highcharts.chart('barChartElectric', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Хүлээн авсан суваг - Цахилгаан'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: channelTogLabels
        },
        yAxis: {
            title: {
                text: 'Ирсэн өргөдөл, гомдлын тоо'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Нийт',
            data: channelTogDatas
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 1000
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });

    var compDulaanChannelsCount = <?php echo $compDulaanChannelsCount; ?>;
    var channelDulaanLabels = compDulaanChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[0]];
    });
    var channelDulaanDatas = compDulaanChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });

    Highcharts.chart('barChartDulaan', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Хүлээн авсан суваг - Дулаан'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: channelDulaanLabels
        },
        yAxis: {
            title: {
                text: 'Ирсэн өргөдөл, гомдлын тоо'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Нийт',
            //   data: newChartData
            data: channelDulaanDatas
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 1000
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>
