<script setup>
import { computed, useAttrs } from 'vue';


defineProps({
    modelValue: String,
})

const attr = useAttrs()

const textSize = computed(() => {
    if(attr.type === 'password') {
        return 'text-xs'
    } else {
        return 'text-sm'
    }
})

defineEmits(['update:modelValue'])
</script>

<template>
    <input :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :class="textSize" class="block w-full rounded-lg p-2.5 border border-gray-300 focus:ring-1 focus:ring-blue-600 focus:outline-none focus:border-blue-600">
</template>