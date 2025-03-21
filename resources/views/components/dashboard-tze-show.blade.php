<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div x-data="{ showPopup: true }">
    <!-- Popup Modal -->
    <div x-show="showPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div
            class="bg-white p-8 rounded-2xl shadow-2xl relative max-w-lg w-full min-h-[350px] transition-all transform scale-100">

            <!-- Close Button -->
            <button @click="showPopup = false"
                class="absolute top-4 right-4 text-gray-600 text-3xl font-bold hover:text-red-600 transition">
                &times;
            </button>

            <!-- Swiper Slider -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide flex flex-col items-center text-center px-6">
                        <div class="flex justify-center w-full mb-4">
                            <img src="{{ asset('images/ip-phone.png') }}" alt="IP Phone" class="w-[200px] h-auto">
                        </div>
                        <p class="text-lg text-gray-800 font-medium leading-relaxed mb-4">
                            📞 Та бүхний ашиглаж буй IP дугаарыг SIP протокол дэмждэг суурин утасны төхөөрөмжид холбож,
                            тохируулан ашиглах боломжтой.
                        </p>
                        <a href="{{ route('banner-detail') }}"
                            class="mt-5 px-6 py-2 text-white bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 transition-all">
                            🔍 Дэлгэрэнгүй
                        </a>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide flex flex-col items-center text-center px-6">
                        <h2 class="text-xl text-gray-900 font-semibold">📞 Дуудлага шилжүүлэх заавар</h2>
                        <p class="text-lg text-gray-700 mt-3 leading-relaxed">
                            Та бүхний ашиглаж буй IP дугаарт ирсэн дуудлагыг өөр утасны дугаар руу шилжүүлэх боломжтой.
                        </p>
                        <p class="text-lg text-gray-700 mt-2">
                            <strong>✅ Дуудлага шилжүүлэх:</strong> <br>
                            *72* дуудлага шилжүүлэх утасны дугаар оруулаад дуудлага хийх товчийг дарна.
                        </p>
                        <p class="text-lg text-gray-700 mt-2">
                            <strong>Жишээ:</strong> <br>
                            *72*99999999 гэж оруулаад дуудлага хийх товчлуур дээр дарахад автомат хариулагчаас хариу
                            өгнө.
                        </p>
                        <p class="text-lg text-gray-700 mt-2 mb-6">
                            <strong>❌ Дуудлага шилжүүлгийг цуцлах:</strong> <br>
                            *72* гэж залгахад шилжүүлсэн дуудлага цуцлагдана.
                        </p>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".mySwiper", {
            loop: true, // Сүүлчийн слайд дуусаад эхнийх рүү автоматаар шилжинэ
            autoplay: {
                delay: 5000
            }, // Автоматаар 5 секунд тутамд шилжинэ
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            }, // Доорхи цэгүүдээр удирдах боломжтой
            effect: "fade", // Шилжилтийн эффект илүү зөөлөн болно
            fadeEffect: {
                crossFade: true
            },
            speed: 800, // Илүү зөөлөн шилжилт
        });
    });
</script>










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
