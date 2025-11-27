<template>
    <div v-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div ref="cardRef" class="w-full max-w-sm rounded-lg bg-white p-8 shadow-lg" style="transform: translateY(-100px); opacity: 0">
            <h2 class="mb-4 text-xl font-bold">Resident Login</h2>
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
                <div class="flex justify-end gap-2">
                    <button type="button" @click="$emit('close')" class="rounded bg-gray-200 px-4 py-2 hover:bg-gray-300">Cancel</button>
                    <button
                        type="submit"
                        :disabled="processing"
                        class="rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700 disabled:opacity-50"
                    >
                        {{ processing ? 'Logging in...' : 'Login' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { animate } from 'motion';
import { nextTick, ref, watch } from 'vue';

const props = defineProps({ show: Boolean });
const emit = defineEmits(['close']);

const form = ref({ email: '', password: '' });
const errors = ref({});
const processing = ref(false);
const cardRef = ref(null);

// Animate modal drop on show
watch(
    () => props.show,
    async (val) => {
        if (val && cardRef.value) {
            await nextTick();
            animate(cardRef.value, { y: [-100, 0], opacity: [0, 1] }, { duration: 0.5, easing: 'ease-out' });
        }
    },
);

const submit = () => {
    processing.value = true;
    errors.value = {};

    router.post(route('resident.login.store'), form.value, {
        onError: (e) => {
            errors.value = e;
            processing.value = false;
        },
        onSuccess: () => {
            form.value = { email: '', password: '' };
            emit('close');
            setTimeout(() => location.reload(), 100);
        },
        onFinish: () => {
            processing.value = false;
        },
    });
};
</script>
