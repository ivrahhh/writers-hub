<script setup>
import Avatar from '@/Components/Avatar.vue';
import Badge from '@/Components/Badge.vue';
import ApplicationLayout from '@/Layouts/ApplicationLayout.vue';
import ChangePassword from '@/Partials/ChangePassword.vue';
import { Link, useForm, Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const props = defineProps({
    user: Object,
    books: Object,
})

const change = ref(false)

const form = useForm('updateAboutMe', {
    about_me: props.user.about_me
})

const updateAboutMe = () => {
    form.put(route('user.profile.update.about-me', props.user.username), {
        onSuccess: () => {
            change.value = false
        }
    })
}

const reset = () => {
    change.value = false
    form.about_me = props.user.about_me
}
</script>

<template>
    <Head title="Profile"/>
    <ApplicationLayout>
        <div class="bg-white min-h-[14rem] relative rounded-lg shadow">
            <div class="bg-slate-900 h-[6rem] rounded-t-lg"></div>
            <div class="w-48 h-auto absolute top-4 left-4 rounded-full ring-1 ring-gray-300">
                <div v-if="!user.image">
                    <Avatar size="profile" :user="user.username" />
                </div>
                <img v-else :src="user.image.url" class="w-full h-full aspect-square rounded-full"/>
            </div>
            <div class="pl-56 py-3 pr-4">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-lg">
                            <i class="fa-solid fa-user-circle text-sm"></i>
                            {{ user.username }}
                        </span>
                        <Link :href="route('user.profile', user.username)" class="text-xs text-blue-600"> #{{ user.id }}</Link>
                    </div>
                </div>
                <div class="mt-3">
                    <Badge :content="user.role" class="bg-indigo-600"/>
                </div>
                <div class="mt-4">
                    <h3 class="group">
                        <i class="fa-solid fa-address-card"></i> About me
                        <button class="invisible group-hover:visible" @click="change = true" v-if="change == false">
                            <i class="fa-solid fa-pen text-xs text-gray-500"></i>
                        </button>
                    </h3>
                    <p class="indent-4 p-4" v-if="change == false">{{ user.about_me }}</p>
                    <form @submit.prevent="updateAboutMe" class="p-4 space-y-4" v-if="change">
                        <textarea v-model="form.about_me" rows="4" class="block w-full rounded-lg p-2.5 border border-gray-300 focus:ring-1 focus:ring-blue-600 focus:border-blu-600 focus:outline-none"></textarea>
                        <div class="flex flex-row-reverse items-center gap-4 justify-start">
                            <button type="submit" class="block px-4 py-2 bg-slate-900 text-sm rounded-lg text-white font-semibold transition hover:bg-slate-800">
                                <i class="fa-solid fa-save mr-2"></i>Save
                            </button>
                            <span type="button" class="block cursor-pointer px-4 py-2 text-sm text-red-600 font-semibold" @click="reset">
                                <i class="fa-solid fa-xmark mr-2"></i>Cancel
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <ChangePassword />
        </div>
    </ApplicationLayout>
</template>