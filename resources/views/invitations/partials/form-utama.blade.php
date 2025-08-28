<h3 class="text-xl font-semibold mb-6">Informasi Utama & Mempelai</h3>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <div class="space-y-4">
        <h4 class="text-lg font-medium text-gray-700 border-b pb-2">Mempelai Pria</h4>
        
        <div x-data="{ imageUrl: '{{ $invitation->groom_photo_path ? asset('storage/' . $invitation->groom_photo_path) : '' }}' }">
            <label for="groom_photo" class="block text-sm font-medium text-gray-700 mb-1">Foto Mempelai Pria</label>
            <div class="mt-1">
                <label for="groom_photo" class="cursor-pointer block w-32 h-32 rounded-full bg-gray-100 border-2 border-dashed flex items-center justify-center text-gray-400 hover:bg-gray-200 hover:border-gray-400 transition">
                    <img x-show="imageUrl" :src="imageUrl" alt="Preview Foto Pria" class="w-full h-full object-cover rounded-full">
                    <div x-show="!imageUrl" class="text-center">
                        <svg class="mx-auto h-10 w-10" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="mt-1 text-xs">Pilih Foto</span>
                    </div>
                </label>
                <input type="file" name="groom_photo" id="groom_photo" class="sr-only" @change="imageUrl = URL.createObjectURL($event.target.files[0])">
            </div>
        </div>
        
        <div>
            <label for="groom_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="groom_name" id="groom_name" value="{{ old('groom_name', $invitation->groom_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div>
            <label for="groom_info" class="block text-sm font-medium text-gray-700">Informasi Tambahan</label>
            <input type="text" name="groom_info" id="groom_info" value="{{ old('groom_info', $invitation->groom_info) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: Putra Pertama dari Bpk. ... & Ibu. ...">
        </div>
    </div>

    <div class="space-y-4">
        <h4 class="text-lg font-medium text-gray-700 border-b pb-2">Mempelai Wanita</h4>
        
        <div x-data="{ imageUrl: '{{ $invitation->bride_photo_path ? asset('storage/' . $invitation->bride_photo_path) : '' }}' }">
            <label for="bride_photo" class="block text-sm font-medium text-gray-700 mb-1">Foto Mempelai Wanita</label>
            <div class="mt-1">
                <label for="bride_photo" class="cursor-pointer block w-32 h-32 rounded-full bg-gray-100 border-2 border-dashed flex items-center justify-center text-gray-400 hover:bg-gray-200 hover:border-gray-400 transition">
                    <img x-show="imageUrl" :src="imageUrl" alt="Preview Foto Wanita" class="w-full h-full object-cover rounded-full">
                    <div x-show="!imageUrl" class="text-center">
                        <svg class="mx-auto h-10 w-10" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="mt-1 text-xs">Pilih Foto</span>
                    </div>
                </label>
                <input type="file" name="bride_photo" id="bride_photo" class="sr-only" @change="imageUrl = URL.createObjectURL($event.target.files[0])">
            </div>
        </div>
        
        <div>
            <label for="bride_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="bride_name" id="bride_name" value="{{ old('bride_name', $invitation->bride_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div>
            <label for="bride_info" class="block text-sm font-medium text-gray-700">Informasi Tambahan</label>
            <input type="text" name="bride_info" id="bride_info" value="{{ old('bride_info', $invitation->bride_info) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: Putri Kedua dari Bpk. ... & Ibu. ...">
        </div>
    </div>
</div>

{{-- URL Slug & Kutipan --}}
<div class="pt-6 mt-6 border-t">
    <div class="mb-6">
        <label for="slug" class="block text-sm font-medium text-gray-700">URL Undangan</label>
        <div class="mt-1 flex rounded-md shadow-sm">
            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">{{ str_replace(['http://', 'https://'], '', url('/undangan/')) }}/</span>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $invitation->slug) }}" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md">
        </div>
    </div>
    <div class="mb-6">
        <label for="quote" class="block text-sm font-medium text-gray-700">Kutipan / Ayat</label>
        <textarea name="quote" id="quote" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('quote', $invitation->quote) }}</textarea>
    </div>
     <div class="mb-6">
        <label for="quote_source" class="block text-sm font-medium text-gray-700">Sumber Kutipan</label>
        <input type="text" name="quote_source" id="quote_source" value="{{ old('quote_source', $invitation->quote_source) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: QS. Ar-Rum: 21">
    </div>
</div>