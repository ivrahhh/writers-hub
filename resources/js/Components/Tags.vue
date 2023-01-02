<script setup>
import { getCurrentInstance, ref } from 'vue';

const props = defineProps({
    text: String,
    selected: {
        type: Boolean,
        default: false,
    }
})

defineEmits(['select'])

const id = ref(getCurrentInstance().vnode.key)
</script>

<template>
    <span class="select-none text-sm px-3 py-1 rounded-xl cursor-pointer whitespace-nowrap transition ease-in-out duration-200" @click="$emit('select', id)" :class="{ 'bg-slate-900 text-white' : selected }">
        {{ text }}
    </span>
</template>