<div class="mt-8">
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-2">
            {{-- <table class="min-w-full text-left text-sm font-light border border-gray-300">
                <thead class="font-medium">
                    <tr class="border-b bg-blue-700 text-white">
                        <th scope="col" class="p-1 border-r">Эрчим хүчний зохицуулах хороо</th>
                        <th scope="col" class="p-1 text-center">{{ $all_comp }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b bg-gray-50">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шинээр ирсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">{{ $new_comp }}</td>
                    </tr>
                    <tr class="border-b bg-orange-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хүлээн авсан</td>
                        <td class="whitespace-nowrap p-1 text-center">{{ $rec_comp }}</td>
                    </tr>
                    <tr class="border-b bg-blue-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хянаж байгаа</td>
                        <td class="whitespace-nowrap p-1 text-center">{{ $ctl_comp }}</td>
                    </tr>
                    <tr class="border-b bg-yellow-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шилжүүлсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">{{ $snt_comp }}</td>
                    </tr>
                    <tr class="border-b bg-green-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шийдвэрлэсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">{{ $slv_comp }}</td>
                    </tr>
                    <tr class="border-b bg-gray-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Буцаасан</td>
                        <td class="whitespace-nowrap p-1 text-center">{{ $rtn_comp }}</td>
                    </tr>
                    <tr class="border-b bg-red-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хугацаа хэтэрсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">{{ $exp_comp }}</td>
                    </tr>
                </tbody>
            </table> --}}
            <div id="chartStatus"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="chartEnergyType"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="donutChartChannel"></div>
        </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6 mt-6">
        <div class="bg-white shadow rounded-lg md:col-span-2 lg:col-span-2 overflow-y-auto">
            <div id="stackedChartTog"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieChartMaker"></div>
        </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6 mt-6">
        <div class="bg-white shadow rounded-lg md:col-span-2 lg:col-span-2 overflow-y-auto">
            <div id="stackedChartDulaan"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieChartStatus"></div>
        </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6 mt-6">
        <div class="bg-white shadow rounded-lg">
            <div id="chartAreaEhzh"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="pieCharTypeSummary"></div>
        </div>
        <div class="bg-white shadow rounded-lg">
            <div id="chartBarChannel"></div>
        </div>
    </section>
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

    Highcharts.chart('chartStatus', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Гомдлын төлөв',
            // align: 'left'
        },
        subtitle: {
            text: 'ЭХЗХ - Гомдлын шийдвэрлэлтийн явц',
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
                    x: 400
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
            data: statusDataset
        }, ]
    });


    // ЭХЗХ Chart энергийн төрлөөр 
    Highcharts.chart('chartEnergyType', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        subtitle: {
            text: 'ЭХЗХ - Гомдлын төрөл цахилгаан, дулаан',
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
        colors: ['#00BFFF', '#FF6347'],
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
    // ЭХЗХ Donut Chart Өргөдлийн ангилал аар
    Highcharts.chart('donutChartChannel', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Өргөдлийн ангилал'
        },
        subtitle: {
            text: 'ЭХЗХ - Ирсэн өргөдөл, гомдлын ангилал',
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
            data: chartCategoryData
        }]
    });

    // Extract series data from the sample data
    const seriesDataTog = newArray.map((item, index) => ({
        name: item.category,
        data: item.values,
        color: customColors[index]
    }));

    // Create the stacked bar chart
    Highcharts.chart('stackedChartTog', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Цахилгаан түгээх, хангах ТЗЭ-чид'
        },
        xAxis: {
            categories: uniqueOrganizationNamesTog
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
        legend: {
            // floating: true,
            align: 'left',
            verticalAlign: 'top',
            layout: 'horizontal',
            // Other legend options...
        },
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
        color: customColors[index]
    }));

    // Create the stacked bar chart
    Highcharts.chart('stackedChartDulaan', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Дулаан түгээх, хангах ТЗЭ-чид'
        },
        xAxis: {
            categories: uniqueOrganizationNamesDulaan
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
        legend: {
            // floating: true,
            align: 'left',
            verticalAlign: 'top',
            layout: 'horizontal',
            // Other legend options...
        },
        series: seriesData2
    });

    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMaker', {
        chart: {
            type: 'pie',
            // width: 400,
            // height: 400
        },
        title: {
            text: 'Гомдол гаргагчийн төрөл'
        },
        subtitle: {
            text: 'ЭХЗХ - Гомдол гаргагчийн төрлөөр',
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
        legend: {
            align: 'center', // Adjust alignment as needed ('left', 'right', 'center')
            verticalAlign: 'bottom', // Adjust vertical alignment as needed ('top', 'middle', 'bottom')
            layout: 'horizontal', // Set layout to horizontal
            minHeight: 100, // Set a maximum height for the legend
            itemStyle: {
                textOverflow: 'ellipsis', // Enable text ellipsis for legend items
                overflow: 'hidden',
                width: '100%', // Ensure width is 100%
                whiteSpace: 'nowrap' // Prevent wrapping
            }
        },
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: compTypeMakersCount
        }]
    });

    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartStatus', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын төлөв'
        },
        subtitle: {
            text: 'ЭХЗХ - Гомдлын шийдвэрлэлтийн явц',
            align: 'center'
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 250,
                depth: 45,
                dataLabels: {
                    enabled: true,
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
        colors: ['#f9fafb', '#3b82f6', '#f59e0b', '#fde047', '#22c55e', '#64748b', '#ef4444'],
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

    // Хүлээн авсан суваг
    Highcharts.chart('chartBarChannel', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Хүлээн авсан суваг'
        },
        subtitle: {
            text: 'ЭХЗХ - Хүлээн авсан сувгаар',
            align: 'center'
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
            type: 'area'
        },
        title: {
            text: 'Санал гомдол'
        },
        subtitle: {
            text: 'ЭХЗХ - Санал, гомдлын тоо сараар',
            align: 'center'
        },
        xAxis: {
            categories: monthLabels
        },
        yAxis: {
            title: {
                text: 'Санал гомдлын тоо'
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

    // Colors
    Highcharts.chart('pieCharTypeSummary', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        subtitle: {
            text: 'ЭХЗХ - Гомдлын төрлөөр',
            align: 'center'
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 250,
                depth: 45,
                dataLabels: {
                    enabled: true,
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
                        // color: '#fff',
                        fontWeight: 'bold',
                        textOutline: 'none'
                    },
                },
                showInLegend: true,
            }
        },
        // colors: ['#082f49', '#075985', '#0284c7', '#38bdf8'], // Set custom colors
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: chartDataCompTypes
        }]
    });
</script>
