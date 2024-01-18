<x-admin-layout>
   <div class="flex h-screen">

      <!-- Left Section -->
      <div class="w-1/2 border-r border-gray-300">
         <h1 class="text-xl font-semibold text-center pb-2"><span class="bg-blue-700 text-white px-2 py-1 rounded-md">Эрчим хүчний зохицуулах хороо</span></h1>
         <section class="grid md:grid-cols-3 xl:grid-cols-3 gap-6 m-2">
            <div class="flex items-center p-2 bg-white shadow rounded-lg">
               <div
                  class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-8 h-8 rounded-full text-purple-700">
                     <path fill-rule="evenodd"
                        d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97zM6.75 8.25a.75.75 0 01.75-.75h9a.75.75 0 010 1.5h-9a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H7.5z"
                        clip-rule="evenodd" />
                  </svg>
               </div>
               <div>
                  <span class="block text-2xl font-bold">{{$bichgeer}}</span>
                  <span class="block text-gray-500">Бичгээр</span>
               </div>
            </div>
            <div class="flex items-center p-2 bg-white shadow rounded-lg">
               <div
                  class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">

                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-8 h-8 rounded-full text-green-700">
                     <path fill-rule="evenodd"
                        d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                        clip-rule="evenodd" />
                  </svg>
               </div>
               <div>
                  <span class="block text-2xl font-bold">{{$utas}}</span>
                  <span class="block text-gray-500">Утсаар</span>
               </div>
            </div>
            <div class="flex items-center p-2 bg-white shadow rounded-lg">
               <div
                  class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-teal-600 bg-teal-100 rounded-full mr-6">
   
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-8 h-8 rounded-full text-teal-700">
                     <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                     <path
                        d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                  </svg>
               </div>
               <div>
                  <span class="inline-block text-2xl font-bold">{{$email}}</span>
                  <span class="block text-gray-500">И-мэйл</span>
               </div>
            </div>
         </section>
      </div>

      <!-- Right Section -->
      <div class="w-1/2 flex items-center justify-center">
         <h2 class="text-2xl font-semibold">Тусгай зөвшөөрөл эзэмшигчид</h2>
      </div>

   </div>
   <div class="p-4 sm:p-6 xl:p-8">
      {{-- <div class="mr-6">
         <h1 class="text-4xl font-semibold mb-2">Хянах самбар</h1>
      </div> --}}
      <section class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
         <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
               class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-8 h-8 rounded-full text-purple-700">
                  <path fill-rule="evenodd"
                     d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97zM6.75 8.25a.75.75 0 01.75-.75h9a.75.75 0 010 1.5h-9a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H7.5z"
                     clip-rule="evenodd" />
               </svg>
            </div>
            <div>
               <span class="block text-2xl font-bold">{{$bichgeer}}</span>
               <span class="block text-gray-500">Бичгээр</span>
            </div>
         </div>
         <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
               class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">

               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-8 h-8 rounded-full text-green-700">
                  <path fill-rule="evenodd"
                     d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                     clip-rule="evenodd" />
               </svg>
            </div>
            <div>
               <span class="block text-2xl font-bold">{{$utas}}</span>
               <span class="block text-gray-500">Утсаар</span>
            </div>
         </div>
         <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
               class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-teal-600 bg-teal-100 rounded-full mr-6">

               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-8 h-8 rounded-full text-teal-700">
                  <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                  <path
                     d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
               </svg>
            </div>
            <div>
               <span class="inline-block text-2xl font-bold">{{$email}}</span>
               <span class="block text-gray-500">И-мэйл</span>
            </div>
         </div>
         <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
               class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-8 h-8 rounded-full text-blue-700">
                  <path fill-rule="evenodd"
                     d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                     clip-rule="evenodd" />
               </svg>
            </div>
            <div>
               <span class="block text-2xl font-bold">{{$biychlen}}</span>
               <span class="block text-gray-500">Биечлэн</span>
            </div>
         </div>
         <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
               class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-yellow-600 bg-yellow-100 rounded-full mr-6">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-8 h-8 rounded-full text-yellow-700">
                  <path fill-rule="evenodd"
                     d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97zM6.75 8.25a.75.75 0 01.75-.75h9a.75.75 0 010 1.5h-9a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H7.5z"
                     clip-rule="evenodd" />
               </svg>
            </div>
            <div>
               <span class="block text-2xl font-bold">{{$web}}</span>
               <span class="block text-gray-500">Веб хуудас</span>
            </div>
         </div>
         <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div
               class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-8 h-8 rounded-full text-red-700">
                  <path d="M10.5 18.75a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" />
                  <path fill-rule="evenodd"
                     d="M8.625.75A3.375 3.375 0 005.25 4.125v15.75a3.375 3.375 0 003.375 3.375h6.75a3.375 3.375 0 003.375-3.375V4.125A3.375 3.375 0 0015.375.75h-6.75zM7.5 4.125C7.5 3.504 8.004 3 8.625 3H9.75v.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V3h1.125c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-6.75A1.125 1.125 0 017.5 19.875V4.125z"
                     clip-rule="evenodd" />
               </svg>
            </div>
            <div>
               <span class="inline-block text-2xl font-bold">{{$mobile}}</span>
               <span class="block text-gray-500">Гар утасны апп</span>
            </div>
         </div>
      </section>
      <section class="grid md:grid-cols-2 sm:grid-cols-1 gap-6 mb-6">
         <div class="flex flex-col bg-white shadow rounded-lg">
            <div class="px-6 py-5 font-semibold border-b border-gray-100">Санал гомдлын тоо</div>
            <div class="p-4 flex-grow">
               <div id="chart"></div>
            </div>
         </div>
         <div class="flex flex-col bg-white shadow rounded-lg">
            <div class="px-6 py-5 font-semibold border-b border-gray-100">Санал гомдлын тоо</div>
            <div class="p-4 flex-grow">
               <div id="chart3"></div>
            </div>
         </div>
      </section>
      <section class="grid md:grid-cols-1 sm:grid-cols-1 gap-6">
         <div class="flex flex-col bg-white shadow rounded-lg">
            <div class="px-6 py-5 font-semibold border-b border-gray-100">Санал гомдлын тоо</div>
            <div class="p-4 flex-grow">
               <div id="chart2"></div>
            </div>
         </div>
      </section>
   </div>
</x-admin-layout>

@push('scripts')

<script type="text/javascript">
   var chartData = <?php echo json_encode($complaints_by_channels)?>;
    var newChartData = chartData.map(obj => obj.count);

    var chartDataMonth = <?php echo json_encode($complaints_by_months)?>;
    var chartData2 = chartDataMonth.map(obj => obj.count);

    var chartDataStatus = <?php echo json_encode($complaints_by_status)?>;
    console.log(chartDataStatus);
    var chartData3 = chartDataStatus.map(obj => {return {
         name: obj.name,
         y: obj.count};
      });
    console.log(chartData3);


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
            data: newChartData
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
    Highcharts.chart('chart2', {

        title: {
            text: 'Санал гомдол'
        },
        subtitle: {
            text: 'Сүүлийн 12 сар'
        },
        xAxis: {
            categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']
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
            data: chartData2
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
    Highcharts.chart('chart3', {
         chart: {
                type: 'pie'
         },
        title: {
            text: 'Санал гомдол'
        },
        tooltip: {
        valueSuffix: '%'
    },
        subtitle: {
            text: 'Санал, гомдлын явц'
        },
        plotOptions: {
            series: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: [{
                     enabled: true,
                     distance: 20
                  }, {
                     enabled: true,
                     distance: -40,
                     format: '{point.percentage:.1f}%',
                     style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                     },
                     filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                     }
                  }]
            }
         },
        series: [{
            name: 'Нийт',
            data: chartData3
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