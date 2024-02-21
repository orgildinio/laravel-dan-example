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
                <span class="block text-2xl font-bold">{{ $ehs_tog_count + $ehs_dulaan_count }}</span>
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
                <span class="block text-2xl font-bold">{{ $ehs_tog_count }}</span>
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
                <span class="inline-block text-2xl font-bold">{{ $ehs_dulaan_count }}</span>
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
        <div class="bg-white shadow rounded-lg">
            <div id="barChartStatusEhs"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="chartEnergyTypeEhs"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieChartCategoryEhs"></div>
        </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-4 mt-4">
        <div class="bg-white shadow rounded-lg">
            <div id="pieChartStatusEhs"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieCharTypeSummaryEhs"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieChartMakerEhs"></div>
        </div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-4 mt-4">
        <div class="bg-white shadow rounded-lg">
            <div id="lineChartEhs"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="barChartChannelEhs"></div>
        </div>
    </section>
</div>

<script type="text/javascript">

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

   Highcharts.chart('barChartStatusEhs', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Гомдлын төлөв',
            // align: 'left'
        },
        subtitle: {
            text: 'ЭХС - Гомдлын шийдвэрлэлтийн явц',
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
            data: statusEhsDataset
        }, ]
    });

    // ЭХЗХ Chart энергийн төрлөөр 
    Highcharts.chart('chartEnergyTypeEhs', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        subtitle: {
            text: 'ЭХС - Гомдлын төрөл цахилгаан, дулаан',
            align: 'center'
        },
        // tooltip: {
        //    valueSuffix: '%'
        // },
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
        colors: ['#3b82f6', '#f97316'],
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: [{
                    name: 'Цахилгаан',
                    y: {{$ehs_tog_count}}
                },
                {
                    name: 'Дулаан',
                    y: {{$ehs_dulaan_count}}
                },
            ]
        }]
    });
    // ЭХЗХ Donut Chart Өргөдлийн ангилал аар
    const ehsCategoryData = @json($ehs_category);
    Highcharts.chart('pieChartCategoryEhs', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Өргөдлийн ангилал'
        },
        subtitle: {
            text: 'ЭХС - Ирсэн өргөдөл, гомдлын ангилал',
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
            data: ehsCategoryData
        }]
    });
    // // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    const ehsStatusData = @json($ehs_status_count);
    Highcharts.chart('pieChartStatusEhs', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        subtitle: {
            text: 'ЭХС - Гомдлын шийдвэрлэлтийн явц',
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
                        fontSize: '12px',
                        // color: '#fff',
                        fontWeight: 'bold',
                        textOutline: 'none'
                    },
                },
                showInLegend: true,
            }
        },
        colors: customColors, // Set custom colors
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: ehsStatusData
        }]
    });

    const ehsTypeData = @json($ehs_type_count);
    Highcharts.chart('pieCharTypeSummaryEhs', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        subtitle: {
            text: 'ЭХС - Гомдлын төрлөөр',
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
                        // color: '#fff',
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
            data: ehsTypeData
        }]
    });

    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    const ehsMakerData = @json($ehs_maker_count);
    Highcharts.chart('pieChartMakerEhs', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдол гаргагчийн төрөл'
        },
        subtitle: {
            text: 'ЭХС - Гомдол гаргагчийн төрлөөр',
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
                        // color: '#fff',
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
            type: 'area'
        },
        title: {
            text: 'Санал гомдол'
        },
        subtitle: {
            text: 'ЭХС - Санал, гомдлын тоо тухайн жилийн сараар',
            align: 'center'
        },
        xAxis: {
            categories: ehsMonthLabels
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
            data: ehsMonthDatas
        }]
    });

    // Хүлээн авсан суваг
    const ehsChannelsData = @json($ehs_channels_count);
    Highcharts.chart('barChartChannelEhs', {
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
            categories: ['Беб хуудас', 'Утас', 'И-Мэйл', 'Биечлэн', 'Гар утас', 'Албан бичиг']
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
            data: ehsChannelsData
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
