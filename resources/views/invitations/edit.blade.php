<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Detail Undangan') }}
        </h2>
    </x-slot>

    {{-- 1. GANTI x-data DENGAN LOGIKA BARU --}}
    <div class="py-12" x-data="{ 
        tab: 'utama',
        submitting: false,
        submitForm() {
            if (this.$refs.editForm.checkValidity()) {
                this.submitting = true;
                this.$refs.editForm.submit();
            } else {
                this.showClientSideErrors();
            }
        },
        showClientSideErrors() {
            const invalidFields = Array.from(this.$refs.editForm.querySelectorAll(':invalid'));
            
            if (invalidFields.length > 0) {
                // Ambil semua pesan error dari browser
                let messages = invalidFields.map(field => {
                    const label = document.querySelector(`label[for='${field.id}']`);
                    return label ? `${label.textContent}: ${field.validationMessage}` : field.validationMessage;
                });

                // Set state global Alpine untuk memicu modal
                errorMessages = messages;
                errorModalOpen = true;

                // Pindah ke tab yang berisi error pertama
                const firstInvalid = invalidFields[0];
                const tabPane = firstInvalid.closest('[x-show]');
                if (tabPane) {
                    const tabName = tabPane.getAttribute('x-show').match(/'(.*?)'/)[1];
                    if (tabName) {
                        this.tab = tabName;
                        setTimeout(() => firstInvalid.focus(), 150);
                    }
                }
            }
        }
    }">
        <div x-init="
            {{-- Inisialisasi modal jika ada error dari server --}}
            @if($errors->any())
                errorMessages = {{ json_encode($errors->all()) }};
                errorModalOpen = true;
            @endif
        ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 overflow-x-auto no-scrollbar" aria-label="Tabs">
                    <a href="#" @click.prevent="tab = 'utama'"
                       :class="{ 'border-indigo-500 text-indigo-600': tab === 'utama', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'utama' }"
                       class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Informasi Utama
                    </a>
                    <a href="#" @click.prevent="tab = 'acara'"
                       :class="{ 'border-indigo-500 text-indigo-600': tab === 'acara', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'acara' }"
                       class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Detail Acara
                    </a>
                    @if($invitation->package && $invitation->package->has_love_story)
                    <a href="#" @click.prevent="tab = 'kisah'"
                       :class="{ 'border-indigo-500 text-indigo-600': tab === 'kisah', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'kisah' }"
                       class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Detail Kisah
                    </a>
                    @endif
                    @if($invitation->package && $invitation->package->count_gallery > 0)
                    <a href="#" @click.prevent="tab = 'galeri'"
                        :class="{ 'border-indigo-500 text-indigo-600': tab === 'galeri', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'galeri' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Galeri Foto
                    </a>
                    @endif
                    @if($invitation->package && $invitation->package->has_rsvp)
                    <a href="#" @click.prevent="tab = 'amplop'"
                        :class="{ 'border-indigo-500 text-indigo-600': tab === 'amplop', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'amplop' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Amplop Digital
                    </a>
                    @endif
                </nav>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                     @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                            <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form x-ref="editForm" action="{{ route('invitation.update', $invitation) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- Konten Tab Sekarang Memanggil Partial --}}
                        <div x-show="tab === 'utama'">  @include('invitations.partials.form-utama') </div>
                        <div x-show="tab === 'acara'">  @include('invitations.partials.form-acara') </div>
                        @if($invitation->package && $invitation->package->has_love_story)   
                        <div x-show="tab === 'kisah'">  @include('invitations.partials.form-kisah') </div>
                        @endif
                        @if($invitation->package && $invitation->package->count_gallery > 0)
                        <div x-show="tab === 'galeri'"> @include('invitations.partials.form-galeri') </div>
                        @endif
                        @if($invitation->package && $invitation->package->has_rsvp)
                        <div x-show="tab === 'amplop'"> @include('invitations.partials.form-amplop') </div>
                        @endif



                        <div class="mt-8 pt-5 border-t">
                            <div class="flex justify-end">
                                {{-- 3. UBAH TOMBOL MENJADI type="button" DAN PANGGIL FUNGSI BARU --}}
                                <button type="button" 
                                        @click="submitForm"
                                        :disabled="submitting"
                                        class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 disabled:opacity-50">
                                    <span x-show="!submitting">Simpan Perubahan</span>
                                    <span x-show="submitting">Menyimpan...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>