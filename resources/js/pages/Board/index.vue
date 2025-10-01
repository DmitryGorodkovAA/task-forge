<template>
    <div v-bind:class="componentsStyle.mainContainer.styleClasses">
        <div class="flex w-[15%] max-w-[250px] min-w-[150px] flex-col items-center overflow-auto bg-gray-300">
            <div class="w-full p-1" v-for="board in props.boards" :key="board.id">
                <div class="w-full cursor-pointer rounded-2xl border-3 bg-white p-4 shadow-lg dark:bg-gray-800" :style="{ borderColor: board.color }">
                    <Link :href="route('boards.index', board.id)">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="inline-block h-3 w-3 rounded-full" :style="{ backgroundColor: board.color }"></span>
                        </div>

                        <h2 class="line-clamp-2 max-h-20 text-xl font-bold text-gray-900 dark:text-gray-100">
                            {{ board.name }}
                        </h2>

                        <p class="line-clamp-3 text-sm text-gray-600 dark:text-gray-400">
                            {{ board.description }}
                        </p>
                    </Link>

                    <!--                    <a :href="route('boards.index', board.id)">-->
                    <!--                        -->
                    <!--                    </a>-->
                </div>
            </div>
            <button
                @click="toggleCreateNewBoardForm"
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
                                @click="toggleCreateNewTaskForm"
                                type="button"
                                class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                            >
                                Создать таску
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

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" v-bind:style="{ visibility: componentsStyle.newTaskForm.visibility }">
        <div class="mx-auto max-w-2xl rounded-2xl border border-gray-100 bg-white/80 p-6 shadow-lg backdrop-blur-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Создать задачу</h3>
                <button
                    class="inline-flex items-center gap-2 rounded-2xl bg-sky-700 px-3 py-1.5 text-sm font-medium text-white hover:bg-sky-800 focus:ring-2 focus:ring-sky-300 focus:outline-none"
                    @click="toggleCreateNewTaskForm"
                    type="button"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Скрыть
                </button>
            </div>

            <form @submit.prevent="submitCreateTaskForm" class="mt-5">
                <div class="grid grid-cols-1 gap-4">
                    <label class="flex flex-col">
                        <span class="mb-1 text-sm font-medium text-gray-700">Название <span class="text-red-500">*</span></span>
                        <input
                            v-model="taskForm.name"
                            type="text"
                            placeholder="Например: Подготовить отчёт"
                            class="block w-full rounded-lg border border-gray-200 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 transition focus:border-sky-400 focus:ring-2 focus:ring-sky-200 focus:outline-none"
                            :class="{ 'border-red-300 ring-2 ring-red-200': taskForm.errors && taskForm.errors.name }"
                            aria-invalid="taskForm.errors && taskForm.errors.name ? 'true' : 'false'"
                        />
                        <p v-if="taskForm.errors && taskForm.errors.name" class="mt-1 text-xs text-red-600">
                            {{ taskForm.errors.name[0] }}
                        </p>
                    </label>

                    <label class="flex flex-col">
                        <span class="mb-1 text-sm font-medium text-gray-700">Описание</span>
                        <input
                            v-model="taskForm.description"
                            type="text"
                            placeholder="Короткое описание (необязательно)"
                            class="block w-full rounded-lg border border-gray-200 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 transition focus:border-sky-400 focus:ring-2 focus:ring-sky-200 focus:outline-none"
                            :class="{ 'border-red-300 ring-2 ring-red-200': taskForm.errors && taskForm.errors.description }"
                        />
                        <p v-if="taskForm.errors && taskForm.errors.description" class="mt-1 text-xs text-red-600">
                            {{ taskForm.errors.description[0] }}
                        </p>
                    </label>

                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex flex-col">
                            <span class="mb-1 text-sm font-medium text-gray-700">Срок</span>
                            <input
                                v-model="taskForm.due_date"
                                type="date"
                                class="block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-gray-800 focus:border-sky-400 focus:ring-2 focus:ring-sky-200 focus:outline-none"
                                :class="{ 'border-red-300 ring-2 ring-red-200': taskForm.errors && taskForm.errors.due_date }"
                            />
                            <p v-if="taskForm.errors && taskForm.errors.due_date" class="mt-1 text-xs text-red-600">
                                {{ taskForm.errors.due_date[0] }}
                            </p>
                        </label>

                        <label class="flex flex-col">
                            <span class="mb-1 text-sm font-medium text-gray-700">Доска <span class="text-red-500">*</span></span>
                            <select
                                v-model.number="taskForm.board_id"
                                class="block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-gray-800 focus:border-sky-400 focus:ring-2 focus:ring-sky-200 focus:outline-none"
                                :class="{ 'border-red-300 ring-2 ring-red-200': taskForm.errors && taskForm.errors.board_id }"
                            >
                                <option disabled value="">Выберите доску</option>
                                <option v-for="board in props.boards" :key="board.id" :value="board.id">
                                    {{ board.name }}
                                </option>
                            </select>
                            <p v-if="taskForm.errors && taskForm.errors.board_id" class="mt-1 text-xs text-red-600">
                                {{ taskForm.errors.board_id[0] }}
                            </p>
                        </label>
                    </div>

                    <div
                        v-if="
                            taskForm.errors &&
                            Object.keys(taskForm.errors).length &&
                            !taskForm.errors.name &&
                            !taskForm.errors.description &&
                            !taskForm.errors.due_date &&
                            !taskForm.errors.board_id
                        "
                        class="rounded-md border border-red-100 bg-red-50 p-3 text-sm text-red-700"
                    >
                        Произошла ошибка. Пожалуйста, проверьте введённые данные.
                    </div>

                    <div class="mt-2 flex items-center justify-between gap-3">
                        <button
                            type="submit"
                            class="inline-flex items-center gap-3 rounded-xl bg-gradient-to-r from-sky-600 to-sky-500 px-4 py-2 text-white shadow hover:from-sky-700 hover:to-sky-600 focus:ring-2 focus:ring-sky-300 focus:outline-none disabled:cursor-not-allowed disabled:opacity-60"
                            :disabled="taskForm.processing"
                        >
                            <svg
                                v-if="taskForm.processing"
                                class="h-4 w-4 animate-spin"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                            </svg>
                            <span>{{ taskForm.processing ? 'Создаётся...' : 'Создать' }}</span>
                        </button>

                        <button
                            type="button"
                            @click="
                                () => {
                                    taskForm.reset('name', 'description', 'due_date');
                                    taskForm.board_id = props.selectedBoard ? props.selectedBoard.id : '';
                                }
                            "
                            class="rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            Очистить
                        </button>

                        <p class="ml-auto text-xs text-gray-500">Поля с <span class="text-red-500">*</span> обязательны</p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div
        class="-translate-y1/2 absolute top-1/2 left-1/2 -translate-x-1/2"
        :style="{ visibility: componentsStyle.newBoardForm.visibility }"
    >
        <div class="mx-auto max-w-2xl min-w-[500px] rounded-2xl border border-gray-100 bg-white/80 p-6 shadow-lg backdrop-blur-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Создать доску</h3>
                <button
                    class="inline-flex items-center gap-2 rounded-2xl bg-sky-700 px-3 py-1.5 text-sm font-medium text-white hover:bg-sky-800 focus:ring-2 focus:ring-sky-300 focus:outline-none"
                    @click="toggleCreateNewBoardForm"
                    type="button"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Скрыть
                </button>
            </div>
        <form @submit.prevent="submitCreateBoardForm" class="mt-5">
            <div class="grid grid-cols-1 gap-4">
                <label class="flex flex-col">
                    <span class="mb-1 text-sm font-medium text-gray-700">Название <span class="text-red-500">*</span></span>
                    <input
                        v-model="boardForm.name"
                        type="text"
                        placeholder="Например: Работа"
                        class="block w-full rounded-lg border border-gray-200 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 transition focus:border-sky-400 focus:ring-2 focus:ring-sky-200 focus:outline-none"
                        :class="{ 'border-red-300 ring-2 ring-red-200': boardForm.errors && boardForm.errors.name }"
                        aria-invalid="boardForm.errors && boardForm.errors.name ? 'true' : 'false'"
                    />
                    <p v-if="taskForm.errors && taskForm.errors.name" class="mt-1 text-xs text-red-600">
                        {{ taskForm.errors.name[0] }}
                    </p>
                </label>
                <label class="flex flex-col">
                    <span class="mb-1 text-sm font-medium text-gray-700">Описание <span class="text-red-500">*</span></span>
                    <input
                        v-model="boardForm.description"
                        type="text"
                        placeholder="Например: Отмечаю тут задачи по работе"
                        class="block w-full rounded-lg border border-gray-200 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 transition focus:border-sky-400 focus:ring-2 focus:ring-sky-200 focus:outline-none"
                        :class="{ 'border-red-300 ring-2 ring-red-200': boardForm.errors && boardForm.errors.description }"
                        aria-invalid="boardForm.errors && boardForm.errors.description ? 'true' : 'false'"
                    />
                    <p v-if="boardForm.errors && boardForm.errors.description" class="mt-1 text-xs text-red-600">
                        {{ taskForm.errors.description[0] }}
                    </p>
                </label>

                <label class="flex flex-col">
                    <span class="mb-1 text-sm font-medium text-gray-700">Цвет доски<span class="text-red-500"></span></span>

                    <input
                        v-model="boardForm.color"
                        type="color"
                        class="h-10 w-10 cursor-pointer rounded-full border-0 p-0"
                        aria-label="Выберите цвет доски"
                    />
                </label>

                <div
                    v-if="
                            boardForm.errors &&
                            Object.keys(boardForm.errors).length &&
                            !taskForm.errors.name &&
                            !taskForm.errors.description &&
                            !taskForm.errors.color
                        "
                    class="rounded-md border border-red-100 bg-red-50 p-3 text-sm text-red-700"
                >
                    Произошла ошибка. Пожалуйста, проверьте введённые данные.
                </div>

                <div class="mt-2 flex items-center justify-between gap-3">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-3 rounded-xl bg-gradient-to-r from-sky-600 to-sky-500 px-4 py-2 text-white shadow hover:from-sky-700 hover:to-sky-600 focus:ring-2 focus:ring-sky-300 focus:outline-none disabled:cursor-not-allowed disabled:opacity-60"
                        :disabled="boardForm.processing"
                    >
                        <svg
                            v-if="boardForm.processing"
                            class="h-4 w-4 animate-spin"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                        <span>{{ boardForm.processing ? 'Создаётся...' : 'Создать' }}</span>
                    </button>

                    <button
                        type="button"
                        @click="
                                () => {
                                    boardForm.reset();
                                    boardForm.color = randomFromPalette();
                                }
                            "
                        class="rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                    >
                        Очистить
                    </button>

                    <p class="ml-auto text-xs text-gray-500">Поля с <span class="text-red-500">*</span> обязательны</p>
                </div>
            </div>
        </form>
        </div>
    </div>
</template>

<script setup>
import Calendar from '@/components/mainComponents/Calendar.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';
import { route } from 'ziggy-js';

const defaultMainContainerStyle = 'flex overflow-scroll h-[100vh] bg-red-300';
const blurMainContainerStyle = 'blur flex overflow-scroll h-[100vh] bg-red-300';

const props = defineProps({
    boards: {
        type: Array,
        required: true,
    },
    tasks: {
        type: Array,
        required: true,
    },
    selectedBoard: {
        type: Object,
        required: true,
    },
});

const taskForm = useForm({
    name: null,
    description: null,
    due_date: null,
    board_id: props.selectedBoard.id,
});
const nicePalette = [
    '#ff6b6b', '#ff8a80', '#ff5252', '#ff1744',
    '#ff9f43', '#ffb74d', '#ff9800', '#ff6d00',
    '#ffd54f', '#ffeb3b', '#fff176', '#ffea00',
    '#fdd835', '#cddc39', '#d4e157', '#aed581',
    '#8bc34a', '#7cb342', '#4caf50', '#2e7d32',
    '#00d2d3', '#00bcd4', '#0097a7', '#006064',
    '#48dbfb', '#18ffff', '#00e5ff', '#00b8d4',
    '#54a0ff', '#4285f4', '#2979ff', '#1565c0',
    '#5f27cd', '#673ab7', '#7e57c2', '#512da8',
    '#f06292', '#ec407a', '#e91e63', '#ad1457',
    '#ffccbc', '#ffab91', '#ff8a65', '#ff7043',
    '#9e9e9e', '#757575', '#616161', '#424242'
];
function randomFromPalette() {
    return nicePalette[Math.floor(Math.random() * nicePalette.length)];
}

const boardForm = useForm({
    name: null,
    description: null,
    color: randomFromPalette(),
});

const date = new Date();

defineOptions({
    layout: MainLayout,
});

const isDark = ref(document.documentElement.classList.contains('dark'));

const componentsStyle = reactive({
    dateSelectorMenu: {
        visibility: 'hidden',
    },
    newTaskForm: {
        visibility: 'hidden',
    },
    newBoardForm: {
        visibility: 'hidden',
    },
    mainContainer: {
        styleClasses: defaultMainContainerStyle,
    },
});

const monthNames = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

const currentMonth = ref(date.getMonth());
const currentYear = ref(date.getFullYear());

function toggleDataSelectMenu() {
    componentsStyle.dateSelectorMenu.visibility = componentsStyle.dateSelectorMenu.visibility === 'visible' ? 'hidden' : 'visible';
}

function toggleCreateNewBoardForm() {
    if (componentsStyle.newBoardForm.visibility === 'visible') {
        componentsStyle.newBoardForm.visibility = 'hidden';
        componentsStyle.mainContainer.styleClasses = defaultMainContainerStyle;
    } else {
        componentsStyle.newBoardForm.visibility = 'visible';
        componentsStyle.mainContainer.styleClasses = blurMainContainerStyle;
    }
}

function toggleCreateNewTaskForm() {
    if (componentsStyle.newTaskForm.visibility === 'visible') {
        componentsStyle.newTaskForm.visibility = 'hidden';
        componentsStyle.mainContainer.styleClasses = defaultMainContainerStyle;
    } else {
        componentsStyle.newTaskForm.visibility = 'visible';
        componentsStyle.mainContainer.styleClasses = blurMainContainerStyle;
    }
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

function submitCreateTaskForm() {
    taskForm.post(route('tasks.store'), {
        onSuccess: () => {
            taskForm.reset();
            taskForm.board_id = props.selectedBoard.id;
            console.log('симс гууд');

            toggleCreateNewTaskForm();
        },
        onError: (errors) => {
            console.log('errors: ', errors);
        },
    });
}

function submitCreateBoardForm() {
    boardForm.post(route('boards.store'), {
        onSuccess: () => {
            console.log('доска создана');
            boardForm.reset();
            boardForm.color = randomFromPalette();
            toggleCreateNewBoardForm();
        },
        onError: (errors) => {
            console.log('errors: ', errors);
        },
    });
}
</script>
