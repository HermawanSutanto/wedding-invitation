<div
    x-data="{ show: false, message: '' }"
    x-init="
        $watch('show', value => {
            if (value) {
                setTimeout(() => { show = false }, 3000); // Sembunyikan setelah 3 detik
            }
        });
        
        @if (session('success'))
            message = '{{ session('success') }}';
            show = true;
        @endif
    "
    x-show="show"
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-5 right-5 z-50 p-4 rounded-md bg-green-500 text-white shadow-lg"
    style="display: none;"
    x-cloak
>
    <div class="flex items-center">
        <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span x-text="message"></span>
    </div>
</div>