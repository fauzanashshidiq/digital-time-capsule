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

                <h2 class="text-lg mb-6 tracking-wider">REGISTER</h2>

                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-3">
                    @csrf

                    <div>
                        <div class="border-2 border-white rounded-md px-4 py-3 bg-transparent">
                            <input id="name" type="text" name="name" :value="old('name')" placeholder="NAME"
                                class="w-full bg-transparent text-white placeholder-gray-400 focus:outline-none"
                                required autofocus />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-[10px] text-red-500" />
                    </div>

                    <div>
                        <div class="border-2 border-white rounded-md px-4 py-3 bg-transparent">
                            <input id="username" type="text" name="username" :value="old('username')"
                                placeholder="USERNAME"
                                class="w-full bg-transparent text-white placeholder-gray-400 focus:outline-none"
                                required />
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-1 text-[10px] text-red-500" />
                    </div>

                    <div>
                        <div class="border-2 border-white rounded-md px-4 py-3 bg-transparent">
                            <input id="password" type="password" name="password" placeholder="PASSWORD"
                                class="w-full bg-transparent text-white placeholder-gray-400 focus:outline-none"
                                required />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px] text-red-500" />
                    </div>

                    <div>
                        <div class="border-2 border-white rounded-md px-4 py-3 bg-transparent">
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                placeholder="CONFIRM PASSWORD"
                                class="w-full bg-transparent text-white placeholder-gray-400 focus:outline-none"
                                required />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')"
                            class="mt-1 text-[10px] text-red-500" />
                    </div>

                    <button type="submit"
                        class="mt-4 py-4 rounded-md tracking-widest text-white bg-gradient-to-br from-[#0f2027] via-[#203a43] to-[#2c5364] border-2 border-cyan-300 hover:shadow-[0_0_15px_rgba(34,211,238,0.5)] transition duration-300 active:scale-95">
                        REGISTER
                    </button>

                    <p class="mt-6 text-xs leading-relaxed">
                        SUDAH PUNYA AKUN?
                        <a href="{{ route('login') }}" class="text-cyan-300 hover:underline">
                            LOGIN
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>