<template>
    <div class="mx-auto mb-10 flex w-full items-center justify-between bg-white p-5 pt-4 text-black shadow dark:bg-gray-900 dark:text-white">
        <div class="flex items-center justify-between">
            <img class="mr-4 w-[72px]" src="res/icons/logo.png" />
            <h1 class="mx-2 text-lg">Доска 1</h1>
            <h1 class="mx-2 text-lg">Доска 2</h1>
            <h1 class="mx-2 text-lg">Доска 3</h1>
        </div>

        <div>
            <button
                class="ease-in-linear min-w-[120px] cursor-pointer rounded-2xl border bg-sky-300 px-4 py-2 transition duration-300 hover:bg-sky-400 dark:bg-blue-500 dark:hover:bg-blue-600"
                @click="toggleTheme"
            >
                {{ isDark ? 'Тёмная' : 'Светлая' }}
            </button>
        </div>
    </div>
    <div>
        <slot></slot>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'

const isDark = ref(document.documentElement.classList.contains('dark'))

function toggleTheme() {
    isDark.value = !isDark.value

    if (isDark.value) {
        document.documentElement.classList.add('dark')
        localStorage.setItem('theme', 'dark')
    } else {
        document.documentElement.classList.remove('dark')
        localStorage.setItem('theme', 'light')
    }
}

onMounted(() => {
    const savedTheme = localStorage.getItem('theme')
    if (savedTheme) {
        document.documentElement.classList.toggle('dark', savedTheme === 'dark')
        isDark.value = savedTheme === 'dark'
    }
})
</script>
