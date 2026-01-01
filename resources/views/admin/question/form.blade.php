<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="form" class="modal-content" method="post" data-store="{{ route('admin.question.store') }}"
                data-update="{{ route('admin.question.update', '__id__') }}">

                @csrf
                <input type="hidden" name="_method" id="method">
                <input type="hidden" name="id" id="id">


                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Unsur</label>
                        <select name="element_id" id="elementId" class="form-control">
                            @foreach ($elements as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->code }} - {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Opsi</label>
                        <select name="option_scale_id" id="optionScaleId" class="form-control">
                            @foreach ($optionScales as $optionScale)
                                <option value="{{ $optionScale->id }}">
                                    {{ $optionScale->code }} - {{ $optionScale->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Tipe</label>
                        <select name="service_channel" id="serviceChannel" class="form-control">
                            <option value="OFFLINE">OFFLINE</option>
                            <option value="ONLINE">ONLINE</option>
                            <option value="HYBRID">HYBRID</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" class="form-control" id="questionCode" name="question_code">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pertnyaan</label>
                        <textarea type="text" class="form-control" id="questionText" name="question_text"></textarea>
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

            const data = button.getAttribute('data-bs-question');

            if (!data) {

                // ===== CREATE MODE =====
                document.getElementById('modalTitle').innerText = 'Tambah Data';
                form.action = form.dataset.store;
                document.getElementById('method').value = 'POST';


            } else {

                // ===== UPDATE MODE =====
                const {
                    id,
                    element_id,
                    option_scale_id,
                    service_channel,
                    question_code,
                    question_text,
                } = JSON.parse(data);

                document.getElementById('modalTitle').innerText = 'Edit Data';

                document.getElementById('id').value = id;
                document.getElementById('elementId').value = element_id;
                document.getElementById('optionScaleId').value = option_scale_id;
                document.getElementById('questionCode').value = question_code;
                document.getElementById('questionText').value = question_text;
                document.getElementById('serviceChannel').value = service_channel;

                document.getElementById('method').value = 'PUT';
                form.action = form.dataset.update.replace('__id__', id);

            }
        });
    </script>
@endpush
