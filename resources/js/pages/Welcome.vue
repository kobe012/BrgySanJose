<script setup>
import Layout from '@/layouts/Layout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted, defineAsyncComponent } from 'vue';
import { animate, inView } from 'motion';

// Lazy-loaded components
const ServiceSection = defineAsyncComponent(() => import('@/components/ServiceSection.vue'));
const About = defineAsyncComponent(() => import('@/components/About.vue'));
const NewsEvents = defineAsyncComponent(() => import('@/components/NewsEvents.vue'));
const Gmaps = defineAsyncComponent(() => import('@/components/Gmaps.vue'));
const Contacts = defineAsyncComponent(() => import('@/components/Contacts.vue'));
const BarangayOfficials = defineAsyncComponent(() => import('@/components/BarangayOfficials.vue'));

const showHero = ref(true);

onMounted(() => {
    animate('.hero-content', {
        opacity: [0, 1],
        y: [100, 0],
    }, { duration: 1 });

    inView('.hero', (el) => {
        animate(el, { opacity: 1, y: [-100, 0] }, {
            duration: 0.9,
            easing: [0.17, 0.55, 0.55, 1],
        });
        return () => animate(el, { opacity: 0, y: -100 }, { duration: 1 });
    });
});

const goToSection = (elementId) => {
    const element = document.getElementById(elementId);
    if (element) {
        const headerHeight = document.querySelector('header')?.offsetHeight || 0;
        const offset = headerHeight + 20;
        const offsetPosition = element.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
    }
};

onMounted(() => {
    const hash = window.location.hash?.substring(1)
    console.log(usePage().props)
    if (hash) {
        setTimeout(() => {
            const el = document.getElementById(hash)
            const headerOffset = document.querySelector('header')?.offsetHeight || 0
            if (el) {
                const elementPosition = el.getBoundingClientRect().top + window.pageYOffset
                const offsetPosition = elementPosition - headerOffset - 20

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth',
                })
            }
        }, 300)
    }
})
</script>

<template>
    <div>
        <ResidentLoginModal :show="showLoginModal" @close="showLoginModal = false" />
    </div>
    <Layout>
        <Head>
            <title>Barangay San Jose, Tagaytay City</title>
            <meta name="description" content="Official website of Barangay San Jose, Tagaytay City." />
        </Head>

        <main>
            <!-- Hero Section -->
            <div class="hero relative w-full min-h-screen overflow-hidden flex flex-col items-center justify-center px-4">
                <!-- Background Image with Overlay -->
                <div class="absolute inset-0 bg-black/60">
                    <img src="/images/logo/UPDATEDTODAY.svg"
                         alt="Tagaytay Background"
                         class="w-full h-full object-cover"
                         draggable="false" />
                </div>

                <!-- Hero Content Card -->
                <Transition name="fade">
                    <div v-if="showHero"
                        class="hero-content relative z-10 text-center w-full max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-3xl mx-auto px-4 sm:px-6 md:px-8 py-8 sm:py-12 md:py-16 rounded-xl sm:rounded-2xl md:rounded-3xl bg-white/20 shadow-2xl border-2 md:border-4 border-green-600 backdrop-blur-md">

                        <!-- Close Button -->
                        <button @click="showHero = false"
                            class="absolute top-2 right-2 sm:top-3 sm:right-3 text-green-900 hover:text-red-600 text-xl sm:text-2xl font-bold bg-white/70 rounded-full w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center shadow-md transition-colors duration-200">
                            &times;
                        </button>

                        <!-- Title -->
                        <h1 class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-extrabold text-green-700 mb-3 sm:mb-4 leading-tight">
                            Welcome to Barangay San Jose
                        </h1>

                        <!-- Subtitle -->
                        <p class="text-base sm:text-lg md:text-2xl lg:text-3xl text-green-900 font-semibold mb-6 sm:mb-8">
                            Tagaytay City • Team Effort • Team Work
                        </p>

                        <!-- Buttons Container -->
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-stretch sm:items-center">
                            <!-- Our Services Button -->
                            <a href="#services"
                               @click.prevent="goToSection('services')"
                               class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-5 sm:px-6 md:px-8 py-3 text-sm sm:text-base md:text-lg font-bold rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105 text-center">
                                Our Services
                            </a>

                            <!-- Contact Us Button -->
                            <a href="#contact"
                               @click.prevent="goToSection('contact')"
                               class="w-full sm:w-auto bg-white hover:bg-gray-100 text-green-700 px-5 sm:px-6 md:px-8 py-3 text-sm sm:text-base md:text-lg font-bold rounded-lg shadow-lg border-2 border-green-600 transition-all duration-300 hover:shadow-xl hover:scale-105 text-center">
                                Contact Us
                            </a>

                            <!-- Official Login Button -->
                            <Link :href="route('login')"
                                class="w-full sm:w-auto bg-white hover:bg-gray-100 text-green-700 px-5 sm:px-6 md:px-8 py-3 text-sm sm:text-base md:text-lg font-bold rounded-lg shadow-lg border-2 border-green-600 transition-all duration-300 hover:shadow-xl hover:scale-105 text-center">
                                Official Login
                            </Link>
                        </div>
                    </div>
                </Transition>
            </div>

            <!-- Content Sections -->
            <section id="services" class="section-animate mt-10 sm:mt-20 px-4 sm:px-6 lg:px-8">
                <ServiceSection />
            </section>

            <section id="about" class="section-animate my-8 px-4 sm:px-6 lg:px-8">
                <About />
            </section>

            <section class="section-animate my-8 px-4 sm:px-6 lg:px-8">
                <BarangayOfficials />
            </section>

            <section id="news-events" class="section-animate my-8 px-4 sm:px-6 lg:px-8">
                <NewsEvents />
            </section>

            <section id="contact" class="section-animate py-10 sm:py-16 my-8 px-4 sm:px-6 lg:px-8">
                <div class="container mx-auto">
                    <Gmaps />
                    <Contacts />
                </div>
            </section>
        </main>
    </Layout>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Ensure hero content never overflows */
.hero-content {
    max-height: 90vh;
    overflow-y: auto;
}

/* Custom scrollbar for hero content if needed */
.hero-content::-webkit-scrollbar {
    width: 6px;
}

.hero-content::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

.hero-content::-webkit-scrollbar-thumb {
    background: rgba(34, 197, 94, 0.5);
    border-radius: 10px;
}

.hero-content::-webkit-scrollbar-thumb:hover {
    background: rgba(34, 197, 94, 0.7);
}
</style>
