<x-app-layout>
    <div class="w-full flex justify-center">
        <div
            class="
                min-h-screen
                w-full
                max-w-6xl
                bg-[#1f1f1f]
                border border-gray-500
                font-['Press_Start_2P']
                py-8
                px-3
                sm:px-6
            "
        >
            <div class="max-w-4xl mx-auto space-y-8">

                {{-- PROFILE INFO --}}
                <div class="bg-gray-200 border-2 border-gray-500 p-4 sm:p-6">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- UPDATE PASSWORD --}}
                <div class="bg-gray-200 border-2 border-gray-500 p-4 sm:p-6">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- DELETE ACCOUNT --}}
                <div class="bg-gray-200 border-2 border-gray-500 p-4 sm:p-6">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
