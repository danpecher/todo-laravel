<script setup>
import {TrashIcon} from "@heroicons/vue/24/outline/index.js";
import {ref} from "vue";

const props = defineProps(['text', 'is_completed'])
const emit = defineEmits(['onToggle', 'onUpdate', 'onDelete'])

const text = ref(props.text)

function handleUpdate() {
    if (text.value.length > 0) {
        emit('onUpdate', text.value)
    } else {
        text.value = props.text
    }
}

</script>

<template>
    <div class="group flex space-x-4 border-b border-gray-200 px-4 py-1 items-center hover:bg-gray-100" >
        <input type="checkbox" :checked="is_completed" v-on:change="$emit('onToggle')" class="h-full w-5 accent-green-700 rounded-full" />

        <div class="flex-grow" :class="{ 'line-through': is_completed, 'opacity-50': is_completed }">
                <span v-if="is_completed">
                    {{ text }}
                </span>

            <form v-else @submit.prevent="handleUpdate">
                <input @focusout="handleUpdate" class="w-full bg-transparent" type="text" v-model="text" maxlength="2048" />
            </form>
        </div>

        <button @click="$emit('onDelete')" class="p-2 text-gray-400 hover:text-red-700 opacity-0 group-hover:opacity-100">
            <TrashIcon class="h-6 w-6" />
        </button>
    </div>
</template>

<style scoped>

</style>
