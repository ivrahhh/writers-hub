<script setup>
import Pagination from '@/Components/Pagination.vue';
import Toast from '@/Components/Toast.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    genres: Object,
    status: String,
})

const form = useForm()
const genreRemoved = computed(() => props.status === 'genre-has-been-deleted')
const active = ref(false)

const remove = (event) => {
    form.delete(event.target.href, {
        preserveScroll: true,
        onSuccess: () => {
            active.value = genreRemoved.value,
            setTimeout(() => active.value = false, 5000)
        }
    })
}

</script>

<template>
    <Head title="Genre"/>
    <AdminLayout>
        <Link :href="route('genres.create')" class="block w-max px-4 py-2 rounded-lg mb-4 bg-slate-900 text-sm text-white hover:bg-slate-800 font-semibold transition">
            <i class="fa-solid fa-plus"></i>
            Add new Genre
        </Link>
        <div v-if="genres.total">
            <div class="relative overflow-x-auto bg-white shadow rounded-lg ring-1 ring-black ring-opacity-5">
                <table class="text-sm text-left w-full">
                    <thead>
                        <tr class="select-none bg-slate-900 text-white border-b font-semibold">
                            <td scope="col" class="px-6 py-3">Genre</td>
                            <td scope="col" class="px-6 py-3">Description</td>
                            <td scope="col" class="px-6 py-3">Added at</td>
                            <td class="sr-only">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="genre in genres.data" :key="genre.id" class="odd:bg-white even:bg-gray-50">
                            <td class="px-6 py-3 whitespace-nowrap">{{ genre.genre }}</td>
                            <td class="px-6 py-3">{{ genre.description }}</td>
                            <td class="px-6 py-3">{{ new Date(genre.created_at).toLocaleDateString() }}</td>
                            <td class="px-6 py-3">
                                <Link @click.prevent="remove" :href="route('genres.destroy', {genre: genre.id})" class="flex items-center text-sm hover:text-red-600">
                                    <i class="fa-solid fa-trash mr-2"></i> Remove
                                </Link> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination 
                :links="genres.links" 
                :from="genres.from"
                :to="genres.to"
                :total="genres.total"
            />
        </div>
        <div class="block w-full rounded-lg bg-gray-200 h-56" v-else>
            <div class="flex flex-col gap-4 items-center justify-center h-full text-gray-500">
                <i class="fa-solid fa-tags text-4xl"></i>
                <span class="text-xl font-semibold">No Genres Created</span>
            </div>
        </div>
    </AdminLayout>
    <Toast :is-active="active" title="Genre Removed" message="Genre has been removed successfully" type="success" />
</template>