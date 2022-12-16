<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const props = defineProps({
    user: String,
    size: {
        type: String,
        default: 'xs'
    }
})

const setSize = computed(() => {
    switch(props.size) {
        case 'xs': 
            return 'h-8 w-8 text-base'
            break
        case 'sm':
            return 'h-12 w-12 text-lg'
            break
        case 'md':
            return 'h-16 w-16 text-xl'
            break
        case 'lg':
            return 'h-20 w-20 text-2xl'
            break
        case 'xl':
            return 'h-24 w-24 text-4xl'
            break
        default:
            return 'h-8 w-8 text-base'
    }
})

const initial = computed(() => {
    return props.user.charAt(0).toUpperCase() 
})

</script>

<template>
    <div class="flex items-center justify-center rounded-full text-white bg-slate-900 cursor-pointer select-none" :class="setSize">
        {{ initial }}
    </div>    
</template>