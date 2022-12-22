<script setup>
import BookTemplate from '@/Components/BookTemplate.vue';
import AuthorDashboard from '@/Layouts/AuthorDashboard.vue';

defineProps({
    books: Object,
})
</script>

<template>
    <AuthorDashboard>
        <div class="flex flex-col divide-y">
            <BookTemplate v-for="book in books.data" :key="book.id" :book="book" />
        </div>
    </AuthorDashboard>
</template>