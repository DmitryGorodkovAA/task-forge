<template>
    <div>
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl dark:bg-gray-800">
                <h2 class="mb-4 text-xl font-bold text-gray-800 dark:text-white">Новая задача</h2>

                <form @submit.prevent="submitTask">
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"> Название </label>
                        <input v-model="form.title" type="text" required class="w-full rounded-xl border p-2 dark:bg-gray-700 dark:text-white" />
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"> Дата </label>
                        <input v-model="form.date" type="date" required class="w-full rounded-xl border p-2 dark:bg-gray-700 dark:text-white" />
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"> Описание (необязательно) </label>
                        <textarea
                            v-model="form.description"
                            rows="3"
                            class="w-full rounded-xl border p-2 dark:bg-gray-700 dark:text-white"
                        ></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"> Доска </label>
                        <select v-model="form.board_id" class="w-full rounded-xl border p-2 dark:bg-gray-700 dark:text-white">
                            <option v-for="board in boards" :key="board.id" :value="board.id">
                                {{ board.name }}
                            </option>
                        </select>
                    </div>

                    <div class="mt-5 flex justify-end gap-3">
                        <button type="button" class="rounded-xl border px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700" @click="closeModal">
                            Отмена
                        </button>
                        <button type="submit" class="rounded-xl bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

defineProps({

})

const showModal = ref(false);

const boards = ref([
    { id: 1, name: 'Доска 1' },
    { id: 2, name: 'Доска 2' },
    { id: 3, name: 'Доска 3' },
]);

const form = ref({
    title: '',
    date: '',
    description: '',
    board_id: boards.value[0].id,
});

function closeModal() {
    showModal.value = false;
}

function submitTask() {
    router.post('/tasks', form.value, {
        onSuccess: () => {
            closeModal();
            form.value = { title: '', date: '', description: '', board_id: boards.value[0].id };
        },
        onError: (errors) => {
            console.error(errors);
        },
    });
}
</script>
