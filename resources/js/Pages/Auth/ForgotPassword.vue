<script setup>
import TextBox from '@/Components/TextBox.vue';
import Toast from '@/Components/Toast.vue';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    status: String,
})

const form = useForm({
    email: '',
})

const passwordResetLinkSent = computed(() => props.status === 'password-reset-request-sent')
const active = ref(false)

const request = () => {
    form.post(route('password.email'), {
        onSuccess: () => {
            form.reset()
            active.value = passwordResetLinkSent.value
            setTimeout(() => active.value = false, 5000)
        }
    })
}
</script>

<template>
    <AuthenticationLayout>
        <div class="form-container">
            <form @submit.prevent="request" class="space-y-4">
                <p class="text-sm">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
                </p>
                <div>
                    <label for="email" class="form-label">Email Address</label>
                    <TextBox type="email" id="email" v-model="form.email" placeholder="example@email.com" autocomplete="email" />
                    <span v-if="form.errors.email" class="text-xs text-red-600">{{ form.errors.email }}</span>
                </div>
                <button type="submit" class="form-submit bg-slate-900 hover:bg-slate-800 text-white" :disabled="form.processing">Submit Request</button>
            </form>
        </div>
        <span class="text-gray-500 text-xs">&copy; 2022</span>
        <Toast
            :isActive="active"
            title="Reset Link Sent"
            message="We have emailed your password reset link!" 
            type="success" />
    </AuthenticationLayout>
</template>