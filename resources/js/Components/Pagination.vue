<script setup>
import { Link } from '@inertiajs/inertia-vue3';


defineProps({
    links: Object,
    from: Number,
    to: Number,
    total: Number,
})

</script>

<template>
    <div class="flex items-center justify-between w-full my-4">
        <span class="text-sm text-gray-500">
            {{ `Showing ${from} to ${to} of ${total} results` }}
        </span>
        <div class="flex items-center bg-white rounded-lg divide-x text-sm shadow">
            <Link :href="link.url" v-for="link in links" class="flex items-center justify-center px-4 py-2" :class="[{ 'bg-slate-900 text-white hover:bg-slate-800' : link.active }, { 'pointer-events-none' : link.url === null }]">
                <span v-html="link.label"></span>
            </Link>
        </div>
    </div>
</template>