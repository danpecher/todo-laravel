<script setup>
import { ref } from 'vue'
import { router } from "@inertiajs/vue3";

defineProps({ todos: Array })

// State
const todoText = ref('')

// Methods
function toggleTodo(id, currentState) {
    router.patch(`/todos/${id}`, {
        is_completed: !currentState
    })
}

function deleteTodo(id) {
    router.delete(`/todos/${id}`)
}

function submit() {
    if (todoText.value.length <= 0) {
        return
    }

    router.post('/todos', {
        text: todoText.value
    })

    todoText.value = ''
}
</script>

<template>
    <div class="container mx-auto flex flex-col h-screen">
        <h1 class="text-6xl font-semibold">Tasks</h1>

        <form @submit.prevent="submit">
            <input v-model="todoText" type="text" placeholder="Create a todo ..." class="border-b border-gray-200 rounded h-10 mt-4 mb-1 mx-1 px-3 py-1 w-full" />
        </form>

        <div class="flex space-x-4 border-b border-gray-200 px-4 py-2" :class="{ 'opacity-50': todo.is_completed }" v-for="todo in todos" key="todo.id">
            <input type="checkbox" :checked="todo.is_completed" v-on:change="() => toggleTodo(todo.id, todo.is_completed)" />
            <div class="flex-grow" :class="{ 'line-through': todo.is_completed }">
                {{ todo.text }}
            </div>
            <button @click="deleteTodo(todo.id)">Delete</button>
        </div>

        <div v-if="todos.length === 0" class="text-gray-700 text-center flex flex-grow items-center justify-center">
            <div>Nothing to see here</div>
        </div>
    </div>
</template>

<style>

</style>
