<div>
    <h2 class="text-md text-gray-900 shadow bg-blue-50 p-2 mb-4 border-l-8 border-primary">Хянах самбар: <span
            class="text-primary font-bold">{{ Auth::user()->org?->name }}</span></h2>

            
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-lg md:col-span-2 lg:col-span-2">
            <div id="barChartStatusTze"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="donutChartChannelTze"></div>
        </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-4 mt-4">
        <div class="bg-white shadow rounded-lg">
            <div id="pieChartStatusTze"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieCharTypeSummaryTze"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieChartMakerTze"></div>
        </div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-4 mt-4">
        <div class="bg-white shadow rounded-lg">
            <div id="lineChartTze"></div>
        </div>

        <div class="bg-white shadow rounded-lg">
            <div id="barChartChannelTze"></div>
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

    Highcharts.chart('barChartStatusTze', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Гомдлын төлөв',
            // align: 'left'
        },
        subtitle: {
            text: 'ТЗЭ - Гомдлын шийдвэрлэлтийн явц',
            align: 'center'
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
                    x: 1200
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
            data: statusDatasetTze
        }, ]
    });

    // ЭХЗХ Donut Chart Өргөдлийн ангилал аар
    Highcharts.chart('donutChartChannelTze', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын ангилал'
        },
        subtitle: {
            text: 'ТЗЭ - Гомдлын ангилал',
            align: 'center'
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
        series: [{
            type: 'pie',
            name: 'Өргөдөл, гомдол',
            data: chartData
        }]
    });

    // // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartStatusTze', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын төлөв'
        },
        subtitle: {
            text: 'ТЗЭ - Гомдлын шийдвэрлэлтийн явц',
            align: 'center'
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
        colors: ['#fca5a5', '#d1d5db', '#86efac', '#93c5fd', '#fdba74', '#f9fafb'], // Set custom colors
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: [{
                    name: 'Хугацаа хэтэрсэн',
                    y: {{ $exp_comp }}
                },
                {
                    name: 'Буцаасан',
                    y: {{ $cnc_comp }}
                },
                {
                    name: 'Шийдвэрлэсэн',
                    y: {{ $slv_comp }}
                },
                {
                    name: 'Хянаж байгаа',
                    y: {{ $ctl_comp }}
                },
                {
                    name: 'Хүлээн авсан',
                    y: {{ $rec_comp }}
                },
                {
                    name: 'Шинээр ирсэн',
                    y: {{ $new_comp }}
                },
            ]
        }]
    });

    Highcharts.chart('pieCharTypeSummaryTze', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        subtitle: {
            text: 'ТЗЭ - Гомдлын төрлөөр',
            align: 'center'
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
        colors: ['#082f49', '#075985', '#0284c7', '#38bdf8'], // Set custom colors
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: chartDataCompTypes
        }]
    });

    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMakerTze', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        subtitle: {
            text: 'ТЗЭ - Гомдол гаргагчийн төрлөөр',
            align: 'center'
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
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: compTypeMakersCount
        }]
    });

    // Line chart санал гомдлын тоо
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

    // Хүлээн авсан суваг
    Highcharts.chart('barChartChannelTze', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Хүлээн авсан суваг'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: channelLabels
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
