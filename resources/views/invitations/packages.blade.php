<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pilih Paket untuk Template "{{ $template->name }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($packages as $package)
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col">
                        <h3 class="text-2xl font-bold text-center text-indigo-600">{{ $package->name }}</h3>
                        <p class="text-4xl font-bold text-center my-4">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        <ul class="space-y-2 text-gray-600 mb-6 flex-grow">
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>{{ $package->max_invitations }} Tamu Undangan</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Galeri Foto</li>
                            {{-- Anda bisa menambahkan fitur lain di sini --}}
                        </ul>
                        
                        <form action="{{ route('invitation.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="template_id" value="{{ $template->id }}">
                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700">
                                Pilih Paket Ini
                            </button>
                        </form>
                    </div>
                @empty
                    <p>Tidak ada paket yang tersedia saat ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>