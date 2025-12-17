<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Capsule
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
                action="{{ route('capsules.store') }}"
                enctype="multipart/form-data"
            >
                @csrf
                {{-- Unlock Date --}}
                <div class="mb-6">
                    <label class="block font-medium mb-1">
                        Unlock Date
                    </label>
                    <input
                        type="date"
                        name="unlock_date"
                        value="{{ old('unlock_date') }}"
                        class="border rounded p-2 w-full focus:ring focus:ring-indigo-300"
                        onchange="updatePreview(this.value)"
                    >

                    <p id="unlock-preview" class="text-sm text-gray-500 mt-1">
                        Select a future date
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
                    >{{ old('message') }}</textarea>
                </div>

                {{-- Images --}}
                <div class="mb-6">
                    <label class="block font-medium mb-1">
                        Capsule Images (optional)
                    </label>

                    <input
                        type="file"
                        name="images[]"
                        multiple
                        accept="image/*"
                        class="w-full border rounded p-2"
                        onchange="previewImages(this)"
                    >
                    <p class="text-sm text-gray-500 mt-1">
                        You can upload multiple images (jpg, png, webp)
                    </p>

                    {{-- Preview --}}
                    <div id="image-preview" class="grid grid-cols-3 gap-3 mt-3"></div>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                        Batalkan
                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Kirim Surat
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
