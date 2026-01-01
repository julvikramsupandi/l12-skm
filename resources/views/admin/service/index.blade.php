<x-layout.admin.app title="Layanan">

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/style.css') }}" />
    @endpush

    <x-layout.admin.pageheader title="Layanan" :breadcrumb="[
        ['label' => $skm->unor->name, 'url' => route('admin.skm.index')],
        ['label' => 'Layanan', 'url' => null],
    ]" />

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
                                    <th>Layanan</th>
                                    <th>Deskripsi</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td class="text-center">
                                            @if ($item->service_channel == 'OFFLINE')
                                                <span class="badge text-bg-secondary">
                                                    {{ $item->service_channel }}
                                                </span>
                                            @elseif($item->service_channel == 'ONLINE')
                                                <span class="badge text-bg-success">
                                                    {{ $item->service_channel }}
                                                </span>
                                            @else
                                                <span class="badge text-bg-primary">
                                                    {{ $item->service_channel }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="{{ $item->is_active ? 'badge text-bg-success' : 'badge text-bg-danger' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-toggle="modal" data-bs-target="#formModal"
                                                    data-bs-service="{{ json_encode($item) }}">
                                                    <i class="ph-duotone ph-pencil-line mx-1"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-id="{{ $item->id }}" data-label="{{ $item->name }}">
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

    @include('admin.service.form')
    @include('admin.service.delete')

    @push('js')
        <script type="module">
            import {
                DataTable
            } from '/admin/js/plugins/module.js';
            window.dt = new DataTable('#dataTable');
        </script>
    @endpush

</x-layout.admin.app>
