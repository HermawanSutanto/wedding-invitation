<div 
    x-data="{ 
        stories: {{ json_encode($stories) }},
        draggingIndex: null,

        dragStart(event, index) {
            this.draggingIndex = index;
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('text/plain', index); 
            event.target.classList.add('opacity-50');
        },

        dragEnd(event) {
            event.target.classList.remove('opacity-50');
            this.draggingIndex = null;
        },

        dragOver(event, index) {
            event.preventDefault();
            if (this.draggingIndex !== null && this.draggingIndex !== index) {
                event.currentTarget.classList.add('bg-indigo-100');
            }
        },

        dragLeave(event) {
            event.currentTarget.classList.remove('bg-indigo-100');
        },

        drop(event, dropIndex) {
            event.preventDefault();
            event.currentTarget.classList.remove('bg-indigo-100');
            if (this.draggingIndex !== null && this.draggingIndex !== dropIndex) {
                const movedItem = this.stories.splice(this.draggingIndex, 1)[0];
                this.stories.splice(dropIndex, 0, movedItem);
                this.draggingIndex = null;
            }
        },

        moveUp(index) {
            if (index > 0) {
                const item = this.stories.splice(index, 1)[0];
                this.stories.splice(index - 1, 0, item);
            }
        },

        moveDown(index) {
            if (index < this.stories.length - 1) {
                const item = this.stories.splice(index, 1)[0];
                this.stories.splice(index + 1, 0, item);
            }
        }
    }"
>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold">Linimasa Kisah Cinta</h3>
        <button 
            type="button" 
            @click="stories.push({ id: '', title: '', story_date: '', description: '' })"
            class="text-sm text-indigo-600 hover:underline">
            + Tambah Cerita
        </button>
    </div>

    <div class="space-y-4">
        <template x-for="(story, index) in stories" :key="story.id || index">
            <div 
                class="border p-4 rounded-md bg-gray-50 relative flex items-start space-x-3"
                draggable="true"
                @dragstart="dragStart($event, index)"
                @dragend="dragEnd($event)"
                @dragover="dragOver($event, index)"
                @dragleave="dragLeave($event)"
                @drop="drop($event, index)"
                :class="{ 'border-indigo-400': draggingIndex === index }"
            >
                <div class="drag-handle cursor-move text-gray-400 hover:text-gray-600 pt-2 hidden md:block">
                    <!-- hanya muncul di desktop -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="5" r="1"></circle>
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="12" cy="19" r="1"></circle>
                    </svg>
                </div>

                <div class="flex-grow">
                    <input type="hidden" :name="`stories[${index}][id]`" x-model="story.id">
                    <input type="hidden" :name="`stories[${index}][order]`" :value="index">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label :for="`story_${index}_title`" class="block text-sm font-medium text-gray-700">Judul Cerita</label>
                            <input type="text" :name="`stories[${index}][title]`" :id="`story_${index}_title`" x-model="story.title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label :for="`story_${index}_date`" class="block text-sm font-medium text-gray-700">Tanggal/Waktu Cerita</label>
                            <input type="text" :name="`stories[${index}][story_date]`" :id="`story_${index}_date`" x-model="story.story_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: Juni 2022">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label :for="`story_${index}_description`" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea :name="`stories[${index}][description]`" :id="`story_${index}_description`" x-model="story.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                </div>

                <!-- Tombol naik/turun hanya tampil di mobile -->
                <div class="flex flex-col items-center space-y-2 ml-2">
                    <button type="button" @click="stories.splice(index, 1)" class="text-gray-400 hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <div class="flex flex-col space-y-1 md:hidden">
                        <button type="button" @click="moveUp(index)" :disabled="index === 0" class="px-1 text-sm bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed">↑</button>
                        <button type="button" @click="moveDown(index)" :disabled="index === stories.length - 1" class="px-1 text-sm bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed">↓</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
