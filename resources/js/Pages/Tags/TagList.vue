<script setup>
import Pagination from '@/Components/Pagination.vue';
import Toast from '@/Components/Toast.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    tags: Object,
    status: String,
})

const form = useForm()
const tagRemoved = computed(() => props.status === 'tag-has-been-deleted')
const active = ref(false)

const remove = (event) => {
    form.delete(event.target.href, {
        preserveScroll: true,
        onSuccess: () => {
            active.value = tagRemoved.value,
            setTimeout(() => active.value = false, 5000)
        }
    })
}

</script>

<template>
    <Head title="Tags"/>
    <AdminLayout>
        <Link :href="route('tags.create')" class="block w-max px-4 py-2 rounded-lg mb-4 bg-slate-900 text-sm text-white hover:bg-slate-800 font-semibold transition">
            <i class="fa-solid fa-plus"></i>
            Add new Tag
        </Link>
        <div class="relative overflow-x-auto bg-white shadow rounded-lg ring-1 ring-black ring-opacity-5">
            <table class="text-sm text-left w-full">
                <thead>
                    <tr class="select-none bg-slate-900 text-white border-b font-semibold">
                        <td scope="col" class="px-6 py-3">Tag ID</td>
                        <td scope="col" class="px-6 py-3">Tag</td>
                        <td scope="col" class="px-6 py-3">Added at</td>
                        <td class="sr-only">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tag in tags.data" :key="tag.id" class="odd:bg-white even:bg-gray-50">
                        <td class="px-6 py-3">{{ tag.id }}</td>
                        <td class="px-6 py-3">{{ tag.tag }}</td>
                        <td class="px-6 py-3">{{ new Date(tag.created_at).toLocaleDateString() }}</td>
                        <td class="px-6 py-3">
                            <Link @click.prevent="remove" :href="route('tags.destroy', {tag: tag.id})" class="text-sm hover:text-red-600">
                                <i class="fa-solid fa-trash mr-2"></i>Remove
                            </Link> 
                        </td>
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
    <Toast :is-active="active" title="Tag Removed" message="Tag has been removed successfully" type="success" />
</template>