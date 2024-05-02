<div class="bg-white">
    {{-- <section class="grid grid-cols-8 gap-2">
        <div class="col-span-6 ...">
            <div class="border border-gray-300">
                <span class="block text-black font-bold text-lg p-2 my-3 uppercase">Эрчим хүчний зохицуулах хороо</span>
            </div>
        </div>
        <div class="col-span-2 ...">
            <div class="border border-gray-300">
                <span class="block text-black font-bold text-lg p-2 my-3 uppercase">Огноо филтер</span>
            </div>
        </div>
    </section> --}}
    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="border border-gray-300 flex items-center justify-center">
            <div class="border-l-4 border-green-500 my-5 px-2">
                <div class="block text-primary font-bold text-xs">Нийт гомдол</div>
                <div class="block text-black font-bold text-lg">{{ $ehzh_tog_count + $ehzh_dulaan_count }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center">
            <div class="border-l-4 border-green-500 my-5 px-2">
                <div class="block text-primary font-bold text-xs">Шинээр ирсэн</div>
                <div class="block text-black font-bold text-lg">{{ $new_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center">
            <div class="border-l-4 border-green-500 my-5 px-2">
                <div class="block text-primary font-bold text-xs">Хүлээн авсан</div>
                <div class="block text-black font-bold text-lg">{{ $rec_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center">
            <div class="border-l-4 border-green-500 my-5 px-2">
                <div class="block text-primary font-bold text-xs">Хянаж байгаа</div>
                <div class="block text-black font-bold text-lg">{{ $ctl_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center">
            <div class="border-l-4 border-green-500 my-5 px-2">
                <div class="block text-primary font-bold text-xs">Шийдвэрлэсэн</div>
                <div class="block text-black font-bold text-lg">{{ $slv_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center">
            <div class="border-l-4 border-green-500 my-5 px-2">
                <div class="block text-primary font-bold text-xs">Хугацаа хэтэрсэн</div>
                <div class="block text-black font-bold text-lg">{{ $exp_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center">
            <div class="border-l-4 border-green-500 my-5 px-2">
                <div class="block text-primary font-bold text-xs">Шилжүүлсэн</div>
                <div class="block text-black font-bold text-lg">{{ $snt_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center">
            <div class="border-l-4 border-green-500 my-5 px-2">
                <div class="block text-primary font-bold text-xs">Буцаасан</div>
                <div class="block text-black font-bold text-lg">{{ $rtn_comp }}</div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="chartEnergyType"></div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="chartTreemap"></div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="chartAreaEhzh"></div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="stackedChartTog" class="w-full overflow-x-auto"></div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="stackedChartDulaan"></div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="donutChartChannel"></div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="pieChartMaker"></div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="chartBarChannel"></div>
            </div>
        </div>
    </section>

    

    {{-- <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-4 my-4">
        <div class="flex flex-col justify-between items-start px-8 py-4 bg-white shadow rounded-lg">
            <div class="">
                <span class="block text-gray-700 font-bold text-lg">Нийт өргөдөл, гомдол</span>
            </div>
            <div class="w-full flex items-center justify-between">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-8 h-8 rounded-full text-purple-700"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
                <div>
                    <span class="block text-4xl font-bold">{{ $ehzh_tog_count + $ehzh_dulaan_count }}</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-between items-start px-8 py-4 bg-white shadow rounded-lg">
            <div class="pb-4">
                <span class="block text-gray-700 font-bold text-lg">Нийт өргөдөл, гомдол /Цахилгаан/</span>
            </div>
            <div class="w-full flex items-center justify-between">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8 rounded-full text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>
                <div>
                    <span class="block text-4xl font-bold">{{ $ehzh_tog_count }}</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-between items-start px-8 py-4 bg-white shadow rounded-lg">
            <div class="">
                <span class="block text-gray-700 font-bold text-lg">Нийт өргөдөл, гомдол /Дулаан/</span>
            </div>
            <div class="w-full flex items-center justify-between">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8 rounded-full text-orange-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                </svg>
                <div>
                    <span class="inline-block text-4xl font-bold">{{ $ehzh_dulaan_count }}</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-between items-start px-8 py-4 bg-white shadow rounded-lg">
            <div class="">
                <span class="block text-gray-700 font-bold text-lg">Хугацаа хэтэрсэн өргөдөл, гомдол</span>
            </div>
            <div class="w-full flex items-center justify-between">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8 rounded-full text-red-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <div>
                    <span class="block text-4xl font-bold">{{ $exp_comp }}</span>
                </div>
            </div>
        </div>

    </section> --}}
    {{-- <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-lg p-4">
            <div id="chartStatus"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="chartEnergyType"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="donutChartChannel"></div>
        </div>
    </section> --}}
    {{-- <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-4 mt-4">
        <div class="bg-white shadow rounded-lg md:col-span-2 lg:col-span-2 overflow-y-auto">
            <div id="stackedChartTog"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieChartMaker"></div>
        </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-4 mt-4">
        <div class="bg-white shadow rounded-lg md:col-span-2 lg:col-span-2 overflow-y-auto">
            <div id="stackedChartDulaan"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieChartStatus"></div>
        </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-4 mt-4">
        <div class="bg-white shadow rounded-lg">
            <div id="chartAreaEhzh"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieCharTypeSummary"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="chartBarChannel"></div>
        </div>
    </section> --}}
</div>

<script type="text/javascript">
    var chartCategoryData = <?php echo $compCategoryCounts; ?>;
    var chartDataCompTypes = <?php echo $compTypeCounts; ?>;
    var compTypeMakersCount = <?php echo $compTypeMakersCount; ?>;

    var compCountsCurrentYear = <?php echo $compCountsCurrentYear; ?>;

    var monthLabels = compCountsCurrentYear.map(function(obj) {
        return obj[Object.keys(obj)[0]] + ' сар';
    });
    var monthDatas = compCountsCurrentYear.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });

    var compChannelsCount = <?php echo $compChannelsCount; ?>;

    var channelLabels = compChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[0]];
    });
    var channelDatas = compChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });

    var allTzeTog = <?php echo $allTzeComplaintsWithStatusTog; ?>;
    var allTzeDulaan = <?php echo $allTzeComplaintsWithStatusDulaan; ?>;

    // Define the mapping of status_id to category names
    const statusCategoryMapping = {
        0: 'Шинээр ирсэн',
        1: 'Шилжүүлсэн',
        2: 'Хүлээн авсан',
        3: 'Хянаж байгаа',
        4: 'Хугацаа хэтэрсэн',
        5: 'Буцаасан',
        6: 'Шийдвэрлэсэн'
    };
    const customColors = ['#fca5a5', '#d1d5db', '#fde047', '#93c5fd', '#fdba74', '#f9fafb', '#86efac'];

    const filteredDataTog = allTzeTog.filter(item => {
        return item.total_count !== 0 || allTzeTog.some(otherItem => otherItem.name === item.name && otherItem
            .total_count !== 0);
    });

    const uniqueOrganizationNamesTog = [...new Set(filteredDataTog.map(item => item.name))];

    // Group the total_count by status_id
    const groupedData = filteredDataTog.reduce((acc, curr) => {
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
    const newArray = Object.values(groupedData).map(item => ({
        category: statusCategoryMapping[item.status],
        status_id: item.status,
        values: item.values
    }));

    statusBarColors = [
        '#f9fafb',
        '#d1d5db',
        '#fde047',
        '#93c5fd',
        '#fdba74',
        '#fca5a5',
        '#86efac',
    ];

    var statusCount = @json($statusCount);

    let dataStatus = statusCount.map((obj, index) => ({
        y: obj['status_count'],
        color: statusBarColors[index]
    }));
    let expireComp = {
        y: {{ $exp_comp }},
        color: '#fca5a5'
    };
    let statusDataset = [...dataStatus, expireComp];
    // console.log(statusDataset);

    // Highcharts.chart('chartStatus', {
    //     chart: {
    //         type: 'bar'
    //     },
    //     title: {
    //         text: 'Гомдлын төлөв',
    //         // align: 'left'
    //     },
    //     subtitle: {
    //         text: 'ЭХЗХ - Гомдлын шийдвэрлэлтийн явц',
    //         align: 'center'
    //     },
    //     xAxis: {
    //         categories: ['Шинээр ирсэн', 'Шилжүүлсэн', 'Хүлээн авсан', 'Хянаж байгаа', 'Цуцалсан', 'Буцаасан',
    //             'Шийдвэрлэсэн', 'Хугацаа хэтэрсэн'
    //         ],
    //         title: {
    //             text: null
    //         },
    //         gridLineWidth: 1,
    //         lineWidth: 0
    //     },
    //     yAxis: {
    //         min: 0,
    //         title: {
    //             text: 'Санал, гомдлын тоо',
    //             // align: 'high'
    //         },
    //         labels: {
    //             overflow: 'justify'
    //         },
    //         gridLineWidth: 0
    //     },
    //     tooltip: {
    //         valueSuffix: ' ширхэг'
    //     },
    //     plotOptions: {
    //         bar: {
    //             borderRadius: '50%',
    //             dataLabels: {
    //                 enabled: true,
    //                 align: 'left', // Justify the data labels to the left
    //                 x: 800
    //             },
    //             // groupPadding: 0.1
    //         },
    //         series: {
    //             pointWidth: 10 // Set the width of the bars to 20 pixels
    //         }
    //     },
    //     legend: {
    //         enabled: false
    //     },
    //     credits: {
    //         enabled: false
    //     },
    //     series: [{
    //         name: 'Санал, гомдлын тоо',
    //         data: statusDataset
    //     }, ]
    // });


    // ЭХЗХ Chart энергийн төрлөөр 
    Highcharts.chart('chartEnergyType', {
        chart: {
            type: 'pie',
            height: 250
        },
        title: {
            text: 'Цахилгаан ба Дулаан',
            align: 'left',
            style: {
                fontSize: '14px',
                color: '#3e4095',
                fontWeight: 'bold',
            }
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 150,
                // depth: 45,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}:<br> {point.y}',
                    style: {
                        fontSize: '9px',
                    },
                    connectorPadding: 0.01
                },
            }
        },
        // colors: ['#00BFFF', '#FF6347'],
        colors: ['#818cf8', '#3730a3'],
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: [{
                    name: 'Цахилгаан',
                    y: {{ $ehzh_tog_count }}
                },
                {
                    name: 'Дулаан',
                    y: {{ $ehzh_dulaan_count }}
                },
            ]
        }]
    });

    var compSumType = <?php echo $compSumType; ?>;
    compSumType.forEach((obj, index) => {
        obj.colorValue = index + 1;
    });

    Highcharts.chart('chartTreemap', {
        chart: {
            height: 250
        },
        colorAxis: {
            minColor: '#a5b4fc',
            maxColor: '#312e81'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}({point.value})'
                }
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            type: 'treemap',
            layoutAlgorithm: 'squarified',
            clip: false,
            data: compSumType
        }],
        title: {
            text: 'Өргөдлийн төрлөөр',
            align: 'left',
            style: {
                fontSize: '14px',
                color: '#3e4095',
                fontWeight: 'bold',
            }
        }
    });
    // ЭХЗХ Donut Chart Өргөдлийн ангилал аар
    Highcharts.chart('donutChartChannel', {
        chart: {
            type: 'pie',
            height: 250
        },
        title: {
            text: 'Өргөдлийн ангилал',
            align: 'left',
            style: {
                fontSize: '14px',
                color: '#3e4095',
                fontWeight: 'bold',
            }
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 150,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}:<br> {point.y}',
                    style: {
                        fontSize: '9px',
                    },
                },
            }
        },
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: [{
            type: 'pie',
            name: 'Өргөдөл, гомдол',
            data: chartCategoryData
        }]
    });

    // Extract series data from the sample data
    const seriesDataTog = newArray.map((item, index) => ({
        name: item.category,
        data: item.values,
        maxPointWidth: 50,
        // color: customColors[index]
    }));

    // Create the stacked bar chart
    Highcharts.chart('stackedChartTog', {
        chart: {
            type: 'column',
            height: 300,
            // width: 600
        },
        title: {
            text: 'Цахилгаан түгээх, хангах ТЗЭ-чид',
            align: 'left',
            style: {
                fontSize: '14px',
                color: '#3e4095',
                fontWeight: 'bold',
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: uniqueOrganizationNamesTog,
            labels: {
                style: {
                    fontSize: '10px'
                }
            },
        },
        yAxis: {
            title: {
                text: 'Санал, гомдлын тоо'
            },
        },
        plotOptions: {
            series: {
                stacking: 'percent',
                dataLabels: {
                    enabled: true,
                    style: {
                        textOutline: '1px contrast',
                        color: 'black',
                        textOutline: 'none',
                        fontSize: 10
                    },
                    backgroundColor: 'rgba(255,255,255,0.8)',
                    borderColor: 'black',
                    borderWidth: 1,
                    padding: 2,
                    borderRadius: 1,
                    shape: 'square'
                }
            }
        },
        legend: {
            itemStyle: {
                fontSize: '9px'
            },
            align: 'left',
            verticalAlign: 'top',
            itemMarginTop: 0
        },
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: seriesDataTog
    });

    const filteredDataDulaan = allTzeDulaan.filter(item => {
        return item.total_count !== 0 || allTzeDulaan.some(otherItem => otherItem.name === item.name &&
            otherItem.total_count !== 0);
    });

    const uniqueOrganizationNamesDulaan = [...new Set(filteredDataDulaan.map(item => item.name))];

    // Group the total_count by status_id
    const groupedDataDulaan = filteredDataDulaan.reduce((acc, curr) => {
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
    const newArrayDulaan = Object.values(groupedDataDulaan).map(item => ({
        category: statusCategoryMapping[item.status],
        status_id: item.status,
        values: item.values
    }));

    // Extract series data from the sample data
    const seriesData2 = newArrayDulaan.map((item, index) => ({
        name: item.category,
        data: item.values,
        maxPointWidth: 50,
    }));

    // Create the stacked bar chart
    Highcharts.chart('stackedChartDulaan', {
        chart: {
            type: 'column',
            height: 300,
        },
        title: {
            text: 'Дулаан түгээх, хангах ТЗЭ-чид',
            align: 'left',
            style: {
                fontSize: '14px',
                color: '#3e4095',
                fontWeight: 'bold',
            }
        },
        xAxis: {
            categories: uniqueOrganizationNamesDulaan,
            // min: 0,
            // max: 1,
            scrollbar: {
                enabled: true
            },
            tickLength: 0,
            labels: {
                style: {
                    fontSize: '10px' // Set the font size of x-axis labels
                }
            },
        },
        yAxis: {
            title: {
                text: 'Санал, гомдлын тоо'
            },
        },
        plotOptions: {
            series: {
                stacking: 'percent',
                dataLabels: {
                    enabled: true,
                    style: {
                        textOutline: '1px contrast',
                        color: 'black',
                        textOutline: 'none',
                        fontSize: 10
                    },
                    backgroundColor: 'rgba(255,255,255,0.8)',
                    borderColor: 'black',
                    borderWidth: 1,
                    padding: 2,
                    borderRadius: 1,
                    shape: 'square'
                }
            }
        },
        legend: {
            itemStyle: {
                fontSize: '9px'
            },
            align: 'left',
            verticalAlign: 'top',
            itemMarginTop: 0
        },
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: seriesData2
    });

    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMaker', {
        chart: {
            type: 'pie',
            // width: 400,
            height: 250
        },
        title: {
            text: 'Гомдол гаргагч',
            align: 'left',
            style: {
                fontSize: '14px',
                color: '#3e4095',
                fontWeight: 'bold',
            }
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 150,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}:<br> {point.y}',
                    style: {
                        fontSize: '9px',
                    },
                    connectorPadding: 0.1,
                },
            }
        },
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: [{
            name: 'Өргөдөл, гомдол',
            data: compTypeMakersCount
        }]
    });

    // Create the pie chart
    // Highcharts.chart('pieChartStatus', {
    //     chart: {
    //         type: 'pie'
    //     },
    //     title: {
    //         text: 'Гомдлын төлөв'
    //     },
    //     subtitle: {
    //         text: 'ЭХЗХ - Гомдлын шийдвэрлэлтийн явц',
    //         align: 'center'
    //     },
    //     plotOptions: {
    //         pie: {
    //             innerSize: '50%',
    //             size: 250,
    //             depth: 45,
    //             dataLabels: {
    //                 enabled: true,
    //                 formatter: function() {
    //                     // Show data labels for non-zero points only
    //                     if (this.y !== 0) {
    //                         return '<b>' + this.percentage.toFixed(1) + '</b>% ';
    //                     } else {
    //                         return null; // Return null to hide the data label
    //                     }
    //                 },
    //                 distance: -35,
    //                 connectorPadding: 0,
    //                 style: {
    //                     fontSize: '14px',
    //                     color: '#fff',
    //                     fontWeight: 'bold',
    //                     textOutline: 'none'
    //                 },
    //             },
    //             showInLegend: true,
    //         }
    //     },
    //     colors: ['#f9fafb', '#3b82f6', '#f59e0b', '#fde047', '#22c55e', '#64748b', '#ef4444'],
    //     series: [{
    //         name: 'Өргөдөл, гомдол',
    //         colorByPoint: true,
    //         data: [{
    //                 name: 'Шинээр ирсэн',
    //                 y: {{ $new_comp }}
    //             },
    //             {
    //                 name: 'Хүлээн авсан',
    //                 y: {{ $rec_comp }}
    //             },
    //             {
    //                 name: 'Хянаж байгаа',
    //                 y: {{ $ctl_comp }}
    //             },
    //             {
    //                 name: 'Шилжүүлсэн',
    //                 y: {{ $snt_comp }}
    //             },
    //             {
    //                 name: 'Шийдвэрлэсэн',
    //                 y: {{ $slv_comp }}
    //             },
    //             {
    //                 name: 'Буцаасан',
    //                 y: {{ $rtn_comp }}
    //             },
    //             {
    //                 name: 'Хугацаа хэтэрсэн',
    //                 y: {{ $exp_comp }}
    //             },
    //         ]
    //     }]
    // });

    // Хүлээн авсан суваг
    Highcharts.chart('chartBarChannel', {
        chart: {
            type: 'bar',
            height: 250
        },
        title: {
            text: 'Хүлээн авсан суваг',
            align: 'left',
            style: {
                fontSize: '14px',
                color: '#3e4095',
                fontWeight: 'bold',
            }
        },
        xAxis: {
            categories: ['Беб хуудас', 'Утас', 'И-Мэйл', 'Биечлэн', 'Гар утас', 'Албан бичиг'],
            labels: {
                style: {
                    fontSize: '11px'
                }
            }
        },
        yAxis: {
            title: {
                text: '',
                style: {
                    fontSize: '11px',
                }
            }
        },
        legend:{ enabled:false },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    style: {
                        textOutline: '1px contrast',
                        color: 'black',
                        textOutline: 'none',
                        fontSize: 10
                    },
                    backgroundColor: 'rgba(255,255,255,0.8)',
                    borderColor: 'black',
                    borderWidth: 1,
                    padding: 2,
                    borderRadius: 1,
                    shape: 'square'
                }
            }
        },
        colors: ['#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: [{
            name: 'Нийт',
            data: compChannelsCount
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

    // Line chart санал гомдлын тоо
    Highcharts.chart('chartAreaEhzh', {
        chart: {
            type: 'area',
            height: 250
        },
        title: {
            text: 'Санал гомдол',
            align: 'left',
            style: {
                fontSize: '14px',
                color: '#3e4095',
                fontWeight: 'bold',
            }
        },
        xAxis: {
            categories: monthLabels
        },
        yAxis: {
            title: {
                text: 'Тоо'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillOpacity: 0.5
            },
            series: {
                dataLabels: {
                    enabled: true,
                    backgroundColor: 'rgba(255,255,255,0.8)',
                    borderColor: 'black',
                    borderWidth: 1,
                    padding: 5,
                    borderRadius: 3,
                    shape: 'callout',
                    align: 'center',
                    verticalAlign: 'bottom',
                    x: 0,
                    y: 30
                }
            }
        },
        series: [{
            name: 'Санал гомдол',
            data: monthDatas,
            color: '#6366f1'
        }]
    });

    // Colors
    // Highcharts.chart('pieCharTypeSummary', {
    //     chart: {
    //         type: 'pie'
    //     },
    //     title: {
    //         text: 'Гомдлын төрөл'
    //     },
    //     subtitle: {
    //         text: 'ЭХЗХ - Гомдлын төрлөөр',
    //         align: 'center'
    //     },
    //     plotOptions: {
    //         pie: {
    //             innerSize: '50%',
    //             size: 250,
    //             depth: 45,
    //             dataLabels: {
    //                 enabled: true,
    //                 formatter: function() {
    //                     // Show data labels for non-zero points only
    //                     if (this.y !== 0) {
    //                         return '<b>' + this.percentage.toFixed(1) + '</b>% ';
    //                     } else {
    //                         return null; // Return null to hide the data label
    //                     }
    //                 },
    //                 distance: -35,
    //                 connectorPadding: 0,
    //                 style: {
    //                     fontSize: '14px',
    //                     // color: '#fff',
    //                     fontWeight: 'bold',
    //                     textOutline: 'none'
    //                 },
    //             },
    //             showInLegend: true,
    //         }
    //     },
    //     // colors: ['#082f49', '#075985', '#0284c7', '#38bdf8'], // Set custom colors
    //     series: [{
    //         name: 'Өргөдөл, гомдол',
    //         colorByPoint: true,
    //         data: chartDataCompTypes
    //     }]
    // });
</script>
