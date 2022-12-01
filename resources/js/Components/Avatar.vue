<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const props = defineProps({
    user: String,
})

const initial = computed(() => {
    return props.user.charAt(0).toUpperCase() 
})

</script>

<template>
    <div class="flex items-center justify-center h-8 w-8 rounded-full text-white bg-slate-900 cursor-pointer select-none">
        {{ initial }}
    </div>    
</template>