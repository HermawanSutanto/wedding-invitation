<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Cek apakah pengguna sudah punya undangan --}}
            @if ($invitation)
                {{-- JIKA SUDAH PUNYA UNDANGAN, TAMPILKAN INI --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-8">
                            <div class="p-6 bg-cover bg-center" style="background-image: url('{{ $invitation->hero_image ? asset('storage/' . $invitation->hero_image) : 'https://images.unsplash.com/photo-1595736250103-05992f055955?q=80&w=2070&auto=format&fit=crop' }}');">
                                <div class="bg-black bg-opacity-50 p-6 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm text-gray-200">Undangan Pernikahan untuk:</p>
                                            <h3 class="text-3xl font-bold text-white font-serif">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h3>
                                        </div>
                                        <span class="text-xs font-semibold inline-block py-1 px-3 uppercase rounded-full {{ $invitation->status == 'published' ? 'bg-green-200 text-green-600' : 'bg-yellow-200 text-yellow-600' }}">
                                            {{ ucfirst($invitation->status) }}
                                        </span>
                                    </div>
                                    @if($invitation->events->first())
                                        <div class="mt-4 text-gray-200">
                                            <p class="font-semibold">Tanggal Acara: {{ \Carbon\Carbon::parse($invitation->events->first()->event_date)->isoFormat('D MMMM YYYY') }}</p>
                                            <p class="text-sm">
                                                @if(\Carbon\Carbon::parse($invitation->events->first()->event_date)->isFuture())
                                                    (Tinggal {{ \Carbon\Carbon::parse($invitation->events->first()->event_date)->diffInDays(now()) }} hari lagi)
                                                @else
                                                    (Acara telah berlangsung)
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6 border-t border-gray-200">
                                 <p class="text-sm text-gray-600 mb-2">Link Undangan Publik:</p>
                                 <div 
                                    x-data="{
                                        link: '{{ route('invitation.public.show', $invitation->slug) }}',
                                        buttonText: 'Copy',
                                        copyToClipboard() {
                                            navigator.clipboard.writeText(this.link).then(() => {
                                                this.buttonText = 'Tersalin!';
                                                setTimeout(() => {
                                                    this.buttonText = 'Copy';
                                                }, 2000); // Kembalikan teks setelah 2 detik
                                            });
                                        }
                                    }"
                                    class="flex items-center space-x-2"
                                >
                                    <input type="text" :value="link" class="w-full px-3 py-2 text-gray-700 border rounded-lg bg-gray-100" readonly>
                                    <button type="button" @click="copyToClipboard" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 w-28 text-center">
                                        <span x-text="buttonText"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-md rounded-lg">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold mb-4">Statistik Tamu (RSVP)</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                                    <div class="p-4 bg-blue-50 rounded-lg">
                                        <p class="text-3xl font-bold text-blue-600">{{ $totalRsvp }}</p>
                                        <p class="text-sm text-gray-600">Total Konfirmasi</p>
                                    </div>
                                    <div class="p-4 bg-green-50 rounded-lg">
                                        <p class="text-3xl font-bold text-green-600">{{ $attendingCount }}</p>
                                        <p class="text-sm text-gray-600">Akan Hadir</p>
                                    </div>
                                    <div class="p-4 bg-red-50 rounded-lg">
                                        <p class="text-3xl font-bold text-red-600">{{ $notAttendingCount }}</p>
                                        <p class="text-sm text-gray-600">Tidak Hadir</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-white overflow-hidden shadow-md rounded-lg">
                           <div class="p-6">
                               <h4 class="text-xl font-semibold mb-4">Aksi Cepat</h4>
                               <div class="flex flex-col space-y-3">
                                   <a href="{{ route('invitation.public.show', $invitation->slug) }}" target="_blank" class="w-full text-center px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600">Lihat Undangan</a>
                                   <a href="{{ route('invitation.edit', $invitation) }}" class="w-full text-center px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Edit Undangan</a>
                                   <a href="{{ route('invitation.index') }}" class="w-full text-center px-4 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-800">Kelola Semua Undangan</a>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- JIKA BELUM PUNYA UNDANGAN, TAMPILKAN INI --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600 mb-6">Anda belum memiliki undangan. Mari buat yang pertama!</p>
                        <a href="{{ route('templates.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700">
                            + Buat Undangan Pertama Anda
                        </a>
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</x-app-layout>