<div class="mt-8">
    <h2 class="text-md text-gray-900 shadow bg-blue-50 p-2 mb-6 border-l-8 border-primary">Хянах самбар: <span class="text-primary font-bold">{{Auth::user()->org?->name}}</span></h2>
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
                                  <th scope="col" class="p-1 border-r">{{Auth::user()->org?->name}}</th>
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
                               <tr class="border-b bg-green-300">
                                  <td class="whitespace-nowrap p-1 font-medium border-r">Шийдвэрлэсэн</td>
                                  <td class="whitespace-nowrap p-1 text-center">{{$slv_comp}}</td>
                               </tr>
                               <tr class="border-b bg-gray-300">
                                  <td class="whitespace-nowrap p-1 font-medium border-r">Цуцлагдсан</td>
                                  <td class="whitespace-nowrap p-1 text-center">{{$cnc_comp}}</td>
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
             <div id="chartEnergyTypeEhs"></div>
       </div>
       <div class="flex justify-center items-center bg-white shadow rounded-lg">
             <div id="donutChartChannelEhs"></div>
       </div>
    </section>
    <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6 mt-6">
        <div class="flex flex-col bg-white shadow rounded-lg justify-center align-middle">
            <div class="p-4 flex-grow">
                <div id="pieChartStatusEhs"></div>
            </div>
        </div>
        <div class="flex flex-col bg-white shadow rounded-lg">
            <div class="p-4 flex-grow">
               <div id="pieCharTypeSummaryEhs"></div>
            </div>
         </div>
       <div class="flex justify-center items-center bg-white shadow rounded-lg">
             <div id="pieChartMakerEhs"></div>
       </div>
    </section>
    <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-6 mt-6">
       <div class="flex flex-col bg-white shadow rounded-lg">
          <div class="p-4 flex-grow">
             <div id="lineChartEhs"></div>
          </div>
       </div>
       
       <div class="flex flex-col bg-white shadow rounded-lg">
          <div class="p-4 flex-grow">
             <div id="barChartChannelEhs"></div>
          </div>
       </div>
    </section>
 </div>

 <script type="text/javascript">
 
    // ЭХЗХ Chart энергийн төрлөөр 
    Highcharts.chart('chartEnergyTypeEhs', {
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
       colors: ['#3b82f6', '#f97316'],
       series: [{
          name: 'Өргөдөл, гомдол',
          colorByPoint: true,
          data: [
             { name: 'Цахилгаан', y: 40 },
             { name: 'Дулаан', y: 60 },
          ]
       }]
    });
    // ЭХЗХ Donut Chart Өргөдлийн ангилал аар
    Highcharts.chart('donutChartChannelEhs', {
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
            data: [
             { name: 'Санал', y: 30 },
             { name: 'Гомдол', y: 40 },
             { name: 'Талархал', y: 20 },
             { name: 'Бусад', y: 10 },
             { name: 'Хүсэлт', y: 10 }
          ]
        }]
    });
 
    // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartMakerEhs', {
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
          data: [
             { name: 'Иргэн', y: 30 },
             { name: 'ААН', y: 40 },
             { name: 'СӨХ', y: 20 },
             { name: 'ТЗЭ', y: 10 },
             { name: 'Төрийн байгууллага', y: 10 }
          ]
       }]
    });
 
    // // Create the pie chart Иргэн ААН СӨХ ТЗЭ Төрийн байгууллага
    Highcharts.chart('pieChartStatusEhs', {
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
       colors: ['#fca5a5', '#d1d5db', '#86efac', '#fde047', '#93c5fd', '#fdba74', '#f9fafb'], // Set custom colors
       series: [{
          name: 'Өргөдөл, гомдол',
          colorByPoint: true,
          data: [
             { name: 'Хугацаа хэтэрсэн', y: 10 },
             { name: 'Буцаасан', y: 5 },
             { name: 'Шийдвэрлэсэн', y: 50 },
             { name: 'Шилжүүлсэн', y: 5 },
             { name: 'Хянаж байгаа', y: 15 },
             { name: 'Хүлээн авсан', y: 10 },
             { name: 'Шинээр ирсэн', y: 5 },
          ]
       }]
    });

    Highcharts.chart('pieCharTypeSummaryEhs', {
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
       colors: ['#082f49', '#075985', '#0284c7', '#38bdf8'], // Set custom colors
       series: [{
          name: 'Өргөдөл, гомдол',
          colorByPoint: true,
          data: [
             { name: 'Төлбөр тооцоо', y: 10 },
             { name: 'Хэмжих хэрэгсэл', y: 5 },
             { name: 'Чанар хангамж', y: 50 },
             { name: 'Бусад', y: 5 },
          ]
       }]
    });
 
    // Line chart санал гомдлын тоо
    Highcharts.chart('lineChartEhs', {
       chart: {
         type: 'area'
     },
       title: {
          text: 'Санал гомдол'
       },
       xAxis: {
          categories: ['1 сар', '2 сар', '3 сар', '4 сар', '5 сар', '6 сар', '7 сар', '8 сар', '9 сар', '10 сар', '11 сар', '12 сар']
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
          data: [5, 0, 15, 2, 25, 12, 45, 26, 32, 19, 24, 36]
       }]
    });

    // Хүлээн авсан суваг
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
        data: [5, 50, 15, 2, 25, 12]
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