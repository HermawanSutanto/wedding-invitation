@props(['messages' => []])

<div
    x-show="open"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-60"
    style="display: none;"
    x-cloak
>
    <!-- Konten Modal -->
    <div
        @click.outside="open = false"
        x-show="open"
        x-transition
        class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 p-6"
    >
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900">Oops! Terjadi Kesalahan</h3>
                <div class="mt-2 text-sm text-gray-600">
                    <p class="mb-2">Mohon perbaiki kesalahan berikut:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <template x-for="message in messages">
                            <li x-text="message"></li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-5 sm:mt-6">
            <button @click="open = false" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 sm:text-sm">
                Mengerti
            </button>
        </div>
    </div>
</div>