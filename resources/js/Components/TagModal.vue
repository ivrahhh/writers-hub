<script setup>
import { ref } from 'vue';

const props = defineProps({
    persist: {
        type: Boolean,
        default: false,
    }
})

const active = ref(props.persist)

const form = useForm({
    tag: ''
})

const save = () => {
    form.post(route('tags.store'), {
        onFinish: () => {
            form.reset()
        }
    })
}
</script>

<template>
    <button @click="active = !active" type="button" class="text-sm flex items-center gap-2 px-4 py-3 rounded-lg shadow ring-black ring-1 ring-opacity-5 bg-slate-900 text-white hover:bg-slate-800 transition duration-200">
        <slot name="toggler" />
    </button>
    <Teleport to="body">
        <Transition
            enter-active-class="transition ease-out duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0" >
            <div class="fixed inset-0 z-40 bg-black/50" v-show="active">
                <div class="relative flex items-center justify-center h-full">
                    <div class="min-w-[24rem] flex flex-col rounded-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="px-4 py-2 rounded-t-lg border-b bg-slate-900 text-white flex items-center justify-between">
                            <span class="text-sm font-semibold">Add new Tag</span>
                            <button @click="active = false" type="button" class="hover:bg-slate-800 w-5 h-5 rounded-md flex items-center justify-center">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="flex flex-col">
                            <form @submit.prevent="save" class="space-y-4 p-4">
                                <div>
                                    <label for="tag" class="form-label">Tag</label>
                                    <TextBox type="text" id="tag" v-model="form.tag" />
                                    <span v-if="form.errors.tag" class="text-xs text-red-600">{{ form.errors.tag }}</span>
                                </div>
                            </form>
                            <div class="px-4 py-2 border-t">
                                <button type="submit" class="px-4 py-2 rounded-lg ml-auto block text-sm bg-slate-900 hover:bg-slate-800 text-white transition duration-200">Add New Tag</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>