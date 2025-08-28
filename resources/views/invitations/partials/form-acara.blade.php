<h3 class="text-xl font-semibold mb-6">Detail Acara (Akad, Resepsi, dll)</h3>
    {{-- Kita akan looping event yang ada --}}
    @foreach($invitation->events as $index => $event)
    <div class="border p-4 rounded-md mb-4">
        <h4 class="font-medium mb-2">{{ $event->title }}</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="event_{{ $index }}_title" class="block text-sm font-medium text-gray-700">Judul Acara</label>
                <input type="text" name="events[{{ $index }}][title]" id="event_{{ $index }}_title" value="{{ old('events.'.$index.'.title', $event->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="event_{{ $index }}_date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="events[{{ $index }}][event_date]" id="event_{{ $index }}_date" value="{{ old('events.'.$index.'.event_date', $event->event_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="event_{{ $index }}_start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                <input type="time" name="events[{{ $index }}][start_time]" id="event_{{ $index }}_start_time" value="{{ old('events.'.$index.'.start_time', $event->start_time) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="event_{{ $index }}_venue_name" class="block text-sm font-medium text-gray-700">Nama Lokasi</label>
                <input type="text" name="events[{{ $index }}][venue_name]" id="event_{{ $index }}_venue_name" value="{{ old('events.'.$index.'.venue_name', $event->venue_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>
        <div class="mt-6">
            <label for="event_{{ $index }}_venue_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap Lokasi</label>
            <textarea name="events[{{ $index }}][venue_address]" id="event_{{ $index }}_venue_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('events.'.$index.'.venue_address', $event->venue_address) }}</textarea>
        </div>
        <div class="mt-6">
            <label for="event_{{ $index }}_gmaps_link" class="block text-sm font-medium text-gray-700">Link Google Maps</label>
            <input type="url" name="events[{{ $index }}][google_maps_link]" id="event_{{ $index }}_gmaps_link" value="{{ old('events.'.$index.'.google_maps_link', $event->google_maps_link) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="https://maps.app.goo.gl/xxxx">
            <p class="mt-1 text-xs text-gray-500">Salin dan tempel link 'Share' dari Google Maps.</p>
        </div>
    </div>
    @endforeach
    {{-- Tombol untuk menambah acara baru bisa ditambahkan di sini dengan Alpine.js/Livewire --}}
