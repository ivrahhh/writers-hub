<script setup>
import Anchor from '@/Components/Anchor.vue';
import Avatar from '@/Components/Avatar.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const user = computed(() => {
    return usePage().props.value.auth.user
})
</script>

<template>
    <div class="flex relative">
        <aside class="fixed inset-y-0 left-0 bg-white w-64 shadow">
            <header class="h-14 bg-slate-900 text-gray-600 flex items-center">
                <Link :href="route('home')" class="flex items-center gap-2 px-4 py-2 text-gray-300">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to Reading
                </Link>
            </header>
            <nav class="flex flex-col py-4">
                <Anchor :href="route('author.dashboard', user.username)" :active="route().current('author.dashboard', user.username)">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-gauge"></i>
                        <span>Dashboard</span>
                    </span>
                </Anchor>                                
                <Anchor :href="route('books.index', user.username)" :active="route().current('books.index', user.username)">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-book"></i>
                        <span>My books</span>
                    </span>
                </Anchor>
            </nav>
        </aside>
        <div class="flex flex-col pl-64 flex-1 grow shrink-0 h-screen">
            <header class="h-14 bg-white w-full shadow px-4 py-2 flex items-center top-0 sticky">
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
                                <Link :href="route('user.profile', $page.props.auth.user.username)" class="block px-4 py-3 text-sm hover:bg-gray-100">Profile</Link>
                                <Link method="POST" as="button" :href="route('logout')" class="block text-start w-full px-4 py-3 text-sm hover:bg-gray-100">Logout</Link>
                            </template>
                        </Dropdown> 
                    </div>
            </header>
            <main class="flex-1 shrink-0 p-4">
                <slot />
            </main>
        </div>
    </div>
</template>