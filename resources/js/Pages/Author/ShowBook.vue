<script setup>
import BookTemplate from '@/Components/BookTemplate.vue';
import AuthorDashboard from '@/Layouts/AuthorDashboard.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const props = defineProps({
    book: Object,
})

const chapters = computed(() => {
    return props.book.chapters
})

const genres = computed(() => {
    return props.book.genres
})

const tags = computed(() => {
    return props.book.tags
})
</script>

<template>
    <AuthorDashboard>
        <div class="flex flex-col gap-4">
            <BookTemplate :book="book"/>
                <div class="flex items-center gap-4">
                    <label for="upload-chapter" class="cursor-pointer block px-4 py-2 rounded-lg bg-slate-900 text-white text-sm hover:bg-slate-800 transition ease-in-out duration-300">Upload Chapter</label>
                    <input type="file" class="hidden" name="chapter" id="upload-chapter" />
                    <Link :href="route('books.chapters.create', book.id)" class="block px-4 py-2 rounded-lg bg-slate-900 text-white text-sm hover:bg-slate-800 transition ease-in-out duration-300">Create new chapter</Link>
                </div>
            <div class="h-[30rem] rounded-lg shadow bg-white ring-1 relative ring-black ring-opacity-5 overflow-y-auto">
                <h6 class="block px-4 py-3 text-lg shadow font-semibold sticky top-0 bg-white">Chapter List</h6>
                <div class="flex flex-col divide-y" v-if="chapters.length">
                    <Link :href="route('chapters.show', chapter.id)" class="px-4 py-3 flex items-center justify-between" v-for="chapter in chapters" :key="chapter.id">
                        <span>{{ chapter.chapter_title }}</span>
                        <span class="text-xs text-gray-500">{{ new Date(chapter.created_at).toLocaleDateString() }}</span>
                    </Link>
                </div>
                <div class="h-96 flex items-center justify-center" v-else>
                    <div class="flex flex-col gap-4 items-center">
                        <i class="fa-solid fa-xmark-circle text-3xl text-gray-500"></i>
                        <h6 class="text-2xl font-black text-gray-500">No Chapters</h6>
                    </div>
                </div>
            </div>
        </div>
    </AuthorDashboard>
</template>