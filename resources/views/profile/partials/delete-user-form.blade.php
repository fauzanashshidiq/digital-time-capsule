<section class="font-['Press_Start_2P'] space-y-6">
    <header>
        <h2 class="text-sm text-black mb-2">
            ▶ DELETE ACCOUNT
        </h2>

        <p class="text-[10px] text-gray-700 leading-relaxed">
            This will permanently erase your save file.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 text-white
               border-2 border-black
               text-xs
               hover:bg-white hover:text-red-600"
    >
        DELETE ACCOUNT
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}"
              class="bg-white border-4 border-black p-6 font-['Press_Start_2P']">
            @csrf
            @method('delete')

            <h2 class="text-xs mb-4">
                ⚠ FINAL WARNING
            </h2>

            <p class="text-[10px] mb-4 leading-relaxed">
                This action cannot be undone.
                Enter your password to confirm.
            </p>

            <div>
                <x-input-label
                    for="password"
                    value="PASSWORD"
                    class="text-[10px] text-black"
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full
                           bg-[#fafafa]
                           border-2 border-black
                           text-xs
                           focus:ring-0
                           focus:border-black"
                />

                <x-input-error class="mt-2 text-[10px]" :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <x-secondary-button
                    x-on:click="$dispatch('close')"
                    class="border-2 border-black text-xs"
                >
                    CANCEL
                </x-secondary-button>

                <x-danger-button
                    class="bg-red-600 text-white
                           border-2 border-black
                           text-xs
                           hover:bg-white hover:text-red-600"
                >
                    DELETE
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
