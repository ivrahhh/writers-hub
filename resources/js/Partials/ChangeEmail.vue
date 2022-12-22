<script setup>
import TextBox from '@/Components/TextBox.vue';
import Toast from '@/Components/Toast.vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, computed } from 'vue';


const props = defineProps({
    status: String,
})

const emailChanged = computed(() => props.status === 'email-change-successfully')
const active = ref(false)

const form = useForm({
    old_email: usePage().props.value.auth.user.email,
    email: '', 
})

const changeEmail = () => {
    form.patch(route('user.profile.update.email'), {
        onSuccess: () => {
            form.reset()
            active.value = emailChanged.value
            setTimeout(() => active.value = false, 5000)
        }
    })
}
</script>

<template>
    <div class="w-full rounded-lg shadow p-4 bg-white flex">
        <div class="flex-1 px-4">
            <span class="block mb-2 font-semibold">Change Email Address</span>
            <p class="text-sm text-gray-500">
                Change your current email address with your new one.
            </p>
        </div>
        <form @submit.prevent="changeEmail" class="space-y-4 flex-1">
            <div>
                <label for="oldEmail" class="form-label">Current Email Address</label>
                <TextBox type="email" id="oldEmail" v-model="form.old_email" autocomplete="email" readonly/>
                <span v-if="form.errors.old_email" class="text-xs text-red-600">{{ form.errors.old_email }}</span>   
            </div>
            <div>
                <label for="email" class="form-label">New Email Address</label>
                <TextBox type="email" id="email" v-model="form.email" autocomplete="email" />
                <span v-if="form.errors.email" class="text-xs text-red-600">{{ form.errors.email }}</span>   
            </div>

            <button type="submit" class="form-submit bg-slate-900 text-white hover:bg-slate-800" :disabled="form.processing">
                    Change Email Address
            </button>
        </form>
    </div>

<Toast 
    :is-active="active"
    title="Email Updated"
    message="Your email address has been change successfully"
    type="success" />
</template>