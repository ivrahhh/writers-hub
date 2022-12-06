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
    tag: '',
})

const tagAdded = computed(() => props.status === 'tag-successfully-added')
const active = ref(false)

const save = () => {
    form.post(route('tags.store'), {
        onSuccess: () => {
            form.reset()
            active.value = tagAdded.value
            setTimeout(() => active.value = false, 5000)
        }
    })
}
</script>

<template>
    <Head title="Tags" />

    <AdminLayout>
        <Link :href="route('tags.create')" class="block w-max px-4 py-2 rounded-lg mb-4 bg-slate-900 text-sm text-white hover:bg-slate-800 font-semibold transition">
            <i class="fa-solid fa-plus"></i>
            Add new Tag
        </Link>
        <div class="w-full rounded-lg bg-white p-4 shadow ring-1 ring-black ring-opacity-5">
            <form @submit.prevent="save" class="space-y-4">
                <div>
                    <label class="form-label" for="tag">Tag Name</label>
                    <TextBox type="text" id="tag" v-model="form.tag" />
                    <span v-if="form.errors.tag" class="text-xs text-red-600">{{ form.errors.tag }}</span>
                </div>
                <button class="form-submit bg-slate-900 hover:bg-slate-800 text-white w-max ml-auto font-semibold">
                    <i class="fa-solid fa-save mr-2"></i>
                    Save
                </button>
            </form>
        </div>
    </AdminLayout>
    <Toast :isActive="active" title="Tag Added" message="Tag has been successfully added" type="success" />
</template>