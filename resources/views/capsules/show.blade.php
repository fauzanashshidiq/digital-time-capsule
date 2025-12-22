<x-app-layout>
    <div class="min-h-screen bg-[#2b2b2b] text-white font-['Press_Start_2P'] p-3 sm:p-6">
        <div class="max-w-5xl mx-auto bg-[#4a4646] border border-gray-500 p-4 sm:p-8">

            <h1 class="text-center text-base sm:text-lg mb-6">
                Buat Surat Untuk Masa Depan
            </h1>

            {{-- UNLOCK DATE --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between
                            border border-gray-400 px-4 py-3 mb-4 gap-4 text-[10px] sm:text-sm">
                    <div class="flex items-center gap-3 border p-2">
                        <span>Unlock Date :</span>
                        <span>
                            {{ \Carbon\Carbon::parse($capsule->unlock_date)->translatedFormat('l, d F Y') }}
                        </span>
                    </div>

                    <img
                        src="{{ asset('img/letter.png') }}"
                        class="w-15 h-15 opacity-80 mx-auto sm:mx-0"
                    />
                </div>

            {{-- CONTENT --}}
            <div class="border border-gray-400 p-3 sm:p-6 bg-white text-black">

                <div class="flex flex-col sm:grid sm:grid-cols-3 gap-4 sm:gap-6">

                    {{-- IMAGE GRID --}}
                    <div
                        class="
                            flex gap-2 overflow-x-auto pb-2
                            sm:grid sm:grid-cols-2 sm:gap-2
                            sm:overflow-y-auto sm:overflow-x-hidden
                            sm:max-h-[420px]
                        "
                    >
                        @forelse ($capsule->images as $image)
                            <img
                                src="{{ asset('storage/' . $image->image_path) }}"
                                class="
                                    border border-gray-300
                                    object-cover
                                    w-24 h-24
                                    sm:w-full sm:h-auto
                                    shrink-0
                                "
                                alt="Capsule Image"
                            >
                        @empty
                            <div class="text-center text-[10px] text-gray-500">
                                No Images
                            </div>
                        @endforelse
                    </div>

                    {{-- MESSAGE --}}
                    <div
                        class="
                            sm:col-span-2
                            p-1 sm:p-4
                            sm:max-h-[420px]
                            sm:overflow-y-auto
                        "
                    >
                        <h2 class="text-center mb-3 font-bold text-[10px] sm:text-xs">
                            MESSAGE
                        </h2>

                        <div
                            class="
                                quill-content
                                text-[10px] sm:text-xs
                                leading-relaxed
                                space-y-2
                                text-black
                            "
                        >
                            {!! $capsule->message !!}
                        </div>
                    </div>

                </div>
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-center mt-4 sm:mt-6">
                <a
                    href="{{ route('dashboard') }}"
                    class="px-5 py-2 sm:px-6 sm:py-3 bg-gray-950 text-white text-[10px] sm:text-xs border border-gray-600 hover:bg-black transition"
                >
                    KEMBALI
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
