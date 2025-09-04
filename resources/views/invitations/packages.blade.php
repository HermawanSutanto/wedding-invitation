@section('title', 'Pilih Paket')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight playfair-display">
            Pilih Paket untuk Template "{{ $template->name }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-lg text-gray-600">Selesaikan langkah terakhir dengan memilih paket yang sesuai dengan kebutuhan Anda.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                @forelse ($packages as $package)
                    <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 {{ $package->is_featured ? 'border-2 border-indigo-500' : '' }}">
                        
                        @if($package->is_featured)
                            <div class="text-center mb-4">
                                <span class="px-4 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full uppercase">Pilihan Favorit</span>
                            </div>
                        @endif

                        <h3 class="text-2xl font-bold text-center text-indigo-600 playfair-display">{{ $package->name }}</h3>
                        
                        <div class="text-center my-4">
                            @if($package->value && $package->value > $package->price)
                                <p class="text-lg text-gray-500 line-through">Rp {{ number_format($package->value, 0, ',', '.') }}</p>
                            @endif
                            <p class="text-5xl font-bold text-gray-800">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        </div>

                        <ul class="space-y-3 text-gray-600 mb-6 flex-grow border-t pt-6">
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 w-5 mr-3"></i>{{ $package->max_guests }} Tamu Undangan</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 w-5 mr-3"></i>{{ $package->count_gallery }} Foto Galeri</li>
                            <li class="flex items-center {{ $package->has_love_story ? '' : 'text-gray-400' }}">
                                <i class="fas {{ $package->has_love_story ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-400' }} w-5 mr-3"></i>Kisah Cinta
                            </li>
                            <li class="flex items-center {{ $package->has_music ? '' : 'text-gray-400' }}">
                                <i class="fas {{ $package->has_music ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-400' }} w-5 mr-3"></i>Musik Latar
                            </li>
                            <li class="flex items-center {{ $package->has_rsvp ? '' : 'text-gray-400' }}">
                                <i class="fas {{ $package->has_rsvp ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-400' }} w-5 mr-3"></i>RSVP & Buku Tamu
                            </li>
                            <li class="flex items-center {{ $package->has_live_streaming ? '' : 'text-gray-400' }}">
                                <i class="fas {{ $package->has_live_streaming ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-400' }} w-5 mr-3"></i>Live Streaming
                            </li>
                        </ul>
                        
                        <form action="{{ route('invitation.store') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="template_id" value="{{ $template->id }}">
                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition shadow-md hover:shadow-lg">
                                Pilih Paket Ini
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-full bg-white text-center p-8 rounded-2xl shadow-lg">
                        <p class="text-gray-500">Tidak ada paket yang tersedia saat ini. Silakan hubungi admin.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>