<script setup>
import TextBox from '@/Components/TextBox.vue';
import TextEditor from '@/Components/TextEditor.vue';
import AuthorDashboard from '@/Layouts/AuthorDashboard.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    book: Number,
})

const form = useForm({
    chapter_title: '',
    content: '',
})

const submit = () => {
    form.post(route('books.chapters.store', props.book), {
        onSuccess: () => form.reset(),
    })
}
</script>

<template>
    <AuthorDashboard>
        <div class="flex flex-col bg-white rounded-lg p-4 shadow">
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <label for="title" class="form-label">Chapter Title</label>
                    <TextBox type="text" id="title" v-model="form.chapter_title" />
                    <span v-if="form.errors.chapter_title" class="text-xs text-red-600">{{ form.errors.chapter_title }}</span>
                </div>
                <div>
                    <label for="synopsis" class="form-label">Content    </label>
                    <TextEditor v-model="form.content" />
                    <span v-if="form.errors.content" class="text-xs text-red-600">{{ form.errors.content }}</span>
                </div>
                <button type="submit" class="block ml-auto rounded-lg px-4 py-2 text-gray-200 bg-slate-900 font-semibold text-sm transition ease-in-out duration-300 hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-save inline-block mr-2"></i> 
                    Save
                </button>
            </form>
        </div>
    </AuthorDashboard>
</template>