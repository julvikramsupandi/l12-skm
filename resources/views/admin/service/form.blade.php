<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="form" class="modal-content" method="post"
                data-store="{{ route('admin.service.store', $skm->id) }}"
                data-update="{{ route('admin.service.update', [$skm->id, '__id__']) }}">

                @csrf
                <input type="hidden" name="_method" id="method">
                <input type="hidden" name="id" id="id">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan Nama Layanan" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Masukkan Deskripsi Layanan" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipe</label>
                        <select class="form-select" id="serviceChannel" name="service_channel" required>
                            <option value="ONLINE">ONLINE</option>
                            <option value="OFFLINE">OFFLINE</option>
                            <option value="HYBRID">HYBRID</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="isActive" name="is_active" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
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

            const data = button.getAttribute('data-bs-service');

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
                    description,
                    service_channel,
                    is_active,
                } = JSON.parse(data);

                document.getElementById('modalTitle').innerText = 'Edit Data';

                document.getElementById('id').value = id;
                document.getElementById('name').value = name;
                document.getElementById('description').value = description;
                document.getElementById('serviceChannel').value = service_channel;
                document.getElementById('isActive').value = is_active;

                document.getElementById('method').value = 'PUT';
                form.action = form.dataset.update.replace('__id__', id);

            }
        });
    </script>
@endpush
