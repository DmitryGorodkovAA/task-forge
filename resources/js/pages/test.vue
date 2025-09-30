<script setup lang="js">
import { reactive, ref } from 'vue';
    import MainLayout from '@/layouts/MainLayout.vue';
import { Input } from '@/components/ui/input/index.js';

    defineOptions({
        layout: MainLayout,
    })

    const tasks = reactive({
        list : [],
    })

    const taskText = ref('');

    function changeTaskText(event){
        taskText.value = event.target.value;
    }

    function addTask() {
        tasks.list.push(taskText.value);
    }

</script>

<template>
    <input :value="taskText" @input="changeTaskText" type="text"></input>
    <button @click="addTask" type="submit">Add Task</button>

    <div class="mb-5" v-for="task in tasks.list">
        {{task}}
    </div>
</template>
<style scoped>
    body{
        background-color: #7e2323;
    }
</style>
