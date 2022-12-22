<script setup>
import Avatar from '@/Components/Avatar.vue'
import Dropdown from '@/Components/Dropdown.vue'
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue';

const user = computed(() => {
    return usePage().props.value.auth.user
})

</script>

<template>
    <div class="flex flex-col h-screen">
        <header class="relative z-40">
            <nav class="sticky top-0 w-full shadow bg-white px-4 py-3">
                <div class="flex items-center gap-4 shrink-0">
                    <Link :href="route('home')" class="flex items-center gap-2">
                        <i class="fa-brands fa-laravel text-3xl text-red-600"></i>
                        <span class="text-lg font-black">Writer's Hub</span>
                    </Link>
                    <ul class="flex items-center gap-8 text-sm flex-1 justify-center" v-if="!route().current('user.profile')">
                        <li>
                            <Link href="/" class="block px-4 py-2 rounded-lg hover:bg-slate-900 transition ease-in-out duration-200 hover:text-white" :class="{ 'bg-slate-900 text-white' : route().current('home') }">Home</Link>
                        </li>
                        <li>
                            <Link href="/" class="block px-4 py-2 rounded-lg hover:bg-slate-900 transition ease-in-out duration-200 hover:text-white" :class="{ 'bg-slate-900 text-white' : false }">Books</Link>
                        </li>
                        <li>
                            <Link href="/" class="block px-4 py-2 rounded-lg hover:bg-slate-900 transition ease-in-out duration-200 hover:text-white" :class="{ 'bg-slate-900 text-white' : false }">Genres</Link>
                        </li>
                    </ul>
                    <div class="ml-auto">
                        <Dropdown>
                            <template #toggler>
                                <span class="text-sm font-semibold z-50 relative">
                                    <Avatar :user="$page.props.auth.user.username" />
                                </span>
                            </template>
                            <template #menu>
                                <div class="flex items-center gap-2 px-4 py-3 border-b">
                                    <i class="fa-solid fa-user-circle"></i>
                                    <span class="text-sm">
                                        {{ $page.props.auth.user.username }}
                                    </span>
                                </div>
                                <Link :href="route('author.dashboard')" class="block px-4 py-3 text-sm hover:bg-gray-100">
                                    {{  (user.role === 'Author') ? "Author's Dashboard" : 'Become an author' }}
                                </Link>
                                <Link :href="route('user.profile', $page.props.auth.user.username)" class="block px-4 py-3 text-sm hover:bg-gray-100">Profile</Link>
                                <Link method="POST" as="button" :href="route('logout')" class="block text-start w-full px-4 py-3 text-sm hover:bg-gray-100">Logout</Link>
                            </template>
                        </Dropdown> 
                    </div>
                </div>
            </nav>
        </header>
        <main class="h-full p-4 overflow-y-auto">
            <slot />
        </main>
    </div>
</template>