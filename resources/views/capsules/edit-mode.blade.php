<x-app-layout>
    <div class="w-full flex justify-center">
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
                <p class="text-center text-[10px] mb-4 tracking-widest uppercase text-gray-400">
                    Locked Capsule
                </p>

                <div class="sm:flex-1 sm:overflow-y-auto overflow-x-auto">
                    <div class="flex sm:grid sm:grid-cols-2 gap-4 sm:gap-y-8 sm:gap-x-4 min-w-max sm:min-w-0 text-center">
                        @forelse ($lockedCapsules as $capsule)
                            <div
                                draggable="true"
                                data-edit-url="{{ route('capsules.edit', $capsule) }}"
                                onclick="selectForEdit(this)"
                                class="capsule-edit
                                    border border-transparent rounded-md p-2
                                    hover:bg-gray-800 transition
                                    cursor-grab shrink-0 w-24 sm:w-auto"
                                ondragstart="onDragStart(event)"
                            >
                                <div class="relative inline-block">
                                    {{-- Locked --}}
                                    <img
                                        src="{{ asset('img/locked.png') }}"
                                        class="mx-auto w-12 sm:w-14 h-12 sm:h-14"
                                    >

                                    {{-- Pencil overlay --}}
                                    <img
                                        src="{{ asset('img/pencil.png') }}"
                                        class="
                                            absolute -top-2 -right-1 w-8 h-8 object-contain
                                        "
                                    >
                                </div>

                                <span class="block text-[8px] text-gray-300 mt-2">
                                    {{ $capsule->remainingLabel() }}
                                </span>
                            </div>
                    @empty
                        <div class="col-span-2 flex flex-col items-center justify-center py-10 opacity-30 w-full border border-transparent border-gray-600 rounded-lg">
                            <p class="text-[10px] tracking-widest uppercase">NO LOCKED CAPSULES</p>
                        </div>
                    @endforelse
                    </div>
                </div>
            </section>

            {{-- CENTER: EDIT PREVIEW --}}
            <section class="flex-1 flex flex-col items-center justify-center gap-12 px-4">
                <div class="relative">
                    {{-- EDIT --}}
                    <a href="{{ route('capsules.edit-mode') }}"
                    id="preview-edit"
                    class="absolute -left-10 top-3 -translate-y-1/2
                            text-gray-400 hover:text-white transition
                            opacity-100 pointer-events-auto
                            sm:opacity-0 sm:pointer-events-none border border-gray-500 p-1 bg-[#1f1f1f] hover:bg-gray-800">
                        <img src="{{ asset('img/pencil.png') }}" class="w-8 h-8 object-contain"></img>
                    </a>

                    {{-- IMAGE --}}
                    <div class="flex flex-col items-center gap-3 px-7">
                        <img
                            src="{{ asset('img/pencil.png') }}"
                            class="
                                w-40 h-40
                                sm:w-64 sm:h-64
                                object-contain
                                opacity-80
                            "
                        />
                    </div>

                    {{-- DELETE --}}
                    <a href="{{ route('capsules.delete-mode') }}"
                    id="preview-delete"
                    class="absolute -right-10 top-3 -translate-y-1/2
                            text-red-600 hover:text-red-500 transition
                            opacity-100 pointer-events-auto
                            sm:opacity-0 sm:pointer-events-none border border-gray-500 p-1 bg-[#1f1f1f] hover:bg-gray-800">
                        <img src="{{ asset('img/trash.png') }}" class="w-8 h-8 object-contain"></img>
                    </a>
                </div>

                {{-- TAP BOX --}}
                <div
                    id="edit-dropzone"
                    onclick="tapToEdit()"
                    ondragover="onDragOver(event)"
                    ondrop="onDrop(event)"
                    class="
                        border border-gray-400
                        px-10 py-8
                        text-center text-[10px]
                        leading-loose tracking-widest
                        bg-[#1f1f1f]
                        min-w-[300px]
                        transition
                        cursor-pointer
                        active:scale-95
                    "
                >
                    Tap atau drag capsule<br>untuk Edit Capsule
                </div>
            </section>

            {{-- RIGHT: Unlocked Capsules --}}
            <section class="border border-gray-500 p-4 sm:p-6 w-full sm:w-72 bg-[#1f1f1f] opacity-60">
                <p class="text-center text-[10px] mb-4 tracking-widest uppercase text-gray-400">
                    Unlocked Capsule
                </p>
                <div class="sm:flex-1 sm:overflow-y-auto overflow-x-auto">
                    <div class="flex sm:grid sm:grid-cols-2 gap-4 sm:gap-y-8 sm:gap-x-4 min-w-max sm:min-w-0 text-center">
                        @forelse ($unlockedCapsules as $capsule)
                            <div class="rounded-md p-2 cursor-not-allowed">
                                <img
                                    src="{{ asset('img/unlocked.png') }}"
                                    class="mx-auto w-12 sm:w-14 h-12 sm:h-14 mb-2"
                                >
                                <span class="block text-[8px] text-gray-300">
                                    {{ $capsule->agoLabel() }}
                                </span>
                            </div>
                        @empty
                            <div class="col-span-2 flex flex-col items-center justify-center py-10 opacity-30 w-full border border-transparent border-gray-600 rounded-lg">
                                <p class="text-[10px] tracking-widest uppercase">NO UNLOCKED CAPSULES</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Drag Script --}}
    <script>
        let selectedEditUrl = null;

        function selectForEdit(el) {
            // clear active
            document.querySelectorAll('.capsule-edit').forEach(c => {
                c.classList.remove('border-yellow-400','bg-yellow-900/20');
            });

            // set active
            el.classList.add('border-yellow-400','bg-yellow-900/20');
            selectedEditUrl = el.dataset.editUrl;
        }

        function tapToEdit() {
            if (selectedEditUrl) {
                window.location.href = selectedEditUrl;
            }
        }

        function onDragStart(e) {
            e.dataTransfer.setData('edit-url', e.currentTarget.dataset.editUrl);
        }

        function onDragOver(e) {
            e.preventDefault();
            e.currentTarget.classList.add('border-yellow-400');
        }

        function onDrop(e) {
            e.preventDefault();
            const url = e.dataTransfer.getData('edit-url');
            if (url) {
                window.location.href = url;
            }
        }
    </script>
</x-app-layout>
