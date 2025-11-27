<script setup>
import ResidentLoginModal from '@/components/ResidentLoginModal.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';

defineProps({
    isHome: Boolean,
});

const page = usePage();
const mobileMenu = ref(false);
const showLoginModal = ref(false);

const scrollToTop = () => {
    if (typeof window !== 'undefined') {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
};

const goToSection = (elementId) => {
    const element = document.getElementById(elementId);
    if (element) {
        const headerHeight = document.querySelector('header')?.offsetHeight || 0;
        const offset = headerHeight + 20;

        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth',
        });
    }
};

function signOut() {
    router.post(
        route('logout'),
        {},
        {
            onFinish: () =>
                Swal.fire({
                    title: 'Logging out!',
                    toast: true,
                    timer: 1000,
                    timerProgressBar: true,
                    position: 'top-right',
                }).then(() => {
                    location.reload();
                }),
        },
    );
}

const openLogin = () => {
    showLoginModal.value = true;
    mobileMenu.value = false; // Close mobile menu when opening login
};
</script>

<template>
    <header
        class="sticky top-0 z-50 w-full border-b-2 border-green-600 bg-gradient-to-br from-[#79cd37] via-[#b6e89c] to-[#3c9cbc] shadow-2xl backdrop-blur-md sm:border-b-3 md:border-b-4"
    >
        <nav class="w-full px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between sm:h-18 md:h-20">
                <!-- Logo and Title -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <img
                        src="images/logo/logomain.png"
                        alt="Barangay Logo"
                        class="h-10 w-10 rounded-full border border-green-600 bg-white p-0.5 shadow sm:h-12 sm:w-12 sm:border-2 sm:p-1 md:h-14 md:w-14"
                    />
                    <Link
                        :href="route('home')"
                        class="hidden rounded-lg bg-white/80 px-3 py-1.5 text-lg font-extrabold tracking-wide text-green-800 drop-shadow-lg transition-colors hover:bg-white/90 lg:block xl:px-4 xl:py-2 xl:text-2xl"
                    >
                        Barangay San Jose Tagaytay City
                    </Link>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden items-center space-x-2 lg:flex xl:space-x-4">
                    <button
                        v-if="isHome"
                        @click.prevent="scrollToTop"
                        class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                    >
                        Home
                    </button>
                    <Link
                        v-else
                        :href="route('home')"
                        class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                    >
                        Home
                    </Link>

                    <template v-if="isHome">
                        <a
                            href="#services"
                            @click.prevent="goToSection('services')"
                            class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                        >
                            Services
                        </a>
                        <a
                            href="#about"
                            @click.prevent="goToSection('about')"
                            class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                        >
                            About
                        </a>
                        <a
                            href="#news-events"
                            @click.prevent="goToSection('news-events')"
                            class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                        >
                            News & Events
                        </a>
                        <a
                            href="#contact"
                            @click.prevent="goToSection('contact')"
                            class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                        >
                            Contact
                        </a>
                    </template>
                    <template v-else>
                        <Link
                            :href="route('home') + '#services'"
                            class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                        >
                            Services
                        </Link>
                        <Link
                            :href="route('home') + '#about'"
                            class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                        >
                            About
                        </Link>
                        <Link
                            :href="route('home') + '#news-events'"
                            class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                        >
                            News & Events
                        </Link>
                        <Link
                            :href="route('home') + '#contact'"
                            class="rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                        >
                            Contact
                        </Link>
                    </template>

                    <!-- Show Login button if not logged in -->
                    <button
                        v-if="!page.props.auth"
                        @click="openLogin"
                        class="rounded-lg bg-green-600 px-3 py-2 text-base font-bold text-white shadow transition-colors hover:bg-green-700 xl:px-4 xl:text-lg"
                    >
                        Login
                    </button>

                    <!-- Dropdown for Authenticated Users -->
                    <div class="group relative" v-else>
                        <button
                            class="flex items-center rounded-lg px-3 py-2 text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white xl:px-4 xl:text-lg"
                        >
                            {{ page.props.auth?.user?.name || 'User' }}
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="ring-opacity-5 invisible absolute right-0 z-50 mt-2 w-56 origin-top-right scale-95 rounded-md bg-white opacity-0 shadow-lg ring-1 ring-black transition-all duration-300 group-hover:visible group-hover:scale-100 group-hover:opacity-100"
                        >
                            <div class="py-1">
                                <Link :href="route('dashboard')" class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100">
                                    Dashboard
                                </Link>
                                <div class="my-1 border-t"></div>
                                <button @click="signOut" class="w-full px-4 py-2 text-left text-sm text-gray-700 transition-colors hover:bg-gray-100">
                                    Logout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Burger -->
                <button
                    @click="mobileMenu = !mobileMenu"
                    class="flex h-10 w-10 flex-col items-center justify-center rounded-md transition-colors hover:bg-green-200 focus:ring-2 focus:ring-green-600 focus:outline-none sm:h-12 sm:w-12 lg:hidden"
                    aria-label="Toggle Menu"
                    :aria-expanded="mobileMenu"
                >
                    <span
                        class="block h-0.5 w-6 rounded bg-green-800 transition-all duration-300 sm:h-1 sm:w-7"
                        :class="{ 'translate-y-1.5 rotate-45 sm:translate-y-2': mobileMenu }"
                    ></span>
                    <span
                        class="my-1 block h-0.5 w-6 rounded bg-green-800 transition-all duration-300 sm:h-1 sm:w-7"
                        :class="{ 'opacity-0': mobileMenu }"
                    ></span>
                    <span
                        class="block h-0.5 w-6 rounded bg-green-800 transition-all duration-300 sm:h-1 sm:w-7"
                        :class="{ '-translate-y-1.5 -rotate-45 sm:-translate-y-2': mobileMenu }"
                    ></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <transition name="fade">
                <div
                    v-if="mobileMenu"
                    class="absolute top-16 left-0 z-40 max-h-[calc(100vh-4rem)] w-full overflow-y-auto border-b-2 border-green-600 bg-gradient-to-br from-[#79cd37] via-[#b6e89c] to-[#3c9cbc] shadow-2xl sm:top-18 sm:max-h-[calc(100vh-4.5rem)] sm:border-b-3 md:top-20 md:max-h-[calc(100vh-5rem)] md:border-b-4 lg:hidden"
                >
                    <div class="flex flex-col items-center space-y-2 px-3 py-4 sm:px-4 sm:py-6">
                        <button
                            v-if="isHome"
                            @click.prevent="
                                scrollToTop();
                                mobileMenu = false;
                            "
                            class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                        >
                            Home
                        </button>
                        <Link
                            v-else
                            :href="route('home')"
                            @click="mobileMenu = false"
                            class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                        >
                            Home
                        </Link>

                        <template v-if="isHome">
                            <a
                                href="#services"
                                @click.prevent="
                                    goToSection('services');
                                    mobileMenu = false;
                                "
                                class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                Services
                            </a>
                            <a
                                href="#about"
                                @click.prevent="
                                    goToSection('about');
                                    mobileMenu = false;
                                "
                                class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                About
                            </a>
                            <a
                                href="#news-events"
                                @click.prevent="
                                    goToSection('news-events');
                                    mobileMenu = false;
                                "
                                class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                News & Events
                            </a>
                            <a
                                href="#contact"
                                @click.prevent="
                                    goToSection('contact');
                                    mobileMenu = false;
                                "
                                class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                Contact
                            </a>
                        </template>
                        <template v-else>
                            <Link
                                :href="route('home') + '#services'"
                                @click="mobileMenu = false"
                                class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                Services
                            </Link>
                            <Link
                                :href="route('home') + '#about'"
                                @click="mobileMenu = false"
                                class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                About
                            </Link>
                            <Link
                                :href="route('home') + '#news-events'"
                                @click="mobileMenu = false"
                                class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                News & Events
                            </Link>
                            <Link
                                :href="route('home') + '#contact'"
                                @click="mobileMenu = false"
                                class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                Contact
                            </Link>
                        </template>

                        <!-- Mobile Login/User Section -->
                        <div v-if="!page.props.auth" class="w-full border-t-2 border-green-600/30 pt-2">
                            <button
                                @click="openLogin"
                                class="w-full rounded-lg bg-green-600 px-4 py-2.5 text-left text-base font-bold text-white shadow transition-colors hover:bg-green-700 sm:py-3 sm:text-lg"
                            >
                                Login
                            </button>
                        </div>

                        <!-- Mobile User Menu (if authenticated) -->
                        <div v-else class="w-full space-y-2 border-t-2 border-green-600/30 pt-2">
                            <div class="px-4 py-2 text-base font-bold text-white sm:text-lg">
                                {{ page.props.auth?.user?.name || 'User' }}
                            </div>
                            <Link
                                :href="route('dashboard')"
                                @click="mobileMenu = false"
                                class="block w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-green-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                Dashboard
                            </Link>
                            <button
                                @click="
                                    signOut();
                                    mobileMenu = false;
                                "
                                class="w-full rounded-lg px-4 py-2.5 text-left text-base font-bold text-green-50 shadow transition-colors hover:bg-red-600 hover:text-white sm:py-3 sm:text-lg"
                            >
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </transition>
        </nav>
    </header>

    <!-- Resident Login Modal -->
    <ResidentLoginModal :show="showLoginModal" @close="showLoginModal = false" />
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition:
        opacity 0.3s ease,
        transform 0.3s ease;
}

.fade-enter-from {
    opacity: 0;
    transform: translateY(-10px);
}

.fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

/* Smooth scrollbar for mobile menu */
.lg\:hidden::-webkit-scrollbar {
    width: 6px;
}

.lg\:hidden::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.lg\:hidden::-webkit-scrollbar-thumb {
    background: rgba(34, 197, 94, 0.5);
    border-radius: 10px;
}

.lg\:hidden::-webkit-scrollbar-thumb:hover {
    background: rgba(34, 197, 94, 0.7);
}
</style>
