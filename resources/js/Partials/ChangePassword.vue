<script setup>
import TextBox from '@/Components/TextBox.vue';
import Toast from '@/Components/Toast.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { computed, inject, ref } from 'vue';

const props = defineProps({
    status: String,
})

const form = useForm({
    password: '',
    new_password: '',
    new_password_confirmation: '',
})

const passwordChange = computed(() => props.status === 'password-changed-successfully' )
const active = ref(false)

const resetPassword = () => {
    form.patch(route('user.profile.update.password'), {
        onFinish: () => {
            form.reset()
        },
        onSuccess: () => {
            form.reset()
            active.value = passwordChange.value
            setTimeout(() => active.value = false, 5000)
        }
    })
}
</script>

<template>
    <div class="w-full rounded-lg shadow p-4 bg-white flex">
        <div class="flex-1 px-4">
            <span class="block mb-2 font-semibold">Change Password</span>
            <p class="text-sm text-gray-500">
                Change your current password with your new one.
            </p>
        </div>
        <form @submit.prevent="resetPassword" class="space-y-4 flex-1">
            <div>
                <label for="password" class="form-label">Current Password</label>
                <TextBox type="password" id="password" v-model="form.password" autocomplete="current-password" />
                <span v-if="form.errors.password" class="text-xs text-red-600">{{ form.errors.password }}</span>   
            </div>
            <div>
                <label for="new_password" class="form-label">New Password</label>
                <TextBox type="password" id="new_password" v-model="form.new_password" autocomplete="new-password" />
                <span v-if="form.errors.new_password" class="text-xs text-red-600">{{ form.errors.new_password }}</span>   
            </div>
            <div>
                <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                <TextBox type="password" id="new_password_confirmation" v-model="form.new_password_confirmation" autocomplete="new-password" />
            </div>

            <button type="submit" class="form-submit bg-slate-900 text-white hover:bg-slate-800" :disabled="form.processing">
                    Change Password
            </button>
        </form>
    </div>

<Toast 
    :is-active="active"
    title="Password Change"
    message="Your password has been change successfully"
    type="success" />
</template>