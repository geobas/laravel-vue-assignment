<script setup>
import Todo from '@/components/Todo.vue';
import { onMounted } from 'vue';
import { useStore, useState, useGetters, useActions } from 'vuex-composition-helpers';

let store = useStore();

let { todos } = useState(['todos']);

let { allCompleted } = useGetters(['allCompleted']);

let { fetchTodos, addTodo, completeAll } = useActions(['fetchTodos', 'addTodo', 'completeAll']);

onMounted(() => {
    fetchTodos();
})

function addItem(e) {
    let body = e.target.value;
    addTodo(body);
    e.target.value = '';
}
</script>

<template>
    <div class="panel">
        <div class="level">
            <h1>To-Do List</h1>
            <button
                class="complete"
                @click="completeAll"
                v-show="! allCompleted"
            >Complete All</button>
        </div>
        <p>
            <input
                class="action"
                placeholder="Do this..."
                @keyup.enter="addItem"
            >
        </p>
        <ul>
            <Todo v-for="(todo,index) in todos" :key="index" :todo="todo"></Todo>
        </ul>
    </div>
</template>

<style>
body {
    display: flex;
    justify-content: center;
}
.level {
    display: flex;
    align-items: center;
}
</style>
