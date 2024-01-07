<script setup>
import { router } from "@inertiajs/vue3"
import TodoInput from "../Components/TodoInput.vue";
import TodoItem from "../Components/TodoItem.vue";

defineProps({ todos: Array })

// Methods
function toggleTodo(id, currentState) {
    router.patch(`/todos/${id}`, {
        is_completed: !currentState
    })
}

function deleteTodo(id) {
    router.delete(`/todos/${id}`)
}

function createTodo(text) {
    router.post('/todos', {
        text
    })
}

function updateTodo(id, text) {
    router.patch(`/todos/${id}`, {
        text
    })
}
</script>

<template>
    <div class="container mx-auto flex flex-col h-screen my-8">
        <h1 class="text-4xl font-semibold mx-2">Tasks</h1>

        <TodoInput @on-create="text => createTodo(text)" />

        <TodoItem
            v-for="todo in todos" :key="todo.id"
            :text="todo.text"
            :is_completed="todo.is_completed"
            @on-toggle="() => toggleTodo(todo.id, todo.is_completed)"
            @on-update="text => updateTodo(todo.id, text)"
            @on-delete="() => deleteTodo(todo.id)"
        />

        <div v-if="todos.length === 0" class="text-gray-700 text-center flex flex-grow items-center justify-center">
            <div>Nothing to see here</div>
        </div>
    </div>
</template>

<style>

</style>
