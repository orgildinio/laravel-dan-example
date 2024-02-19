<div class="mt-4">
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
