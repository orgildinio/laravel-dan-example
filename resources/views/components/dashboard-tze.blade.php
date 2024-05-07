<div class="bg-white">

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-2">
            <div class="border border-gray-300 flex items-center justify-start">
                <div class="my-5 px-4">
                    <div class="block text-primary font-bold text-sm">Нийт гомдол</div>
                    <div class="block text-black font-bold text-lg">{{ $tze_tog + $tze_dulaan }}</div>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300 flex items-center justify-start">
                <div class="my-5 px-4">
                    <div class="block text-primary font-bold text-sm">Цахилгаан</div>
                    <div class="block text-black font-bold text-lg">{{ $tze_tog }}</div>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300 flex items-center justify-start">
                <div class="my-5 px-4">
                    <div class="block text-primary font-bold text-sm">Дулаан</div>
                    <div class="block text-black font-bold text-lg">{{ $tze_dulaan }}</div>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300 flex items-center justify-start">
                <div class="my-5 px-4">
                    <div class="block text-primary font-bold text-sm">Хугацаа хэтэрсэн</div>
                    <div class="block text-black font-bold text-lg">{{ $exp_comp }}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="chartEnergyTypeTze"></div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="pieChartStatusTze"></div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="lineChartTze"></div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="stackedChartContainerTze1"></div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="stackedChartContainerTze2"></div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="pieChartMakerElectric"></div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="pieChartMakerDulaan"></div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="barChartElectric"></div>
            </div>
        </div>
    </section>

    {{-- <section class="grid md:grid-cols-4 xl:grid-cols-4 gap-4 mt-4">
        <div id="barChartStatusTog" class="bg-white shadow rounded-lg"></div>
        <div id="pieChartMakerElectric" class="bg-white shadow rounded-lg"></div>
        <div id="barChartStatusDulaan" class="bg-white shadow rounded-lg"></div>
        <div id="pieChartMakerDulaan" class="bg-white shadow rounded-lg"></div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-4 mt-4">
        <div id="barChartElectric" class="bg-white shadow rounded-lg"></div>
        <div id="barChartDulaan" class="bg-white shadow rounded-lg"></div>
    </section> --}}
</div>

<script type="text/javascript">
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

    const statusBarColors = [
        '#f9fafb',
        '#d1d5db',
        '#fde047',
        '#93c5fd',
        '#fdba74',
        '#fca5a5',
        '#86efac',
    ];

    // ЭХЗХ Chart энергийн төрлөөр 
    Highcharts.chart('chartEnergyTypeTze', {
        chart: {
            type: 'pie',
            height: 250,
            // marginTop: 10
            // width: 300
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
        colors: ['#818cf8', '#3730a3'],
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
    });
    const customColorsStacked = ['#fca5a5', '#d1d5db', '#86efac', '#fde047', '#93c5fd', '#fdba74', '#f9fafb'];
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartStatusTze', {
        chart: {
            type: 'pie',
            height: 250
        },
        title: {
            text: 'Гомдлын төрөл',
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
                    connectorPadding: 0.01
                },
            }
        },
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
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
        maxPointWidth: 50,
    }));

    // Create the stacked bar chart
    Highcharts.chart('stackedChartContainerTze1', {
        chart: {
            type: 'column',
            height: 300,
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
        xAxis: {
            categories: orgNametogTab2,
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
        maxPointWidth: 50,
    }));

    // Stacked Chart 2
    Highcharts.chart('stackedChartContainerTze2', {
        chart: {
            type: 'column',
            height: 300,
            scrollablePlotArea: {
                minWidth: orgNameDulaanTab2 * 70
            }
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
            categories: orgNameDulaanTab2,
            labels: {
                style: {
                    fontSize: '10px' // Set the font size of x-axis labels
                }
            },
        },
        yAxis: {
            title: {
                text: 'Санал, гомдлын тоо'
            }
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

    // Highcharts.chart('barChartStatusTog', {
    //     chart: {
    //         type: 'bar'
    //     },
    //     title: {
    //         text: 'Гомдлын төлөв',
    //         // align: 'left'
    //     },
    //     subtitle: {
    //         text: '',
    //         align: ''
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
    //         data: statusTogDataset
    //     }, ]
    // });


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

    // Highcharts.chart('barChartStatusDulaan', {
    //     chart: {
    //         type: 'bar'
    //     },
    //     title: {
    //         text: 'Гомдлын төлөв',
    //         // align: 'left'
    //     },
    //     subtitle: {
    //         text: '',
    //         align: ''
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
    //         data: statusDulaanDataset
    //     }, ]
    // });

    var compMakerTogCount = <?php echo $compMakerTogCount; ?>;
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMakerElectric', {
        chart: {
            type: 'pie',
            height: 250
        },
        title: {
            text: 'Цахилгаан',
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
                    connectorPadding: 0.01
                },
            }
        },
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: [{
            name: 'Өргөдөл, гомдол',
            data: compMakerTogCount
        }]
    });
    var compMakerDulaanCount = <?php echo $compMakerDulaanCount; ?>;
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMakerDulaan', {
        chart: {
            type: 'pie',
            height: 250
        },
        title: {
            text: 'Дулаан',
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

    var compDulaanChannelsCount = <?php echo $compDulaanChannelsCount; ?>;
    var channelDulaanLabels = compDulaanChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[0]];
    });
    var channelDulaanDatas = compDulaanChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });

    Highcharts.chart('barChartElectric', {
        chart: {
            type: 'column',
            height: 250,
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
            categories: channelTogLabels,
            labels: {
                style: {
                    fontSize: '10px' // Set the font size of x-axis labels
                }
            },
        },
        yAxis: {
            title: {
                text: 'Санал, гомдлын тоо'
            }
        },
        plotOptions: {
            series: {
                // stacking: 'percent',
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
                },
                pointWidth: 50,
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
        series: [{
                name: 'Цахилгаан',
                data: channelTogDatas
            },
            {
                name: 'Дулаан',
                data: channelDulaanDatas
            }
        ],
    });

    

    // Highcharts.chart('barChartDulaan', {
    //     chart: {
    //         type: 'bar'
    //     },
    //     title: {
    //         text: 'Хүлээн авсан суваг - Дулаан'
    //     },
    //     subtitle: {
    //         text: ''
    //     },
    //     xAxis: {
    //         categories: channelDulaanLabels
    //     },
    //     yAxis: {
    //         title: {
    //             text: 'Ирсэн өргөдөл, гомдлын тоо'
    //         }
    //     },
    //     legend: {
    //         layout: 'vertical',
    //         align: 'right',
    //         verticalAlign: 'middle'
    //     },
    //     plotOptions: {
    //         series: {
    //             allowPointSelect: true
    //         }
    //     },
    //     series: [{
    //         name: 'Нийт',
    //         //   data: newChartData
    //         data: channelDulaanDatas
    //     }],
    //     responsive: {
    //         rules: [{
    //             condition: {
    //                 maxWidth: 1000
    //             },
    //             chartOptions: {
    //                 legend: {
    //                     layout: 'horizontal',
    //                     align: 'center',
    //                     verticalAlign: 'bottom'
    //                 }
    //             }
    //         }]
    //     }
    // });
</script>
