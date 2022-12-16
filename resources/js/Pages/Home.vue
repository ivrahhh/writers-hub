<script setup>
import ApplicationLayout from '@/Layouts/ApplicationLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';


defineProps({
    books: Object,
})

</script>

<template>
    <Head title="Home"/>
    
    <ApplicationLayout>
    </ApplicationLayout>
</template>