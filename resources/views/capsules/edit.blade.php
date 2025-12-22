<x-app-layout>
<div class="min-h-screen bg-[#2b2b2b] text-white font-['Press_Start_2P']">

    {{-- CONTAINER --}}
    <div class="w-full px-4 sm:px-10 py-8">
        <div class="w-full max-w-6xl mx-auto bg-[#4a4646] border border-gray-500 p-6 sm:p-8">

            {{-- TITLE --}}
            <h1 class="text-center text-base sm:text-lg mb-6">
                Ubah Surat Masa Depan
            </h1>

            {{-- INFO --}}
            <div class="mb-4 border border-yellow-500 p-3 text-yellow-300 text-[10px]">
                Capsule masih terkunci.  
                Isi lama tidak ditampilkan dan akan diganti permanen.
            </div>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="mb-4 border border-red-500 p-3 text-red-300 text-xs">
                    <ul class="list-disc pl-5 space-y-1">
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
                onsubmit="syncQuill()"
            >
                @csrf
                @method('PUT')

                {{-- UNLOCK DATE --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between
                            border border-gray-400 px-4 py-3 mb-4 gap-4 text-[10px] sm:text-sm">

                    <div class="flex items-center gap-3 border p-2">
                        <span>Unlock Date :</span>
                        <input
                            type="date"
                            name="unlock_date"
                            value="{{ old($capsule->unlock_date->format('Y-m-d')) }}"
                            class="bg-transparent text-white focus:outline-none border-none"
                            onchange="updatePreview(this.value)"
                        />
                    </div>

                    <img
                        src="{{ asset('img/letter.png') }}"
                        class="w-14 h-14 opacity-80 mx-auto sm:mx-0"
                    />
                </div>

                <p id="unlock-preview" class="text-[10px] text-gray-300 mb-4">
                    Current unlock date:
                    {{ $capsule->unlock_date->toFormattedDateString() }}
                </p>

                {{-- MESSAGE EDITOR --}}
                <div class="border border-gray-400 bg-white text-black mb-6">

                    {{-- TOOLBAR --}}
                    <div id="toolbar"
                         class="border-b border-gray-300 px-3 py-2 text-xs flex flex-wrap gap-3">
                        <button class="ql-bold font-bold">B</button>
                        <button class="ql-italic italic">I</button>
                        <button class="ql-underline underline">U</button>
                        <button class="ql-link">🔗</button>
                        <button class="ql-align" value=""></button>
                        <button class="ql-align" value="center"></button>
                        <button class="ql-align" value="right"></button>
                    </div>

                    {{-- EDITOR --}}
                    <div id="editor"
                         class="h-48 sm:h-56 p-4 text-sm"></div>

                    {{-- HIDDEN INPUT --}}
                    <input type="hidden" name="message" id="message">
                </div>

                {{-- ATTACHMENTS --}}
                <div class="mb-6">
                    <input
                        type="file"
                        name="images[]"
                        multiple
                        accept="image/*"
                        class="hidden"
                        id="imageInput"
                        onchange="previewImages(this)"
                    />

                    <p class="text-[10px] text-gray-300 mb-2">
                        Upload baru akan menggantikan semua gambar lama
                    </p>

                    <div class="grid grid-cols-5 gap-2 mb-3">
                        @for ($i = 0; $i < 5; $i++)
                            <label
                                for="imageInput"
                                class="h-16 sm:h-20 border border-gray-400
                                       flex items-center justify-center
                                       cursor-pointer text-xl text-gray-300
                                       hover:bg-gray-600 transition">
                                +
                            </label>
                        @endfor
                    </div>

                    <div id="image-preview"
                         class="flex gap-2 overflow-x-auto pb-2"></div>
                </div>

                {{-- ACTIONS --}}
                <div class="flex justify-between items-center gap-4">
                    <a href="{{ route('capsules.edit-mode') }}"
                       class="px-5 py-3 bg-red-600 text-[10px] sm:text-sm
                              hover:bg-red-700 transition">
                        Batal
                    </a>

                    <button type="submit"
                            class="p-3 bg-green-600 text-[10px] sm:text-sm
                                   hover:bg-green-700 transition">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
function updatePreview(date) {
    if (!date) return;
    const target = new Date(date);
    document.getElementById('unlock-preview').innerText =
        `Capsule will unlock on ${target.toDateString()}`;
}

function previewImages(input) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';

    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className =
                'h-16 sm:h-20 w-16 sm:w-20 object-cover border border-gray-400 flex-shrink-0';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}
</script>

<script>
const quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Rewrite a message for your future self...',
    modules: {
        toolbar: '#toolbar'
    }
});

function syncQuill() {
    const input = document.getElementById('message');
    const html = quill.root.innerHTML.trim();

    input.value =
        (html === '<p><br></p>' || html === '') ? '' : html;
}
</script>
</x-app-layout>
