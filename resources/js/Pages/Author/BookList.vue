<script setup>
import BookTemplate from '@/Components/BookTemplate.vue';
import AuthorDashboard from '@/Layouts/AuthorDashboard.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const props = defineProps({
    books: Object,
})

const bookData = computed(() => {
    return props.books.data
})
</script>

<template>
    <Head title="My Books"/>
    <AuthorDashboard>
        <div class="my-4 flex items-center">
            <Link :href="route('books.create')" class="block ml-auto px-4 py-2 rounded-lg bg-slate-900 text-gray-200 text-sm transition ease-in-out duration-300 hover:bg-slate-800 hover:text-white">
                <i class="fa-solid fa-plus"></i> 
                Add new book
            </Link>
        </div>
        <div class="flex flex-col divide-y" v-if="bookData.length">
            <BookTemplate v-for="book in books.data" :key="book.id" :book="book" />
        </div>
        <div class="flex flex-col justify-center items-center bg-gray-200 h-64 rounded-lg" v-else>
            <i class="fa-solid fa-circle-xmark text-gray-500 text-4xl block mb-3"></i>
            <h5 class="text-2xl font-black text-gray-500">No Book Created</h5>
        </div>
    </AuthorDashboard>
</template>