<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" class="modal-content" id="deleteForm"
                data-action="{{ route('admin.service.destroy', [$skm->id, '__id__']) }}">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <p class="mb-0">
                        Yakin ingin menghapus
                        <strong id="deleteName"></strong>?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ph-duotone ph-x-circle"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="ph-duotone ph-trash"></i>
                        Hapus
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        const deleteModal = document.getElementById('deleteModal');

        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-label');

            const form = deleteModal.querySelector('#deleteForm');

            document.getElementById('deleteName').innerText = name;
            form.action = form.dataset.action.replace('__id__', id);
        });
    </script>
@endpush
