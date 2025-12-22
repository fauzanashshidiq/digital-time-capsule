<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet" />

<aside class="hidden sm:flex w-72 bg-[#1f1f1f] border-r border-gray-600 p-6 flex-col justify-between min-h-screen font-['Press_Start_2P'] text-white shrink-0">
    <div>
        <div class="mb-10 pt-4 text-center">
            <p class="text-sm leading-loose">
                Hai {{ Auth::user()->name }},<br />
                Selamat Menjelajahi Waktu
            </p>
        </div>

        <a href="{{ route('dashboard') }}" 
           class="block w-full mb-8 border {{ request()->routeIs('dashboard') ? 'border-white bg-gray-700' : 'border-gray-400' }} py-4 text-center text-[10px] hover:bg-gray-800 transition">
            DASHBOARD
        </a>

        <div class="space-y-6">
            <div class="pt-4 text-center">
                <p class="text-sm leading-loose uppercase">Tools</p>
            </div>

            <a href="{{ route('capsules.create') }}" 
            class="w-full py-3 flex flex-col items-center justify-center gap-3 text-[10px] transition border {{ request()->routeIs('capsules.create') ? 'border-white bg-gray-700 text-white' : 'border-transparent text-gray-400 hover:bg-gray-800' }}">
                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                <span>BUAT CAPSULE</span>
            </a>

            <a href="{{ route('capsules.edit-mode') }}" 
            class="w-full py-3 flex flex-col items-center justify-center gap-3 text-[10px] transition border {{ request()->routeIs('capsules.edit-mode') ? 'border-white bg-gray-700 text-white' : 'border-transparent text-gray-400 hover:bg-gray-800' }}">
                <i data-lucide="pencil" class="w-5 h-5"></i>
                <span>EDIT CAPSULE</span>
            </a>

            <a href="{{ route('capsules.delete-mode') }}" 
            class="w-full py-3 flex flex-col items-center justify-center gap-3 text-[10px] transition border {{ request()->routeIs('capsules.delete-mode') ? 'border-red-500 bg-red-900/20 text-red-500' : 'border-transparent text-red-500 hover:bg-gray-800' }}">
                <i data-lucide="trash-2" class="w-5 h-5"></i>
                <span>HAPUS CAPSULE</span>
            </a>
        </div>
    </div>

    <div class="sticky bottom-0 bg-[#1f1f1f] border-t border-gray-700 p-6 space-y-4">
        <a href="{{ route('profile.edit') }}" 
            class="block text-[10px] text-gray-400 hover:text-white">
            PROFILE
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full text-left text-[10px] text-red-700 hover:text-red-500 uppercase">
                LOG OUT
            </button>
        </form>
    </div>
</aside>