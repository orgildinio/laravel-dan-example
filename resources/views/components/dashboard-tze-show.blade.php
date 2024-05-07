<div class="bg-white">
    <h2 class="text-md text-gray-900 shadow bg-blue-50 p-2 mb-4 border-l-8 border-primary">Хянах самбар: <span
            class="text-primary font-bold">{{ Auth::user()->org?->name }}</span></h2>
    <section class="grid grid-cols-6 gap-2 mt-2">
        <div class="border border-gray-300 flex items-center justify-center">
            <div class="border-l-4 border-green-500 my-5 px-2">
                <div class="block text-primary font-bold text-xs">Нийт гомдол</div>
                <div class="block text-black font-bold text-lg">{{ $all_comp }}</div>
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
    </section>

    <section class="grid grid-cols-6 gap-2 mt-2">
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="donutChartChannelTze"></div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="pieCharTypeSummaryTze"></div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="border border-gray-300">
                <div id="pieChartMakerTze"></div>
            </div>
        </div>
    </section>
            
    <section class="grid grid-cols-6 gap-2 mt-2">
        <div class="col-span-3">
            <div class="border border-gray-300">
                <div id="lineChartTze"></div>
            </div>
        </div>
        <div class="col-span-3">
            <div class="border border-gray-300">
                <div id="barChartChannelTze"></div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    var chartData = <?php echo $compCategoryCounts; ?>;
    var chartDataCompTypes = <?php echo $compTypeCounts; ?>;
    var compTypeMakersCount = <?php echo $compTypeMakersCount; ?>;
    var compChannelsCount = <?php echo $compChannelsCount; ?>;

    var channelLabels = compChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[0]];
    });
    var channelDatas = compChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });

    var compCountsCurrentYear = <?php echo $compCountsCurrentYear; ?>;

    var monthLabels = compCountsCurrentYear.map(function(obj) {
        return obj[Object.keys(obj)[0]] + ' сар';
    });
    var monthDatas = compCountsCurrentYear.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });
    // console.log(monthDatas);

    // Barchart status TZE
    statusBarColorsTze = [
        '#f9fafb',
        '#d1d5db',
        '#fde047',
        '#93c5fd',
        '#fdba74',
        '#fca5a5',
        '#86efac',
    ];

    var statusCountTze = @json($statusCount);

    let dataStatusTze = statusCountTze.map((obj, index) => ({
        y: obj['status_count'],
        color: statusBarColorsTze[index]
    }));
    let expireCompTze = {
        y: {{ $exp_comp }},
        color: '#fca5a5'
    };
    let statusDatasetTze = [...dataStatusTze, expireCompTze];

    // ЭХЗХ Donut Chart Өргөдлийн ангилал аар
    Highcharts.chart('donutChartChannelTze', {
        chart: {
            type: 'pie',
            height: 250
        },
        title: {
            text: 'Гомдлын ангилал',
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
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: [{
            name: 'Өргөдөл, гомдол',
            data: chartData
        }]
    });

    Highcharts.chart('pieCharTypeSummaryTze', {
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
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: chartDataCompTypes
        }]
    });

    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMakerTze', {
        chart: {
            type: 'pie',
            height: 250
        },
        title: {
            text: 'Гомдлын гаргагч',
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
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: compTypeMakersCount
        }]
    });

    // Line chart санал гомдлын тоо
    Highcharts.chart('lineChartTze', {
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
            categories: monthLabels
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
            },
        },
        series: [{
            name: 'Санал гомдол',
            data: monthDatas,
            color: '#6366f1'
        }]
    });

    // Хүлээн авсан суваг
    Highcharts.chart('barChartChannelTze', {
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
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: channelLabels
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
            //   data: newChartData
            data: channelDatas
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
