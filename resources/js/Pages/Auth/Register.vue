<script setup>
import TextBox from '@/Components/TextBox.vue';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    email: '',
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post(route('register.store'), {
        onFinish: () => form.reset('password','password_confirmation')
    })
}
</script>

<template>
    <Head title="Create account" />
    <AuthenticationLayout>
        <div class="form-container">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="email" class="form-label">Email Address</label>
                    <TextBox type="email" id="email" v-model="form.email" placeholder="example@email.com" autocomplete="email" />
                    <span v-if="form.errors.email" class="text-xs text-red-600">{{ form.errors.email }}</span>
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <TextBox type="password" id="password" v-model="form.password" autocomplete="new-password" />
                    <span v-if="form.errors.password" class="text-xs text-red-600">{{ form.errors.password }}</span>
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <TextBox type="password" id="password" v-model="form.password_confirmation" autocomplete="new-password" />
                </div>
                <button type="submit" class="form-submit bg-slate-900 text-white hover:bg-slate-800" :disabled="form.processing">Register Account</button>
            </form>
        </div>
        <div class="block w-96 p-4 rounded-lg border border-gray-300 text-center">
            <span class="text-sm">
                Already have an account ?
                <Link href="/login" class="text-blue-600 hover:underline">Log In</Link>
            </span>
        </div>
        <span class="text-gray-500 text-xs">&copy; 2022</span>
    </AuthenticationLayout>
</template>