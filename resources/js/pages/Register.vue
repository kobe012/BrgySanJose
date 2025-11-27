<script setup>
import Layout from '@/layouts/Layout.vue'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const errors = ref({})

const submit = () => {
    router.post(route('register.store'), form.value, {
        onError: (e) => {
            errors.value = e
        },
        onSuccess: () => {
            // Show success message and redirect to homepage
            Swal.fire({
                title: 'Registration Successful!',
                text: 'Your registration has been submitted. Please wait for admin approval.',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#22c55e'
            }).then(() => {
                // Redirect to homepage after closing the alert
                router.visit(route('home'))
            })
        }
    })
}
</script>

<template>
    <Layout>
        <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow mb-12">
            <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">First Name & Last Name</label>
                    <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" required />
                    <div v-if="errors.name" class="text-red-500 text-xs mt-1">{{ errors.name }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input v-model="form.email" type="email" class="w-full border rounded px-3 py-2" required />
                    <div v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input v-model="form.password" type="password" class="w-full border rounded px-3 py-2" required />
                    <div v-if="errors.password" class="text-red-500 text-xs mt-1">{{ errors.password }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input v-model="form.password_confirmation" type="password" class="w-full border rounded px-3 py-2"
                        required />
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                    Register
                </button>
                 <!-- <a :href="route('login.google')"
                    class="mt-4 w-full max-w-sm bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition text-center block">
                    Login with Google
                </a>  -->
            </form>
        </div>
    </Layout>
</template>
