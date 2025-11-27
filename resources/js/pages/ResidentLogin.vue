<script setup>
import Layout from '@/layouts/Layout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = ref({
    email: '',
    password: '',
});
const errors = ref({});

const submit = () => {
    router.post(route('resident.login.store'), form.value, {
        onError: (e) => {
            errors.value = e;
        },
    });
};
</script>

<template>
    <Layout>
        <div class="mx-auto mt-12 max-w-md rounded-xl bg-white p-8 shadow">
            <h1 class="mb-6 text-center text-2xl font-bold">Login</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label>Email</label>
                    <input v-model="form.email" type="email" required class="w-full rounded border px-3 py-2" />
                    <div v-if="errors.email" class="mt-1 text-xs text-red-500">{{ errors.email }}</div>
                </div>
                <div>
                    <label>Password</label>
                    <input v-model="form.password" type="password" required class="w-full rounded border px-3 py-2" />
                    <div v-if="errors.password" class="mt-1 text-xs text-red-500">{{ errors.password }}</div>
                </div>
                <button type="submit" class="w-full rounded bg-green-600 py-2 text-white transition hover:bg-green-700">Login</button>
            </form>
        </div>
    </Layout>
</template>
