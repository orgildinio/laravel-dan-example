<div class="mt-8">
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6">
       <div class="flex flex-col bg-white shadow rounded-lg">
          <div class="p-4 flex-grow">
             <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                   <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                      <div class="overflow-hidden">
                         <table class="min-w-full text-left text-sm font-light border border-gray-300">
                            <thead class="font-medium">
                               <tr class="border-b bg-blue-700 text-white">
                                  <th scope="col" class="p-1 border-r">Эрчим хүчний зохицуулах хороо</th>
                                  <th scope="col" class="p-1 text-center">{{$all_comp}}</th>
                               </tr>
                            </thead>
                            <tbody>
                               <tr class="border-b bg-gray-50">
                                  <td class="whitespace-nowrap p-1 font-medium border-r">Шинээр ирсэн</td>
                                  <td class="whitespace-nowrap p-1 text-center">{{$new_comp}}</td>
                               </tr>
                               <tr class="border-b bg-orange-300">
                                  <td class="whitespace-nowrap p-1 font-medium border-r">Хүлээн авсан</td>
                                  <td class="whitespace-nowrap p-1 text-center">{{$rec_comp}}</td>
                               </tr>
                               <tr class="border-b bg-blue-300">
                                  <td class="whitespace-nowrap p-1 font-medium border-r">Хянаж байгаа</td>
                                  <td class="whitespace-nowrap p-1 text-center">{{$ctl_comp}}</td>
                               </tr>
                               <tr class="border-b bg-yellow-300">
                                  <td class="whitespace-nowrap p-1 font-medium border-r">Шилжүүлсэн</td>
                                  <td class="whitespace-nowrap p-1 text-center">{{$snt_comp}}</td>
                               </tr>
                               <tr class="border-b bg-green-300">
                                  <td class="whitespace-nowrap p-1 font-medium border-r">Шийдвэрлэсэн</td>
                                  <td class="whitespace-nowrap p-1 text-center">{{$slv_comp}}</td>
                               </tr>
                               <tr class="border-b bg-gray-300">
                                  <td class="whitespace-nowrap p-1 font-medium border-r">Буцаасан</td>
                                  <td class="whitespace-nowrap p-1 text-center">{{$rtn_comp}}</td>
                               </tr>
                               <tr class="border-b bg-red-300">
                                  <td class="whitespace-nowrap p-1 font-medium border-r">Хугацаа хэтэрсэн</td>
                                  <td class="whitespace-nowrap p-1 text-center">{{$exp_comp}}</td>
                               </tr>
                            </tbody>
                         </table>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="flex justify-center items-center bg-white shadow rounded-lg">
             <div id="chartEnergyType"></div>
       </div>
       <div class="flex justify-center items-center bg-white shadow rounded-lg">
             <div id="donutChartChannel"></div>
       </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6 mt-6">
       <div class="flex flex-col bg-white shadow rounded-lg md:col-span-2 lg:col-span-2">
          <div class="p-4 flex-grow">
             <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                   <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                      <div class="overflow-hidden">
                         {{-- <h1 class="text-center font-bold pb-2">Цахилгаан түгээх, хангах ТЗЭ-чид</h1> --}}
                         <div id="stackedChartContainer1"></div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="flex justify-center items-center bg-white shadow rounded-lg">
             <div id="pieChartMaker"></div>
       </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6 mt-6">
       <div class="flex flex-col bg-white shadow rounded-lg md:col-span-2 lg:col-span-2">
          <div class="p-4 flex-grow">
             <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                   <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                      <div class="overflow-hidden">
                         <div id="stackedChartContainer2"></div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="flex flex-col bg-white shadow rounded-lg justify-center align-middle">
          <div class="p-4 flex-grow">
             <div id="pieChartStatus"></div>
          </div>
       </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6 mt-6">
       <div class="flex flex-col bg-white shadow rounded-lg">
          <div class="p-4 flex-grow">
             <div id="chart2"></div>
          </div>
       </div>
       <div class="flex flex-col bg-white shadow rounded-lg">
          <div class="p-4 flex-grow">
             <div id="pieCharTypeSummary"></div>
          </div>
       </div>
       <div class="flex flex-col bg-white shadow rounded-lg">
          <div class="p-4 flex-grow">
             <div id="chart"></div>
          </div>
       </div>
    </section>
 </div>

 <script type="text/javascript">
    // var chartData = <?php //echo json_encode($complaints_by_channels)?>;
    // var newChartData = chartData.map(obj => obj.count);
 
    // var chartDataMonth = <?php //echo json_encode($complaints_by_months)?>;
    // var chartData2 = chartDataMonth.map(obj => obj.count);
 
    // var chartDataStatus = <?php //echo json_encode($complaints_by_status)?>;
    // console.log(chartDataStatus);
   //  var chartData3 = chartDataStatus.map(obj => {return {
   //     name: obj.name,
   //     y: obj.count};
   //  });
    //  console.log(chartData3);
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

   var compTzeTogCounts = <?php echo $compTzeTogCounts; ?>;

   var chartTzeTogLabels = compTzeTogCounts.map(function(obj) {
      return obj[Object.keys(obj)[0]];
   });
   var chartTzelTogDatas = compChannelsCount.map(function(obj) {
      return obj[Object.keys(obj)[1]];
   });

   
 
    // ЭХЗХ Chart энергийн төрлөөр 
    Highcharts.chart('chartEnergyType', {
       chart: {
          type: 'pie',
          width: 300
       },
       title: {
          text: 'Гомдлын төрөл'
       },
       // tooltip: {
       //    valueSuffix: '%'
       // },
       plotOptions: {
          pie: {
             allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br> {point.percentage:.1f} %',
                distance: -80, // Set distance to move the labels inside
                connectorPadding: 0 // Remove connector padding
             },
             showInLegend: true,
             size: '100%' // Set the size of the pie chart
          }
       },
       colors: ['#00BFFF', '#FF6347'],
       series: [{
          name: 'Өргөдөл, гомдол',
          colorByPoint: true,
          data: [
             { name: 'Цахилгаан', y: {{$ehzh_tog_count}} },
             { name: 'Дулаан', y: {{$ehzh_dulaan_count}} },
          ]
       }]
    });
    // ЭХЗХ Donut Chart Өргөдлийн ангилал аар
    Highcharts.chart('donutChartChannel', {
        chart: {
          type: 'pie',
          width: 300
       },
        title: {
            text: 'Өргөдлийн ангилал'
        },
        plotOptions: {
            pie: {
                innerSize: '50%', // Set inner size to create a donut chart
                depth: 45, // Add a 3D effect
                dataLabels: {
                    enabled: true,
                    crop: false,
                    distance: '-10%',
                    // style: {
                    //     fontWeight: 'bold',
                    //     fontSize: '16px'
                    // },
                    connectorWidth: 0,
                    format: '<b>{point.name}</b>:<br> {point.percentage:.1f} %',
                    // distance: -30, // Set distance to move the labels inside
                    // connectorPadding: 0 // Remove connector padding
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
 
    const customColors = ['#fca5a5', '#d1d5db', '#86efac', '#fde047', '#93c5fd', '#fdba74', '#f9fafb'];
 
    // Stacked Chart 1
    const data = [
       { category: 'Хугацаа хэтэрсэн', values: [20, 30, 40, 24, 26, 46] },
       { category: 'Буцаасан', values: [20, 30, 40, 24, 26, 46] },
       { category: 'Шийдвэрлэсэн', values: [20, 30, 40, 24, 26, 46] },
       { category: 'Шилжүүлсэн', values: [20, 30, 40, 24, 26, 46] },
       { category: 'Хянаж байгаа', values: [20, 30, 40, 24, 26, 46] },
       { category: 'Хүлээн авсан', values: [15, 25, 35, 39, 26, 54] },
       { category: 'Шинээр ирсэн', values: [10, 20, 30, 14, 7, 16] },
    ];
    
 
    // Extract series data from the sample data
    const seriesData = data.map((item, index) => ({
       name: item.category,
       data: item.values,
       color: customColors[index]
    }));
 
    // Create the stacked bar chart
    Highcharts.chart('stackedChartContainer1', {
       chart: {
          type: 'bar'
       },
       title: {
          text: 'Цахилгаан түгээх, хангах ТЗЭ-чид'
       },
       xAxis: {
          categories: chartTzeTogLabels
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
                 enabled: true
             }
         }
       },
       series: seriesData
    });
 
    // Stacked Chart 2
    const data2 = [
       { category: 'Хугацаа хэтэрсэн', values: [15, 34, 25, 34, 29, 26] },
       { category: 'Буцаасан', values: [20, 30, 26, 24, 6, 46] },
       { category: 'Шийдвэрлэсэн', values: [20, 30, 4, 24, 26, 46] },
       { category: 'Шилжүүлсэн', values: [20, 30, 4, 36, 26, 25] },
       { category: 'Хянаж байгаа', values: [20, 30, 40, 2, 26, 6] },
       { category: 'Хүлээн авсан', values: [15, 25, 5, 9, 26, 4] },
       { category: 'Шинээр ирсэн', values: [10, 20, 30, 14, 7, 6] },
    ];
 
    // Extract series data from the sample data
    const seriesData2 = data2.map((item, index) => ({
       name: item.category,
       data: item.values,
       color: customColors[index]
    }));
 
    // Create the stacked bar chart
    Highcharts.chart('stackedChartContainer2', {
       chart: {
          type: 'bar'
       },
       title: {
          text: 'Дулаан түгээх, хангах ТЗЭ-чид'
       },
       xAxis: {
          categories: ['УБДС ТӨХК', 'ОСНААУГ ОНӨААТҮГ', 'ДСЦТС ТӨХК', 'Ганбиж ХХК', 'Баянмонгол хотхон ХХК', 'Гангар-Орд ХХК']
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
                 enabled: true
             }
         }
       },
       series: seriesData2
    });
 
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMaker', {
       chart: {
          type: 'pie',
          width: 300
       },
       title: {
          text: 'Гомдлын төрөл'
       },
       plotOptions: {
          pie: {
             allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br> {point.percentage:.1f} %',
                distance: -40, // Set distance to move the labels inside
                connectorPadding: 0 // Remove connector padding
             },
             showInLegend: true
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
          text: 'Гомдлын төрөл'
       },
       plotOptions: {
          pie: {
             allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br> {point.percentage:.1f} %',
                distance: -40, // Set distance to move the labels inside
                connectorPadding: 0 // Remove connector padding
             },
             showInLegend: true
          }
       },
       colors: customColors, // Set custom colors
       series: [{
          name: 'Өргөдөл, гомдол',
          colorByPoint: true,
          data: [
             { name: 'Хугацаа хэтэрсэн', y: {{$exp_comp}} },
             { name: 'Буцаасан', y: {{$rtn_comp}} },
             { name: 'Шийдвэрлэсэн', y: {{$slv_comp}} },
             { name: 'Шилжүүлсэн', y: {{$snt_comp}} },
             { name: 'Хянаж байгаа', y: {{$ctl_comp}} },
             { name: 'Хүлээн авсан', y: {{$rec_comp}} },
             { name: 'Шинээр ирсэн', y: {{$new_comp}} },
          ]
       }]
    });
 
    // Хүлээн авсан суваг
    Highcharts.chart('chart', {
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
          categories: ['Беб хуудас', 'Утас', 'И-Мэйл', 'Биечлэн', 'Гар утас', 'Албан бичиг'
          ]
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
    Highcharts.chart('chart2', {
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
 
    // Colors
    const customColors2 = ['#082f49', '#075985', '#0284c7', '#38bdf8'];
    Highcharts.chart('pieCharTypeSummary', {
       chart: {
          type: 'pie'
       },
       title: {
          text: 'Гомдлын төрөл'
       },
       plotOptions: {
          pie: {
             allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br> {point.percentage:.1f} %',
                distance: -40, // Set distance to move the labels inside
                connectorPadding: 0 // Remove connector padding
             },
             showInLegend: true
          }
       },
       colors: customColors2, // Set custom colors
       series: [{
          name: 'Өргөдөл, гомдол',
          colorByPoint: true,
          data: chartDataCompTypes
       }]
    });
 
 
 </script>