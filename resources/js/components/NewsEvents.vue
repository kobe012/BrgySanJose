<script setup>
import SGLGB from '@/../../public/images/news/SGLGB.jpg'
import KALINISA from '@/../../public/images/news/KALINISA.jpg'
import HAPAG from '@/../../public/images/news/HAPAG.jpg'
import { onMounted } from 'vue'
import { animate, inView } from 'motion'
import { Link } from '@inertiajs/vue3'
const newsItems = [
    {
        id: 1,
        title: 'Barangay San Jose, Tagaytay City: 2024 SGLGB National Passer! 🌠🏆',
        image: SGLGB,
        link: 'https://www.facebook.com/share/p/12GGatYmEGV/', },
    {
        id: 2,
        title: 'Barangay San Jose receives Kalinisan, Barco, and Hapag awards! 🌟🏆',
        image: KALINISA,
        link: 'https://www.facebook.com/share/p/1DCsGEgrCA/',
    },
    {
        id: 3,
        title: '🌱✨ Congratulations, Barangay San Jose! ✨🌱',
        image: HAPAG,
        link: 'https://www.facebook.com/share/p/19z1Tz9cFr/',
    },
]
onMounted(() => {
    // Animate the background container
    inView('.news-back', (el) => {
        animate(
            el,
            { opacity: [0, 1], y: [-50, 0] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] },
        )
        return () => {
            el.style.opacity = 0
            el.style.transform = 'translateY(-100px)'
        }
    })

    // Animate the content as before
    inView('.news-sec', (el) => {
        animate(
            el,
            { opacity: [0, 1], y: [-50, 0] },
            { duration: 1, easing: [0.1, 0.1, 0.1, 0.9] },
        )
        return () => {
            el.style.opacity = 0
            el.style.transform = 'translateY(-100px)'
        }
    })
})
</script>

<template>
    <div class="news-back opacity-10 backdrop-blur-md rounded-3xl shadow-2xl p-10 mx-2 md:mx-10 my-8" id="news-events">
        <div class="news-sec max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 w-full mt-8 mb-20">
            <!-- Section Title -->
            <div class="text-center mb-12">
                <h2
                    class="text-4xl font-extrabold text-green-700 mb-4 bg-white/80 px-8 py-4 rounded-lg drop-shadow-lg inline-block">
                    News & Events
                </h2>
                <br />
                <p class="text-xl text-green-900 bg-white/70 px-6 py-2 rounded-lg inline-block">
                    Stay updated with our latest news and events
                </p>
            </div>

            <div class="news-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 my-8">
                <div v-for="item in newsItems" :key="item.id"
                    class="news-card bg-white/90 rounded-2xl overflow-hidden shadow-2xl border-2 border-green-300 transition-transform hover:scale-105 hover:shadow-green-400">
                    <div class="relative group">
                        <img :src="item.image" :alt="item.title" class="w-full h-64 object-cover" draggable="false" />
                        <div
                            class="absolute inset-0 bg-linear-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="flex space-x-4">
                                <a :href="item.image"
                                    class="text-white bg-green-600 p-2 rounded-full hover:bg-green-700"
                                    title="View Image" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </a>
                                <a :href="item.link" target="_blank"
                                    class="text-white bg-green-600 p-2 rounded-full hover:bg-green-700"
                                    title="More Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-green-700 mb-2">{{ item.title }}</h4>
                    </div>
                </div>
            </div>

            <div class="w-full grid items-center justify-center">
                <Link :href="route('news-and-events')"
                    class="p-2 bg-white rounded-3xl shadow-2xl border-2 border-green-300 transition-transform hover:scale-105 hover:shadow-green-400">
                See More
                </Link>
            </div>
        </div>
    </div>
</template>
