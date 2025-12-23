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

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#4F46E5">
    <link rel="apple-touch-icon" href="{{ asset('icons/icon-192.png') }}">

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
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .then(reg => console.log('SW registered:', reg))
                .catch(err => console.log('SW registration failed:', err));
            });
        }
    </script>
</body>
</html>