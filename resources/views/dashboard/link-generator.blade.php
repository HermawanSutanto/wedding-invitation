<!-- Public Invitation Link -->
<div 
    x-data="{
        link: '{{ route('invitation.public.show', $invitation->slug) }}',
        buttonText: 'Copy',
        copyToClipboard() {
            navigator.clipboard.writeText(this.link).then(() => {
                this.buttonText = 'Tersalin!';
                setTimeout(() => { this.buttonText = 'Copy' }, 2000);
            });
        }
    }"
    class="flex items-center space-x-2"
>
    <div class="flex-grow">
        <label class="text-xs text-gray-500">Public Invitation Link</label>
        <input type="text" :value="link" class="w-full px-3 py-1.5 text-sm text-gray-700 border rounded-lg bg-gray-100" readonly>
    </div>
    <button type="button" @click="copyToClipboard" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 w-28 text-center self-end">
        <span x-text="buttonText"></span>
    </button>
</div>

<!-- Create Link for Specific Guest -->
<div 
    x-data="{ 
        guestName: '', 
        baseUrl: '{{ route('invitation.public.show', $invitation->slug) }}',
        buttonText: 'Copy',
        get finalUrl() {
            if (!this.guestName.trim()) return this.baseUrl;
            return this.baseUrl + '?to=' + encodeURIComponent(this.guestName.trim());
        },
        copyToClipboard() {
            navigator.clipboard.writeText(this.finalUrl).then(() => {
                this.buttonText = 'Tersalin!';
                setTimeout(() => { this.buttonText = 'Copy' }, 2000);
            });
        }
    }"
    class="flex items-center space-x-2"
>
    <div class="flex-grow">
        <label class="text-xs text-gray-500">Create Link for Specific Guest</label>
        <input type="text" x-model="guestName" placeholder="Ketik nama tamu..." class="w-full px-3 py-1.5 text-sm text-gray-700 border rounded-lg">
    </div>
    <div class="flex-grow">
        <label class="text-xs text-gray-500">Sharable Link</label>
        <input type="text" :value="finalUrl" class="w-full px-3 py-1.5 text-sm text-gray-700 border rounded-lg bg-gray-100" readonly>
    </div>
    <button type="button" @click="copyToClipboard" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 w-28 text-center self-end">
        <span x-text="buttonText"></span>
    </button>
</div>