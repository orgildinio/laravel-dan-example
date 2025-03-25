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
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-2 mt-2">
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
            <div class="border-l-4 border-blue-500 px-3">
                <div class="block text-primary font-bold text-xs sm:text-sm">Шилжүүлсэн</div>
                <div class="block text-black font-bold text-lg sm:text-xl">{{ $snt_comp }}</div>
            </div>
        </div>
        <div class="border border-gray-300 flex items-center justify-center p-4">
            <div class="border-l-4 border-green-500 px-3">
                <div class="block text-primary font-bold text-xs sm:text-sm">Шийдвэрлэсэн</div>
                <div class="block text-black font-bold text-lg sm:text-xl">{{ $slv_comp }}</div>
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
    // **ЭХЗХ Chart энергийн төрлөөр**  
    // Энэ график нь "Цахилгаан" болон "Дулаан" гэсэн хоёр төрлийн өгөгдлийг харуулна.
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
        credits: {
            enabled: false
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


    // **Treemap Chart - Өргөдлийн төрлөөр**  
    // Энэ treemap нь өргөдлийн төрлүүдийг нийт тоогоор нь ангилж харуулна.
    var compSumType = <?php echo $compSumType; ?>;
    compSumType.forEach((obj, index) => {
        obj.colorValue = index + 1;
    });
    Highcharts.chart('chartTreemap', {
        chart: {
            height: 250
        },
        credits: {
            enabled: false
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

    // **Өргөдлийн ангилал (Donut Chart)**  
    // Энэ график нь өргөдөл, гомдлын ангиллуудыг харуулна.
    var chartCategoryData = <?php echo $compCategoryCounts; ?>;
    Highcharts.chart('donutChartChannel', {
        chart: {
            type: 'pie',
            height: 250
        },
        credits: {
            enabled: false
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


    // **Гомдол гаргагчийн ангилал (Pie Chart)**  
    // Иргэн, ААН, ТЗЭ, төрийн байгууллага гэх мэт ангиллаар гомдол гаргагчдыг харуулна.
    var compTypeMakersCount = <?php echo $compTypeMakersCount; ?>;
    Highcharts.chart('pieChartMaker', {
        chart: {
            type: 'pie',
            height: 250
        },
        credits: {
            enabled: false
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
                },
            }
        },
        colors: ['#342BC2', '#6F68F1', '#9993FF', '#407ED9', '#2465C3', '#1897BF'],
        series: [{
            name: 'Өргөдөл, гомдол',
            data: compTypeMakersCount
        }]
    });


    // **Хүлээн авсан суваг (Bar Chart)**  
    // Өргөдөл, гомдлыг ямар сувгаар хүлээн авсныг харуулна.
    var compChannelsCount = <?php echo $compChannelsCount; ?>;
    var channelLabels = compChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[0]];
    });
    var channelDatas = compChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });
    Highcharts.chart('chartBarChannel', {
        chart: {
            type: 'bar',
            height: 250
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
        }]
    });


    // **Санал гомдлын тоо (Area Spline Chart)**  
    // Сарын дотор өргөдөл, гомдлын өөрчлөлтийг харуулна.
    var compCountsCurrentYear = <?php echo $compCountsCurrentYear; ?>;
    var monthLabels = compCountsCurrentYear.map(function(obj) {
        return obj[Object.keys(obj)[0]] + ' сар';
    });
    var monthDatas = compCountsCurrentYear.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });
    Highcharts.chart('chartAreaEhzh', {
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
            },
        },
        series: [{
            name: 'Санал гомдол',
            data: monthDatas,
            color: '#6366f1'
        }]
    });
</script>
