<x-layout.admin.app title="Indeks Kepuasan Masyarakat (OPD)">

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/style.css') }}" />
    @endpush

    <x-layout.admin.pageheader title="Indeks Kepuasan Masyarakat (OPD)" :breadcrumb="[['label' => 'Indeks Kepuasan Masyarakat (OPD)', 'url' => null]]" />

    <div class="row">
        <div class="col-md-12">
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
                                    <th>Unit Organisasi</th>
                                    <th>Telepon</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skm as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->unor->name }}</td>
                                        <td>{{ $item->unor->telephone }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                                                <a href="#" type="button" class="btn btn-outline-primary">
                                                    <i class="ph-duotone ph-eye mx-1"></i>
                                                    <span class="me-1">Lihat Detail</span>
                                                </a>
                                                <a href="{{ route('admin.service.index', $item->id) }}" type="button"
                                                    class="btn btn-outline-success">
                                                    <i class="ph-duotone ph-user-gear mx-1"></i>
                                                    <span class="me-1">Layanan</span>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="return copyToClipboard('{{ $item->uuid }}')"
                                                    type="button" class="btn btn-outline-info">
                                                    <i class="ph-duotone ph-link mx-1"></i>
                                                    <span class="me-1">Link</span>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $item->id }}" data-label="{{ $item->unor->name }}">
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


    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast align-items-center text-bg-success border-0" id="toastCopy" class="toast" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="ph-duotone ph-copy"></i>
                <strong class="me-auto mx-2">Link disalin ke clipboard</strong>
            </div>
            <div class="toast-body" id="toast-body">
            </div>
        </div>
    </div>

    @include('admin.skm.form')
    @include('admin.skm.delete')



    @push('js')
        <script type="module">
            import {
                DataTable
            } from '/assets/admin/js/plugins/module.js';
            window.dt = new DataTable('#dataTable');


            window.copyToClipboard = function(text) {
                const toastId = document.getElementById('toastCopy');

                const route = '{{ route('survey.services', '__uuid__') }}';
                const textArea = document.createElement("textarea");

                const textValue = route.replace('__uuid__', text);
                textArea.value = textValue;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand("copy");
                document.body.removeChild(textArea);

                const toastBody = document.getElementById('toast-body');
                toastBody.textContent = textValue;

                const toast = new bootstrap.Toast(toastId);
                toast.show();
            }
        </script>
    @endpush

</x-layout.admin.app>
