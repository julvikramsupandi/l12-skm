<x-layout.admin.app title="Opsi Jawaban">

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/style.css') }}" />
    @endpush

    <x-layout.admin.pageheader title="Opsi Jawaban" :breadcrumb="[['label' => 'Opsi Jawaban', 'url' => null]]" />

    <div class="row">
        <div class="col-xl-6">
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
                                    <th>Jenis Opsi</th>
                                    <th>Label</th>
                                    <th>Nilai</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($answerOptions as $answerOption)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $answerOption->optionScale->code }}</td>
                                        <td>{{ $answerOption->label }}</td>
                                        <td>{{ $answerOption->score }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-toggle="modal" data-bs-target="#formModal"
                                                    data-bs-answer-option="{{ json_encode($answerOption) }}">
                                                    <i class="ph-duotone ph-pencil-line mx-1"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $answerOption->id }}"
                                                    data-label="{{ $answerOption->label }}">
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

    @include('admin.answer_option.form')
    @include('admin.answer_option.delete')

    @push('js')
        <script type="module">
            import {
                DataTable
            } from '/assets/admin/js/plugins/module.js';
            window.dt = new DataTable('#dataTable');
        </script>
    @endpush

</x-layout.admin.app>
