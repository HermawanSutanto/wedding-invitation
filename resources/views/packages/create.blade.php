<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Paket Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    
                    <form action="{{ route('packages.store') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Paket</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700">Harga Jual (Rp)</label>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                </div>
                                <div>
                                    <label for="value" class="block text-sm font-medium text-gray-700">Harga Asli / Coret (Rp)</label>
                                    <input type="number" name="value" id="value" value="{{ old('value') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Opsional">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t">
                             <h3 class="text-lg font-medium text-gray-900 mb-4">Batasan Fitur</h3>
                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="count_gallery" class="block text-sm font-medium text-gray-700">Jumlah Galeri Foto</label>
                                    <input type="number" name="count_gallery" id="count_gallery" value="{{ old('count_gallery', 5) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                </div>
                                <div>
                                    <label for="max_guests" class="block text-sm font-medium text-gray-700">Jumlah Tamu Undangan</label>
                                    <input type="number" name="max_guests" id="max_guests" value="{{ old('max_guests', 100) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                </div>
                             </div>
                        </div>

                        <div class="mt-8 pt-6 border-t">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Opsi Fitur</h3>
                            <div class="space-y-4">
                                <div class="flex items-start"><div class="flex items-center h-5"><input id="has_love_story" name="has_love_story" type="checkbox" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"></div><div class="ml-3 text-sm"><label for="has_love_story" class="font-medium text-gray-700">Aktifkan Fitur Kisah Cinta</label></div></div>
                                <div class="flex items-start"><div class="flex items-center h-5"><input id="has_music" name="has_music" type="checkbox" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"></div><div class="ml-3 text-sm"><label for="has_music" class="font-medium text-gray-700">Aktifkan Fitur Musik Latar</label></div></div>
                                <div class="flex items-start"><div class="flex items-center h-5"><input id="has_rsvp" name="has_rsvp" type="checkbox" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"></div><div class="ml-3 text-sm"><label for="has_rsvp" class="font-medium text-gray-700">Aktifkan Fitur RSVP & Buku Tamu</label></div></div>
                                <div class="flex items-start"><div class="flex items-center h-5"><input id="has_live_streaming" name="has_live_streaming" type="checkbox" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"></div><div class="ml-3 text-sm"><label for="has_live_streaming" class="font-medium text-gray-700">Aktifkan Fitur Live Streaming</label></div></div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Tampilan</h3>
                            <div class="space-y-4">
                                <div class="flex items-start"><div class="flex items-center h-5"><input id="is_featured" name="is_featured" type="checkbox" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"></div><div class="ml-3 text-sm"><label for="is_featured" class="font-medium text-gray-700">Jadikan Paket Unggulan (Featured)</label></div></div>
                                <div class="flex items-start"><div class="flex items-center h-5"><input id="is_active" name="is_active" type="checkbox" value="1" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"></div><div class="ml-3 text-sm"><label for="is_active" class="font-medium text-gray-700">Aktifkan Paket Ini</label></div></div>
                            </div>
                        </div>
                        
                        <div class="mt-8 pt-5 border-t">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('packages.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md text-sm font-medium">
                                    Batal
                                </a>
                                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Simpan Paket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>