<div class="mt-8">
   
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6">
        <div id="chartEnergyTypeTze" class="bg-white shadow rounded-lg"></div>
        <div id="pieChartStatusTze" class="bg-white shadow rounded-lg"></div>
        <div id="lineChartTze" class="bg-white shadow rounded-lg"></div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 mt-6 mb-6">
      <div class="flex items-center border-r border-black">
         <div class="flex-1 border-t border-b border-black mx-4"></div>
         <div class="text-lg font-bold">Цахилгаан</div>
         <div class="flex-1 border-t border-b border-black mx-4"></div>
      </div>
      <div class="flex items-center">
         <div class="flex-1 border-t border-b border-black mx-4"></div>
         <div class="text-lg font-bold">Дулаан</div>
         <div class="flex-1 border-t border-b border-black mx-4"></div>
      </div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-6 mt-6">
         <div class="bg-white shadow rounded-lg">
            <div id="stackedChartContainerTze1"></div>
         </div>
         <div class="bg-white shadow rounded-lg">
            <div id="stackedChartContainerTze2"></div>
         </div>
    </section>
    <section class="grid md:grid-cols-4 xl:grid-cols-4 gap-6 mt-6">
        {{-- <div class="flex flex-col bg-white shadow rounded-lg p-2">
            <table class="min-w-full text-left text-sm font-light border border-gray-300">
                <thead class="font-medium">
                    <tr class="border-b bg-blue-700 text-white">
                        <th scope="col" class="p-1 border-r">Тусгай зөвшөөрөл эзэмшигч</th>
                        <th scope="col" class="p-1 text-center">100</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b bg-gray-50">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шинээр ирсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-orange-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хүлээн авсан</td>
                        <td class="whitespace-nowrap p-1 text-center">10</td>
                    </tr>
                    <tr class="border-b bg-blue-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хянаж байгаа</td>
                        <td class="whitespace-nowrap p-1 text-center">15</td>
                    </tr>
                    <tr class="border-b bg-yellow-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шилжүүлсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-green-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шийдвэрлэсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">50</td>
                    </tr>
                    <tr class="border-b bg-gray-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Буцаасан</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-red-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хугацаа хэтэрсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">10</td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
        <div id="barChartStatusTog" class="bg-white shadow rounded-lg"></div>
        <div id="pieChartMakerElectric" class="bg-white shadow rounded-lg"></div>
        {{-- <div class="flex flex-col bg-white shadow rounded-lg p-2">
            <table class="min-w-full text-left text-sm font-light border border-gray-300">
                <thead class="font-medium">
                    <tr class="border-b bg-blue-700 text-white">
                        <th scope="col" class="p-1 border-r">Тусгай зөвшөөрөл эзэмшигч</th>
                        <th scope="col" class="p-1 text-center">100</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b bg-gray-50">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шинээр ирсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-orange-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хүлээн авсан</td>
                        <td class="whitespace-nowrap p-1 text-center">10</td>
                    </tr>
                    <tr class="border-b bg-blue-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хянаж байгаа</td>
                        <td class="whitespace-nowrap p-1 text-center">15</td>
                    </tr>
                    <tr class="border-b bg-yellow-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шилжүүлсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-green-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Шийдвэрлэсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">50</td>
                    </tr>
                    <tr class="border-b bg-gray-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Буцаасан</td>
                        <td class="whitespace-nowrap p-1 text-center">5</td>
                    </tr>
                    <tr class="border-b bg-red-300">
                        <td class="whitespace-nowrap p-1 font-medium border-r">Хугацаа хэтэрсэн</td>
                        <td class="whitespace-nowrap p-1 text-center">10</td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
        <div id="barChartStatusDulaan" class="bg-white shadow rounded-lg"></div>
        <div id="pieChartMakerDulaan" class="bg-white shadow rounded-lg"></div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-6 mt-6">
        <div id="barChartElectric" class="bg-white shadow rounded-lg"></div>
        <div id="barChartDulaan" class="bg-white shadow rounded-lg"></div>
    </section>
</div>

<script type="text/javascript">
    // ЭХЗХ Chart энергийн төрлөөр 
    Highcharts.chart('chartEnergyTypeTze', {
        chart: {
            type: 'pie',
            marginTop: 10
            // width: 300
        },
        title: {
            text: 'Гомдлын төрөл'
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
        // legend: {
        //    floating: true,
        //    // layout: 'vertical',
        //    x: -100,
        //    y: 10
        // },
        colors: ['#00BFFF', '#FF6347'],
        series: [{
            name: 'Өргөдөл, гомдол',
            colorByPoint: true,
            data: [{
                    name: 'Цахилгаан',
                    y: {{ $tze_tog }}
                },
                {
                    name: 'Дулаан',
                    y: {{ $tze_dulaan }}
                },
            ]
        }],
        // subtitle: {
        //    text: 'Нийт:  {{ $tze_tog + $tze_dulaan }}', // Display the total value in the center
        //    verticalAlign: 'middle',
        //    floating: true,
        //    style: {
        //       fontSize: '18px',
        //       color: '#000',
        //       fontWeight: 'bold'
        //    }
        // }
    });
    const customColorsStacked = ['#fca5a5', '#d1d5db', '#86efac', '#fde047', '#93c5fd', '#fdba74', '#f9fafb'];
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartStatusTze', {
        chart: {
            type: 'pie',
            marginTop: 70
        },
        title: {
            text: 'Гомдлын төрөл'
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 250,
                depth: 45,
                dataLabels: {
                    enabled: true,
                    // format: '<b>{point.percentage:.1f}%</b>',
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
        legend: {
            // maxHeight: 50,
            // floating: true,
            // layout: 'vertical',
            // x: 10,
            // y: 10
        },
        colors: ['#f9fafb', '#3b82f6', '#f59e0b', '#fde047', '#22c55e', '#64748b',
            '#ef4444'
        ], // Set custom colors
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
        color: customColors[index]
    }));

    // Create the stacked bar chart
    Highcharts.chart('stackedChartContainerTze1', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Цахилгаан түгээх, хангах ТЗЭ-чид'
        },
        xAxis: {
            categories: orgNametogTab2
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
        color: customColors[index]
    }));

    // Stacked Chart 2
    Highcharts.chart('stackedChartContainerTze2', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Дулаан түгээх, хангах ТЗЭ-чид'
        },
        xAxis: {
            categories: orgNameDulaanTab2
        },
        yAxis: {
            title: {
                text: 'Values'
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
        series: seriesDulaanTab2
    });

    // Bar chart status tog
    let statusCountTog = @json($statusTog);
    let dataStatusTog = statusCountTog.map((obj, index) => ({
        y: obj['status_count'],
        color: statusBarColors[index]
    }));
    let statusExpireTog = {
        y: {{ $statusExpireTog }},
        color: '#fca5a5'
    };
    let statusTogDataset = [...dataStatusTog, statusExpireTog];

   //  let datalableTog = statusTogDataset.map(function(obj) {
   //      return obj[Object.keys(obj)[1]];
   //  });

    Highcharts.chart('barChartStatusTog', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Гомдлын төлөв',
            // align: 'left'
        },
        subtitle: {
            text: '',
            align: ''
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
            data: statusTogDataset
        }, ]
    });


    // Bar chart status dulaan
    let statusCountDulaan = @json($statusDulaan);
    let dataStatusDulaan = statusCountDulaan.map((obj, index) => ({
        y: obj['status_count'],
        color: statusBarColors[index]
    }));
    let statusExpireDulaan = {
        y: {{ $statusExpireDulaan }},
        color: '#fca5a5'
    };
    let statusDulaanDataset = [...dataStatusDulaan, statusExpireDulaan];

    Highcharts.chart('barChartStatusDulaan', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Гомдлын төлөв',
            // align: 'left'
        },
        subtitle: {
            text: '',
            align: ''
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
            data: statusDulaanDataset
        }, ]
    });

    var compMakerTogCount = <?php echo $compMakerTogCount; ?>;
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMakerElectric', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын гаргагчийн төрөл',
            style: {
                fontSize: '14px' // Set the desired font size here
            }
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 200,
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
            data: compMakerTogCount
        }]
    });
    var compMakerDulaanCount = <?php echo $compMakerDulaanCount; ?>;
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMakerDulaan', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Гомдлын гаргагчийн төрөл',
            style: {
                fontSize: '14px' // Set the desired font size here
            }
        },
        plotOptions: {
            pie: {
                innerSize: '50%',
                size: 200,
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
            data: compMakerDulaanCount
        }]
    });



    // Хүлээн авсан суваг
    var compTogChannelsCount = <?php echo $compTogChannelsCount; ?>;
    var channelTogLabels = compTogChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[0]];
    });
    var channelTogDatas = compTogChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });

    Highcharts.chart('barChartElectric', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Хүлээн авсан суваг - Цахилгаан'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: channelTogLabels
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
            data: channelTogDatas
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

    var compDulaanChannelsCount = <?php echo $compDulaanChannelsCount; ?>;
    var channelDulaanLabels = compDulaanChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[0]];
    });
    var channelDulaanDatas = compDulaanChannelsCount.map(function(obj) {
        return obj[Object.keys(obj)[1]];
    });

    Highcharts.chart('barChartDulaan', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Хүлээн авсан суваг - Дулаан'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: channelDulaanLabels
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
            data: channelDulaanDatas
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
