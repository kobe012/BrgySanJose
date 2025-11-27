<script setup>
import { useForm, Head, router, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

// Show/hide password toggle
const showPassword = ref(false)

// Access flash messages from Laravel
const page = usePage()
const flash = page.props.flash

// Form data
const form = useForm({
    username: '',
    password: '',
    remember: false,
})

// Handle login
const handleLogin = () => {
    form.post(route('login'), {
        onSuccess: () => {
            router.visit(route('dashboard')) // Adjust route name if needed
        },
        onError: () => {
            // Errors are already handled below
        },
    })
}
</script>

<template>
    <div class="flex items-center justify-center min-h-screen bg-green-600">

        <Head title="Official Login" />

        <form @submit.prevent="handleLogin" autocomplete="off" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
            <h2 class="text-xl font-bold mb-4 text-green-700 text-center">Barangay Official Login</h2>

            <!-- Flash message -->
            <div v-if="flash?.message" class="bg-green-100 text-green-800 text-sm p-3 rounded mb-3">
                {{ flash.message }}
            </div>

            <!-- Error messages -->
            <div v-if="form.hasErrors" class="bg-red-100 text-red-800 text-sm p-3 rounded mb-3">
                <div v-for="(error, key) in form.errors" :key="key">{{ error }}</div>
            </div>

            <!-- Username -->
            <input v-model="form.username" type="text" placeholder="Username" required
                class="w-full p-2 border border-green-400 rounded mb-3 focus:ring-2 focus:ring-green-500 focus:outline-none" />

            <!-- Password with toggle -->
            <div class="relative mb-3">
                <input :type="showPassword ? 'text' : 'password'" v-model="form.password" placeholder="Password"
                    required
                    class="w-full p-2 border border-green-400 rounded focus:ring-2 focus:ring-green-500 focus:outline-none pr-10" />
                <button type="button" @click="showPassword = !showPassword"
                    class="absolute right-2 top-2 text-sm text-gray-600">
                    {{ showPassword ? '🙈 Hide' : '👁️ Show' }}
                </button>
            </div>

            <!-- Remember Me -->
            <label class="flex items-center text-sm mb-4 text-gray-700">
                <input type="checkbox" v-model="form.remember" class="mr-2" />
                Remember Me
            </label>

            <!-- Login Button -->
            <button type="submit" :disabled="form.processing"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                {{ form.processing ? 'Logging in...' : 'Login' }}
            </button>
        </form>


        <!-- Google OAuth Login -->
        <!-- <a :href="route('login.google')"
            class="mt-4 w-full max-w-sm bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition text-center block">
            Login with Google
        </a> --> <!--not fix yet, need to bring up -->
    </div>
</template>
