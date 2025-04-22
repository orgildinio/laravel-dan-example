<div class="bg-white">
    <form method="GET" autocomplete="off" class="">
        <div class="flex flex-row gap-2 p-2">
            <div>
                <input type="date" id="startdate" name="startdate"
                    value="{{ request('startdate', now()->subMonth()->toDateString()) }}"
                    class="w-36 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
            </div>
            <div>
                <input type="date" id="enddate" name="enddate"
                    value="{{ request('enddate', now()->toDateString()) }}"
                    class="w-36 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
            </div>
            <div class="flex items-end">
                <button type="submit"
                    class="bg-primary hover:bg-primaryHover text-white font-medium rounded-lg p-2 mr-2">
                    Хайх
                </button>
            </div>
        </div>
    </form>
    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-2">
            <div class="border border-gray-300 flex items-center justify-start">
                <div class="my-5 px-4">
                    <div class="block text-primary font-bold text-sm">Нийт гомдол</div>
                    <div class="block text-black font-bold text-lg">{{ $ehs_tog_count + $ehs_dulaan_count }}</div>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300 flex items-center justify-start">
                <div class="my-5 px-4">
                    <div class="block text-primary font-bold text-sm">Цахилгаан</div>
                    <div class="block text-black font-bold text-lg">{{ $ehs_tog_count }}</div>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300 flex items-center justify-start">
                <div class="my-5 px-4">
                    <div class="block text-primary font-bold text-sm">Дулаан</div>
                    <div class="block text-black font-bold text-lg">{{ $ehs_dulaan_count }}</div>
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
        <div class="col-span-3">
            <div class="border border-gray-300">
                <div id="pieChartStatusEhs"></div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="chartEnergyTypeEhs"></div>
            </div>
        </div>
        <div class="col-span-3">
            <div class="border border-gray-300">
                <div id="chartTreemap"></div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-5">
            <div class="border border-gray-300">
                <div id="lineChartEhs"></div>
            </div>
        </div>
        <div class="col-span-3">
            <div class="border border-gray-300">
                <div id="pieChartCategoryEhs"></div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-3">
            <div class="border border-gray-300">
                <div id="pieChartMakerEhs"></div>
            </div>
        </div>
        <div class="col-span-5">
            <div class="border border-gray-300">
                <div id="barChartChannelEhs"></div>
            </div>
        </div>
    </section>

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

    // bar chart status

    const statusCountEhs = @json($ehs_status_count);

    const expireEhs = {
        y: {{ $exp_comp }},
        color: '#fca5a5'
    };

    const dataStatusEhs = statusCountEhs.map((obj, index) => ({
        y: obj['y'],
        color: statusBarColors[index]
    }));
    const statusEhsDataset = [...dataStatusEhs, expireEhs];

    // ЭХЗХ Chart энергийн төрлөөр 
    Highcharts.chart('chartEnergyTypeEhs', {
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
                    y: {{ $ehs_tog_count }}
                },
                {
                    name: 'Дулаан',
                    y: {{ $ehs_dulaan_count }}
                },
            ]
        }]
    });
    // ЭХЗХ Donut Chart Өргөдлийн ангилал аар
    const ehsCategoryData = @json($ehs_category);
    Highcharts.chart('pieChartCategoryEhs', {
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
                    connectorPadding: 0.1,
                },
            }
        },
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: [{
            name: 'Өргөдөл, гомдол',
            data: ehsCategoryData
        }]
    });

    const ehsTypeData = @json($ehs_type_count);
    ehsTypeData.forEach((obj, index) => {
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
                    format: '{point.name} - {point.value}',
                    color: '#FFFFFF',
                    style: {
                        textOutline: 'none',
                        fontSize: 10
                    },
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
            data: ehsTypeData
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


    // // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    const ehsStatusData = @json($ehs_status_count);
    Highcharts.chart('pieChartStatusEhs', {
        chart: {
            type: 'pie',
            height: 250,
        },
        title: {
            text: 'Гомдлын шийдвэрлэлт',
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
            data: ehsStatusData
        }]
    });

    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    const ehsMakerData = @json($ehs_maker_count);
    Highcharts.chart('pieChartMakerEhs', {
        chart: {
            type: 'pie',
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
            data: ehsMakerData
        }]
    });

    // Line chart санал гомдлын тоо
    const ehsMonthData = @json($ehs_month_count);
    const ehsMonthLabels = ehsMonthData.map(function(obj) {
        return obj[Object.keys(obj)[0]] + ' сар';
    });
    const ehsMonthDatas = ehsMonthData.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });
    Highcharts.chart('lineChartEhs', {
        chart: {
            type: 'areaspline',
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
            categories: ehsMonthLabels
        },
        yAxis: {
            title: {
                text: ''
            }
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
            data: ehsMonthDatas,
            color: '#6366f1'
        }]
    });

    // Хүлээн авсан суваг
    const ehsChannelsData = @json($ehs_channels_count);
    var channelLabels = ehsChannelsData.map(function(obj) {
        return obj[Object.keys(obj)[0]];
    });
    var channelDatas = ehsChannelsData.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });
    // console.log(ehsChannelsData);
    Highcharts.chart('barChartChannelEhs', {
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
            categories: channelLabels,
            labels: {
                style: {
                    fontSize: '10px' // Set the font size of x-axis labels
                }
            },
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        plotOptions: {
            series: {
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
            name: 'Нийт',
            data: channelDatas
        }],
    });
</script>
