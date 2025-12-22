<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body { font-family: 'Press Start 2P', cursive; }
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: #1f1f1f; }
            ::-webkit-scrollbar-thumb { background: #4a4646; }
        </style>
    </head>
    <body class="min-h-screen bg-[#2b2b2b] text-white antialiased font-['Press_Start_2P']">
    <div class="flex min-h-screen">
        @include('layouts.navigation')

        <main class="flex-1 w-full flex flex-col overflow-x-hidden px-4 py-8 sm:p-10">
            @isset($header)
                <div class="mb-8">
                    {{ $header }}
                </div>
            @endisset

            <div class="flex-1 flex flex-col items-center justify-center">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>