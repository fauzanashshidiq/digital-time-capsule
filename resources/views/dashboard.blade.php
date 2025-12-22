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
                        class="remaining-item group"
                        data-unlock="{{ $capsule->unlock_date->timestamp }}"
                        data-label="{{ $capsule->remainingLabel() }}"
                        onclick="selectCapsule('{{ $capsule->remainingLabel() }}', 'locked', null, true)"
                    >
                        <img src="{{ asset('img/locked.png') }}" alt="Locked" class="mx-auto w-10 h-10 object-contain mb-2 group-hover:scale-110 transition">
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
            <a id="capsule-link" href="javascript:void(0)" class="block transition-all duration-300 opacity-70">
                <img 
                    id="preview-img"
                    src="{{ asset('img/locked.png') }}" 
                    alt="Preview" 
                    class="w-64 h-64 object-contain mx-auto"
                />
            </a>

            <div id="preview-box" class="border border-gray-400 px-8 py-6 text-center text-[10px] leading-loose tracking-widest bg-[#1f1f1f] min-w-[300px]">
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
                        class="group"
                        onclick="selectCapsule('{{ $capsule->agoLabel() }}', 'unlocked', '{{ route('capsules.show', $capsule) }}', false)"
                    >
                        <img src="{{ asset('img/unlocked.png') }}" alt="Unlocked" class="mx-auto w-10 h-10 object-contain mb-2 group-hover:scale-110 transition">
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
        function selectCapsule(label, type, url, isLocked) {
            const previewText = document.getElementById('preview-text');
            const previewImg = document.getElementById('preview-img');
            const previewLink = document.getElementById('capsule-link');
            
            // Set Text & Image
            if (isLocked) {
                previewText.innerHTML = label.toUpperCase() + "<br>REMAINING";
                previewImg.src = "{{ asset('img/locked.png') }}";
                previewLink.style.opacity = "0.5";
                previewLink.href = "javascript:void(0)";
                previewLink.classList.add('cursor-not-allowed');
            } else {
                previewText.innerHTML = label.toUpperCase() + " AGO<br><span class='text-green-500'>TAP TO OPEN</span>";
                previewImg.src = "{{ asset('img/unlocked.png') }}";
                previewLink.style.opacity = "1";
                previewLink.href = url;
                previewLink.classList.remove('cursor-not-allowed');
            }
        }

        // Logic Timer (Opsional jika ingin countdown jalan terus)
        function startCountdown() {
            document.querySelectorAll('.remaining-item').forEach(item => {
                const unlockAt = parseInt(item.dataset.unlock);
                const textEl = item.querySelector('.remaining-text');
                
                setInterval(() => {
                    const now = Math.floor(Date.now() / 1000);
                    const diff = unlockAt - now;
                    if (diff <= 0) {
                        textEl.innerText = "READY!";
                    }
                }, 1000);
            });
        }
        startCountdown();
    </script>
</x-app-layout>