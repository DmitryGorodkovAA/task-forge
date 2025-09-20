<template>
    <div class="ring-opacity-5 shadow ring-1 ring-black flex flex-col w-full h-full">
        <div class="grid grid-cols-7 gap-px border-b border-gray-300 bg-gray-200 text-center text-xs leading-6 font-semibold text-gray-700 lg:flex-none">
            <div v-for="(day, index) in weekDays" :key="index" class="flex justify-center bg-white py-2">
                <span>{{ day[0] }}</span>
                <span class="sr-only sm:not-sr-only">{{ day.slice(1) }}</span>
            </div>
        </div>

        <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">
            <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-6 lg:gap-px">
                <div
                    v-for="day in calendarDays"
                    :key="day.dateString"
                    :class="dayClass(day)"
                    class="relative h-[8rem] px-3 py-2 "
                >
                    <time :datetime="day.dateString" :class="timeClass(day)">{{ day.day }}</time>
                    <div class="overflow-auto max-h-[6rem] mb-1">
                        <ol v-if="day.events.length" class="mt-2">
                            <li v-for="(event, idx) in day.events" :key="idx">
                                <a href="#" class="group flex">
                                    <p class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">{{ event.name }}</p>
                                    <time
                                        :datetime="event.due_date"
                                        class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block"
                                    >
                                        {{ formatEventTime(event.due_date) }}
                                    </time>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="isolate grid w-full grid-cols-7 grid-rows-6 gap-px lg:hidden">
                <button
                    v-for="day in calendarDays"
                    :key="day.dateString"
                    type="button"
                    :class="mobileDayClass(day)"
                    class="flex h-14 flex-col px-3 py-2 hover:bg-gray-100 focus:z-10"
                >
                    <time :datetime="day.dateString" class="ml-auto" :class="mobileTimeClass(day)">
                        {{ day.day }}
                    </time>
                    <span class="sr-only">{{ day.events.length }} event{{ day.events.length !== 1 ? 's' : '' }}</span>
                    <span v-if="day.events.length" class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                        <span v-for="(e, idx) in day.events" :key="idx" class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        month: { type: Number, required: true }, // 1-12
        year: { type: Number, default: new Date().getFullYear() },
        tasks: { type: Array, default: () => [] }, // [{ name, date }]
    },
    computed: {
        weekDays() {
            return ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
        },
        calendarDays() {
            const days = [];

            const year = this.year;
            const month = this.month; // 1-12

            if (!year || !month) return days;

            const firstDayOfMonth = new Date(year, month - 1, 1);
            const lastDayOfMonth = new Date(year, month, 0);

            const startWeekDay = (firstDayOfMonth.getDay() + 6) % 7;

            for (let i = startWeekDay; i > 0; i--) {
                const d = new Date(year, month - 1, 1 - i);
                days.push({
                    date: d,
                    day: d.getDate(),
                    currentMonth: false,
                    events: this.getEvents(d),
                    dateString: this.formatDate(d),
                });
            }

            for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
                const d = new Date(year, month - 1, i);
                days.push({
                    date: d,
                    day: i,
                    currentMonth: true,
                    events: this.getEvents(d),
                    dateString: this.formatDate(d),
                });
            }

            const totalDays = 42;
            const nextMonthDays = totalDays - days.length;
            for (let i = 1; i <= nextMonthDays; i++) {
                const d = new Date(year, month, i);
                days.push({
                    date: d,
                    day: d.getDate(),
                    currentMonth: false,
                    events: this.getEvents(d),
                    dateString: this.formatDate(d),
                });
            }

            return days;
        }    },
    methods: {
        getEvents(day) {
            const dateStr = this.formatDate(day);
            return this.tasks.filter(task => task.due_date.startsWith(dateStr));
        },
        formatDate(d) {
            const month = String(d.getMonth() + 1).padStart(2, "0");
            const day = String(d.getDate()).padStart(2, "0");
            return `${d.getFullYear()}-${month}-${day}`;
        },
        formatEventTime(dateStr) {
            const date = new Date(dateStr);
            const hours = date.getHours();
            const ampm = hours >= 12 ? "PM" : "AM";
            const hour12 = hours % 12 === 0 ? 12 : hours % 12;
            return `${hour12}${ampm}`;
        },
        dayClass(day) {
            return day.currentMonth ? "bg-white text-gray-900" : "bg-gray-50 text-gray-500";
        },
        timeClass(day) {
            const today = new Date();
            return day.date.toDateString() === today.toDateString()
                ? "flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white"
                : "";
        },
        mobileDayClass(day) {
            return day.currentMonth ? "bg-white text-gray-900" : "bg-gray-50 text-gray-500";
        },
        mobileTimeClass(day) {
            const today = new Date();
            return day.date.toDateString() === today.toDateString() ? "font-semibold text-indigo-600" : "";
        },
    },
};
</script>
