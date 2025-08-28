<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Detail Undangan') }}
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
                    <form action="{{ route('invitation.update', $invitation) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div x-show="tab === 'utama'">
                            <h3 class="text-xl font-semibold mb-6">Informasi Utama & Mempelai</h3>
                            
                            {{-- Mempelai Pria --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="groom_name" class="block text-sm font-medium text-gray-700">Nama Mempelai Pria</label>
                                    <input type="text" name="groom_name" id="groom_name" value="{{ old('groom_name', $invitation->groom_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label for="groom_info" class="block text-sm font-medium text-gray-700">Info Mempelai Pria</label>
                                    <input type="text" name="groom_info" id="groom_info" value="{{ old('groom_info', $invitation->groom_info) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Putra dari Bpk. ... & Ibu. ...">
                                </div>
                                <div class="mb-6">
                                <label for="groom_photo" class="block text-sm font-medium text-gray-700">Foto Mempelai Pria</label>
                                <input type="file" name="groom_photo" id="groom_photo" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                @if($invitation->groom_photo_path)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $invitation->groom_photo_path) }}" alt="Foto Mempelai Pria" class="h-24 w-24 object-cover rounded-md">
                                        <p class="text-xs text-gray-500 mt-1">Gambar saat ini. Upload file baru untuk menggantinya.</p>
                                    </div>
                                @endif
                            </div>
                            </div>
                            
                            {{-- Mempelai Wanita --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="bride_name" class="block text-sm font-medium text-gray-700">Nama Mempelai Wanita</label>
                                    <input type="text" name="bride_name" id="bride_name" value="{{ old('bride_name', $invitation->bride_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label for="bride_info" class="block text-sm font-medium text-gray-700">Info Mempelai Wanita</label>
                                    <input type="text" name="bride_info" id="bride_info" value="{{ old('bride_info', $invitation->bride_info) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Putri dari Bpk. ... & Ibu. ...">
                                </div>
                                <div class="mb-6">
                                <label for="bride_photo" class="block text-sm font-medium text-gray-700">Foto Mempelai Wanita</label>
                                <input type="file" name="bride_photo" id="bride_photo" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                @if($invitation->bride_photo_path)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $invitation->bride_photo_path) }}" alt="Foto Mempelai Wanita" class="h-24 w-24 object-cover rounded-md">
                                        <p class="text-xs text-gray-500 mt-1">Gambar saat ini. Upload file baru untuk menggantinya.</p>
                                    </div>
                                @endif
                            </div>
                            </div>

                             {{-- URL Slug --}}
                            <div class="mb-6">
                                <label for="slug" class="block text-sm font-medium text-gray-700">URL Undangan</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">nikahyuk.com/</span>
                                    <input type="text" name="slug" id="slug" value="{{ old('slug', $invitation->slug) }}" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md">
                                </div>
                            </div>

                            {{-- Kutipan --}}
                            <div class="mb-6">
                                <label for="quote" class="block text-sm font-medium text-gray-700">Kutipan / Ayat</label>
                                <textarea name="quote" id="quote" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('quote', $invitation->quote) }}</textarea>
                            </div>
                        </div>

                        <div x-show="tab === 'acara'">
                            <h3 class="text-xl font-semibold mb-6">Detail Acara (Akad, Resepsi, dll)</h3>
                            {{-- Kita akan looping event yang ada --}}
                            @foreach($invitation->events as $index => $event)
                            <div class="border p-4 rounded-md mb-4">
                                <h4 class="font-medium mb-2">{{ $event->title }}</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="event_{{ $index }}_title" class="block text-sm font-medium text-gray-700">Judul Acara</label>
                                        <input type="text" name="events[{{ $index }}][title]" id="event_{{ $index }}_title" value="{{ old('events.'.$index.'.title', $event->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>
                                    <div>
                                        <label for="event_{{ $index }}_date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                                        <input type="date" name="events[{{ $index }}][event_date]" id="event_{{ $index }}_date" value="{{ old('events.'.$index.'.event_date', $event->event_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>
                                    <div>
                                        <label for="event_{{ $index }}_start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                        <input type="time" name="events[{{ $index }}][start_time]" id="event_{{ $index }}_start_time" value="{{ old('events.'.$index.'.start_time', $event->start_time) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>
                                    <div>
                                        <label for="event_{{ $index }}_venue_name" class="block text-sm font-medium text-gray-700">Nama Lokasi</label>
                                        <input type="text" name="events[{{ $index }}][venue_name]" id="event_{{ $index }}_venue_name" value="{{ old('events.'.$index.'.venue_name', $event->venue_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <label for="event_{{ $index }}_venue_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap Lokasi</label>
                                    <textarea name="events[{{ $index }}][venue_address]" id="event_{{ $index }}_venue_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('events.'.$index.'.venue_address', $event->venue_address) }}</textarea>
                                </div>
                            </div>
                            @endforeach
                            {{-- Tombol untuk menambah acara baru bisa ditambahkan di sini dengan Alpine.js/Livewire --}}
                        </div>
                        <div x-show="tab === 'kisah'">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-semibold">Linimasa Kisah Cinta</h3>
                                <button type="button" class="text-sm text-indigo-600 hover:underline">
                                    + Tambah Cerita
                                </button>
                            </div>
                            
                            <div class="space-y-6">
                                @foreach($invitation->stories as $index => $story)
                                <div class="border p-4 rounded-md bg-gray-50">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="story_{{ $story->id }}_title" class="block text-sm font-medium text-gray-700">Judul Cerita</label>
                                            <input type="text" name="stories[{{ $story->id }}][title]" id="story_{{ $story->id }}_title" value="{{ old('stories.'.$story->id.'.title', $story->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        </div>
                                        <div>
                                            <label for="story_{{ $story->id }}_date" class="block text-sm font-medium text-gray-700">Tanggal/Waktu Cerita</label>
                                            <input type="text" name="stories[{{ $story->id }}][story_date]" id="story_{{ $story->id }}_date" value="{{ old('stories.'.$story->id.'.story_date', $story->story_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: Juni 2022">
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label for="story_{{ $story->id }}_description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                        <textarea name="stories[{{ $story->id }}][description]" id="story_{{ $story->id }}_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('stories.'.$story->id.'.description', $story->description) }}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div x-show="tab === 'galeri'">
                            <h3 class="text-xl font-semibold mb-6">Gambar Utama & Galeri Foto</h3>

                            <div class="mb-6 pb-6 border-b">
                                <label for="cover_image" class="block text-sm font-medium text-gray-700">Gambar Cover Depan</label>
                                <p class="text-xs text-gray-500 mt-1 mb-2">Rasio potret (9:16) disarankan. Akan di-crop ke ukuran 1080x1920px.</p>
                                <input type="file" name="cover_image" id="cover_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                @if($invitation->cover_image)
                                    <div class="mt-2">
                                        <p class="text-xs text-gray-600 mb-1">Gambar saat ini:</p>
                                        <img src="{{ asset('storage/' . $invitation->cover_image) }}" alt="Cover Image" class="h-48 object-cover rounded-md border">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-6 pb-6 border-b">
                                <label for="hero_image" class="block text-sm font-medium text-gray-700">Gambar Hero Utama</label>
                                <p class="text-xs text-gray-500 mt-1 mb-2">Rasio lanskap (16:9) disarankan. Akan di-crop ke ukuran 1920x1080px.</p>
                                <input type="file" name="hero_image" id="hero_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                @if($invitation->hero_image)
                                    <div class="mt-2">
                                        <p class="text-xs text-gray-600 mb-1">Gambar saat ini:</p>
                                        <img src="{{ asset('storage/' . $invitation->hero_image) }}" alt="Hero Image" class="h-32 object-cover rounded-md border w-auto">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-6">
                                <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Galeri (Bisa pilih banyak)</label>
                                <input type="file" name="gallery_images[]" id="gallery_images" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                            </div>

                            <h4 class="text-lg font-medium text-gray-800 mb-4">Foto Galeri Saat Ini:</h4>
                            @if($invitation->galleries->isEmpty())
                                <p class="text-gray-500">Belum ada foto di galeri.</p>
                            @else
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                    @foreach($invitation->galleries as $galleryImage)
                                        <div x-data class="relative group" id="gallery-image-{{ $galleryImage->id }}">
                                            <img src="{{ asset('storage/'. $galleryImage->image_path) }}" alt="Foto Galeri" class="w-full h-32 object-cover rounded-md">
                                            
                                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                
                                                {{-- GANTI <form> DENGAN <button> BIASA --}}
                                                <button 
                                                    type="button" 
                                                    @click="
                                                        if (confirm('Yakin ingin menghapus foto ini?')) {
                                                            fetch('{{ route('gallery.destroy', $galleryImage) }}', {
                                                                method: 'POST', // Method tetap POST karena kita akan spoofing DELETE
                                                                headers: {
                                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                                    'Content-Type': 'application/json'
                                                                },
                                                                body: JSON.stringify({
                                                                    _method: 'DELETE'
                                                                })
                                                            })
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                if (data.success) {
                                                                    // Hilangkan gambar dari halaman secara langsung
                                                                    $el.closest('#gallery-image-{{ $galleryImage->id }}').remove();
                                                                } else {
                                                                    alert('Gagal menghapus foto.');
                                                                }
                                                            });
                                                        }
                                                    "
                                                    class="text-white text-2xl hover:text-red-500 transition-colors">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div x-show="tab === 'amplop'">
                            @include('invitations.partials.form-amplop')
                        </div>


                        <div class="mt-8 pt-5 border-t">
                            <div class="flex justify-end">
                                <button type="submit" onclick="" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>