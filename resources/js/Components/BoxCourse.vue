<script setup>
import { Link } from "@inertiajs/vue3";
import BadgeCategory from "./BadgeCategory.vue";
import { computed, onMounted } from "vue";

const props = defineProps({
    categoryClass: {
        type: String,
        required: true,
    },
    backgroundBadge: {
        type: String,
        required: true,
    },
    iconBadge: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    teacher: {
        type: String,
        required: true,
    },
    teachersJob: {
        type: String,
        required: true,
    },
    avatar: {
        type: String,
        required: true,
    },
    level: {
        type: Number,
        required: true,
    },
    slug: {
        type: String,
        required: true,
    },
    thumbnail: {
        type: String,
        required: true,
    },
});

const bars = computed(() => {
    const levels = [
        { height: "h-3", color: "bg-primary" },
        { height: "h-5", color: "bg-neutral-50" },
        { height: "h-7", color: "bg-neutral-50" },
    ];

    return levels.map((bar, index) => {
        if (index < props.level) {
            bar.color = "bg-primary";
        }
        return bar;
    });
});
</script>
<template>
    <Link
        :href="`/courses/${slug}`"
        class="h-[25rem] w-full rounded-2xl border border-neutral-90 overflow-hidden relative group"
    >
        <img
            :src="thumbnail"
            class="h-full w-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105"
            alt=""
        />
        <div
            class="absolute h-full w-full bottom-0 bg-box-course py-2 px-4 flex flex-col justify-end gap-3"
        >
            <!-- Category -->
            <BadgeCategory
                :category="categoryClass"
                :backgroundColor="backgroundBadge"
                :icons="iconBadge"
            />
            <!-- Title -->
            <h1
                class="text-xl-plus text-neutral-10 font-bold h-[4.6875rem] mb-3"
            >
                {{ title }}
            </h1>
            <!-- Mentor -->
            <div class="flex justify-between items-center py-3">
                <div class="flex gap-2 items-center">
                    <img
                        :src="avatar"
                        class="size-8 object-cover rounded-full"
                        alt=""
                    />

                    <div>
                        <p class="text-neutral-20 font-bold text-sm mb-1">
                            {{ teacher }}
                        </p>
                        <p class="text-neutral-40 -mt-1.5 text-sm">
                            {{ teachersJob }}
                        </p>
                    </div>
                </div>
                <div class="flex items-end gap-[0.13rem]">
                    <div
                        v-for="(bar, index) in bars"
                        :key="index"
                        :class="`w-2 ${bar.height} ${bar.color} rounded-[6.25rem]`"
                    ></div>
                </div>
            </div>
        </div>
    </Link>
</template>
