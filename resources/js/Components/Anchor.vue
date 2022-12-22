<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    active: Boolean,
})

</script>

<template>
    <Link class="block px-4 py-3 text-sm text-gray-800" :class="{'font-semibold border border-gray-300 border-r-[5px] border-r-slate-900': active}">
        <slot />
    </Link>    
</template>