<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto grid grid-cols-3 gap-6">

            {{-- LEFT: Locked --}}
            <div class="bg-gray-100 p-4 rounded">
                <h3 class="font-semibold mb-3">Locked</h3>

                @forelse ($lockedCapsules as $capsule)
                    <button
                        class="block w-full text-left p-2 hover:bg-gray-200 rounded remaining-item"
                        data-unlock="{{ $capsule->unlock_date->startOfDay()->timestamp }}"
                        onclick="selectCapsule(
                            this.dataset.label,
                            'locked'
                        )"
                        data-label="{{ ucfirst($capsule->remainingLabel()) }}"
                    >
                        <span class="remaining-text">
                            {{ ucfirst($capsule->remainingLabel()) }}
                        </span>
                    </button>
                @empty
                    <p class="text-sm text-gray-500">No locked capsules</p>
                @endforelse
            </div>

            {{-- CENTER: Preview --}}
            <a
                id="capsule-preview"
                href="javascript:void(0)"
                class="block bg-white p-6 rounded shadow text-center cursor-default"
            >
                <h2 id="capsule-title" class="text-xl font-semibold mb-2">
                    Select a capsule
                </h2>
                <p id="capsule-message" class="text-gray-600">
                    Click a capsule to preview
                </p>
            </a>

            {{-- RIGHT: Unlocked --}}
            <div class="bg-gray-100 p-4 rounded">
                <h3 class="font-semibold mb-3">Unlocked</h3>

                @forelse ($unlockedCapsules as $capsule)
                    <button
                        class="block w-full text-left p-2 hover:bg-gray-200 rounded"
                        onclick="selectCapsule(
                            '{{ ucfirst($capsule->agoLabel()) }}',
                            'unlocked',
                            '{{ route('capsules.show', $capsule) }}'
                        )"
                    >
                        {{ ucfirst($capsule->agoLabel()) }}
                    </button>
                @empty
                    <p class="text-sm text-gray-500">No unlocked capsules</p>
                @endforelse
            </div>

        </div>
    </div>
    <script>
        function selectCapsule(label, type, url = null) {
            const preview = document.getElementById('capsule-preview');
            const title = document.getElementById('capsule-title');
            const message = document.getElementById('capsule-message');

            title.innerText = label;

            if (type === 'locked') {
                message.innerText = 'This capsule is still locked';

                preview.href = 'javascript:void(0)';
                preview.classList.remove('cursor-pointer', 'hover:bg-gray-50');
                preview.classList.add('cursor-not-allowed');

            } else {
                message.innerText = 'Tap the capsule to see the letter';

                preview.href = url;
                preview.classList.remove('cursor-not-allowed');
                preview.classList.add('cursor-pointer', 'hover:bg-gray-50');
            }
        }
    </script>
    <script>
    function formatRemaining(seconds) {
        if (seconds <= 0) return 'Unlocked';

        const units = [
            { label: 'year', value: 31536000 },
            { label: 'month', value: 2592000 },
            { label: 'week', value: 604800 },
            { label: 'day', value: 86400 },
            { label: 'hour', value: 3600 },
            { label: 'minute', value: 60 },
            { label: 'second', value: 1 },
        ];

        let parts = [];

        for (const unit of units) {
            const amount = Math.floor(seconds / unit.value);
            if (amount > 0) {
                parts.push(`${amount} ${unit.label}${amount > 1 ? 's' : ''}`);
                seconds -= amount * unit.value;
            }
            if (parts.length === 2) break;
        }

        return parts.join(' and ') + ' remaining';
    }

    function startRemainingCountdown() {
        document.querySelectorAll('.remaining-item').forEach(button => {
            const unlockTimestamp = parseInt(button.dataset.unlock);
            const text = button.querySelector('.remaining-text');

            setInterval(() => {
                const now = Math.floor(Date.now() / 1000);
                const diff = unlockTimestamp - now;

                const label = formatRemaining(diff);
                text.innerText = label;

                // update preview label kalau sedang dipilih
                if (document.getElementById('capsule-title').innerText === button.dataset.label) {
                    document.getElementById('capsule-title').innerText = label;
                }

            }, 1000);
        });
    }

    startRemainingCountdown();
    </script>
</x-app-layout>
