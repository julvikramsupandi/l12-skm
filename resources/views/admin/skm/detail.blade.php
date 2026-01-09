<x-layout.admin.app title="{{ $skm->unor->name }}">

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/style.css') }}" />
    @endpush

    <x-layout.admin.pageheader title="{{ $skm->unor->name }}" :breadcrumb="[
        ['label' => 'Indeks Kepuasan Masyarakat (OPD)', 'url' => route('admin.skm.index')],
        ['label' => $skm->unor->name, 'url' => null],
    ]" />

    <div class="row">
        <div class="col-xl-6 d-xl-flex pb-4 mb-xl-0">
            <div class="card h-100 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ph-duotone ph-user-gear fs-3"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">Layanan</h5>
                            <p class="text-muted text-sm mb-0">Pilih layanan yang akan ditampilkan</p>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.service.index', $skm->id) }}">
                                <button type="button" class="btn btn-icon btn-outline-success" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Tambah Layanan">
                                    <i class="ph-duotone ph-plus"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="bg-body p-3 mt-3 rounded">
                        @can('skm.show')
                            <form action="{{ route('admin.skm.show', $skm->id) }}" method="post">
                            @endcan
                            @can('skm.show-by-unor')
                                <form action="{{ route('admin.skm.by-unor') }}" method="post">
                                @endcan

                                @csrf
                                <div class="row g-2">
                                    <div class="col-lg-12">
                                        <select name="service" id="select-service" class="choices">
                                            <option value="">- Semua Layanan -</option>
                                            @foreach ($services as $item)
                                                <option {{ $serviceSelected == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="year" class="form-control">
                                            @for ($i = date('Y'); $i >= 2022; $i--)
                                                <option {{ $yearSelected == $i ? 'selected' : '' }}
                                                    value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-lg-5">
                                        <select name="month" class="form-control">
                                            <option value="">- Semua Bulan -</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option {{ $monthSelected == $i ? 'selected' : '' }}
                                                    value="{{ $i }}">
                                                    {{ \Carbon\Carbon::createFromDate(null, $i, 1)->locale('id')->translatedFormat('F') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-lg-3 d-flex justify-content-center align-items-center">
                                        <button class="btn btn-primary w-100 text-nowrap">
                                            <i class="ph-duotone ph-eye"></i> Tampilkan
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 d-xl-flex pb-4 mb-xl-0">
            <div class="card h-100 w-100 welcome-banner bg-purple-800">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="row">

                        <div class="col-lg-4 d-flex justify-content-center align-items-center order-1 order-lg-2">
                            <div class="rounded-circle border border-5 border-foreground text-white"
                                style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center; font-size: 3rem; font-weight: bold; background-color: rgb(103,58,183, 0.25);">
                                {{ $skmQualityValue }}
                            </div>
                        </div>

                        <div class="col-lg-8 order-2 order-lg-1">
                            <div class="p-4 text-center text-lg-start">
                                <h4 class="text-white">{{ $serviceSelectedName }}</h4>
                                <p class="text-white">
                                    Berdasarkan hasil penilaian dari {{ $respondentTotal }} responden, diperoleh nilai
                                    sebesar
                                    <span class="fw-bold">{{ $scoreTotal }}</span>
                                    dengan peringkat
                                    <span class="fw-bold">
                                        {{ $skmQualityValue }}
                                        ({{ $skmQualityLabel }})
                                    </span>
                                </p>
                                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">

                                    <a href="javascript:void(0)" class="btn btn-outline-light text-nowrap"
                                        data-bs-toggle="modal" data-bs-target="#qrcodeModal">
                                        <i class="ph-duotone ph-copy"></i> Tautan Kuesioner
                                    </a>
                                    <a href="javascript:void(0)"
                                        onclick="return alert('Fitur ini masih dalam proses pengembangan. Terima Kasih.')"
                                        class="btn btn-outline-light text-nowrap">
                                        <i class="ph-duotone ph-brackets-curly"></i> Sematkan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-4 d-xl-flex pb-4 mb-xl-0">
            <div class="card h-100 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ph-duotone ph-chart-bar fs-3"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">Grafik</h5>
                            <p class="text-muted text-sm mb-0">
                                {{ $serviceSelectedName }} | {{ $yearSelected }} |
                                {{ $monthSelected ? \Carbon\Carbon::createFromDate(null, $monthSelected, 1)->locale('id')->translatedFormat('F') : 'Semua Bulan' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div id="elementBarChart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 d-xl-flex pb-4 mb-xl-0">
            <div class="card h-100 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ph-duotone ph-squares-four fs-3"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">Nilai Unsur Pelayanan</h5>
                            <p class="text-muted text-sm mb-0">
                                {{ $serviceSelectedName }} | {{ $yearSelected }} |
                                {{ $monthSelected ? \Carbon\Carbon::createFromDate(null, $monthSelected, 1)->locale('id')->translatedFormat('F') : 'Semua Bulan' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm">
                                <tr>
                                    <th class="text-center">KODE</th>
                                    <th>UNSUR PELAYANAN</th>
                                    <th class="text-center">NILAI UNSUR</th>
                                    <th class="text-center">MUTU</th>
                                    <th class="text-center">KINERJA</th>
                                </tr>
                                @foreach ($elementScores as $element)
                                    <tr>
                                        <td class="text-center">{{ $element['element_code'] }}</td>
                                        <td>{{ $element['element_name'] }}</td>
                                        <td class="text-center">{{ $element['element_score'] }}</td>
                                        <td class="text-center">{{ $element['element_quality_value'] }}</td>
                                        <td class="text-center">
                                            @if ($element['element_quality_value'] == 'A')
                                                <badge class="badge text-bg-primary">
                                                    {{ $element['element_quality_label'] }}
                                                </badge>
                                            @elseif($element['element_quality_value'] == 'B')
                                                <badge class="badge text-bg-success">
                                                    {{ $element['element_quality_label'] }}
                                                </badge>
                                            @elseif($element['element_quality_value'] == 'C')
                                                <badge class="badge text-bg-warning">
                                                    {{ $element['element_quality_label'] }}
                                                </badge>
                                            @else
                                                <badge class="badge text-bg-danger">
                                                    {{ $element['element_quality_label'] }}
                                                </badge>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-12 d-xl-flex pb-4 mb-xl-0">
            <div class="card h-100 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ph-duotone ph-chart-donut fs-3"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">
                                Grafik Perbandingan Responden (Jenis Kelamin, Pendidikan, Pekerjaan)
                            </h5>
                            <p class="text-muted text-sm mb-0">
                                {{ $serviceSelectedName }} | {{ $yearSelected }} |
                                {{ $monthSelected ? \Carbon\Carbon::createFromDate(null, $monthSelected, 1)->locale('id')->translatedFormat('F') : 'Semua Bulan' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-3 row justify-between">
                        <div class="col-lg-4">
                            <div id="genderDonutChart"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="educationDonutChart"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="occupationDonutChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 d-xl-flex pb-4 mb-xl-0">
            <div class="card h-100 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ph-duotone ph-envelope fs-3"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">
                                Masukan dan saran
                            </h5>
                            <p class="text-muted text-sm mb-0">
                                {{ $serviceSelectedName }} | {{ $yearSelected }} |
                                {{ $monthSelected ? \Carbon\Carbon::createFromDate(null, $monthSelected, 1)->locale('id')->translatedFormat('F') : 'Semua Bulan' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th>NAMA</th>
                                    <th>LAYANAN</th>
                                    <th class="text-center">MASUKAN DAN SARAN</th>
                                </tr>
                                @foreach ($feedbacks as $feedback)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $feedback->respondent->respondent_name }}</td>
                                        <td>{{ $feedback->respondent->service->name }}</td>
                                        <td class="text-wrap">{{ $feedback->feedback }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('admin.skm.qrcode')

    @push('js')
        <script src="{{ asset('assets/admin/js/plugins/choices.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/apexcharts.min.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Choices('#select-service', {
                    searchEnabled: true,
                    shouldSort: false,
                    // placeholder: true,
                    // placeholderValue: 'Pilih Layanan',
                    // itemSelectText: '',
                    allowHTML: false,
                });
            });


            const elementScores = @json($elementScores);

            var elementOptions = {
                chart: {
                    type: 'bar',
                    height: 420,
                    // width: '90%',
                    toolbar: {
                        show: false
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        },
                        dynamicAnimation: {
                            enabled: true,
                            speed: 350
                        }
                    }
                },

                colors: ['#673AB7'],

                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "vertical",
                        shadeIntensity: 0.4,
                        gradientToColors: undefined,
                        inverseColors: false,
                        opacityFrom: 0.95,
                        opacityTo: 1,
                        stops: [0, 90, 100]
                    }
                },

                series: [{
                    name: 'Nilai Unsur',
                    data: elementScores.map(e => e.element_score),
                }],

                xaxis: {
                    categories: elementScores.map(e => e.element_name),
                    labels: {
                        style: {
                            fontSize: '12px',
                        }
                    }
                },

                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '55%',
                        distributed: true

                    }
                },

                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toFixed(0);
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' poin';
                        }
                    }
                },

                legend: {
                    show: false
                }

            };

            var elementChart = new ApexCharts(
                document.querySelector("#elementBarChart"),
                elementOptions
            );

            setTimeout(function() {
                elementChart.render();
            }, 1000)


            /// ===========================
            const genderData = @json(array_values($respondentGenderTotal));
            const genderLabels = @json(array_keys($respondentGenderTotal));

            var genderDonutOptions = {
                chart: {
                    type: 'donut',
                    height: 320,
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        }
                    }
                },

                series: genderData,

                labels: genderLabels,

                colors: [
                    '#673AB7', // Laki-laki (biru)
                    '#E58A00' // Perempuan (pink)
                ],

                legend: {
                    position: 'bottom',
                    fontSize: '14px'
                },

                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return opts.w.globals.series[opts.seriesIndex];
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' responden';
                        }
                    }
                },

                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '14px',
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 280
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var genderDonutChart = new ApexCharts(
                document.querySelector("#genderDonutChart"),
                genderDonutOptions
            );

            setTimeout(function() {
                genderDonutChart.render();
            }, 1000)


            /// ===========================
            const educationData = @json(array_values($respondentEducationTotal));
            const educationLabels = @json(array_keys($respondentEducationTotal));

            var educationDonutOptions = {
                chart: {
                    type: 'donut',
                    height: 320,
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        }
                    }
                },

                series: educationData,

                labels: educationLabels,

                colors: [
                    '#673AB7',
                    '#E58A00'
                ],

                legend: {
                    position: 'bottom',
                    fontSize: '14px'
                },

                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return opts.w.globals.series[opts.seriesIndex];
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' responden';
                        }
                    }
                },

                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '14px',
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 280
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var educationDonutChart = new ApexCharts(
                document.querySelector("#educationDonutChart"),
                educationDonutOptions
            );

            setTimeout(function() {
                educationDonutChart.render();
            }, 1000)

            /// ===========================
            const occupationData = @json(array_values($respondentOccupationTotal));
            const occupationLabels = @json(array_keys($respondentOccupationTotal));

            var occupationDonutOptions = {
                chart: {
                    type: 'donut',
                    height: 320,
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        }
                    }
                },

                series: occupationData,

                labels: occupationLabels,

                colors: [
                    '#673AB7',
                    '#E58A00'
                ],

                legend: {
                    position: 'bottom',
                    fontSize: '14px'
                },

                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return opts.w.globals.series[opts.seriesIndex];
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' responden';
                        }
                    }
                },

                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '14px',
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 280
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var occupationDonutChart = new ApexCharts(
                document.querySelector("#occupationDonutChart"),
                occupationDonutOptions
            );

            setTimeout(function() {
                occupationDonutChart.render();
            }, 1000)
        </script>
    @endpush

</x-layout.admin.app>
