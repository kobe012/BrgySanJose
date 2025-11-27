<script setup>
import { animate, inView } from 'motion'
import { onMounted } from 'vue'

onMounted(() => {
    // Animate the background container
    inView('.photo-bg', (el) => {
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

    // Animate the content
    inView('.photo-sec', (el) => {
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

    inView('.photo-sect', (el) => {
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
    <div class="photo-bg opacity-10 backdrop-blur-md rounded-2xl sm:rounded-3xl shadow-2xl p-4 sm:p-6 md:p-8 lg:p-10 mx-4 sm:mx-6 md:mx-10 my-8 text-center">

        <!-- Title -->
        <h2 class="photo-sect drop-shadow-lg text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-700 mb-4 sm:mb-6 md:mb-8 select-none bg-white/80 px-4 sm:px-6 py-2 rounded-lg inline-block text-center">
            Barangay Officials
        </h2>

        <!-- Image Container -->
        <div class="photo-sec flex justify-center rounded-lg">
            <img
                src="images/logo/officials/BarangayOfficials(Final).svg"
                alt="Barangay San Jose Tagaytay Officials"
                class="w-full max-w-6xl rounded-lg sm:rounded-xl shadow-2xl border-2 sm:border-3 md:border-4 border-green-600 bg-white/90 p-2 sm:p-3 md:p-4 object-contain"
                style="min-height: 200px;"
                draggable="false"
            />
        </div>
    </div>
</template>

<style scoped>
/* Ensure image scales properly on all devices */
.photo-sec img {
    height: auto;
    display: block;
}

/* Prevent image stretching */
@media (max-width: 640px) {
    .photo-sec img {
        min-height: 200px;
        max-height: 500px;
    }
}

@media (min-width: 641px) and (max-width: 1024px) {
    .photo-sec img {
        min-height: 300px;
        max-height: 600px;
    }
}

@media (min-width: 1025px) {
    .photo-sec img {
        min-height: 400px;
        max-height: 800px;
    }
}
</style>
