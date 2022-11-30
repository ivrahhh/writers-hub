<script setup>
import Toast from '@/Components/Toast.vue';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    status: String,
})

const form = useForm()

const verificationSent = computed(() => props.status === 'verification-link-sent')
const active = ref(false)

const send = () => {
    form.post(route('verification.send'), {
        onSuccess: () => {
            active.value = verificationSent.value
            setTimeout(() => active.value = false, 5000)
        }
    })
}
</script>

<template>
    <Head title="Verify Email" />

    <header>
        <nav class="flex items-center p-4">
            <div class="ml-auto">
                <Link as="button" method="POST" :href="route('logout')" class="px-4 py-2 text-sm hover:bg-slate-900 rounded-lg hover:text-white transition ease-in-out duration-200 font-semibold">Logout</Link>
            </div>
        </nav>
    </header>
    <AuthenticationLayout>
        <div class="form-container">
            <form @submit.prevent="send" class="space-y-4">
                <p class="text-sm">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
            we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </p>
                <button type="submit" class="form-submit bg-slate-900 hover:bg-slate-800 text-white" :disabled="form.processing">Resend Verification Link</button>
            </form>
        </div>
        <Toast
            :isActive="active"
            title="Verification Link Sent"
            message="The email verification link has been sent to your email." 
            type="success" />
    </AuthenticationLayout>
</template>