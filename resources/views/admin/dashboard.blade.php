 <x-layout.admin.app>

     <div class="row d-xl-flex"><!-- [ sample-page ] start -->

         <div class="col-md-6 col-xxl-3 d-xl-flex">
             <div class="card h-80 w-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center">
                         <div class="flex-shrink-0">
                             <div class="avtar avtar-s bg-light-primary">
                                 <i class="ph-duotone ph-buildings text-primary fs-2"></i>
                             </div>
                         </div>
                         <div class="flex-grow-1 ms-3">
                             <h6 class="mb-0">Unit Organisasi</h6>
                         </div>
                     </div>

                     <div class="bg-body p-3 mt-3 rounded">
                         <h3 class="mb-1">{{ $skmTotal }}</h3>
                         <p class="text-muted mb-0 text-sm">Total Unit Organisasi Terdaftar</p>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-md-6 col-xxl-3 d-xl-flex">
             <div class="card h-80 w-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center">
                         <div class="flex-shrink-0">
                             <div class="avtar avtar-s bg-light-warning">
                                 <i class="ph-duotone ph-hard-drives text-warning fs-2"></i>
                             </div>
                         </div>
                         <div class="flex-grow-1 ms-3">
                             <h6 class="mb-0">Layanan</h6>
                         </div>
                     </div>

                     <div class="bg-body p-3 mt-3 rounded">
                         <h3 class="mb-1">{{ $serviceTotal }}</h3>
                         <p class="text-muted mb-0 text-sm">Layanan Terdaftar di Unit Organisasi</p>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-md-6 col-xxl-3 d-xl-flex">
             <div class="card h-80 w-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center">
                         <div class="flex-shrink-0">
                             <div class="avtar avtar-s bg-light-info">
                                 <i class="ph-duotone ph-users-four text-info fs-2"></i>
                             </div>
                         </div>
                         <div class="flex-grow-1 ms-3">
                             <h6 class="mb-0">Responden</h6>
                         </div>
                     </div>

                     <div class="bg-body p-3 mt-3 rounded">
                         <h3 class="mb-1">{{ $respondentTotal }}</h3>
                         <p class="text-muted mb-0 text-sm">Total Responden</p>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-md-6 col-xxl-3 d-xl-flex">
             <div class="card h-80 w-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center">
                         <div class="flex-shrink-0">
                             <div class="avtar avtar-s bg-light-primary">
                                 <span class="fs-3 text-primary">{{ $skmQualityValue }}</span>
                             </div>
                         </div>
                         <div class="flex-grow-1 ms-3">
                             <h6 class="mb-0">IKM Provinsi Gorontalo</h6>
                         </div>
                     </div>

                     <div class="bg-body p-3 mt-3 rounded">
                         <h3 class="mb-1">{{ $skmScoreTotal }}</h3>
                         <p class="text-muted mb-0 text-sm">Nilai {{ $skmScoreTotal }} dengan Peringkat
                             {{ $skmQualityValue }}
                             ({{ $skmQualityLabel }})</p>
                     </div>
                 </div>
             </div>
         </div>

     </div>

     <!-- [ Main Content ] start -->
     <div class="row">

         <div class="col-lg-8 d-xl-flex">
             <div class="card h-80 w-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center mb-2">
                         <div class="flex-grow-1">
                             <h5 class="mb-0">Jumlah Responden Tahun {{ $year }} </h5>
                         </div>
                     </div>
                     {{-- <h5 class="text-end my-2">5.44% <span class="badge bg-success">+2.6%</span> </h5> --}}
                     <div id="respondentLineChart"></div>
                 </div>
             </div>
         </div>
         <div class="col-lg-4 d-xl-flex">
             <div class="card h-80 w-100">
                 <div class="card-header">
                     <h5 class="mb-0">Aktivitas Responden Terbaru</h5>
                 </div>
                 <div class="card-body p-0">
                     <ul class="list-group list-group-flush">

                         @foreach ($respondentRecent as $item)
                             <li class="list-group-item">
                                 <div class="d-flex align-items-center">
                                     <div class="flex-shrink-0">
                                         <div class="avtar avtar-s border">
                                             {{ $item->initials }}
                                         </div>
                                     </div>
                                     <div class="flex-grow-1 ms-3">
                                         <div class="row g-1">
                                             <div class="col-8">
                                                 <h6 class="mb-0">{{ $item->masked_name }}</h6>
                                                 <p class="text-muted mb-0 text-truncate">
                                                     <small>
                                                         {{ $item->service->name }}
                                                     </small>
                                                 </p>
                                             </div>
                                             <div class="col-4 text-end">
                                                 <h6 class="mb-1">
                                                     {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d/m/Y') }}
                                                 </h6>
                                                 <p class="text-warning mb-0">
                                                     <i class="ph-duotone ph-clock"></i>
                                                     {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                                                 </p>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                         @endforeach

                     </ul>
                 </div>
             </div>
         </div>

     </div>


     @push('js')
         <script src="{{ asset('assets/admin/js/plugins/apexcharts.min.js') }}"></script>

         <script>
             document.addEventListener("DOMContentLoaded", function() {

                 const monthlyDataRespondent = @json($chartLineData);

                 var options = {
                     chart: {
                         type: 'area',
                         height: 360,
                         toolbar: {
                             show: false
                         },
                         zoom: {
                             enabled: false
                         },
                         animations: {
                             enabled: true,
                             easing: 'easeinout',
                             speed: 900,
                             animateGradually: {
                                 enabled: true,
                                 delay: 120
                             },
                             dynamicAnimation: {
                                 enabled: true,
                                 speed: 350
                             }
                         }
                     },

                     series: [{
                         name: 'Jumlah Responden',
                         data: monthlyDataRespondent
                     }],

                     xaxis: {
                         categories: [
                             'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                             'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                         ],
                         title: {
                             text: 'Bulan'
                         },
                         axisBorder: {
                             show: false
                         },
                         axisTicks: {
                             show: false
                         }

                     },

                     yaxis: {
                         min: 0,
                         forceNiceScale: true,
                         title: {
                             text: 'Jumlah Responden'
                         }
                     },

                     stroke: {
                         curve: 'smooth',
                         width: 2
                     },

                     markers: {
                         //  size: 5,
                         hover: {
                             size: 5
                         }
                     },

                     colors: ['#673AB7'],

                     fill: {
                         type: 'gradient',
                         gradient: {
                             shadeIntensity: 1,
                             type: 'vertical',
                             inverseColors: false,
                             opacityFrom: 0.5,
                             opacityTo: 0
                         }
                     },

                     tooltip: {
                         y: {
                             formatter: function(val) {
                                 return val;
                             }
                         }
                     },


                     dataLabels: {
                         enabled: false
                     },

                     plotOptions: {
                         bar: {
                             columnWidth: '45%',
                             borderRadius: 4
                         }
                     },
                     grid: {
                         strokeDashArray: 4
                     },
                 };

                 var chart = new ApexCharts(
                     document.querySelector("#respondentLineChart"),
                     options
                 );
                 setTimeout(() => {
                     chart.render();
                 }, 1000);
             });
         </script>
     @endpush

 </x-layout.admin.app>
