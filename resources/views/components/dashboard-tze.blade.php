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
        <div class="col-span-8">
            <div class="border border-gray-300">
                <div id="stackedChartContainerTze1"></div>
            </div>
        </div>
        <div class="col-span-8">
            <div class="border border-gray-300">
                <div id="stackedChartContainerTze2"></div>
            </div>
        </div>
        <div class="col-span-8">
            <div class="border border-gray-300">
                <div id="complaintsChart"></div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-8 gap-2 mt-2">
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="barChartElectric"></div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="border border-gray-300">
                <div id="lineChartTze"></div>
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
                text: ''
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
                text: ''
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
                name: 'Цахилгаан',
                data: channelTogDatas
            },
            {
                name: 'Дулаан',
                data: channelDulaanDatas
            }
        ],
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

    /*========================================================*/
    Highcharts.chart('complaintsChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: {!! json_encode($categories) !!},
            title: {
                text: 'ТЗЭ'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Өргөдөл, гомдлын тоо'
            },
            stackLabels: {
                enabled: true
            }
        },
        legend: {
            align: 'right',
            verticalAlign: 'top',
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.category}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Нийт: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
                name: 'Шинээр ирсэн',
                data: {!! json_encode($statusCounts['Status 0']) !!},
                color: '#7cb5ec'
            },
            {
                name: 'Шилжүүлсэн',
                data: {!! json_encode($statusCounts['Status 1']) !!},
                color: '#8085e9'
            },
            {
                name: 'Хүлээн авсан',
                data: {!! json_encode($statusCounts['Status 2']) !!},
                color: '#434348'
            },
            {
                name: 'Хянаж байгаа',
                data: {!! json_encode($statusCounts['Status 3']) !!},
                color: '#f7a35c'
            },
            {
                name: 'Шийдвэрлэсэн',
                data: {!! json_encode($statusCounts['Status 6']) !!},
                color: '#90ed7d'
            }
        ]
    });
</script>
