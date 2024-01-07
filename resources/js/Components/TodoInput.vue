<script setup>
import { ref } from 'vue'

const emit = defineEmits(['onCreate'])

const todoText = ref('')

function handleSubmit() {
    if (todoText.value.length <= 0) {
        return
    }

    emit('onCreate', todoText.value)

    todoText.value = ''
}
</script>

<template>
    <form @submit.prevent="handleSubmit">
        <input v-model="todoText" type="text" placeholder="What to do..." class="border border-gray-200 rounded-md h-10 my-5 mx-1 px-3 py-1 w-full shadow text-lg font-medium placeholder:font-normal placeholder:text-base" />
    </form>
</template>

<style scoped>

</style>
