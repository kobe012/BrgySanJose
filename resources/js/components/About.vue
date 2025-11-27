<script setup>
import { onMounted } from 'vue'
import { animate, inView } from 'motion'

defineOptions({ name: 'HomeAbout' })

onMounted(() => {
  // Animate the background container
  inView('.about-sect', (el) => {
    animate(
      el,
      { opacity: [0,1], y: [-50, 0] },
      { duration: 1, easing: [0.17, 0.55, 0.55, 1] },
    )
    return () => {
      el.style.opacity = 0
      el.style.transform = 'translateY(-50px)'
    }
  })

  // Animate the content
  inView('.about', (el) => {
    animate(
      el,
      { opacity: [0,1], y: [-50, 0] },
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
  <div class="about rounded-2xl sm:rounded-3xl shadow-2xl p-4 sm:p-6 md:p-10 mx-4 sm:mx-6 md:mx-10 my-8 opacity-10 backdrop-blur-md">
    <div class="about-sect service-sect max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 w-full" id="about-us">

      <!-- Section Title -->
      <div class="text-center mb-8 sm:mb-10 md:mb-12">
        <h2 class="drop-shadow-lg text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-700 mb-4 select-none bg-white/80 px-4 sm:px-6 py-2 rounded-lg inline-block">
          About Us
        </h2>
      </div>

      <!-- Content Card -->
      <div class="max-w-4xl mx-auto px-4 sm:px-6 md:px-8 lg:px-10 min-h-[300px] sm:min-h-[350px] md:min-h-96 w-full select-none bg-white/90 rounded-2xl sm:rounded-3xl shadow-2xl p-6 sm:p-8 md:p-10">

        <!-- Logo -->
        <div class="flex justify-center mb-4 sm:mb-6">
          <img
            src="/images/logo/logomain.png"
            alt="Barangay Logo"
            class="h-24 w-24 sm:h-28 sm:w-28 md:h-36 md:w-36 rounded-full border-2 sm:border-3 md:border-4 border-green-600 shadow-lg bg-white p-2"
            draggable="false"
          />
        </div>

        <!-- First Paragraph -->
        <p class="bg-[#3c9cbc] bg-gradient-to-br from-[#3c9cbc] to-[#79cd37] rounded-lg sm:rounded-xl drop-shadow-lg text-white font-semibold sm:font-bold text-sm sm:text-base md:text-lg lg:text-xl text-center max-w-3xl mx-auto mb-4 sm:mb-5 md:mb-6 p-4 sm:p-5 md:p-6 border border-green-200 sm:border-2 leading-relaxed">
          Barangay San Jose, Tagaytay City is a charming and serene community that blends urban
          convenience with a countryside ambiance. Situated in the cool and breezy uplands of Cavite,
          it offers picturesque views of lush greenery and the iconic Taal Lake. The barangay is a
          vibrant area, home to local businesses, cozy residential neighborhoods, and welcoming
          establishments catering to tourists and residents.
        </p>

        <!-- Second Paragraph -->
        <p class="bg-[#3c9cbc] bg-gradient-to-br from-[#3c9cbc] to-[#79cd37] rounded-lg sm:rounded-xl drop-shadow-lg text-white font-semibold sm:font-bold text-sm sm:text-base md:text-lg lg:text-xl text-center max-w-3xl mx-auto p-4 sm:p-5 md:p-6 border border-green-200 sm:border-2 leading-relaxed">
          Under the leadership of Barangay Captain Hon. Joey Desingaño, the community has thrived,
          focusing on development initiatives that enhance the quality of life for its residents. His
          dedication to service and community engagement has further strengthened the bond among the
          residents.
        </p>
      </div>

    </div>
  </div>
</template>

<style scoped>
/* Optional: Add smooth scrolling behavior */
#about-us {
  scroll-margin-top: 80px;
}
</style>
