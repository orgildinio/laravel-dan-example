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
                    class="bg-primary hover:bg-primaryHover text-white font-medium rounded-lg px-4 py-2 mr-2">
                    Хайх
                </button>
            </div>
        </div>
    </form>
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-8 gap-2 mt-2">
        <div class="border border-gray-300 flex items-center justify-center p-4">
            <div class="border-l-4 border-green-500 px-3">
                <div class="block text-primary font-bold text-xs sm:text-sm">Нийт гомдол</div>
                <div class="block text-black font-bold text-lg sm:text-xl">{{ $ehzh_tog_count + $ehzh_dulaan_count }}
                </div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center p-4">
            <div class="border-l-4 border-green-500 px-3">
                <div class="block text-primary font-bold text-xs sm:text-sm">Шинээр ирсэн</div>
                <div class="block text-black font-bold text-lg sm:text-xl">{{ $new_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center p-4">
            <div class="border-l-4 border-green-500 px-3">
                <div class="block text-primary font-bold text-xs sm:text-sm">Хүлээн авсан</div>
                <div class="block text-black font-bold text-lg sm:text-xl">{{ $rec_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center p-4">
            <div class="border-l-4 border-green-500 px-3">
                <div class="block text-primary font-bold text-xs sm:text-sm">Хянаж байгаа</div>
                <div class="block text-black font-bold text-lg sm:text-xl">{{ $ctl_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center p-4">
            <div class="border-l-4 border-green-500 px-3">
                <div class="block text-primary font-bold text-xs sm:text-sm">Шийдвэрлэсэн</div>
                <div class="block text-black font-bold text-lg sm:text-xl">{{ $slv_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center p-4">
            <div class="border-l-4 border-red-500 px-3">
                <div class="block text-primary font-bold text-xs sm:text-sm">Хугацаа хэтэрсэн</div>
                <div class="block text-black font-bold text-lg sm:text-xl">{{ $exp_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center p-4">
            <div class="border-l-4 border-blue-500 px-3">
                <div class="block text-primary font-bold text-xs sm:text-sm">Шилжүүлсэн</div>
                <div class="block text-black font-bold text-lg sm:text-xl">{{ $snt_comp }}</div>
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
    // console.log(compChannelsCount);

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
            labels: {
                style: {
                    fontSize: '10px' // Set the font size of x-axis labels
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
        series: seriesData2
    });

    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMaker', {
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
            data: compTypeMakersCount
        }]
    });

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
            categories: channelLabels,
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
        legend: {
            enabled: false
        },
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

    // Line chart санал гомдлын тоо
    Highcharts.chart('chartAreaEhzh', {
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
            },
        },
        series: [{
            name: 'Санал гомдол',
            data: monthDatas,
            color: '#6366f1'
        }]
    });
</script>
