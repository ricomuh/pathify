<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    slug: {
        type: String,
        required: true,
    },
    category: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    seatsLeft: {
        type: Number,
        required: true,
    },
    daysLeft: {
        type: Number,
        required: true,
    },
    thumbnail: {
        type: String,
        required: true,
    },
    width: {
        type: String,
        default: "w-full",
    },
});

// days left
const daysLeft = computed(() => {
    const eventDate = new Date(props.daysLeft);
    const today = new Date();
    const timeDiff = eventDate - today;
    const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
    return days;
});

const isFinished = computed(() => daysLeft.value <= 0);
</script>

<template>
    <div
        :class="`rounded-2xl text-start bg-neutral-10 border border-neutral-90 overflow-hidden ${width}`"
    >
        <img :src="thumbnail" alt="" class="w-full h-[12.5rem] object-cover" />
        <div class="p-3">
            <p class="text-primary">{{ category }}</p>
            <h1
                class="font-bold text-start text-xl-plus leading-[1.575rem] text-neutral-100 mb-3 h-20 text-wrap"
            >
                {{ title }}
            </h1>
            <Link
                :href="`/events/${slug}`"
                class="w-full text-center text-neutral-20 block rounded-xl border-b-4 border-primary-hover mb-1 bg-primary py-2"
                >Lihat Detail</Link
            >
            <div v-if="!isFinished" class="flex justify-between items-center">
                <p class="font-semibold text-neutral-90">
                    {{ seatsLeft }} Kursi Tersisa
                </p>
                <p class="text-sm text-neutral-90">{{ daysLeft }} Hari Lagi</p>
            </div>
            <p v-else class="text-sm text-end text-neutral-90">Selesai</p>
        </div>
    </div>
</template>
