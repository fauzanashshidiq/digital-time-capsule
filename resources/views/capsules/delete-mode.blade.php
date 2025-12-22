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
            {{-- LEFT: LOCKED --}}
            <section class="border border-gray-500 p-4 sm:p-6 w-full sm:w-72 bg-[#1f1f1f]">
                <p class="text-center text-[10px] mb-4 tracking-widest text-gray-400">
                    LOCKED CAPSULE
                </p>

                <div class="sm:flex-1 sm:overflow-y-auto overflow-x-auto">
                    <div class="flex sm:grid sm:grid-cols-2 gap-4 sm:gap-y-8 sm:gap-x-4 min-w-max sm:min-w-0 text-center">
                        @forelse ($lockedCapsules as $capsule)
                        <div
                            draggable="true"
                            data-url="{{ route('capsules.destroy',$capsule) }}"
                            data-label="{{ $capsule->remainingLabel() }}"
                            data-type="locked"
                            onclick="selectCapsule(this)"
                            ondragstart="onDragStart(event)"
                            class="
                                capsule-item
                                border border-transparent rounded-md p-2
                                transition
                                cursor-grab shrink-0 w-24 sm:w-auto
                                hover:bg-red-900/30
                                hover:border-red-500"
                        >
                            <div class="relative inline-block">
                                <img src="{{ asset('img/locked.png') }}" class="mx-auto w-12 sm:w-14 h-12 sm:h-14">
                                <img src="{{ asset('img/cancel.png') }}"
                                    class="absolute -top-2 -right-2 w-8 h-8 object-contain">
                            </div>
                            <span class="block text-[8px] mt-2 text-gray-300">
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

            {{-- CENTER --}}
            <section class="flex-1 flex flex-col items-center justify-center gap-10">
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

                    <div class="flex flex-col items-center gap-3 px-7">
                        <img src="{{ asset('img/trash.png') }}"
                            class="ww-40 h-40
                                sm:w-64 sm:h-64
                                object-contain
                                opacity-80 ">
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

                <div
                    id="delete-dropzone"
                    onclick="openModal()"
                    ondrop="onDrop(event)"
                    ondragover="onDragOver(event)"
                    class="
                        border border-gray-400
                        px-10 py-8
                        text-center text-[10px]
                        tracking-widest
                        bg-[#1f1f1f]
                        cursor-pointer
                        transition
                        hover:border-red-500
                        hover:text-red-400
                        hover:bg-red-900/20
                        active:scale-95"
                        >
                    Tap atau drag capsule<br>untuk hapus
                </div>
            </section>

            {{-- RIGHT: UNLOCKED --}}
            <section class="border border-gray-500 p-4 sm:p-6 w-full sm:w-72 bg-[#1f1f1f]">
                <p class="text-center text-[10px] mb-4 tracking-widest text-gray-400">
                    UNLOCKED CAPSULE
                </p>

                <div class="sm:flex-1 sm:overflow-y-auto overflow-x-auto">
                    <div class="flex sm:grid sm:grid-cols-2 gap-4 sm:gap-y-8 sm:gap-x-4 min-w-max sm:min-w-0 text-center">
                        @forelse ($unlockedCapsules as $capsule)
                        <div
                            draggable="true"
                            data-url="{{ route('capsules.destroy',$capsule) }}"
                            data-label="{{ $capsule->agoLabel() }}"
                            data-type="unlocked"
                            onclick="selectCapsule(this)"
                            ondragstart="onDragStart(event)"
                            class="
                                capsule-item
                                border border-transparent rounded-md p-2
                                transition
                                cursor-grab shrink-0 w-24 sm:w-auto
                                hover:bg-red-900/30
                                hover:border-red-500"
                        >
                            <div class="relative inline-block">
                                <img src="{{ asset('img/unlocked.png') }}" class="mx-auto w-12 sm:w-14 h-12 sm:h-14">
                                <img src="{{ asset('img/cancel.png') }}"
                                    class="absolute -top-2 -right-1 w-8 h-8 object-contain">
                            </div>
                            <span class="block text-[8px] mt-2 text-gray-300">
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
</div>

    {{-- MODAL --}}
    <div id="delete-modal"
        class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
    <div class="bg-[#4a4646] border border-gray-500 p-6 w-[90%] max-w-sm text-center">
        <img id="modal-img" class="w-20 mx-auto mb-4">
        <p id="modal-label" class="text-[10px] mb-6"></p>
        <div class="flex justify-between gap-4">
            <button onclick="closeModal()"
                class="
                    px-4 py-3
                    bg-gray-600 text-[10px]
                    transition
                    hover:bg-gray-500
                    active:scale-95
                "
                >
                BATAL
            </button>
            <button onclick="confirmDelete()"
                class="
                    px-4 py-3
                    bg-red-700 text-[10px]
                    transition
                    hover:bg-red-600
                    hover:shadow-[0_0_10px_rgba(255,0,0,0.5)]
                    active:scale-95
                "
                >
                HAPUS
            </button>
        </div>
    </div>

    <form id="delete-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        let selectedUrl = null;
        let selectedLabel = null;
        let selectedType = null;

        function selectCapsule(el){
            // clear active delete
            document.querySelectorAll('.capsule-item').forEach(c => {
                c.classList.remove(
                    'border-red-500',
                    'bg-red-900/40'
                );
                c.classList.add('border-transparent');
            });
            el.classList.remove('border-transparent');
            // set active delete
            el.classList.add(
                'border-red-500',
                'bg-red-900/40'
            );
            // simpan data
            selectedUrl   = el.dataset.url;
            selectedLabel = el.dataset.label;
            selectedType  = el.dataset.type;
        }

        function onDragStart(e){
            selectCapsule(e.currentTarget);
        }

        function onDrop(){
            openModal();
        }

        function openModal(){
            if(!selectedUrl) return;

            document.getElementById('modal-label').innerText = selectedLabel;
            document.getElementById('modal-img').src =
                selectedType === 'locked'
                    ? "{{ asset('img/locked.png') }}"
                    : "{{ asset('img/unlocked.png') }}";

            document.getElementById('delete-modal').classList.remove('hidden');
            document.getElementById('delete-modal').classList.add('flex');
        }

        function closeModal(){
            document.getElementById('delete-modal').classList.add('hidden');
        }

        function confirmDelete(){
            const form = document.getElementById('delete-form');
            form.action = selectedUrl;
            form.submit();
        }

        function onDragOver(e){
            e.preventDefault();
            e.currentTarget.classList.add('border-red-500','bg-red-900/30');
        }

        function onDrop(e){
            e.preventDefault();
            e.currentTarget.classList.remove('border-red-500','bg-red-900/30');
            openModal();
        }
    </script>
</x-app-layout>
