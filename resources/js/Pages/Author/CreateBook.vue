<script setup>
import Tags from '@/Components/Tags.vue';
import TextBox from '@/Components/TextBox.vue';
import TextEditor from '@/Components/TextEditor.vue';
import AuthorDashboard from '@/Layouts/AuthorDashboard.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const props =  defineProps({
    tags: Object,
    genres: Object,
})

const form = useForm({
    title: '',
    synopsis: '',
    tags: [],
    genres: [],
})

const createBook = () => {
    form.post(route('books.store'), {
        onSuccess: () => {
            form.reset()
        }
    })
}

const chooseGenre = (id) => {
    if(form.genres.includes(id)) {    
        const index = form.genres.indexOf(id)
        form.genres.splice(index, 1)
        return
    }

    form.genres.push(id)    
    return
}

const chooseTag = (id) => {
    if(form.tags.includes(id)) {    
        const index = form.tags.indexOf(id)
        form.tags.splice(index, 1)
        return
    }

    form.tags.push(id)    
    return
}

</script>

<template>
    <Head title="Create new Book"/>
    <AuthorDashboard>
        <div class="flex flex-col bg-white rounded-lg p-4 shadow">
            <form @submit.prevent="createBook" class="space-y-6">
                <div>
                    <label for="title" class="form-label">Book Title</label>
                    <TextBox type="text" id="title" v-model="form.title" />
                    <span v-if="form.errors.title" class="text-xs text-red-600">{{ form.errors.title }}</span>
                </div>
                <div>
                    <label class="form-label">Genres</label>
                    <div class="flex gap-4 flex-wrap">
                        <Tags v-for="genre in genres" :key="genre.id" :text="genre.genre" @select="chooseGenre" :selected="form.genres.includes(genre.id)"/>
                    </div>
                    <span v-if="form.errors.genres" class="text-xs text-red-600">{{ form.errors.genres }}</span>
                </div>
                <div>
                    <label class="form-label">Tags</label>
                    <div class="flex gap-4 flex-wrap">
                        <Tags v-for="tag in tags" :key="tag.id" :text="tag.tag" @select="chooseTag" :selected="form.tags.includes(tag.id)" />
                    </div>
                    <span v-if="form.errors.tags" class="text-xs text-red-600">{{ form.errors.tags }}</span>
                </div>
                <div>
                    <label for="synopsis" class="form-label">Synopsis</label>
                    <TextEditor v-model="form.synopsis" />
                    <span v-if="form.errors.synopsis" class="text-xs text-red-600">{{ form.errors.synopsis }}</span>
                </div>
                <button type="submit" class="block ml-auto rounded-lg px-4 py-2 text-gray-200 bg-slate-900 font-semibold text-sm transition ease-in-out duration-300 hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-save inline-block mr-2"></i> 
                    Save
                </button>
            </form>
        </div>
    </AuthorDashboard>
</template>