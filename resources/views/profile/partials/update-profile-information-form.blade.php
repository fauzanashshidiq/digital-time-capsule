<section class="font-['Press_Start_2P']">
    <header class="mb-6">
        <h2 class="text-sm text-black mb-2">
            ▶ PROFILE INFORMATION
        </h2>

        <p class="text-[10px] text-gray-700 leading-relaxed">
            Update your player name and email address.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        {{-- NAME --}}
        <div>
            <x-input-label
                for="name"
                value="NAME"
                class="text-[10px] text-black"
            />

            <x-text-input
                id="name"
                name="name"
                type="text"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
                class="mt-2 block w-full
                       bg-[#fafafa]
                       border-2 border-black
                       text-xs
                       focus:ring-0
                       focus:border-black
                       text-gray-700 p-2"
            />

            <x-input-error class="mt-2 text-[10px]" :messages="$errors->get('name')" />
        </div>

        {{-- USERNAME --}}
        <div>
            <x-input-label
                for="username"
                value="USERNAME"
                class="text-[10px] text-black"
            />

            <x-text-input
                id="username"
                name="username"
                type="text"
                :value="old('username', $user->username)"
                required
                autocomplete="username"
                class="mt-2 block w-full
                       bg-[#fafafa]
                       border-2 border-black
                       text-xs
                       focus:ring-0
                       focus:border-black
                       text-gray-700 p-2"
            />

            <x-input-error class="mt-2 text-[10px]" :messages="$errors->get('username')" />
        </div>

        {{-- EMAIL VERIFICATION --}}
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="border-2 border-black p-3 bg-yellow-100 text-[10px]">
                <p class="mb-2">
                    ⚠ EMAIL NOT VERIFIED
                </p>

                <button
                    form="send-verification"
                    class="underline hover:text-gray-600"
                >
                    RESEND VERIFICATION
                </button>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-green-700">
                        ✔ VERIFICATION SENT
                    </p>
                @endif
            </div>
        @endif

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

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] text-green-700"
                >
                    ✔ SAVED
                </p>
            @endif
        </div>
    </form>
</section>
