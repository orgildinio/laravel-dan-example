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
            <div>
                <select name="energy_type" id="energy_type"
                    class="w-36 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2">
                    <option value="">-- Сонгох --</option>
                    <option value="1" {{ request('energy_type') == '1' ? 'selected' : '' }}>Цахилгаан</option>
                    <option value="2" {{ request('energy_type') == '2' ? 'selected' : '' }}>Дулаан</option>
                </select>
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
    var compTogChannelsCount = <?php echo $compTogChannelsCount; ?>;
    var compDulaanChannelsCount = <?php echo $compDulaanChannelsCount; ?>;

    // Fix xAxis categories mapping
    var channelTogLabels = compTogChannelsCount.map(function(obj) {
        return obj.category; // Use 'category' explicitly
    });
    var channelTogDatas = compTogChannelsCount.map(function(obj) {
        return obj.value; // Use 'value' explicitly
    });

    var channelDulaanLabels = compDulaanChannelsCount.map(function(obj) {
        return obj.category;
    });
    var channelDulaanDatas = compDulaanChannelsCount.map(function(obj) {
        return obj.value;
    });

    // Ensure labels match (for consistent xAxis)
    var allLabels = [...new Set([...channelTogLabels, ...channelDulaanLabels])];


    Highcharts.chart('barChartElectric', {
        chart: {
            type: 'column',
            height: 250,
        },
        credits: {
            enabled: false
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
            categories: allLabels,
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
                data: allLabels.map(label => {
                    let index = channelTogLabels.indexOf(label);
                    return index !== -1 ? channelTogDatas[index] : 0; // Fill missing data with 0
                })
            },
            {
                name: 'Дулаан',
                data: allLabels.map(label => {
                    let index = channelDulaanLabels.indexOf(label);
                    return index !== -1 ? channelDulaanDatas[index] : 0;
                })
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
        credits: {
            enabled: false
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
        credits: {
            enabled: false
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
                name: 'Шинээр ирсэн', // Хөх (шинээр ирсэн гомдол)
                data: {!! json_encode($statusCounts['Status 0']) !!},
                color: '#d1d5db' // Bright Blue
            },
            {
                name: 'Шилжүүлсэн', // Ягаан туяатай хөх (процессын дунд шат)
                data: {!! json_encode($statusCounts['Status 1']) !!},
                color: '#6f42c1' // Purple
            },
            {
                name: 'Хүлээн авсан', // Саарал (мэдээлэл хүлээн авсан, хараахан шийдвэр гараагүй)
                data: {!! json_encode($statusCounts['Status 2']) !!},
                color: '#fde047' // Gray
            },
            {
                name: 'Хянаж байгаа', // Улбар шар (идэвхтэй ажиллаж байгаа)
                data: {!! json_encode($statusCounts['Status 3']) !!},
                color: '#93c5fd' // Orange
            },
            {
                name: 'Шийдвэрлэсэн', // Ногоон (шийдвэр гарсан, амжилттай дууссан)
                data: {!! json_encode($statusCounts['Status 6']) !!},
                color: '#86efac' // Green
            }
        ]
    });
</script>
