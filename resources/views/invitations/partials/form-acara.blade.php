
<h3 class="text-xl font-semibold mb-6">Detail Acara (Akad, Resepsi, dll)</h3>

<div x-data="eventsManager()">
    {{-- Loop Dinamis Menggunakan Alpine.js --}}
    <template x-for="(event, index) in events" :key="index">
        <div class="border p-6 rounded-lg mb-6 last:mb-0 relative">
            <h4 class="font-medium text-lg mb-4 text-gray-800" x-text="event.title || 'Acara Baru'"></h4>

            {{-- Tombol Hapus Acara (hanya tampil jika ada lebih dari 1 acara) --}}
            <template x-if="events.length > 1">
                <button 
                    type="button" 
                    @click="removeEvent(index)"
                    class="absolute top-4 right-4 text-red-500 hover:text-red-700"
                    title="Hapus Acara Ini">
                    <svg xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
            </template>

            {{-- Hidden input untuk ID, agar saat update, Laravel tahu event mana yang diubah --}}
            <input type="hidden" :name="`events[${index}][id]`" :value="event.id">

            {{-- Baris 1: Judul & Tanggal --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label :for="`event_${index}_title`" class="block text-sm font-medium text-gray-700">Judul Acara</label>
                    <input type="text" :name="`events[${index}][title]`" :id="`event_${index}_title`" x-model="event.title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label :for="`event_${index}_date`" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" :name="`events[${index}][event_date]`" :id="`event_${index}_date`" x-model="event.event_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            {{-- Baris 2: Waktu Mulai & Nama Lokasi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label :for="`event_${index}_start_time`" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                    <input type="time" :name="`events[${index}][start_time]`" :id="`event_${index}_start_time`" x-model="event.start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label :for="`event_${index}_venue_name`" class="block text-sm font-medium text-gray-700">Nama Lokasi</label>
                    <input type="text" :name="`events[${index}][venue_name]`" :id="`event_${index}_venue_name`" x-model="event.venue_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            {{-- Sisa formulir (Alamat, Maps, dll.) mengikuti pola yang sama --}}
            <div class="mt-6">
                <label :for="`event_${index}_venue_address`" class="block text-sm font-medium text-gray-700">Alamat Lengkap Lokasi</label>
                <textarea :name="`events[${index}][venue_address]`" :id="`event_${index}_venue_address`" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" x-model="event.venue_address"></textarea>
            </div>
            
            <div class="mt-6">
                <label :for="`event_${index}_google_maps_link`" class="block text-sm font-medium text-gray-700">Link Google Maps</label>
                <input type="url" :name="`events[${index}][google_maps_link]`" :id="`event_${index}_google_maps_link`" x-model="event.google_maps_link" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="[https://maps.app.goo.gl/](https://maps.app.goo.gl/)...">
            </div>

            @if($invitation->package && $invitation->package->has_live_streaming)
            <div class="mt-6">
                <label :for="`event_${index}_livestream_link`" class="block text-sm font-medium text-gray-700">Link Live Streaming (Opsional)</label>
                <input type="url" :name="`events[${index}][livestream_link]`" :id="`event_${index}_livestream_link`" x-model="event.livestream_link" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: [https://youtube.com/live/](https://youtube.com/live/)...">
            </div>
            @endif

            {{-- Baris 6: Warna Dress Code (DIREVISI) --}}
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Warna Dress Code</label>
                <div x-data="{ newColor: '#000000' }" class="space-y-3">
                    
                    {{-- Hidden input sekarang mengambil value dari `event` di dalam loop --}}
                    <input type="hidden" :name="`events[${index}][dress_code_colors]`" :value="JSON.stringify(event.dress_code_colors)">

                    {{-- Display current colors dari `event` di dalam loop --}}
                    <template x-for="(color, colorIndex) in event.dress_code_colors" :key="colorIndex">
                        <div class="flex items-center space-x-2">
                            <span class="inline-block w-6 h-6 rounded-full border border-gray-300" :style="`background-color: ${color}`"></span>
                            <span x-text="color" class="text-sm font-mono"></span>
                            {{-- Tombol hapus sekarang memodifikasi `event.dress_code_colors` --}}
                            <button type="button" @click="event.dress_code_colors.splice(colorIndex, 1)" class="text-red-600 hover:text-red-800 text-xs">
                                Hapus
                            </button>
                        </div>
                    </template>

                    {{-- Input for new color --}}
                    <div class="flex items-center space-x-2 mt-2">
                        <input type="color" x-model="newColor" class="w-10 h-10 border rounded-md cursor-pointer">
                        {{-- Tombol tambah sekarang memodifikasi `event.dress_code_colors` --}}
                        <button type="button" @click="if (newColor && !event.dress_code_colors.includes(newColor)) { event.dress_code_colors.push(newColor); newColor = '#000000'; }" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                            Tambah Warna
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

    {{-- Tombol Tambah Acara --}}
    <div class="mt-6">
        <button 
            type="button" 
            @click="addEvent()"
            class="w-full text-center px-4 py-3 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300">
            + Tambah Acara
        </button>
    </div>
</div>

<script>
    function eventsManager() {
        return {
            // Inisialisasi data: Ambil dari 'old' input jika ada (setelah validasi gagal),
            // atau dari data asli. Pastikan `dress_code_colors` adalah array.
            events: @json(old('events', $invitation->events->toArray() ?? [])).map(event => {
                // Pastikan `dress_code_colors` selalu sebuah array
                if (typeof event.dress_code_colors === 'string') {
                    try {
                        event.dress_code_colors = JSON.parse(event.dress_code_colors);
                    } catch (e) {
                        event.dress_code_colors = [];
                    }
                } else if (!Array.isArray(event.dress_code_colors)) {
                    event.dress_code_colors = [];
                }
                return event;
            }),
            
            // Fungsi untuk menambah acara baru
            addEvent() {
                this.events.push({
                    id: null, // ID null karena ini acara baru
                    title: '',
                    event_date: '',
                    start_time: '',
                    venue_name: '',
                    venue_address: '',
                    google_maps_link: '',
                    livestream_link: '',
                    dress_code_colors: [] // Default array kosong
                });
            },

            // Fungsi untuk menghapus acara berdasarkan index-nya
            removeEvent(index) {
                this.events.splice(index, 1);
            }
        }
    }
</script>

