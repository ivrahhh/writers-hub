<script setup>
import Avatar from '@/Components/Avatar.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <div class="flex w-full overflow-x-clip min-h-screen">
        <aside class="flex flex-col fixed left-0 inset-y-0 z-20 h-screen w-64 bg-slate-800">
            <header class="relative flex h-16 flex-shrink-0 items-center justify-center border-b border-gray-600">
                <div class="flex items-center justify-center px-6 w-full">
                    <i class="fa-brands fa-laravel text-3xl text-red-600"></i>
                    <Link :href="route('dashboard')" class="block w-full text-gray-300 font-semibold text-lg ml-3">Writer's Hub</Link>
                </div>
            </header>
            <nav class="flex-1 py-6 overflow-x-hidden overflow-y-auto items-center shadow"> 
                <ul class="px-3 space-y-6">
                    <li class="overflow-hidden">
                        <Link href="" class="flex items-center gap-3 text-sm px-3 py-2 rounded-lg hover:bg-slate-900 text-white">
                            <i class="fa-solid fa-house"></i>
                            Dashboard
                        </Link>
                    </li>
                    <li class="overflow-hidden">
                        <Link href="" class="flex items-center gap-3 text-sm px-3 py-2 rounded-lg hover:bg-slate-900 text-white">
                            <i class="fa-solid fa-book"></i>
                            Books
                        </Link>
                    </li>
                    <li class="overflow-hidden">
                        <Link :href="route('tags.index')" class="flex items-center gap-3 text-sm px-3 py-2 rounded-lg hover:bg-slate-900 text-white">
                            <i class="fa-solid fa-tags"></i>
                            Tags
                        </Link>
                    </li>
                    <li class="overflow-hidden">
                        <Link href="" class="flex items-center gap-3 text-sm px-3 py-2 rounded-lg hover:bg-slate-900 text-white">
                            <i class="fa-solid fa-layer-group"></i>
                            Genres
                        </Link>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="flex transition-all gap-y-6 flex-col w-screen h-full pl-64">
            <header class="sticky top-0 z-10 flex h-16 w-full bg-white items-center shadow">
                <div class="flex items-center w-full px-6">
                    <div class="ml-auto relative">
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
                                        {{ $page.props.auth.user.email }}
                                    </span>
                                </div>
                                <Link href="" class="block px-4 py-3 text-sm hover:bg-gray-100">Profile</Link>
                                <Link method="POST" as="button" :href="route('logout')" class="block text-start w-full px-4 py-3 text-sm hover:bg-gray-100">Logout</Link>
                            </template>
                        </Dropdown> 
                    </div>
                </div>
            </header>       
            <main class="flex-1 w-full max-w-7xl mx-auto px-6">
                <slot />
            </main>
        </div>
    </div>
</template>