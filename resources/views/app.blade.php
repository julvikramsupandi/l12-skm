<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Survei Kepuasan Masyarakat (SKM) adalah kegiatan pengukuran berkala untuk menilai tingkat kepuasan masyarakat terhadap kualitas pelayanan publik berdasarkan perbandingan antara harapan dan kenyataan pelayanan." />
    <meta name="keywords" content="SKM, Survei Kepuasan Masyarakat, Survei, Kepuasan, Masyarakat" />
    <meta name="author" content="Julvikram Supandi" />

    <link rel="icon" href="{{ asset('/assets/images/favicon.png') }}" type="image/x-icon" />

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.tsx', "resources/js/Pages/{$page['component']}.tsx"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
