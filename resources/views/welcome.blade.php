<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Digital Time Capsule</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet" />
</head>

<body
    class="min-h-screen bg-gradient-to-br from-[#0f2027] via-[#203a43] to-[#2c5364] flex items-center justify-center text-white font-['Press_Start_2P']">
    <div class="flex flex-col items-center">

        <h1 class="text-xl md:text-2xl tracking-widest text-center mb-1 drop-shadow-[0_0_12px_rgba(0,255,255,0.6)]">
            DIGITAL TIME CAPSULE
        </h1>

        <img src="{{ asset('img/ikonutama.png') }}" alt="Icon Utama" class="w-64 md:w-80 lg:w-96 object-contain mb-1" />

        @if (Route::has('login'))
            @auth
                {{-- Jika sudah login, ke dashboard --}}
                <a href="{{ url('/dashboard') }}"
                    class="inline-block px-8 py-4 rounded-lg tracking-widest text-white bg-gradient-to-br from-[#0f2027] via-[#203a43] to-[#2c5364] border-2 border-cyan-300 hover:from-[#2c5364] hover:via-[#203a43] hover:to-[#0f2027] transition duration-300 text-center">
                    MULAI
                </a>
            @else
                {{-- Jika belum login, ke login --}}
                <a href="{{ route('login') }}"
                    class="inline-block px-8 py-4 rounded-lg tracking-widest text-white bg-gradient-to-br from-[#0f2027] via-[#203a43] to-[#2c5364] border-2 border-cyan-300 hover:from-[#2c5364] hover:via-[#203a43] hover:to-[#0f2027] transition duration-300 text-center">
                    MULAI
                </a>
            @endauth
        @endif

    </div>
</body>

</html>