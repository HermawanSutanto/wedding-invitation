<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Paket Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    
                    <form action="{{ route('packages.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Paket</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: Paket Gold" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Harga Jual (Rp)</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: 150000" required>
                            </div>

                            <div>
                                <label for="value" class="block text-sm font-medium text-gray-700">Harga Asli / Coret (Rp)</label>
                                <input type="number" name="value" id="value" value="{{ old('value') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Opsional, contoh: 200000">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="count_gallery" class="block text-sm font-medium text-gray-700">Jumlah Galeri Foto</label>
                            <input type="number" name="count_gallery" id="count_gallery" value="{{ old('count_gallery', 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: 10" required>
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