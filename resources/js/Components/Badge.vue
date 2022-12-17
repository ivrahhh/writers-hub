<script setup>
import { computed } from 'vue';

defineProps({
    content: String,
})
</script>

<template>
    <span class="block text-xs px-3 py-1 rounded-xl bg-slate-900 text-white w-min">{{ content }}</span>
</template>