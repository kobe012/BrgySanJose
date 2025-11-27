<script setup>
import { animate, inView } from 'motion'
import { onMounted, ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import RegisterModal from './RegisterModal.vue'

const page = usePage()
const showRegisterModal = ref(false)

const services = [
    { route: 'barangay-clearance', name: 'Barangay Clearance' },
    { route: 'working-clearance', name: 'Barangay Working Clearance' },
    { route: 'water-electrical-permit', name: 'Water & Electrical Permit' },
    { route: 'fencing-building-permit', name: 'Fencing/Building Permit' },
    { route: 'business-clearance', name: 'Business Clearance' },
    { route: 'indigency-clearance', name: 'Indigency Clearance' },
]

const handleServiceClick = (service) => {
    if (!page.props.auth) {
        showRegisterModal.value = true
    } else {
        router.visit(route(service.route))
    }
}

onMounted(() => {
    inView('.service-bg-animate', (el) => {
        animate(
            el,
            { opacity: [0, 1], y: [-50, 0] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] },
        )
        return () => {
            el.style.opacity = 0
            el.style.transform = 'translateY(-50px)'
        }
    })
    inView('.service-sect', (el) => {
        animate(
            el,
            { opacity: [0, 1], y: [-50, 0] },
            { duration: 1, easing: [0.1, 0.1, 0.1, 0.9] },
        )
        return () => {
            el.style.opacity = 0
            el.style.transform = 'translateY(-50px)'
        }
    })
})
</script>

<template>
    <div
        class="service-bg-animate opacity-10 backdrop-blur-md rounded-2xl sm:rounded-3xl shadow-2xl p-4 sm:p-6 md:p-8 lg:p-10 mx-4 sm:mx-6 md:mx-10 my-6 sm:my-8">
        <div class="service-sect max-w-7xl mx-auto px-4 sm:px-6 md:px-8 lg:px-10 w-full">

            <!-- Section Header -->
            <div class="text-center mb-6 sm:mb-8 md:mb-10 lg:mb-12">
                <h2
                    class="drop-shadow-lg text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-700 mb-3 sm:mb-4 select-none bg-white/80 px-4 sm:px-6 py-2 rounded-lg inline-block">
                    Our Services
                </h2>
                <br class="hidden sm:block" />
                <p
                    class="drop-shadow-lg text-sm sm:text-base md:text-lg lg:text-xl text-green-900 select-none bg-white/70 px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg inline-block mt-2 sm:mt-0">
                    Explore our available services below
                </p>
            </div>

            <!-- Services Grid Container -->
            <div class="bg-white/90 backdrop-blur-md rounded-xl sm:rounded-2xl md:rounded-3xl p-4 sm:p-6 md:p-8 lg:p-10 shadow-2xl">
                <ul
                    class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4 md:gap-6 lg:gap-8 select-none">
                    <li v-for="service in services" :key="service.route" draggable="false"
                        class="service-card bg-gradient-to-br from-green-100 via-white to-[#b6e89c] h-full shadow-lg rounded-lg sm:rounded-xl overflow-hidden transition-all duration-300 transform hover:scale-105 hover:shadow-2xl border-2 border-green-300 cursor-pointer">
                        <button type="button"
                            class="block w-full h-full text-left p-4 sm:p-5 md:p-6 lg:p-8 bg-transparent border-none outline-none focus:ring-2 focus:ring-green-500 focus:ring-inset rounded-lg sm:rounded-xl transition-all"
                            @click="handleServiceClick(service)">
                            <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-green-700 mb-1.5 sm:mb-2 leading-tight">
                                {{ service.name }}
                            </h2>
                            <p class="text-green-900 text-xs sm:text-sm md:text-base leading-relaxed">
                                Learn more about our {{ service.name.toLowerCase() }} services.
                            </p>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <RegisterModal :show="showRegisterModal" @close="showRegisterModal = false" />
    </div>
</template>

<style scoped>
/* Custom breakpoint for very small devices */
@media (min-width: 475px) {
    .xs\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

/* Ensure service cards maintain minimum height */
.service-card {
    min-height: 140px;
}

@media (min-width: 640px) {
    .service-card {
        min-height: 160px;
    }
}

@media (min-width: 1024px) {
    .service-card {
        min-height: 180px;
    }
}

/* Smooth hover animation */
.service-card:hover {
    animation: pulse-border 1.5s infinite;
}

@keyframes pulse-border {
    0%, 100% {
        border-color: rgb(134, 239, 172);
    }
    50% {
        border-color: rgb(34, 197, 94);
    }
}

/* Improve touch targets on mobile */
@media (hover: none) and (pointer: coarse) {
    .service-card button {
        min-height: 140px;
    }
}
</style>
