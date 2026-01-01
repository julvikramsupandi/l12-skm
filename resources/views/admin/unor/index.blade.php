<x-layout.admin.app title="Unit Organisasi">

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/style.css') }}" />
    @endpush

    <x-layout.admin.pageheader title="Unit Organisasi" :breadcrumb="[['label' => 'Unit Organisasi', 'url' => null]]" />

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
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unors as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->telephone }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-toggle="modal" data-bs-target="#formModal"
                                                    data-bs-unor="{{ json_encode($item) }}">
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

    @include('admin.unor.form')
    @include('admin.unor.delete')

    @push('js')
        <script type="module">
            import {
                DataTable
            } from '/admin/js/plugins/module.js';
            window.dt = new DataTable('#dataTable');
        </script>
    @endpush

</x-layout.admin.app>
