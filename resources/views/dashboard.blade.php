<x-app-layout>
    <div class="flex flex-col sm:flex-row w-full max-w-6xl h-auto sm:h-[85vh] gap-6 sm:gap-4">
        {{-- MOBILE CREATE --}}
        <a href="{{ route('capsules.create') }}"
           class="sm:hidden flex items-center justify-center
                  h-10 w-full
                  border border-gray-500
                  bg-[#1f1f1f]
                  hover:text-white hover:bg-gray-800
                  transition">
            <img src="{{ asset('img/plus.png') }}" class="w-8 h-8 object-contain"></img>
        </a>

        {{-- LEFT: Locked Capsules --}}
        <section class="border border-gray-500 p-4 sm:p-6 w-full sm:w-72 bg-[#1f1f1f]">
            <p class="text-center text-[10px] my-4 tracking-widest uppercase text-gray-400">
                Locked Capsule
            </p>

            <div class="sm:flex-1 sm:overflow-y-auto overflow-x-auto">
                <div class="flex sm:grid sm:grid-cols-2 gap-4 sm:gap-y-8 sm:gap-x-4 min-w-max sm:min-w-0 text-center">
                    @foreach ($lockedCapsules as $capsule)
                        <button
                            class="capsule-btn capsule-locked
                                   border border-transparent rounded-md p-2
                                   hover:bg-gray-800 transition shrink-0 w-24 sm:w-auto"
                            onclick="selectCapsule(
                                '{{ $capsule->remainingLabel() }}',
                                'locked',
                                null,
                                true,
                                this
                            )"
                        >
                            <img src="{{ asset('img/locked.png') }}"
                                 class="mx-auto w-12 sm:w-14 h-12 sm:h-14 mb-2">
                            <span class="block text-[8px] text-gray-300">
                                {{ $capsule->remainingLabel() }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CENTER: Preview --}}
        <section class="flex-1 flex flex-col items-center justify-center gap-12 px-4">
            <div class="relative">
                {{-- EDIT --}}
                <a href="{{ route('capsules.edit-mode') }}"
                   id="preview-edit"
                   class="absolute -left-10 top-1/2 -translate-y-1/2
                          text-gray-400 hover:text-white transition
                          opacity-100 pointer-events-auto
                          sm:opacity-0 sm:pointer-events-none">
                    <img src="{{ asset('img/pencil.png') }}" class="w-8 h-8 object-contain"></img>
                </a>

                {{-- IMAGE --}}
                <div class="flex flex-col items-center gap-3">
                    <img
                        id="preview-img"
                        src="{{ asset('img/locked.png') }}"
                        class="
                            w-40 h-40
                            sm:w-64 sm:h-64
                            object-contain
                            opacity-70
                            transition
                        "
                    />

                    <p
                        id="preview-status"
                        class="
                            text-[10px] sm:text-xl
                            tracking-widest
                            uppercase
                            text-gray-400
                        "
                    >
                        LOCKED
                    </p>
                </div>

                {{-- DELETE --}}
                <a href="{{ route('capsules.delete-mode') }}"
                   id="preview-delete"
                   class="absolute -right-10 top-1/2 -translate-y-1/2
                          text-red-600 hover:text-red-500 transition
                          opacity-100 pointer-events-auto
                          sm:opacity-0 sm:pointer-events-none">
                    <img src="{{ asset('img/trash.png') }}" class="w-8 h-8 object-contain"></img>
                </a>
            </div>

            <div
                id="preview-box"
                class="border border-gray-400 px-8 py-6 text-center text-[10px]
                       leading-loose tracking-widest bg-[#1f1f1f]
                       min-w-[300px]
                       transition cursor-not-allowed opacity-60"
            >
                <span id="preview-text">CHOOSE CAPSULE</span>
            </div>
        </section>

        {{-- RIGHT: Unlocked Capsules --}}
        <section class="border border-gray-500 p-4 sm:p-6 w-full sm:w-72 bg-[#1f1f1f]">
            <p class="text-center text-[10px] mb-4 tracking-widest uppercase text-gray-400">
                Unlocked Capsule
            </p>

            <div class="sm:flex-1 sm:overflow-y-auto overflow-x-auto">
                <div class="flex sm:grid sm:grid-cols-2 gap-4 sm:gap-y-8 sm:gap-x-4 min-w-max sm:min-w-0 text-center">
                    @foreach ($unlockedCapsules as $capsule)
                        <button
                            class="capsule-btn capsule-unlocked
                                   border border-transparent rounded-md p-2
                                   hover:bg-gray-800 transition shrink-0 w-24 sm:w-auto"
                            onclick="selectCapsule(
                                '{{ $capsule->agoLabel() }}',
                                'unlocked',
                                '{{ route('capsules.show', $capsule) }}',
                                false,
                                this
                            )"
                        >
                            <img src="{{ asset('img/unlocked.png') }}"
                                 class="mx-auto w-12 sm:w-14 h-12 sm:h-14 mb-2">
                            <span class="block text-[8px] text-gray-300">
                                {{ $capsule->agoLabel() }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

    </div>

    <script>
    function selectCapsule(label, type, url, isLocked, el) {
        const previewText = document.getElementById('preview-text');
        const previewImg  = document.getElementById('preview-img');
        const previewBox  = document.getElementById('preview-box');
        const editBtn     = document.getElementById('preview-edit');
        const deleteBtn   = document.getElementById('preview-delete');
        const statusText = document.getElementById('preview-status');

        document.querySelectorAll('.capsule-btn').forEach(btn => {
            btn.classList.remove(
                'border-yellow-400','bg-yellow-900/20',
                'border-green-400','bg-green-900/20'
            );
            btn.classList.add('border-transparent');
        });

        if (isLocked) {
            el.classList.add('border-yellow-400','bg-yellow-900/20');
        } else {
            el.classList.add('border-green-400','bg-green-900/20');
        }

        if (isLocked) {
            previewText.innerHTML = label.toUpperCase();
            previewImg.src = "{{ asset('img/locked.png') }}";
            previewImg.classList.add('opacity-70');
            previewBox.dataset.href = "";
            previewBox.classList.add('cursor-not-allowed','opacity-60');
            previewBox.classList.remove('cursor-pointer','border-green-400', 'hover:bg-gray-800');
            statusText.innerText = 'LOCKED';
            statusText.classList.remove('text-green-400');
            statusText.classList.add('text-gray-400');
        } else {
            previewText.innerHTML =
                label.toUpperCase() +
                "<br><span class='text-green-500'>Tap the capsule to see the letter</span>";
            previewImg.src = "{{ asset('img/unlocked.png') }}";
            previewImg.classList.remove('opacity-70');
            previewBox.dataset.href = url;
            previewBox.classList.remove('cursor-not-allowed','opacity-60');
            previewBox.classList.add('cursor-pointer','border-green-400', 'hover:bg-gray-800');
            statusText.innerText = 'UNLOCKED';
            statusText.classList.remove('text-gray-400');
            statusText.classList.add('text-green-400');

            // DESKTOP ONLY show edit/delete
            if (window.innerWidth >= 640) {
                editBtn.classList.remove('opacity-0','pointer-events-none');
                deleteBtn.classList.remove('opacity-0','pointer-events-none');
            }
        }
    }

    document.getElementById('preview-box').addEventListener('click', function () {
        if (this.dataset.href) {
            window.location.href = this.dataset.href;
        }
    });
    </script>
</x-app-layout>