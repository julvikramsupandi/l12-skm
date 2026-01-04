<x-layout.admin.app title="Indeks Kepuasan Masyarakat (OPD)">

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/style.css') }}" />
    @endpush

    <x-layout.admin.pageheader title="Indeks Kepuasan Masyarakat (OPD)" :breadcrumb="[['label' => 'Indeks Kepuasan Masyarakat (OPD)', 'url' => null]]" />

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                    <div class="col-xl-6">
                        <form id="form" class="modal-content" method="post"
                            action="{{ route('admin.skm.store') }}">
                            @csrf

                            <div class="btn-group btn-group-sm w-100" role="group">
                                <div class="mb-1"
                                    style="background-color: #2CA87F;  border-top-left-radius: 20px;  border-bottom-left-radius: 20px; width: 100% !important;">

                                    <select class="choices" id="unorId" name="unor_id">
                                        <option value="">Pilih Unit Organisasi</option>
                                        @foreach ($unors as $unor)
                                            <option value="{{ $unor->id }}">{{ $unor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success mb-1 px-4 text-nowrap"
                                    class="btn btn-primary">
                                    <i class="ph-duotone ph-plus-circle"></i>
                                    Tambah
                                </button>
                            </div>

                        </form>
                    </div>
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
                                                <a href="{{ route('admin.skm.show', $item->id) }}" type="button"
                                                    class="btn btn-outline-primary">
                                                    <i class="ph-duotone ph-eye mx-1"></i>
                                                    <span class="me-1">Lihat Detail</span>
                                                </a>
                                                <a href="{{ route('admin.service.index', $item->id) }}" type="button"
                                                    class="btn btn-outline-success">
                                                    <i class="ph-duotone ph-user-gear mx-1"></i>
                                                    <span class="me-1">Layanan</span>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="copyToClipboard('{{ route('survey.services', $item->uuid) }}')"
                                                    type="button" class="btn btn-outline-info">
                                                    <i class="ph-duotone ph-link mx-1"></i>
                                                    <span class="me-1">Tautan</span>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $item->id }}"
                                                    data-label="{{ $item->unor->name }}">
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
                <strong class="me-auto mx-2">Tautan disalin ke clipboard</strong>
            </div>
            <div class="toast-body" id="toast-body">
            </div>
        </div>
    </div>

    @include('admin.skm.delete')

    @push('js')
        <script src="{{ asset('assets/admin/js/plugins/choices.min.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Choices('#unorId', {
                    searchEnabled: true,
                    shouldSort: false,
                    // placeholder: true,
                    // placeholderValue: 'Pilih Layanan',
                    // itemSelectText: '',
                    allowHTML: false,
                });
            });
        </script>


        <script type="module">
            import {
                DataTable
            } from '/assets/admin/js/plugins/module.js';
            window.dt = new DataTable('#dataTable');


            window.copyToClipboard = function(text) {
                const toastId = document.getElementById('toastCopy');
                const toastBody = document.getElementById('toast-body');

                navigator.clipboard.writeText(text)
                    .then(() => {
                        toastBody.textContent = text;

                        const toast = new bootstrap.Toast(toastId);
                        toast.show();
                    })
                    .catch(err => {
                        console.error('Gagal menyalin teks: ', err);
                    });
            }
        </script>
    @endpush

</x-layout.admin.app>
