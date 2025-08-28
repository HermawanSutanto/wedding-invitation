<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Detail Undangan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'utama' }">
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
                    <a href="#" @click.prevent="tab = 'kisah'"
                       :class="{ 'border-indigo-500 text-indigo-600': tab === 'kisah', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'kisah' }"
                       class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Detail Kisah
                    </a>
                    <a href="#" @click.prevent="tab = 'galeri'"
                        :class="{ 'border-indigo-500 text-indigo-600': tab === 'galeri', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'galeri' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Galeri Foto
                    </a>
                    <a href="#" @click.prevent="tab = 'amplop'"
                        :class="{ 'border-indigo-500 text-indigo-600': tab === 'amplop', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'amplop' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Amplop Digital
                    </a>
                    
                    {{-- Tambahkan tab lain di sini jika perlu --}}
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
                    <form action="{{ route('invitation.update', $invitation) }}" method="POST" enctype="multipart/form-data" x-data="{ submitting: false }" @submit="submitting = true">
                        @csrf
                        @method('PUT')

                        {{-- Konten Tab Sekarang Memanggil Partial --}}
                        <div x-show="tab === 'utama'">  @include('invitations.partials.form-utama') </div>
                        <div x-show="tab === 'acara'">  @include('invitations.partials.form-acara') </div>
                        <div x-show="tab === 'kisah'">  @include('invitations.partials.form-kisah') </div>
                        <div x-show="tab === 'galeri'"> @include('invitations.partials.form-galeri') </div>
                        <div x-show="tab === 'amplop'"> @include('invitations.partials.form-amplop') </div>



                        <div class="mt-8 pt-5 border-t">
                            <div class="flex justify-end">
                                {{-- Modifikasi tombol ini --}}
                                <button type="submit" 
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