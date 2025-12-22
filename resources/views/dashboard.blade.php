<x-app-layout>
    <div class="flex w-full max-w-6xl h-[85vh] items-stretch gap-4">
        
        {{-- LEFT: Locked Capsules --}}
        <section class="border border-gray-500 p-6 w-72 h-full flex flex-col bg-[#1f1f1f]">
            <p class="text-center text-[10px] mb-8 tracking-widest uppercase text-gray-400">
                Locked Capsule
            </p>

            <div class="grid grid-cols-2 gap-y-8 gap-x-4 text-center">
                @forelse ($lockedCapsules as $capsule)
                    <button 
                        class="remaining-item group capsule-btn capsule-locked
                            border border-transparent rounded-md p-2
                            hover:bg-gray-800 transition"
                        data-unlock="{{ $capsule->unlock_date->timestamp }}"
                        data-label="{{ $capsule->remainingLabel() }}"
                        onclick="selectCapsule(
                            '{{ $capsule->remainingLabel() }}',
                            'locked',
                            null,
                            true,
                            this
                        )"
                    >
                        <img src="{{ asset('img/locked.png') }}" alt="Locked" class="mx-auto w-14 h-14 object-contain mb-2 group-hover:scale-110 transition"> 
                        <span class="block text-[8px] text-gray-300 tracking-tighter remaining-text"> 
                            {{ $capsule->remainingLabel() }} 
                        </span>
                    </button>
                @empty
                    <p class="col-span-2 text-[8px] text-gray-600">Kosong...</p>
                @endforelse
            </div>
        </section>

        {{-- CENTER: Interactive Preview --}}
        <section class="flex-1 flex flex-col items-center justify-center gap-12 px-4">
            <img 
                id="preview-img"
                src="{{ asset('img/locked.png') }}" 
                alt="Preview" 
                class="w-64 h-64 object-contain mx-auto opacity-70 transition"
            />
            <div 
                id="preview-box"
                class="border border-gray-400 px-8 py-6 text-center text-[10px]
                    leading-loose tracking-widest bg-[#1f1f1f]
                    min-w-[300px]
                    transition cursor-not-allowed opacity-60"
            >
                <span id="preview-text">PILIH CAPSULE</span>
            </div>
        </section>

        {{-- RIGHT: Unlocked Capsules --}}
        <section class="border border-gray-500 p-6 w-72 h-full flex flex-col bg-[#1f1f1f]">
            <p class="text-center text-[10px] mb-8 tracking-widest uppercase text-gray-400">
                Unlocked Capsule
            </p>

            <div class="grid grid-cols-2 gap-y-8 gap-x-4 text-center">
                @forelse ($unlockedCapsules as $capsule)
                    <button 
                        class="group capsule-btn capsule-unlocked
                            border border-transparent rounded-md p-2
                            hover:bg-gray-800 transition"
                        onclick="selectCapsule(
                            '{{ $capsule->agoLabel() }}',
                            'unlocked',
                            '{{ route('capsules.show', $capsule) }}',
                            false,
                            this
                        )"
                    >
                        <img src="{{ asset('img/unlocked.png') }}" alt="Unlocked" class="mx-auto w-14 h-14 object-contain mb-2 group-hover:scale-110 transition">
                        <span class="block text-[8px] text-gray-300 tracking-tighter">
                            {{ $capsule->agoLabel() }} 
                        </span>
                    </button>
                @empty
                    <p class="col-span-2 text-[8px] text-gray-600">Kosong...</p>
                @endforelse
            </div>
        </section>

    </div>

    <script>
    function selectCapsule(label, type, url, isLocked, el) {
        const previewText = document.getElementById('preview-text');
        const previewImg  = document.getElementById('preview-img');
        const previewBox  = document.getElementById('preview-box');

        // RESET capsule active (sama seperti sebelumnya)
        document.querySelectorAll('.capsule-btn').forEach(btn => {
            btn.classList.remove(
                'border-yellow-400','bg-yellow-900/20',
                'border-green-400','bg-green-900/20',
                'capsule-active'
            );
            btn.classList.add('border-transparent');
        });

        // SET ACTIVE
        if (isLocked) {
            el.classList.add('border-yellow-400','bg-yellow-900/20','capsule-active');
        } else {
            el.classList.add('border-green-400','bg-green-900/20','capsule-active');
        }

        // ===== UPDATE PREVIEW =====
        if (isLocked) {
            previewText.innerHTML = label.toUpperCase() + "<br>";
            previewImg.src = "{{ asset('img/locked.png') }}";
            previewImg.classList.add('opacity-70');

            previewBox.dataset.href = "";
            previewBox.classList.add('cursor-not-allowed','opacity-60');
            previewBox.classList.remove(
                'cursor-pointer',
                'hover:bg-green-900/30',
                'border-green-400'
            );

        } else {
            previewText.innerHTML =
                label.toUpperCase() +
                "<br><span class='text-green-500'>TAP TO OPEN</span>";
            previewImg.src = "{{ asset('img/unlocked.png') }}";
            previewImg.classList.remove('opacity-70');

            previewBox.dataset.href = url;
            previewBox.classList.remove('cursor-not-allowed','opacity-60');
            previewBox.classList.add(
                'cursor-pointer',
                'hover:bg-green-900/30',
                'border-green-400'
            );
        }
    }

    // CLICK HANDLER PREVIEW BOX
    document.getElementById('preview-box').addEventListener('click', function () {
        const url = this.dataset.href;
        if (url) {
            window.location.href = url;
        }
    });
    </script>
</x-app-layout>