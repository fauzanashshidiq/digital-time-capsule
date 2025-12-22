<x-guest-layout>
    <div class="flex min-h-screen font-['Press_Start_2P']">

        <div class="hidden md:flex w-2/3 flex-col items-center justify-center p-10 text-center">
            <h1 class="text-2xl tracking-widest mb-4 drop-shadow-[0_0_12px_rgba(0,255,255,0.6)] text-white">
                DIGITAL TIME CAPSULE
            </h1>

            <img src="{{ asset('img/ikonutama.png') }}" alt="Icon Utama" class="w-96 object-contain" />
        </div>

        <div
            class="w-full md:w-1/3 bg-black/40 backdrop-blur-md flex items-center justify-center border-l border-cyan-900/50">
            <div class="w-full max-w-sm px-8 text-center text-white">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf

                    <div>
                        <x-input-error :messages="$errors->get('username')" class="mb-2 text-xs text-red-400" />
                        <div class="border-2 border-white rounded-md px-4 py-3 bg-transparent">
                            <input id="username" type="text" name="username" :value="old('username')"
                                placeholder="Username"
                                class="w-full bg-transparent text-white placeholder-gray-400 focus:outline-none"
                                required autofocus />
                        </div>
                    </div>

                    <div class="mt-2">
                        <div class="border-2 border-white rounded-md px-4 py-3 bg-transparent">
                            <input id="password" type="password" name="password" placeholder="Password"
                                class="w-full bg-transparent text-white placeholder-gray-400 focus:outline-none"
                                required autocomplete="current-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-400" />
                    </div>

                    <div class="flex items-center mt-2">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded bg-transparent border-white text-cyan-500 focus:ring-cyan-500">
                        <label for="remember_me" class="ms-2 text-[10px] text-gray-300">INGAT SAYA</label>
                    </div>

                    <button type="submit"
                        class="mt-4 py-4 rounded-md tracking-widest text-white bg-gradient-to-br from-[#0f2027] via-[#203a43] to-[#2c5364] border-2 border-cyan-300 hover:shadow-[0_0_15px_rgba(34,211,238,0.5)] transition duration-300 active:scale-95">
                        LOGIN
                    </button>

                    <p class="mt-8 text-xs leading-relaxed">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-cyan-300 hover:underline">
                            Register
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>