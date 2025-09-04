<h3 class="text-xl font-semibold mb-6">Detail Acara (Akad, Resepsi, dll)</h3>

@foreach($invitation->events as $index => $event)
<div class="border p-6 rounded-lg mb-6 last:mb-0">
    <h4 class="font-medium text-lg mb-4 text-gray-800">{{ $event->title }}</h4>

    {{-- Baris 1: Judul & Tanggal --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="event_{{ $index }}_title" class="block text-sm font-medium text-gray-700">Judul Acara</label>
            <input type="text" name="events[{{ $index }}][title]" id="event_{{ $index }}_title" value="{{ old('events.'.$index.'.title', $event->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div>
            <label for="event_{{ $index }}_date" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="events[{{ $index }}][event_date]" id="event_{{ $index }}_date" value="{{ old('events.'.$index.'.event_date', $event->event_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
    </div>

    {{-- Baris 2: Waktu Mulai & Nama Lokasi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div>
            <label for="event_{{ $index }}_start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
            <input type="time" name="events[{{ $index }}][start_time]" id="event_{{ $index }}_start_time" value="{{ old('events.'.$index.'.start_time', $event->start_time) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div>
            <label for="event_{{ $index }}_venue_name" class="block text-sm font-medium text-gray-700">Nama Lokasi</label>
            <input type="text" name="events[{{ $index }}][venue_name]" id="event_{{ $index }}_venue_name" value="{{ old('events.'.$index.'.venue_name', $event->venue_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
    </div>

    {{-- Baris 3: Alamat Lengkap Lokasi --}}
    <div class="mt-6">
        <label for="event_{{ $index }}_venue_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap Lokasi</label>
        <textarea name="events[{{ $index }}][venue_address]" id="event_{{ $index }}_venue_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('events.'.$index.'.venue_address', $event->venue_address) }}</textarea>
    </div>
    
    {{-- Baris 4: Link Google Maps --}}
    <div class="mt-6">
        <label for="event_{{ $index }}_google_maps_link" class="block text-sm font-medium text-gray-700">Link Google Maps</label>
        <input type="url" name="events[{{ $index }}][google_maps_link]" id="event_{{ $index }}_google_maps_link" value="{{ old('events.'.$index.'.google_maps_link', $event->google_maps_link) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="https://maps.app.goo.gl/...">
    </div>

    {{-- Baris 5: Live Streaming (Kondisional) --}}
    @if($invitation->package && $invitation->package->has_live_streaming)
    <div class="mt-6">
        <label for="event_{{ $index }}_livestream_link" class="block text-sm font-medium text-gray-700">Link Live Streaming (Opsional)</label>
        <input type="url" name="events[{{ $index }}][livestream_link]" id="event_{{ $index }}_livestream_link" value="{{ old('events.'.$index.'.livestream_link', $event->livestream_link) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: https://youtube.com/live/...">
    </div>
    @endif
    
    {{-- Baris 6: Warna Dress Code (Kondisional) --}}
   <div class="mt-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Warna Dress Code</label>
        <div 
            x-data="{ 
                colors: @json(old('events.'.$index.'.dress_code_colors', $event->dress_code_colors ?? [])),
                newColor: '#000000',
                addAColor() {
                    if (this.newColor && !this.colors.includes(this.newColor)) {
                        this.colors.push(this.newColor);
                        this.newColor = '#000000'; // Reset color picker
                    }
                },
                removeColor(index) {
                    this.colors.splice(index, 1);
                }
            }" 
            id="event_{{ $index }}_dress_code_colors_wrapper"
            class="space-y-3"
        >
            {{-- Hidden input to send all colors as a JSON string to the backend --}}
            <input type="hidden" name="events[{{ $index }}][dress_code_colors]" :value="JSON.stringify(colors)">

            {{-- Display current colors --}}
            <template x-for="(color, colorIndex) in colors" :key="colorIndex">
                <div class="flex items-center space-x-2">
                    <span class="inline-block w-6 h-6 rounded-full border border-gray-300" :style="`background-color: ${color}`"></span>
                    <span x-text="color" class="text-sm font-mono"></span>
                    <button type="button" @click="removeColor(colorIndex)" class="text-red-600 hover:text-red-800 text-xs">
                        Hapus
                    </button>
                </div>
            </template>

            {{-- Input for new color --}}
            <div class="flex items-center space-x-2 mt-2">
                <input type="color" x-model="newColor" class="w-10 h-10 border rounded-md cursor-pointer">
                <button type="button" @click="addAColor()" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                    Tambah Warna
                </button>
            </div>
            @error('events.'.$index.'.dress_code_colors')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
@endforeach