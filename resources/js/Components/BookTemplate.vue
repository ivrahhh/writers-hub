<script setup>

defineProps({
    book: Object,
})
</script>

<template>
    <div class="flex p-4 bg-white">
        <div class="max-w-[12rem] h-56 shrink-0">
            <img :src="book.image.url"  class="object-cover h-full rounded-lg"/>
        </div>
        <div class="flex flex-col px-4">
            <h6 class="text-lg font-bold">{{ book.title }}</h6>
            <span class="text-xs text-gray-600  ">
                Publish Date :{{ new Date(book.created_at).toLocaleDateString() }}
            </span>
            <div class="mt-6">
                <h6 class="font-semibold block mb-2">Synopsis</h6>
                <p class="indent-4 text-sm text-gray-700" v-html="book.synopsis"></p>
            </div>
        </div>
    </div>
</template>