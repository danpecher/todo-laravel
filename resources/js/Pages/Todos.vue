<script setup>
import { ref } from 'vue'
import { router } from "@inertiajs/vue3"
import { TrashIcon } from "@heroicons/vue/24/outline"
import TodoInput from "../Components/TodoInput.vue";

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

function createTodo(text) {
    router.post('/todos', {
        text: text
    })
}

function updateTodo(todo) {
    router.patch(`/todos/${todo.id}`, {
        text: todo.text
    })
}
</script>

<template>
    <div class="container mx-auto flex flex-col h-screen my-8">
        <h1 class="text-4xl font-semibold mx-2">Tasks</h1>

        <TodoInput @on-create="text => createTodo(text)" />

        <div class="group flex space-x-4 border-b border-gray-200 px-4 py-1 items-center hover:bg-gray-100" v-for="todo in todos" key="todo.id">
            <input type="checkbox" :checked="todo.is_completed" v-on:change="() => toggleTodo(todo.id, todo.is_completed)" class="h-full w-5 accent-green-700 rounded-full" />

            <div class="flex-grow" :class="{ 'line-through': todo.is_completed, 'opacity-50': todo.is_completed }">
                <span v-if="todo.is_completed">
                    {{ todo.text }}
                </span>

                <form v-else @submit.prevent="() => updateTodo(todo)">
                    <input @focusout="() => updateTodo(todo)" class="w-full bg-transparent" type="text" v-model="todo.text" />
                </form>
            </div>

            <button @click="deleteTodo(todo.id)" class="p-2 text-gray-400 hover:text-red-700 opacity-0 group-hover:opacity-100">
                <TrashIcon class="h-6 w-6" />
            </button>
        </div>

        <div v-if="todos.length === 0" class="text-gray-700 text-center flex flex-grow items-center justify-center">
            <div>Nothing to see here</div>
        </div>
    </div>
</template>

<style>

</style>
