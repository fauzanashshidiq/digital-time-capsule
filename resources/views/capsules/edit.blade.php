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
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                {{-- Info --}}
                <div class="mb-6 text-sm text-gray-600 bg-gray-50 p-3 rounded">
                    <p>
                        This capsule is still locked.
                        You may rewrite its content, but previous content
                        will not be shown.
                    </p>
                </div>

                {{-- Unlock Date --}}
                <div class="mb-6">
                    <label class="block font-medium mb-1">
                        Unlock Date
                    </label>
                    <input
                        type="date"
                        name="unlock_date"
                        value="{{ old($capsule->unlock_date->format('Y-m-d')) }}"
                        class="border rounded p-2 w-full focus:ring focus:ring-indigo-300"
                    >
                </div>

                {{-- Message --}}
                <div class="mb-6">
                    <label class="block font-medium mb-1">
                        New Capsule Message
                    </label>
                    <textarea
                        name="message"
                        rows="6"
                        class="w-full border rounded p-2 focus:ring focus:ring-indigo-300"
                        placeholder="Write a new message for your future self..."
                    >{{ old('message') }}</textarea>
                </div>

                {{-- Images --}}
                <div class="mb-6">
                    <label class="block font-medium mb-1">
                        New Capsule Images (optional)
                    </label>

                    <input
                        type="file"
                        name="images[]"
                        multiple
                        accept="image/*"
                        class="w-full border rounded p-2"
                    >

                    <p class="text-sm text-gray-500 mt-1">
                        Uploading images will permanently replace all existing images.
                    </p>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('capsules.edit-mode') }}"
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
</x-app-layout>
