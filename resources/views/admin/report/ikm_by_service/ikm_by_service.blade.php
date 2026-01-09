<x-layout.admin.app title="IKM Per Layanan">

    <x-layout.admin.pageheader title="IKM Per Layanan" :breadcrumb="[['label' => 'IKM Per Layanan', 'url' => null]]" />

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
                    <form
                        action="{{ auth()->user()->can('report.ikm-by-service')
                            ? route('admin.report.ikm-by-service')
                            : route('admin.report.ikm-by-service-by-unor') }}"
                        method="post">

                        @csrf
                        <div class="row g-2">
                            @cannot('report.ikm-by-service-by-unor')
                                <div class="col-lg-12">
                                    <select name="skm" id="select-skm" class="choices">
                                        <option value="">- Provinsi Gorontalo -</option>
                                        @foreach ($skms as $item)
                                            <option {{ $skmSelected == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->unor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endcannot
                            <div class="col-lg-4">
                                <select name="year" class="form-control">
                                    @for ($i = date('Y'); $i >= 2022; $i--)
                                        <option {{ $yearSelected == $i ? 'selected' : '' }} value="{{ $i }}">
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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between items-center">
                    <div>
                        <h5 class="mb-0">Indeks Kepuasan Masyarakat Per Layanan</h5>
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
                        <table class="table table-bordered" id="data-table">
                            <thead>
                                <th>NO</th>
                                <th>JENIS LAYANAN</th>
                                <th>JUMLAH RESPONDEN</th>

                                @foreach ($elements as $e)
                                    <th>{{ $e->name }}</th>
                                @endforeach

                                <th>IKM</th>
                            </thead>
                            <tbody>
                                @foreach ($dataByService as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['service_name'] }}</td>
                                        <td class="text-center">
                                            {{ $respondentByService[$item['service_id']] ?? 0 }}
                                        </td>

                                        @foreach ($elements as $e)
                                            <td class="text-center">
                                                {{ $item['elements'][$e->code]['element_score'] ?? 0 }}
                                            </td>
                                        @endforeach

                                        <td class="text-center">{{ $item['ikm_total'] }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="3">Rerata IKM Per Unsur</td>
                                    @foreach ($elements as $ea)
                                        <td class="text-center">
                                            {{ $elementScoresAvg[$ea->code]['element_score'] ?? 0 }}
                                        </td>
                                    @endforeach
                                    <td class="text-center fw-bold">{{ $scoreTotalAvg }}</td>
                                </tr>

                                <tr>
                                    <td colspan="3">IKM Unit Layanan</td>
                                    <td colspan="{{ count($elements) + 1 }}" class="text-center fw-bold">
                                        {{ $scoreTotalAvg }}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">Mutu Unit Layanan</td>
                                    <td colspan="{{ count($elements) + 1 }}" class="text-center fw-bold">
                                        {{ $ikmQualityValue }} ({{ $ikmQualityLabel }})
                                    </td>
                                </tr>
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
