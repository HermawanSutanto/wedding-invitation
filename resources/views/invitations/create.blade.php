<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Undangan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'utama' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
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
                </nav>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <form action="{{ route('invitations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- TAB INFORMASI UTAMA --}}
                        <div x-show="tab === 'utama'">
                            <h3 class="text-xl font-semibold mb-6">Informasi Utama & Mempelai</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="groom_name" class="block text-sm font-medium text-gray-700">Nama Mempelai Pria</label>
                                    <input type="text" name="groom_name" id="groom_name" value="{{ old('groom_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label for="groom_info" class="block text-sm font-medium text-gray-700">Info Mempelai Pria</label>
                                    <input type="text" name="groom_info" id="groom_info" value="{{ old('groom_info') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Putra dari Bpk. ... & Ibu. ...">
                                </div>
                                <div>
                                    <label for="groom_photo" class="block text-sm font-medium text-gray-700">Foto Mempelai Pria</label>
                                    <input type="file" name="groom_photo" id="groom_photo" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="bride_name" class="block text-sm font-medium text-gray-700">Nama Mempelai Wanita</label>
                                    <input type="text" name="bride_name" id="bride_name" value="{{ old('bride_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label for="bride_info" class="block text-sm font-medium text-gray-700">Info Mempelai Wanita</label>
                                    <input type="text" name="bride_info" id="bride_info" value="{{ old('bride_info') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Putri dari Bpk. ... & Ibu. ...">
                                </div>
                                <div>
                                    <label for="bride_photo" class="block text-sm font-medium text-gray-700">Foto Mempelai Wanita</label>
                                    <input type="file" name="bride_photo" id="bride_photo" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="slug" class="block text-sm font-medium text-gray-700">URL Undangan</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">nikahyuk.com/</span>
                                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="quote" class="block text-sm font-medium text-gray-700">Kutipan / Ayat</label>
                                <textarea name="quote" id="quote" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('quote') }}</textarea>
                            </div>
                        </div>

                        {{-- TAB ACARA --}}
                        <div x-show="tab === 'acara'">
                            <h3 class="text-xl font-semibold mb-6">Detail Acara</h3>
                            <div class="border p-4 rounded-md mb-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Judul Acara</label>
                                        <input type="text" name="events[0][title]" value="{{ old('events.0.title', 'Akad Nikah') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                                        <input type="date" name="events[0][event_date]" value="{{ old('events.0.event_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                        <input type="time" name="events[0][start_time]" value="{{ old('events.0.start_time') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Lokasi</label>
                                        <input type="text" name="events[0][venue_name]" value="{{ old('events.0.venue_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700">Alamat Lengkap Lokasi</label>
                                    <textarea name="events[0][venue_address]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('events.0.venue_address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- TAB KISAH --}}
                        <div x-show="tab === 'kisah'">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-semibold">Linimasa Kisah Cinta</h3>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="border p-4 rounded-md bg-gray-50">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Judul Cerita</label>
                                            <input type="text" name="stories[0][title]" value="{{ old('stories.0.title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Tanggal/Waktu Cerita</label>
                                            <input type="text" name="stories[0][story_date]" value="{{ old('stories.0.story_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: Juni 2022">
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                        <textarea name="stories[0][description]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('stories.0.description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TAB GALERI --}}
                        <div x-show="tab === 'galeri'">
                            <h3 class="text-xl font-semibold mb-6">Gambar Utama & Galeri Foto</h3>

                            <div class="mb-6 pb-6 border-b">
                                <label for="cover_image" class="block text-sm font-medium text-gray-700">Gambar Cover Depan</label>
                                <input type="file" name="cover_image" id="cover_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                            </div>

                            <div class="mb-6 pb-6 border-b">
                                <label for="hero_image" class="block text-sm font-medium text-gray-700">Gambar Hero Utama</label>
                                <input type="file" name="hero_image" id="hero_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                            </div>

                            <div class="mb-6">
                                <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Galeri (Bisa pilih banyak)</label>
                                <input type="file" name="gallery_images[]" id="gallery_images" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                            </div>
                        </div>

                        <div class="mt-8 pt-5 border-t">
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Simpan Undangan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
