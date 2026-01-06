<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="form" class="modal-content" method="post" data-store="{{ route('admin.user.store') }}"
                data-update="{{ route('admin.user.update', '__id__') }}">

                @csrf
                <input type="hidden" name="_method" id="method">
                <input type="hidden" name="id" id="id">


                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Peran (Role)</label>
                        <select name="role" id="role" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama User</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
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

            const data = button.getAttribute('data-bs-user');

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
                    email,
                } = JSON.parse(data);

                const dataRole = button.getAttribute('data-bs-role');
                const role = JSON.parse(dataRole);

                document.getElementById('modalTitle').innerText = 'Edit Data';

                document.getElementById('id').value = id;
                document.getElementById('name').value = name;
                document.getElementById('email').value = email;
                document.getElementById('role').value = role;

                document.getElementById('method').value = 'PUT';
                form.action = form.dataset.update.replace('__id__', id);

            }
        });
    </script>
@endpush
