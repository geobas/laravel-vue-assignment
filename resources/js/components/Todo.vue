<script setup>
import { useActions } from 'vuex-composition-helpers';

let { deleteTodo, toggleTodo } = useActions(['deleteTodo', 'toggleTodo']);

defineProps({
    todo: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <li class="todo" :class="{ 'is-complete': todo.done }">
        <input
            :id="todo.id"
            type="checkbox"
            :checked="todo.done"
            @change="toggleTodo(todo)"
        >

        <label
            :for="todo.id"
            v-text="todo.body">
        </label>

        <button
            class="close"
            @click="deleteTodo(todo)"
        >X</button>
    </li>
</template>

<style>
button {
    margin-left: 0.5em;
}
.is-complete {
    color: grey;
}
</style>
