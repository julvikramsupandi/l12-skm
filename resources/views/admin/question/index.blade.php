<x-layout.admin.app title="Pertanyaan">

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/style.css') }}" />
    @endpush

    <x-layout.admin.pageheader title="Pertanyaan" :breadcrumb="[['label' => 'Pertanyaan', 'url' => null]]" />

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#formModal">
                        <i class="ph-duotone ph-plus-circle"></i>
                        Tambah
                    </button>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Unsur</th>
                                    <th>Jenis Opsi</th>
                                    <th>Pertanyaan</th>
                                    <th>Tipe</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $item->question_code }}</td>
                                        <td>{{ $item->element->name }}</td>
                                        <td>{{ $item->optionScale->code }}</td>
                                        <td>{{ $item->question_text }}</td>
                                        <td class="text-center">
                                            @if ($item->service_channel == 'OFFLINE')
                                                <span
                                                    class="badge text-bg-secondary">{{ $item->service_channel }}</span>
                                            @elseif($item->service_channel == 'ONLINE')
                                                <span class="badge text-bg-success">{{ $item->service_channel }}</span>
                                            @else
                                                <span class="badge text-bg-primary">{{ $item->service_channel }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-toggle="modal" data-bs-target="#formModal"
                                                    data-bs-question="{{ json_encode($item) }}">
                                                    <i class="ph-duotone ph-pencil-line mx-1"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $item->id }}"
                                                    data-label="{{ $item->question_text }}">
                                                    <i class="ph-duotone ph-trash mx-1"></i>
                                                </button>
                                            </div>
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

    @include('admin.question.form')
    @include('admin.question.delete')

    @push('js')
        <script type="module">
            import {
                DataTable
            } from '/admin/js/plugins/module.js';
            window.dt = new DataTable('#dataTable');
        </script>
    @endpush

</x-layout.admin.app>
