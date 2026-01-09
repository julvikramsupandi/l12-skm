<x-layout.admin.app title="Analisis Responden">

    <x-layout.admin.pageheader title="Analisis Responden" :breadcrumb="[['label' => 'Analisis Responden', 'url' => null]]" />

    @php

        $labelMonth = $monthSelected
            ? (is_numeric($monthSelected)
                ? \Carbon\Carbon::createFromDate(null, $monthSelected, 1)->locale('id')->translatedFormat('F')
                : periodLabel($monthSelected))
            : 'Semua Bulan';

        $label = $skmSelectedName . ' - ' . $serviceSelectedName . ' - Tahun ' . $yearSelected . ' - ' . $labelMonth;
    @endphp

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    @can('report.analytic-respondent')
                        <form action="{{ route('admin.report.analytic-respondents') }}" method="post">
                        @endcan

                        @can('report.analytic-respondent-by-unor')
                            <form action="{{ route('admin.report.analytic-respondents-by-unor') }}" method="post">
                            @endcan

                            @csrf
                            <div class="row g-2">
                                @cannot('report.analytic-respondent-by-unor')
                                    <div class="col-lg-12">
                                        <select name="skm" id="select-skm" class="choices"
                                            onchange="this.form.submit()">
                                            <option value="">- Provinsi Gorontalo -</option>
                                            @foreach ($skms as $item)
                                                <option {{ $skmSelected == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->unor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endcannot
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
                                                value="{{ $i }}">
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <select name="month" class="form-control">
                                        <optgroup label="Bulan">
                                            <option value="">- Semua Bulan -</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option {{ $monthSelected == $i ? 'selected' : '' }}
                                                    value="{{ $i }}">
                                                    {{ \Carbon\Carbon::createFromDate(null, $i, 1)->locale('id')->translatedFormat('F') }}
                                                </option>
                                            @endfor
                                        </optgroup>
                                        <optgroup label="Triwulan">
                                            @for ($i = 1; $i <= 4; $i++)
                                                <option {{ $monthSelected == 'TW' . $i ? 'selected' : '' }}
                                                    value="TW{{ $i }}">
                                                    {{ periodLabel('TW' . $i) }}
                                                </option>
                                            @endfor
                                        </optgroup>
                                        <optgroup label="Semester">
                                            @for ($i = 1; $i <= 2; $i++)
                                                <option {{ $monthSelected == 'S' . $i ? 'selected' : '' }}
                                                    value="S{{ $i }}">
                                                    {{ periodLabel('S' . $i) }}
                                                </option>
                                            @endfor
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-lg-3 d-flex justify-content-center align-items-center">
                                    <button class="btn btn-primary w-100 text-nowrap">
                                        <i class="ph-duotone ph-eye"></i> Proses
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between items-center">
                    <div>
                        <h5 class="mb-0">{{ $respondentTotal }} Responden</h5>
                        <span class="text-muted text-sm">
                            {{ $label }}
                        </span>
                    </div>

                    <div>

                        <button type="button" onclick="exportTableToExcel()" class="btn btn-success text-nowrap">
                            <i class="ph-duotone ph-file-xls"></i>
                            Download
                        </button>

                    </div>

                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered " id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>KARAKTERISTIK</th>
                                    <th>INDIKATOR</th>
                                    <th>JUMLAH</th>
                                    <th>PERSENTASE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    function percent($value, $total)
                                    {
                                        return $total > 0 ? round(($value / $total) * 100) : 0;
                                    }
                                @endphp


                                <tr>
                                    <td rowspan="2">1</td>
                                    <td rowspan="2">Jenis Kelamin</td>
                                    <td>Laki-Laki</td>
                                    <td>{{ $respondentGenderTotal['L'] ?? 0 }}</td>
                                    <td>{{ percent($respondentGenderTotal['L'] ?? 0, $respondentTotal) }}%</td>
                                </tr>
                                <tr>
                                    <td>Perempuan</td>
                                    <td>{{ $respondentGenderTotal['P'] ?? 0 }}</td>
                                    <td>{{ percent($respondentGenderTotal['P'] ?? 0, $respondentTotal) }}%</td>
                                </tr>


                                @php $no = 2; @endphp

                                @foreach ($educations as $index => $edu)
                                    <tr>
                                        @if ($index === 0)
                                            <td rowspan="{{ count($educations) }}">{{ $no }}
                                            </td>
                                            <td rowspan="{{ count($educations) }}">Pendidikan</td>
                                        @endif

                                        <td>{{ $edu }}</td>
                                        <td>{{ $respondentEducationTotal[$edu] ?? 0 }}</td>
                                        <td>{{ percent($respondentEducationTotal[$edu] ?? 0, $respondentTotal) }}%
                                        </td>
                                    </tr>
                                @endforeach

                                @php $no++; @endphp

                                @foreach ($occupations as $index => $job)
                                    <tr>
                                        @if ($index === 0)
                                            <td rowspan="{{ count($occupations) }}">{{ $no }}
                                            </td>
                                            <td rowspan="{{ count($occupations) }}">Pekerjaan</td>
                                        @endif

                                        <td>{{ $job }}</td>
                                        <td>{{ $respondentOccupationTotal[$job] ?? 0 }}</td>
                                        <td>{{ percent($respondentOccupationTotal[$job] ?? 0, $respondentTotal) }}%
                                        </td>
                                    </tr>
                                @endforeach

                                @php $no++; @endphp

                                <tr>
                                    <td rowspan="2">{{ $no }}</td>
                                    <td rowspan="2">Kategorisasi Penggunaan Layanan</td>
                                    <td>Disabilitas</td>
                                    <td>{{ $respondentDisabilityTotal[1] ?? 0 }}</td>
                                    <td>{{ percent($respondentDisabilityTotal[1] ?? 0, $respondentTotal) }}%</td>
                                </tr>
                                <tr>
                                    <td>Non Disabilitas</td>
                                    <td>{{ $respondentDisabilityTotal[0] ?? 0 }}</td>
                                    <td>{{ percent($respondentDisabilityTotal[0] ?? 0, $respondentTotal) }}%</td>
                                </tr>

                                @php $no++; @endphp


                                @foreach ($disabilityTypes as $index => $dis)
                                    <tr>
                                        @if ($index === 0)
                                            <td rowspan="{{ count($disabilityTypes) }}">{{ $no }}</td>
                                            <td rowspan="{{ count($disabilityTypes) }}">Kategorisasi Jenis
                                                Disabilitas
                                            </td>
                                        @endif

                                        <td>{{ $dis }}</td>
                                        <td>{{ $respondentDisabilityTypeTotal[$dis] ?? 0 }}</td>
                                        <td>{{ percent($respondentDisabilityTypeTotal[$dis] ?? 0, $respondentTotal) }}%
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('js')
        <script src="{{ asset('assets/admin/js/plugins/choices.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/xlsx.full.min.js') }}"></script>

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

                new Choices('#select-skm', {
                    searchEnabled: true,
                    shouldSort: false,
                    // placeholder: true,
                    // placeholderValue: 'Pilih Layanan',
                    // itemSelectText: '',
                    allowHTML: false,
                });



            });

            function exportTableToExcel() {
                // Get the table element by its ID
                var table = document.getElementById('data-table');

                // Convert the table to a worksheet using SheetJS utility
                var workbook = XLSX.utils.table_to_book(table, {
                    sheet: "Sheet JS"
                });

                // Write the workbook and trigger a download
                XLSX.writeFile(workbook, '{{ $label }}.xlsx');
            }
        </script>
    @endpush

</x-layout.admin.app>
