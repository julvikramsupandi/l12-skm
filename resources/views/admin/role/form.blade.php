<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="form" class="modal-content" method="post" data-store="{{ route('admin.role.store') }}"
                data-update="{{ route('admin.role.update', '__id__') }}">

                @csrf
                <input type="hidden" name="_method" id="method">
                <input type="hidden" name="id" id="id">


                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Peran (Role)</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Contoh : SuperAdmin">
                        <span class="text-primary text-sm">
                            Rekomendasi nama role menggunakan PascalCase
                            agar lebih mudah dibaca dan dipahami.
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permission</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" class="form-check-input"
                                            value="{{ $permission->name }}" id="{{ $permission->name }}">
                                        <label class="form-check-label" for="{{ $permission->name }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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

            // ===== RESET FORM =====
            form.reset();
            document.getElementById('method').value = '';
            document.getElementById('id').value = '';

            // uncheck semua permission
            document.querySelectorAll('input[name="permissions[]"]').forEach(cb => {
                cb.checked = false;
            });

            const data = button.getAttribute('data-bs-role');

            // ================= CREATE =================
            if (!data) {
                document.getElementById('modalTitle').innerText = 'Tambah Role';
                form.action = form.dataset.store;
                document.getElementById('method').value = 'POST';
                return;
            }

            // ================= UPDATE =================
            const role = JSON.parse(data);

            document.getElementById('modalTitle').innerText = 'Edit Role';
            document.getElementById('id').value = role.id;
            document.getElementById('name').value = role.name;

            // centang permission milik role
            if (role.permissions) {
                role.permissions.forEach(function(perm) {

                    const checkbox = document.querySelector(
                        `input[name="permissions[]"][value="${perm.name}"]`
                    );
                    if (checkbox) checkbox.checked = true;
                });
            }

            document.getElementById('method').value = 'PUT';
            form.action = form.dataset.update.replace('__id__', role.id);
        });
    </script>
@endpush
