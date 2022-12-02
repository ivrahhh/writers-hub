<script setup>
import { computed, onUpdated, ref } from 'vue';

const props = defineProps({
    title: String,
    isActive: Boolean,
    type: {
        type: String,
        default: 'success,'
    },
    message: String,
})

const active = ref(props.isActive)

const icon = computed(() => {
    if(props.type === 'danger') {
        return 'fa-solid fa-triangle-exclamation text-red-600'
    } else {
        return 'fa-regular fa-circle-check text-green-600'
    }
})

const dismiss = () => {
    active.value = false
}

onUpdated(() => {
    active.value = props.isActive
})
</script>

<template>
    <Transition 
        enter-active-class="transition-all ease-out duration-300"
        enter-from-class="transform translate-x-full opacity-0"
        enter-to-class="transform translate-x-0 opacity-100"
        leave-active-class="transition-all ease-out duration-300"
        leave-from-class="transform translate-x-0 opacity-100"
        leave-to-class="transform translate-x-full opacity-0" >
        <div v-if="active" class="fixed bottom-8 right-8 origin-bottom-right w-96 shadow-lg bg-white ring-1 ring-black ring-opacity-5 rounded-lg p-4">
            <div class="flex items-center justify-between mb-3 text-sm font-semibold">
                <div class="flex items-center gap-2">
                    <i :class="icon"></i>{{ props.title }}
                </div>
                <i class="fa-solid fa-xmark text-gray-400 hover:text-gray-700 cursor-pointer" @click="dismiss"></i>
            </div>
            <span class="text-sm text-gray-600 overflow-hidden">
                {{ props.message }}
            </span>
        </div>
    </Transition>
</template>