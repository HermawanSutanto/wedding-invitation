@section('title', 'Pilih Template')

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight playfair-display">
                {{ __('Pilih Desain Template') }}
            </h2>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('templates.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    + Tambah Template Baru
                </a> 
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="text-center mb-12">
                <p class="text-lg text-gray-600">Pilih desain yang paling Anda sukai untuk memulai perjalanan Anda.</p>
            </div> --}}
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                
                @forelse ($templates as $template)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $template->path_preview) }}" alt="{{ $template->name }}" class="w-full h-96 object-cover object-top transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-6">
                                <h3 class="font-bold text-2xl text-white playfair-display">{{ $template->name }}</h3>
                                <p class="text-white/80 text-sm mt-1">{{ $template->description }}</p>
                            </div>
                        </div>
                        <div class="p-4 bg-gray-50 flex justify-between items-center">
                            <a href="{{ route('templates.preview', $template->url) }}" target="_blank" class="text-sm font-semibold text-gray-600 hover:text-indigo-600">
                                Lihat Pratinjau
                            </a>
                            <div class="flex space-x-2">
                                <a href="{{ route('invitation.packages', $template) }}" class="px-5 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 shadow-md hover:shadow-lg transition">
                                    Pilih
                                </a>
                                @if(auth()->user()->isAdmin())
                                    <form action="{{ route('templates.destroy', $template) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus template ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 bg-red-100 text-red-600 text-sm rounded-lg hover:bg-red-200" title="Hapus Template">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl shadow-lg">
                        <p class="text-gray-500">Belum ada template yang tersedia saat ini.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>