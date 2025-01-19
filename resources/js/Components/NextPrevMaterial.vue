<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    prevEpisode: {
        type: String,
        required: true,
    },
    nextEpisode: {
        type: String,
        required: true,
    },
    submission: {
        type: Object,
        required: false,
        default: false,
    },
    title: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div
        class="bg-neutral-10 px-6 py-5 border-t flex justify-between items-center rounded-xl fixed w-full"
    >
        <Link
            :href="prevEpisode"
            class="flex gap-2 items-center p-3 border-2 boder-neutral-50 !border-b-[6px] hover:bg-neutral-20 rounded-xl"
        >
            <img src="/media/icons/arrow-left.svg" alt="" />
            <p class="text-neutral-90 hidden lg:inline-block">
                Materi Sebelumnya
            </p>
        </Link>
        <p class="md:text-lg font-semibold lg:hidden text-center">
            {{ title }}
        </p>
        <Link
            v-if="!submission"
            :href="nextEpisode"
            class="flex gap-2 items-center p-3 border-2 boder-neutral-50 !border-b-[6px] hover:bg-neutral-20 rounded-xl"
        >
            <p class="text-neutral-90 hidden lg:inline-block">
                Materi Selanjutnya
            </p>
            <img src="/media/icons/arrow-left.svg" class="rotate-180" alt="" />
        </Link>
    </div>
</template>
