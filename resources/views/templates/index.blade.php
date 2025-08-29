<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pilih Template Undangan') }}
            </h2>
            {{-- TOMBOL BARU --}}
            @if(auth()->user()->isAdmin())
                <a href="{{ route('templates.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                + Tambah Template Baru
                </a> 
            @endif
            
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-6 text-gray-600">Pilih desain yang paling Anda sukai untuk memulai.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        
                        @forelse ($templates as $template)
                            <div class="border rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col">
                                <img src="{{ asset('storage/' . $template->path_preview) }}" alt="{{ $template->name }}" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-4 flex-grow flex flex-col">
                                    <h3 class="font-semibold flex-grow" href="{{ route('templates.' . $template->url) }}">{{ $template->name }}</h3>
                                    <div class="mt-4 flex justify-end items-center space-x-2">
                                        {{-- Tombol Pilih --}}
                                        {{-- Ganti tombol "Pilih" Anda dengan kode ini --}}

                                        {{-- <form action="{{ route('invitation.createFromTemplate', $template) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                                                Pilih
                                            </button>
                                        </form> --}}
                                        <a href="{{ route('invitation.packages', $template) }}" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                                            Pilih
                                        </a>
                                        {{-- Form untuk Tombol Hapus --}}
                                        @if(auth()->user()->isAdmin())
                                        <form action="{{ route('templates.destroy', $template) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus template ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        @empty
                                {{-- ... (bagian ini tetap sama) ... --}}
                            {{-- Tampilan jika tidak ada template di database --}}
                            <div class="col-span-full text-center py-10">
                                <p class="text-gray-500">Belum ada template yang tersedia saat ini.</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>                                                                                                     