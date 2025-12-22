<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet" />

<aside class="w-72 bg-[#1f1f1f] border-r border-gray-600 p-6 flex flex-col justify-between min-h-screen font-['Press_Start_2P'] text-white">
    <div>
        <div class="mb-10 pt-4">
            <p class="text-[10px] leading-loose text-gray-300">
                Hai {{ Auth::user()->name }},<br />
                Selamat<br />
                Menjelajahi<br />
                Waktu
            </p>
        </div>

        <a href="{{ route('dashboard') }}" 
           class="block w-full mb-8 border {{ request()->routeIs('dashboard') ? 'border-white bg-gray-700' : 'border-gray-400' }} py-3 text-center text-[10px] hover:bg-gray-800 transition">
            DASHBOARD
        </a>

        <div class="space-y-6">
            <p class="text-[10px] text-gray-500 uppercase tracking-widest">Tools</p>

            <a href="{{ route('capsules.create') }}" 
               class="w-full border border-gray-400 py-3 flex items-center justify-center gap-2 text-[10px] hover:bg-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                BUAT CAPSULE
            </a>

            <a href="{{ route('capsules.edit-mode') }}" 
               class="w-full flex items-center justify-center gap-2 text-gray-400 text-[10px] hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                EDIT CAPSULE
            </a>

            <a href="{{ route('capsules.delete-mode') }}" 
               class="w-full flex items-center justify-center gap-2 text-red-500 text-[10px] hover:text-red-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                HAPUS CAPSULE
            </a>
        </div>
    </div>

    <div class="border-t border-gray-700 pt-6 space-y-4">
        <a href="{{ route('profile.edit') }}" class="block text-[10px] text-gray-400 hover:text-white">
            PROFILE
        </a>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left text-[10px] text-red-700 hover:text-red-500 uppercase">
                LOG OUT _
            </button>
        </form>
    </div>
</aside>