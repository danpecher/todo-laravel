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

function updateTodo(todo) {
    router.patch(`/todos/${todo.id}`, {
        text: todo.text
    })
}
</script>

<template>
    <div class="container mx-auto flex flex-col h-screen my-8">
        <h1 class="text-4xl font-semibold mx-2">Tasks</h1>

        <form @submit.prevent="submit">
            <input v-model="todoText" type="text" placeholder="Create a todo ..." class="border border-gray-200 rounded-md h-10 my-5 mx-1 px-3 py-1 w-full shadow" />
        </form>

        <div class="flex space-x-4 border-b border-gray-200 px-4 py-3" v-for="todo in todos" key="todo.id">
            <input type="checkbox" :checked="todo.is_completed" v-on:change="() => toggleTodo(todo.id, todo.is_completed)" class="w-6 accent-green-700 rounded-full" />

            <div class="flex-grow" :class="{ 'line-through': todo.is_completed, 'opacity-50': todo.is_completed }">
                <span v-if="todo.is_completed">
                    {{ todo.text }}
                </span>

                <form v-else @submit.prevent="() => updateTodo(todo)">
                    <input @focusout="() => updateTodo(todo)" class="w-full" type="text" v-model="todo.text" />
                </form>
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
