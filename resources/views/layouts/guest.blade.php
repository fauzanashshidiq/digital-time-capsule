<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet" />

    <script>
        // Konfigurasi tambahan agar variabel warna cyan-300 terbaca oleh CDN
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cyan: {
                            300: 'oklch(86.5% 0.127 207.078)',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-br from-[#0f2027] via-[#203a43] to-[#2c5364]">
        {{ $slot }}
    </div>
</body>

</html>