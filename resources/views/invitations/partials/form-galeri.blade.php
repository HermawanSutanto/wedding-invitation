<h3 class="text-xl font-semibold mb-6">Gambar Utama & Galeri Foto</h3>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6 pb-6 border-b">
    <div x-data="{ imageUrl: '{{ $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : '' }}' }">
        <label for="cover_image" class="block text-sm font-medium text-gray-700">Gambar Cover Depan</label>
        <p class="text-xs text-gray-500 mt-1 mb-2">Rasio potret (9:16) disarankan.</p>
        
        <label for="cover_image" class="cursor-pointer mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-indigo-400 transition">
            <div class="space-y-1 text-center">
                <img x-show="imageUrl" :src="imageUrl" alt="Preview Cover" class="mx-auto h-48 object-cover rounded-md border">
                <div x-show="!imageUrl" class="mx-auto h-48 flex flex-col items-center justify-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    <span class="mt-2 block text-sm text-indigo-600 hover:text-indigo-800">Upload file</span>
                </div>
            </div>
            <input type="file" name="cover_image" id="cover_image" class="sr-only" @change="imageUrl = URL.createObjectURL($event.target.files[0])">
        </label>
    </div>

    <div x-data="{ imageUrl: '{{ $invitation->hero_image ? asset('storage/' . $invitation->hero_image) : '' }}' }">
        <label for="hero_image" class="block text-sm font-medium text-gray-700">Gambar Hero Utama</label>
        <p class="text-xs text-gray-500 mt-1 mb-2">Rasio lanskap (16:9) disarankan.</p>

         <label for="hero_image" class="cursor-pointer mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-indigo-400 transition">
            <div class="space-y-1 text-center">
                <img x-show="imageUrl" :src="imageUrl" alt="Preview Hero" class="mx-auto h-48 object-cover rounded-md border">
                <div x-show="!imageUrl" class="mx-auto h-48 flex flex-col items-center justify-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    <span class="mt-2 block text-sm text-indigo-600 hover:text-indigo-800">Upload file</span>
                </div>
            </div>
            <input type="file" name="hero_image" id="hero_image" class="sr-only" @change="imageUrl = URL.createObjectURL($event.target.files[0])">
        </label>
    </div>
</div>

<div 
    x-data="{ previews: [] }" 
    class="mb-6"
>
    <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Galeri (Bisa pilih banyak)</label>
    
    <label for="gallery_images" class="cursor-pointer mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-indigo-400 transition">
        <div class="space-y-1 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            <span class="mt-2 block text-sm text-indigo-600 hover:text-indigo-800">Pilih foto untuk galeri</span>
        </div>
    </label>
    <input 
        type="file" 
        name="gallery_images[]" 
        id="gallery_images" 
        multiple 
        class="sr-only" 
        @change="previews = Array.from($event.target.files).map(file => ({ url: URL.createObjectURL(file), name: file.name }))"
    >

    <div x-show="previews.length > 0" class="mt-4">
        <h4 class="text-sm font-medium text-gray-800 mb-2">Pratinjau Foto Baru:</h4>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <template x-for="preview in previews" :key="preview.name">
                <div class="relative">
                    <img :src="preview.url" class="w-full h-32 object-cover rounded-md border">
                </div>
            </template>
        </div>
    </div>
</div>

<div x-data="{ galleries: {{ json_encode($invitation->galleries) }} }">
    <h4 class="text-lg font-medium text-gray-800 mb-4 border-t pt-6">Foto Galeri Saat Ini:</h4>
    
    <p x-show="galleries.length === 0" class="text-gray-500">Belum ada foto di galeri.</p>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
        <template x-for="(galleryImage, index) in galleries" :key="galleryImage.id">
            <div class="relative group">
                <img :src="`/storage/${galleryImage.image_path}`" alt="Foto Galeri" class="w-full h-32 object-cover rounded-md">
                
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <button 
                        type="button" 
                        @click="
                            if (confirm('Yakin ingin menghapus foto ini?')) {
                                fetch(`/gallery/${galleryImage.id}`, {
                                    method: 'POST',
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ _method: 'DELETE' })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        galleries.splice(index, 1); // Hapus item dari array
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
        </template>
    </div>
</div>