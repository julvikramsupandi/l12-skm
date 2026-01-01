@props([
    'title' => null,
])


<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>

    <title>{{ $title ? "$title | " : '' }}{{ config('app.name') }}</title>

    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Survei Kepuasan Masyarakat (SKM) adalah kegiatan pengukuran berkala untuk menilai tingkat kepuasan masyarakat terhadap kualitas pelayanan publik berdasarkan perbandingan antara harapan dan kenyataan pelayanan." />
    <meta name="keywords" content="SKM, Survei Kepuasan Masyarakat, Survei, Kepuasan, Masyarakat" />
    <meta name="author" content="Julvikram Supandi" />


    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('/assets/images/favicon.png') }}" type="image/x-icon" />
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('assets/admin/fonts/inter/inter.css') }}" id="main-font-link" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ asset('assets/admin/fonts/phosphor/duotone/style.css') }}" />
    <!-- [Tabler Icons] https://tablericons.com -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/fonts/tabler-icons.min.css') }}" /> --}}
    <!-- [Feather Icons] https://feathericons.com -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/fonts/feather.css') }}" /> --}}
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/fonts/fontawesome.css') }}" /> --}}
    <!-- [Material Icons] https://fonts.google.com/icons -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/fonts/material.css') }}" /> --}}
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style-preset.css') }}" />

    @stack('css')

</head>

<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-3" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
    data-pc-theme_contrast="" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <x-layout.admin.sidebar />
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    <x-layout.admin.header />
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            {{ $slot }}
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- [ Footer ] start -->
    <x-layout.admin.footer />
    <!-- [ Footer ] end -->

    @if (session('toast'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast align-items-center 
            {{ session('toast.type') == 'success' ? 'text-bg-success' : 'text-bg-danger' }} border-0"
                id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    {!! session('toast.type') == 'success'
                        ? '<i class="ph-duotone ph-seal-check"></i>'
                        : '<i class="ph-duotone ph-info"></i>' !!}
                    <strong class="me-auto mx-2">{{ session('toast.title') }}</strong>
                </div>
                <div class="toast-body">
                    {{ session('toast.message') }}
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                var toast = new bootstrap.Toast(document.getElementById('toast'));
                toast.show();
            });
        </script>
    @endif


    <!-- Required Js -->
    <script src="{{ asset('assets/admin/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/feather.min.js') }}"></script>
    {{-- <div class="floting-button">
        <a href="https://1.envato.market/zNkqj6"
            class="btn btn btn-danger buynowlinks d-inline-flex align-items-center gap-2" data-bs-toggle="tooltip"
            title="Buy Now">
            <i class="ph-duotone ph-shopping-cart"></i>
            <span>Buy Now</span>

        </a>
    </div> --}}

    {{-- <script>
        layout_change('light');
    </script>

    <script>
        change_box_container('false');
    </script>

    <script>
        layout_caption_change('true');
    </script>

    <script>
        layout_rtl_change('false');
    </script>

    <script>
        preset_change('preset-3');
    </script>

    <script>
        main_layout_change('vertical');
    </script> --}}



    @stack('js');

</body>
<!-- [Body] end -->

</html>
