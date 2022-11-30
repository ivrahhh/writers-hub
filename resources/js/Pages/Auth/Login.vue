<script setup>
import TextBox from '@/Components/TextBox.vue';
import Toast from '@/Components/Toast.vue';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { computed, onMounted, ref } from 'vue';

const props = defineProps({
    status: String,
})

const form = useForm({
    email: '',
    password: '',
    remember: '',
})

const resetSuccessful = computed(() => props.status === 'password-reset-successfully')
const active = ref(false)

const submit = () => {
    form.post(route('login.auth'), {
        onFinish: () => form.reset('password'),
    })
}

onMounted(() => {
    active.value = resetSuccessful.value
    setTimeout(() => active.value = false, 5000)
})
</script>

<template>
    <Head title="Login" />
    <AuthenticationLayout>
        <div class="form-container">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="email" class="form-label">Email Address</label>
                    <TextBox type="email" id="email" v-model="form.email" placeholder="example@email..com" autocomplete="email" />
                    <span v-if="form.errors.email" class="text-xs text-red-600">{{ form.errors.email }}</span>        
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <TextBox type="password" id="password" v-model="form.password" autocomplete="current_password" />
                    <span v-if="form.errors.password" class="text-xs text-red-600">{{ form.errors.password }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-1.5">
                        <input type="checkbox" value="1" id="remember" v-model="form.remember" class="accent-slate-900"/>
                        <label class="text-sm block" for="remember">Remember Me</label>
                    </div>
                    <Link :href="route('password.request')" class="text-sm text-blue-600">Forgot Password ?</Link>
                </div>
                <button type="submit" class="form-submit bg-slate-900 text-white hover:bg-slate-800" :disabled="form.processing">
                    Log in
                </button>
            </form>
        </div>
        <div class="block w-96 p-4 rounded-lg border border-gray-300 text-center">
            <span class="text-sm">
                Don't have a account ?
                <Link href="/register" class="text-blue-600">Create new account</Link>
            </span>
        </div>
        <span class="text-gray-500 text-xs">&copy; 2022</span>
        <Toast
            :isActive="active"
            title="Password Reset"
            message="Your password has been reset!" 
            type="success" />
    </AuthenticationLayout>
</template>