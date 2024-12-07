<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

// Dummy data untuk carousel
const props = defineProps({
    testimonials: {
        type: Array,
        required: true,
    },
});

// Ref untuk posisi scroll
const carouselRef = ref(null);
let autoScrollInterval = null;

const startAutoScroll = () => {
    if (carouselRef.value) {
        autoScrollInterval = setInterval(() => {
            carouselRef.value.scrollLeft += 1;
        }, 16); // Smooth scrolling interval
    }
};

const stopAutoScroll = () => {
    if (autoScrollInterval) {
        clearInterval(autoScrollInterval);
        autoScrollInterval = null;
    }
};

onMounted(() => {
    startAutoScroll();
});

onBeforeUnmount(() => {
    stopAutoScroll();
});
</script>

<template>
    <div class="relative">
        <div
            class="absolute top-0 left-0 h-full w-[10%] bg-gradient-to-r from-white to-transparent pointer-events-none z-10"
        ></div>

        <!-- Carousel -->
        <div
            ref="carouselRef"
            class="flex overflow-x-auto gap-6 no-scrollbar relative"
        >
            <div
                v-for="(testimonial, index) in [
                    ...testimonials,
                    ...testimonials,
                ]"
                :key="index"
                class="min-w-96 max-w-96 xl:min-w-[30rem] xl:max-w-[30rem] flex-shrink-0 border-2 border-neutral-50 bg-neutral-20 p-6 rounded-2xl"
            >
                <p
                    class="xl:text-lg xl:leading-[1.60125rem] h-32 text-neutral-80"
                >
                    {{ testimonial.body }}
                </p>
                <div
                    class="flex gap-3 items-center border rounded-xl border-neutral-50 p-2 xl:p-3"
                >
                    <img
                        :src="testimonial.user.profile_picture"
                        class="size-[3.125rem] rounded-lg"
                        alt=""
                    />
                    <div>
                        <h2 class="text-neutral-100 font-bold xl:text-lg">
                            {{ testimonial.user.fullname }}
                        </h2>
                        <p class="-mt-1 text-neutral-90">
                            {{ testimonial.job }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="absolute top-0 right-0 h-full w-[10%] bg-gradient-to-l from-white to-transparent pointer-events-none z-10"
        ></div>
    </div>
</template>

<style scoped>
.no-scrollbar {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}

.no-scrollbar::-webkit-scrollbar {
    display: none; /* Chrome, Safari, and Opera */
}
</style>
