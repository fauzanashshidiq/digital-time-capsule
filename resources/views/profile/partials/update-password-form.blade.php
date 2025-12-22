<section class="font-['Press_Start_2P']">
    <header class="mb-6">
        <h2 class="text-sm text-black mb-2">
            ▶ UPDATE PASSWORD
        </h2>

        <p class="text-[10px] text-gray-700 leading-relaxed">
            Use a strong password to protect your save data.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        {{-- CURRENT PASSWORD --}}
        <div>
            <x-input-label
                for="current_password"
                value="CURRENT PASSWORD"
                class="text-[10px] text-black"
            />

            <x-text-input
                id="current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="mt-2 block w-full
                       bg-[#fafafa]
                       border-2 border-black
                       text-xs
                       focus:ring-0
                       focus:border-black
                       text-gray-700 p-2"
            />

            <x-input-error class="mt-2 text-[10px]" :messages="$errors->updatePassword->get('current_password')" />
        </div>

        {{-- NEW PASSWORD --}}
        <div>
            <x-input-label
                for="password"
                value="NEW PASSWORD"
                class="text-[10px] text-black"
            />

            <x-text-input
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-2 block w-full
                       bg-[#fafafa]
                       border-2 border-black
                       text-xs
                       focus:ring-0
                       focus:border-black
                       text-gray-700 p-2"
            />

            <x-input-error class="mt-2 text-[10px]" :messages="$errors->updatePassword->get('password')" />
        </div>

        {{-- CONFIRM --}}
        <div>
            <x-input-label
                for="password_confirmation"
                value="CONFIRM PASSWORD"
                class="text-[10px] text-black"
            />

            <x-text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-2 block w-full
                       bg-[#fafafa]
                       border-2 border-black
                       text-xs
                       focus:ring-0
                       focus:border-black
                       text-gray-700 p-2"
            />

            <x-input-error class="mt-2 text-[10px]" :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        {{-- ACTION --}}
        <div class="flex items-center gap-4">
            <x-primary-button
                class="bg-black text-white
                       border-2 border-black
                       text-xs
                       hover:bg-white hover:text-black"
            >
                SAVE
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p class="text-[10px] text-green-700">
                    ✔ PASSWORD UPDATED
                </p>
            @endif
        </div>
    </form>
</section>
