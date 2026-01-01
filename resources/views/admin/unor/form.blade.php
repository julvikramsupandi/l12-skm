<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="form" class="modal-content" method="post" data-store="{{ route('admin.unor.store') }}"
                data-update="{{ route('admin.unor.update', '__id__') }}">

                @csrf
                <input type="hidden" name="_method" id="method">
                <input type="hidden" name="id" id="id">


                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Unit Organisasi</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telephone" name="telephone">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Faksimili</label>
                        <input type="text" class="form-control" id="fax" name="fax">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea type="text" class="form-control" id="address" name="address"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ph-duotone ph-x-circle"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="ph-duotone ph-floppy-disk"></i>
                        Simpan
                    </button>
                </div>

            </form>


        </div>
    </div>
</div>


@push('js')
    <script>
        const modal = document.getElementById('formModal');

        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const form = modal.querySelector('#form');

            // reset form
            form.reset();
            document.getElementById('method').value = '';
            document.getElementById('id').value = '';

            const data = button.getAttribute('data-bs-unor');

            if (!data) {

                // ===== CREATE MODE =====
                document.getElementById('modalTitle').innerText = 'Tambah Data';
                form.action = form.dataset.store;
                document.getElementById('method').value = 'POST';


            } else {

                // ===== UPDATE MODE =====
                const {
                    id,
                    name,
                    address,
                    telephone,
                    fax,
                } = JSON.parse(data);

                document.getElementById('modalTitle').innerText = 'Edit Data';

                document.getElementById('id').value = id;
                document.getElementById('name').value = name;
                document.getElementById('address').value = address;
                document.getElementById('telephone').value = telephone;
                document.getElementById('fax').value = fax;

                document.getElementById('method').value = 'PUT';
                form.action = form.dataset.update.replace('__id__', id);

            }
        });
    </script>
@endpush
