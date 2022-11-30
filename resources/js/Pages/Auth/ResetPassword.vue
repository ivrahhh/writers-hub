<script setup>
import TextBox from '@/Components/TextBox.vue';
import Toast from '@/Components/Toast.vue';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    email: String,
    token: String,
    status: String,
})

const form = useForm({
    email: props.email,
    token: props.token,
    password: '',
    password_confirmation: '',
})

const invalidToken = computed(() => props.status === 'invalid-token')
const active = ref(false)

const resetPassword = () => {
    form.put(route('password.update'), {
        onFinish: () => form.reset('password','password_confirmation'),
        onSuccess: () => {
            active.value = invalidToken.value
            setTimeout(() => active.value = false, 5000)
        }
    })
}
</script>

<template>
    <Head title="Reset Password" />
    <AuthenticationLayout>
        <div class="form-container">
            <form @submit.prevent="resetPassword" class="space-y-4">
                <div>
                    <label for="email" class="form-label">Email Address</label>
                    <TextBox type="email" id="email" v-model="form.email" readonly />
                    <span v-if="form.errors.email" class="text-xs text-red-600">{{ form.errors.email }}</span>
                </div>
                <div>
                    <label for="password" class="form-label">New Password</label>
                    <TextBox type="password" id="password" v-model="form.password" autocomplete="new-password" />
                    <span v-if="form.errors.password" class="text-xs text-red-600">{{ form.errors.password }}</span>
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <TextBox type="password" id="password_confirmation" v-model="form.password_confirmation" />
                </div>
                <button type="submit" class="form-submit bg-slate-900 hover:bg-slate-800 text-white" :disabled="form.processing">Reset Password</button>
            </form>
        </div>
        <Toast
            :isActive="active"
            title="Invalid Reset Token"
            message="This password reset token is invalid." 
            type="danger" />
    </AuthenticationLayout>
</template>