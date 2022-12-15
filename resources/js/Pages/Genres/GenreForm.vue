<script setup>
import TextBox from '@/Components/TextBox.vue';
import Toast from '@/Components/Toast.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    status: String,
})

const form = useForm({
    genre: '',
    description: '',
})

const genreAdded = computed(() => props.status === 'genre-has-been-added')
const active = ref(false)

const save = () => {
    form.post(route('genres.store'), {
        onSuccess: () => {
            form.reset()
            active.value = genreAdded.value
            setTimeout(() => active.value = false, 5000)
        }
    })
}
</script>

<template>
    <Head title="Genres" />

    <AdminLayout>
        <Link :href="route('genres.index')" class="block w-max px-4 py-2 rounded-lg mb-4 bg-slate-900 text-sm text-white hover:bg-slate-800 font-semibold transition">
            <i class="fa-solid fa-arrow-left"></i>
            Back to List
        </Link>
        <div class="w-full rounded-lg bg-white p-4 shadow ring-1 ring-black ring-opacity-5">
            <form @submit.prevent="save" class="space-y-4">
                <div>
                    <label class="form-label" for="genre">Genre Name</label>
                    <TextBox type="text" id="genre" v-model="form.genre" />
                    <span v-if="form.errors.genre" class="text-xs text-red-600">{{ form.errors.genre }}</span>
                </div>
                <div>
                    <label class="form-label" for="description">Desciprtion</label>
                    <textarea id="description" v-model="form.description" class="block w-full rounded-lg text-sm p-2.5 border border-gray-300 focus:ring-1 focus:outline-none focus:ring-blue-600 focus:border-blue-600" rows="5"></textarea>
                    <span v-if="form.errors.description" class="text-xs text-red-600">{{ form.errors.description }}</span>
                </div>
                <button class="form-submit bg-slate-900 hover:bg-slate-800 text-white w-max ml-auto font-semibold">
                    <i class="fa-solid fa-save mr-2"></i>
                    Save
                </button>
            </form>
        </div>
    </AdminLayout>
    <Toast :isActive="active" title="Genre Added" message="Genre has been successfully added" type="success" />
</template>