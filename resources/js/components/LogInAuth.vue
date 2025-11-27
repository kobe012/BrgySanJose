<template>
    <div class="flex min-h-screen items-center justify-center bg-gray-100">
        <div class="w-full max-w-md rounded-xl bg-white p-8 shadow-md">
            <!-- Title -->
            <h2 class="mb-2 text-2xl font-bold text-gray-800">Back to your digital life</h2>
            <p class="mb-6 text-sm text-gray-500">Choose one of the options to go</p>

            <!-- Email & Password -->
            <form @submit.prevent="login">
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="Email"
                    class="mb-3 w-full rounded-md border px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                />
                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Password"
                    class="mb-6 w-full rounded-md border px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                />

                <button type="submit" class="w-full rounded-md bg-blue-600 py-2 font-semibold text-white hover:bg-blue-700">Log in</button>
            </form>

            <!-- Divider -->
            <div class="my-6 flex items-center">
                <hr class="flex-1 border-gray-300" />
                <span class="px-2 text-sm text-gray-500">Or continue with</span>
                <hr class="flex-1 border-gray-300" />
            </div>

            <!-- OAuth Buttons -->
            <div class="flex justify-between space-x-4">
                <OAuthButton provider="google" icon="logos:google-icon" @click="oauth('google')" />
            </div>
        </div>
    </div>
</template>

<script setup>
import OAuthButton from '@/Components/Auth/OAuthButton.vue'; // Create separately //loginUsers
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const form = reactive({
    email: '',
    password: '',
});

function login() {
    router.post('/login', form);
}

function oauth(provider) {
    window.location.href = `/auth/redirect/${provider}`;
}
</script>
