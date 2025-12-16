<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Capsule Opened
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow rounded-lg p-8 space-y-6">

                {{-- Date info --}}
                <div class="text-center text-gray-500 text-sm">
                    Unlocked Date: {{ $capsule->unlock_date }}
                </div>
                
                {{-- Images --}}
                @if ($capsule->images->count())
                    <div class="grid grid-cols-2 gap-4 pt-4">
                        @foreach ($capsule->images as $image)
                            <img
                            src="{{ asset('storage/' . $image->image_path) }}"
                                alt="Capsule Image"
                                class="rounded-lg object-cover"
                                >
                        @endforeach
                    </div>
                @endif

                {{-- Message --}}
                <div class="text-gray-800 text-lg leading-relaxed whitespace-pre-line">
                    {{ $capsule->message }}
                </div>
                
                {{-- Back --}}
                <div class="pt-6 text-center">
                    <a
                        href="{{ route('dashboard') }}"
                        class="text-indigo-600 hover:underline text-sm"
                    >
                        ← Back to Dashboard
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
