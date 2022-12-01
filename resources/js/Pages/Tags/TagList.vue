<script setup>
import Pagination from '@/Components/Pagination.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';


defineProps({
    tags: Object,
})

</script>

<template>
    <Head title="Tags"/>
    <AdminLayout>
        <div class="relative overflow-x-auto bg-white shadow rounded-lg">
            <table class="text-sm text-left w-full">
                <thead>
                    <tr class="select-none bg-gray-50 border-b font-semibold">
                        <td scope="col" class="px-6 py-3">Tag ID</td>
                        <td scope="col" class="px-6 py-3">Tag</td>
                        <td scope="col" class="px-6 py-3">Added at</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tag in tags.data" :key="tag.id" class="odd:bg-white even:bg-gray-50">
                        <td class="px-6 py-3">{{ tag.id }}</td>
                        <td class="px-6 py-3">{{ tag.tag }}</td>
                        <td class="px-6 py-3">{{ new Date(tag.created_at).toLocaleDateString() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination 
            :links="tags.links" 
            :from="tags.from"
            :to="tags.to"
            :total="tags.total"
        />
    </AdminLayout>
</template>