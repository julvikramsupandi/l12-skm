<div class="modal fade" id="qrcodeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">{{ $serviceSelectedName }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body justify-content-center">
                <div class="bg-white p-3 border-radius text-center">
                    <div id="qrcode"></div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                @if ($serviceSelected != null)
                    <button type="button" class="btn btn-primary"
                        onclick="return copyToClipboard('{{ route('survey.form', [$skm->uuid, $serviceSelected]) }}')">
                        <i class="ph-duotone ph-copy"></i>
                        Salin tautan
                    </button>
                @else
                    <button type="button" class="btn btn-primary"
                        onclick="copyToClipboard('{{ route('survey.services', [$skm->uuid]) }}')">
                        <i class="ph-duotone ph-copy"></i>
                        Salin tautan
                    </button>
                @endif
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


@push('js')
    <script src="{{ asset('assets/admin/js/plugins/easy.qrcode.min.js') }}"></script>

    <script type="text/javascript">
        ///
        function copyToClipboard(text) {
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

        @if ($serviceSelected != null)
            var url = "{{ route('survey.form', [$skm->uuid, $serviceSelected]) }}";
        @else
            var url = "{{ route('survey.services', [$skm->uuid]) }}";
        @endif


        /// Options
        var options = {
            text: url,
            width: 276,
            height: 276,
            // logo: "../demo/logo.png", // Relative address, relative to `easy.qrcode.min.js`
            logo: "/assets/images/survei-logo.png",
            logoWidth: 64, // fixed logo width. default is `width/3.5`
            logoHeight: 64, // fixed logo height. default is `heigth/3.5`
            logoMaxWidth: undefined, // Maximum logo width. if set will ignore `logoWidth` value
            logoMaxHeight: undefined, // Maximum logo height. if set will ignore `logoHeight` value
            logoBackgroundColor: '#ffffff', // Logo backgroud color, Invalid when `logBgTransparent` is true; default is '#ffffff'
            logoBackgroundTransparent: true,
        };

        // Create QRCode Object
        new QRCode(document.getElementById("qrcode"), options);
    </script>
@endpush
