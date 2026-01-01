<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="form" class="modal-content" method="post" data-store="{{ route('admin.skm.store') }}"
                data-update="{{ route('admin.skm.update', '__id__') }}">

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
                        <select class="form-select" id="unorId" name="unor_id">
                            <option value="">Pilih Unit Organisasi</option>
                            @foreach ($unors as $unor)
                                <option value="{{ $unor->id }}">{{ $unor->name }}</option>
                            @endforeach
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

            const data = button.getAttribute('data-bs-skm');

            if (!data) {

                // ===== CREATE MODE =====
                document.getElementById('modalTitle').innerText = 'Tambah Data';
                form.action = form.dataset.store;
                document.getElementById('method').value = 'POST';


            } else {

                // ===== UPDATE MODE =====
                const {
                    id,
                    unor_id,
                } = JSON.parse(data);

                document.getElementById('modalTitle').innerText = 'Edit Data';

                document.getElementById('id').value = id;
                document.getElementById('unorId').value = unor_id;

                document.getElementById('method').value = 'PUT';
                form.action = form.dataset.update.replace('__id__', id);

            }
        });
    </script>
@endpush
