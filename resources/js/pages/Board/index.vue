<template>
    <div class="flex h-[calc(100vh-100px)] bg-red-300">
        <div class="flex max-h-screen w-[15%] max-w-[250px] min-w-[150px] flex-col items-center overflow-auto bg-gray-300">
            <div class="w-full p-1" v-for="board in props.boards" :key="board.id">
                <div class="w-full cursor-pointer rounded-2xl border-3 bg-white p-4 shadow-lg dark:bg-gray-800" :style="{ borderColor: board.color }">
                    <a :href="route('boards.index', board.id)">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="inline-block h-3 w-3 rounded-full" :style="{ backgroundColor: board.color }"></span>
                        </div>

                        <h2 class="line-clamp-2 max-h-20 text-xl font-bold text-gray-900 dark:text-gray-100">
                            {{ board.name }}
                        </h2>

                        <p class="line-clamp-3 text-sm text-gray-600 dark:text-gray-400">
                            {{ board.description }}
                        </p>
                    </a>
                </div>
            </div>
            <button
                class="max-w-[80%] transform rounded-2xl bg-gradient-to-r from-blue-500 to-purple-500 px-6 py-3 font-semibold text-white shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:brightness-110 dark:from-blue-600 dark:to-purple-700 dark:focus:ring-blue-500"
            >
                Создать доску
            </button>
        </div>
        <div class="flex flex-1 items-center justify-center overflow-hidden">
            <div class="flex h-full w-full flex-col pr-1 pl-1">
                <header class="flex items-center justify-between border-b border-gray-200 px-6 py-4 lg:flex-none">
                    <h1 class="text-base leading-6 font-semibold text-gray-900">
                        <time datetime="2022-01">January 2022</time>
                    </h1>
                    <div class="flex items-center">
                        <div class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch">
                            <div class="flex min-w-[200px] justify-between rounded-lg bg-gray-100 p-1 shadow dark:bg-gray-800">
                                <button
                                    @click="prevMonth"
                                    class="flex h-7 w-7 items-center justify-center rounded bg-white shadow transition hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600"
                                >
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            fill-rule="evenodd"
                                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>

                                <span class="content-center text-sm font-semibold text-gray-900 dark:text-gray-100">
                                    {{ monthNames[currentMonth] }} {{ currentYear }}
                                </span>

                                <button
                                    @click="nextMonth"
                                    class="flex h-7 w-7 items-center justify-center rounded bg-white shadow transition hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600"
                                >
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            fill-rule="evenodd"
                                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="hidden md:ml-4 md:flex md:items-center">
                            <div class="relative">
                                <button
                                    type="button"
                                    @click="toggleDataSelectMenu"
                                    class="flex cursor-pointer items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 ring-inset hover:bg-gray-50"
                                    id="menu-button"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                >
                                    Month view
                                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                                <div
                                    id="date-selector-menu"
                                    class="ring-opacity-5 absolute right-0 z-10 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black focus:outline-none"
                                    role="menu"
                                    aria-orientation="vertical"
                                    aria-labelledby="menu-button"
                                    tabindex="-1"
                                    :style="{ visibility: componentsStyle.dateSelectorMenu.visibility }"
                                >
                                    <div class="py-1" role="none">
                                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0"
                                            >Day view</a
                                        >
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1"
                                            >Week view</a
                                        >
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2"
                                            >Month view</a
                                        >
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3"
                                            >Year view</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="ml-6 h-6 w-px bg-gray-300"></div>
                            <button
                                type="button"
                                class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                            >
                                Add event
                            </button>
                        </div>
                        <div class="relative ml-6 md:hidden">
                            <button
                                type="button"
                                class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500"
                                id="menu-0-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                <span class="sr-only">Open menu</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z"
                                    />
                                </svg>
                            </button>
                            <div
                                class="ring-opacity-5 absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black focus:outline-none"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="menu-0-button"
                                tabindex="-1"
                            >
                                <div class="py-1" role="none">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-0-item-0"
                                        >Create event</a
                                    >
                                </div>
                                <div class="py-1" role="none">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-0-item-1"
                                        >Go to today</a
                                    >
                                </div>
                                <div class="py-1" role="none">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-0-item-2"
                                        >Day view</a
                                    >
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-0-item-3"
                                        >Week view</a
                                    >
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-0-item-4"
                                        >Month view</a
                                    >
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-0-item-5"
                                        >Year view</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <Calendar :month="currentMonth + 1" :year="currentYear" :tasks="props.tasks" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import Calendar from '@/components/mainComponents/Calendar.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import { route } from 'ziggy-js';

const date = new Date();

defineOptions({
    layout: MainLayout,
});

const isDark = ref(document.documentElement.classList.contains('dark'));

const props = defineProps({
    boards: {
        type: Array,
        required: true,
    },
    tasks: {
        type: Array,
        required: true,
    },
});

console.log(props.boards);

const componentsStyle = reactive({
    dateSelectorMenu: {
        visibility: 'hidden',
    },
});

const monthNames = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

const currentMonth = ref(date.getMonth());
const currentYear = ref(date.getFullYear());

function toggleDataSelectMenu() {
    componentsStyle.dateSelectorMenu.visibility = componentsStyle.dateSelectorMenu.visibility === 'visible' ? 'hidden' : 'visible';
}

function nextMonth() {
    if (currentMonth.value === 11) {
        currentMonth.value = 0;
        currentYear.value += 1;
    } else {
        currentMonth.value += 1;
    }
}

function prevMonth() {
    if (currentMonth.value === 0) {
        currentMonth.value = 11;
        currentYear.value -= 1;
    } else {
        currentMonth.value -= 1;
    }
}

// mounted
onMounted(() => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.classList.toggle('dark', savedTheme === 'dark');
        isDark.value = savedTheme === 'dark';
    }
});
</script>
