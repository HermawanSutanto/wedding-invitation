<h3 class="text-xl font-semibold mb-6">Kelola Amplop Digital</h3>

<div class="space-y-6">
    @forelse($invitation->gifts as $gift)
    <div x-data class="border p-4 rounded-md bg-gray-50 relative" id="gift-{{ $gift->id }}">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="gift_{{ $gift->id }}_bank" class="block text-sm font-medium text-gray-700">Nama Bank / E-Wallet</label>
                <input type="text" name="gifts[{{ $gift->id }}][bank_name]" value="{{ old('gifts.'.$gift->id.'.bank_name', $gift->bank_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="gift_{{ $gift->id }}_number" class="block text-sm font-medium text-gray-700">Nomor Rekening / Telp</label>
                <input type="text" name="gifts[{{ $gift->id }}][account_number]" value="{{ old('gifts.'.$gift->id.'.account_number', $gift->account_number) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="gift_{{ $gift->id }}_holder" class="block text-sm font-medium text-gray-700">Atas Nama</label>
                <input type="text" name="gifts[{{ $gift->id }}][account_holder_name]" value="{{ old('gifts.'.$gift->id.'.account_holder_name', $gift->account_holder_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>
        <button type="button" 
            @click="
                if (confirm('Yakin ingin menghapus amplop ini?')) {
                    fetch('{{ route('gift.destroy', $gift) }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                        body: JSON.stringify({ _method: 'DELETE' })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            $el.closest('#gift-{{ $gift->id }}').remove();
                        } else {
                            alert('Gagal menghapus amplop.');
                        }
                    });
                }
            "
            class="absolute top-2 right-2 text-gray-400 hover:text-red-600 text-xl font-bold">&times;
        </button>
    </div>
    @empty
        <p class="text-sm text-gray-500">Belum ada amplop digital yang ditambahkan.</p>
    @endforelse
</div>

<div class="mt-8 pt-6 border-t">
    <h4 class="text-lg font-medium text-gray-800 mb-4">Tambah Amplop Baru</h4>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Bank / E-Wallet</label>
            <input type="text" name="new_gift[bank_name]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: BCA">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Rekening</label>
            <input type="text" name="new_gift[account_number]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="1234567890">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Atas Nama</label>
            <input type="text" name="new_gift[account_holder_name]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Budi Santoso">
        </div>
    </div>
</div>