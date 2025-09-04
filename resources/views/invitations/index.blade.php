@section('title', 'Undangan Saya')

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight playfair-display">
                {{ __('Undangan Saya') }}
            </h2>
            <a href="{{ route('templates.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Buat Undangan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($invitations->isEmpty())
                {{-- Tampilan jika belum ada undangan --}}
                <div class="bg-white text-center p-8 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Anda Belum Punya Undangan</h3>
                    <p class="text-gray-600 mb-6">Mari buat undangan pertama Anda yang tak terlupakan!</p>
                    <a href="{{ route('templates.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                        + Pilih Template Sekarang
                    </a>
                </div>
            @else
                {{-- Tampilan jika sudah ada undangan dengan kartu yang dirapikan --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($invitations as $invitation)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 flex flex-col">
                            
                            <!-- GAMBAR KARTU -->
                            <a href="{{ route('invitation.public.show', $invitation->slug) }}" target="_blank" class="block relative group">
                                <img src="{{ $invitation->hero_image ? asset('storage/' . $invitation->hero_image) : 'https://placehold.co/600x400/f4f7f9/334155?text=Wedding+Invitation' }}" 
                                     alt="Invitation Cover Image for {{ $invitation->groom_name }} & {{ $invitation->bride_name }}" class="w-full h-48 object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition-all duration-300"></div>
                            </a>

                            <!-- KONTEN UTAMA KARTU -->
                            <div class="p-6 flex-grow flex flex-col">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-bold text-lg text-slate-800 leading-tight playfair-display pr-2">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h3>
                                    <span class="text-xs font-semibold mt-1 flex-shrink-0 inline-block py-1 px-2.5 uppercase rounded-full {{ $invitation->status == 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $invitation->status }}
                                    </span>
                                </div>
                                
                                <!-- INFORMASI TANGGAL & LOKASI -->
                                <div class="space-y-2 text-sm text-slate-500 mb-5 flex-grow">
                                    @if($invitation->events->first())
                                        <p class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ \Carbon\Carbon::parse($invitation->events->first()->event_date)->isoFormat('dddd, D MMMM YYYY') }}
                                        </p>
                                        <p class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $invitation->events->first()->venue_name }}
                                        </p>
                                    @else
                                        <p class="text-slate-400 italic">Tanggal acara belum diatur.</p>
                                    @endif
                                </div>

                                <!-- BAGIAN AKSI (FOOTER KARTU) -->
                                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <a href="{{ route('invitation.public.show', $invitation->slug) }}" target="_blank" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Lihat Undangan
                                    </a>
                                    <div class="flex items-center space-x-2">
                                        <!-- Tombol Edit dengan Ikon -->
                                        <a href="{{ route('invitation.edit', $invitation) }}" class="p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-100 rounded-full transition-colors" title="Edit Undangan">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z"></path></svg>
                                        </a>
                                        <!-- Tombol Hapus dengan Ikon -->
                                        <form action="{{ route('invitation.destroy', $invitation) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus undangan ini secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-100 rounded-full transition-colors" title="Hapus Undangan">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
