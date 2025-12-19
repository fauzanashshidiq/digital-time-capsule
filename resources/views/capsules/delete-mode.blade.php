<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Delete Capsules
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto grid grid-cols-3 gap-6">

            {{-- LEFT: Locked Capsules --}}
            <div class="bg-gray-100 p-4 rounded">
                <h3 class="font-semibold mb-3">Locked Capsules</h3>

                @forelse ($lockedCapsules as $capsule)
                    <button
                        class="block w-full text-left p-2 hover:bg-red-100 rounded"
                        onclick="selectCapsule(
                            '{{ $capsule->remainingLabel() }}',
                            '{{ route('capsules.destroy', $capsule) }}'
                        )"
                    >
                        {{ ucfirst($capsule->remainingLabel()) }}
                    </button>
                @empty
                    <p class="text-sm text-gray-500">No locked capsules</p>
                @endforelse
            </div>

            {{-- CENTER: Delete Preview --}}
            <button
                id="capsule-preview"
                onclick="confirmDelete()"
                class="block w-full bg-white p-6 rounded shadow text-center cursor-not-allowed"
                disabled
            >
                <h2 id="capsule-title" class="text-xl font-semibold mb-2">
                    Select a capsule
                </h2>
                <p id="capsule-message" class="text-red-600">
                    Choose a capsule to delete
                </p>
            </button>

            {{-- RIGHT: Unlocked Capsules --}}
            <div class="bg-gray-100 p-4 rounded">
                <h3 class="font-semibold mb-3">Unlocked Capsules</h3>

                @forelse ($unlockedCapsules as $capsule)
                    <button
                        class="block w-full text-left p-2 hover:bg-red-100 rounded"
                        onclick="selectCapsule(
                            '{{ $capsule->agoLabel() }}',
                            '{{ route('capsules.destroy', $capsule) }}'
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

    {{-- Hidden delete form --}}
    <form id="delete-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        let deleteUrl = null;

        function selectCapsule(label, url) {
            const preview = document.getElementById('capsule-preview');
            const title = document.getElementById('capsule-title');
            const message = document.getElementById('capsule-message');

            deleteUrl = url;

            title.innerText = label;
            message.innerText = 'Tap to permanently delete this capsule';

            preview.disabled = false;
            preview.classList.remove('cursor-not-allowed');
            preview.classList.add('cursor-pointer', 'hover:bg-red-50');
        }

        function confirmDelete() {
            if (!deleteUrl) return;

            if (!confirm('Are you sure you want to delete this capsule?')) return;

            const form = document.getElementById('delete-form');
            form.action = deleteUrl;
            form.submit();
        }
    </script>
</x-app-layout>
