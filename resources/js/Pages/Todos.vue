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
    <div>
        <form @submit.prevent="submit">
            <input v-model="todoText" type="text" />
            <button type="submit">Create</button>
        </form>

        <ul>
            <li v-for="todo in todos" key="todo.id">
                <span :style="{textDecoration: todo.is_completed ? 'line-through' : ''}">{{ todo.text }}</span>
                &nbsp;
                <input type="checkbox" :checked="todo.is_completed" v-on:change="() => toggleTodo(todo.id, todo.is_completed)" />
                &nbsp;
                <button @click="deleteTodo(todo.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<style>

</style>
