<script setup>
import TagModal from '@/Components/TagModal.vue';
import Pagination from '@/Components/Pagination.vue';
import TextBox from '@/Components/TextBox.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

defineProps({
    tags: Object,
    status: String,
})

</script>

<template>
    <Head title="Tags"/>
    <AdminLayout>
        <div class="my-4">
            <Modal >
                <template #toggler>
                    <i class="fa-solid fa-plus"></i>
                    New Tag
                </template>
            </Modal>
        </div>
        <div class="relative overflow-x-auto bg-white shadow rounded-lg ring-1 ring-black ring-opacity-5">
            <table class="text-sm text-left w-full">
                <thead>
                    <tr class="select-none bg-slate-900 text-white border-b font-semibold">
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