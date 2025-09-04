<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Paket Undangan') }}
            </h2>
            <a href="{{ route('packages.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 ...">
                + Tambah Paket Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                   <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Paket</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fitur Utama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($packages as $package)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $package->name }}</div>
                                            @if($package->is_featured)
                                                <div class="text-xs text-indigo-600 font-semibold">Unggulan</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                                            @if($package->value)
                                                <div class="text-xs text-gray-500 line-through">Rp {{ number_format($package->value, 0, ',', '.') }}</div>
                                            @endif
                                        </td>
                                        
                                        {{-- ## PERUBAHAN UTAMA DI SINI ## --}}
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                                                <span class="font-semibold text-gray-700">{{ $package->count_gallery }}</span> <span>Foto Galeri</span>
                                                <span class="font-semibold text-gray-700">{{ $package->max_guests }}</span> <span>Tamu</span>
                                                
                                                <span class="{{ $package->has_love_story ? 'text-green-600' : 'text-red-500' }}">
                                                    <i class="fas {{ $package->has_love_story ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                                </span>
                                                <span>Kisah Cinta</span>
                                                
                                                <span class="{{ $package->has_music ? 'text-green-600' : 'text-red-500' }}">
                                                    <i class="fas {{ $package->has_music ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                                </span>
                                                <span>Musik</span>
                                                
                                                <span class="{{ $package->has_rsvp ? 'text-green-600' : 'text-red-500' }}">
                                                    <i class="fas {{ $package->has_rsvp ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                                </span>
                                                <span>RSVP</span>

                                                <span class="{{ $package->has_live_streaming ? 'text-green-600' : 'text-red-500' }}">
                                                    <i class="fas {{ $package->has_live_streaming ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                                </span>
                                                <span>Live Stream</span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            @if($package->is_active)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        {{-- GANTI LINK HAPUS DENGAN FORM INI --}}
                                            <form action="{{ route('packages.destroy', $package) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-4 text-red-600 hover:text-red-900">
                                                    Hapus
                                                </button>
                                            </form>                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <p class="text-gray-500">Belum ada paket yang ditambahkan.</p>
                                        </td>
                                    </tr>                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>