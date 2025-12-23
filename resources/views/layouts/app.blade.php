<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <link rel="icon" href="{{ asset('favicon.ico') }}?v=1" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=1" type="image/x-icon">
        <meta name="theme-color" content="#4F46E5">
        <link rel="apple-touch-icon" href="{{ asset('icons/icon-192.png') }}">

        <style>
            body { font-family: 'Press Start 2P', cursive; }
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: #1f1f1f; }
            ::-webkit-scrollbar-thumb { background: #4a4646; }
            .capsule-active {
                box-shadow: 0 0 12px rgba(255,255,255,0.15);
            }
            .ql-editor.ql-blank::before {
                font-family: 'Press Start 2P', monospace;
                font-size: 10px;
                color: #9ca3af;
                opacity: 0.8;
                left: 16px;
            }
            .ql-editor {
                font-family: 'Press Start 2P', monospace;
                font-size: 11px;
                line-height: 1.8;
            }
        </style>
    </head>
    <body class="min-h-screen bg-[#2b2b2b] text-white antialiased font-['Press_Start_2P']">
    <div class="flex min-h-screen">
        @include('layouts.navigation')

        <main class="flex-1 w-full flex flex-col overflow-x-hidden px-4 py-8 sm:p-10">
            <!-- MOBILE TOP BAR -->
            <div class="flex sm:hidden justify-between items-center mb-4">
    <a
        href="{{ route('dashboard') }}"
        class="border border-gray-500 px-3 py-2 bg-[#1f1f1f] text-xs hover:bg-gray-800"
    >
        DASHBOARD
    </a>

    <div class="relative" x-data="{ open: false }">
        <button
            @click="open = !open"
            class="border border-gray-500 px-3 py-2 bg-[#1f1f1f] text-xs flex items-center gap-1"
        >
            {{ auth()->user()->name }}
            <span :class="open ? 'rotate-180' : ''" class="transition-transform">▼</span>
        </button>

        <div
            x-show="open"
            @click.outside="open = false"
            x-transition
            class="absolute right-0 mt-2 w-40 bg-[#1f1f1f] border border-gray-500 text-xs z-50"
            style="display: none;"
        >
            <a
                href="{{ route('profile.edit') }}"
                class="block px-4 py-2 hover:bg-gray-800"
            >
                PROFILE
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="w-full text-left px-4 py-2 text-red-400 hover:bg-gray-800"
                >
                    LOGOUT
                </button>
            </form>
        </div>
    </div>
</div>

            @isset($header)
                <div class="mb-8">
                    {{ $header }}
                </div>
            @endisset

            <div class="flex-1 w-full">
                <div class="mb-3 text-center">
                    <p class="text-sm sm:text-2xl leading-loose mb-2">
                        Digital Time Capsule
                    </p>
                </div>
                {{ $slot }}
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
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