<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Capsule
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            {{-- Error --}}
            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('capsules.update', $capsule) }}"
            >
                @csrf
                @method('PUT')

                {{-- Unlock Date --}}
                <div class="mb-6">
                    <label class="block font-medium mb-1">
                        Unlock Date
                    </label>
                    <input
                        type="date"
                        name="unlock_date"
                        value="{{ old('unlock_date', $capsule->unlock_date->format('Y-m-d')) }}"
                        class="border rounded p-2 w-full focus:ring focus:ring-indigo-300"
                        onchange="updatePreview(this.value)"
                    >

                    <p id="unlock-preview" class="text-sm text-gray-500 mt-1">
                        This capsule will unlock on
                        {{ $capsule->unlock_date->toFormattedDateString() }}
                    </p>
                </div>

                {{-- Message --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">
                        Capsule Message
                    </label>
                    <textarea
                        name="message"
                        rows="6"
                        class="w-full border rounded p-2 focus:ring focus:ring-indigo-300"
                        placeholder="Write a message for your future self..."
                    >{{ old('message', $capsule->message) }}</textarea>
                </div>

                {{-- Info --}}
                <div class="mb-6 text-sm text-gray-500">
                    <p>
                        ⚠️ Capsule can only be edited while locked.
                        Once unlocked, it becomes read-only.
                    </p>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('capsules.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                    >
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function updatePreview(date) {
            if (!date) return;
            const target = new Date(date);
            document.getElementById('unlock-preview').innerText =
                `This capsule will unlock on ${target.toDateString()}`;
        }
    </script>
</x-app-layout>
